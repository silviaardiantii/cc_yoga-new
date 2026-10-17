<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingReschedule;
use App\Models\CreditTransaction;
use App\Models\Customer;
use App\Models\YogaClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function create($classId)
    {
        $yogaClass = YogaClass::findOrFail($classId);

        return view('bookings.create', compact('yogaClass'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_code' => ['required', 'string', 'max:20'],
            'yoga_class_id' => ['required', 'integer', 'exists:yoga_classes,id'],
        ]);

        $customer = Customer::where(
            'customer_code',
            strtoupper(trim($data['customer_code']))
        )->first();

        if (!$customer) {
            return back()->withInput()->withErrors([
                'customer_code' => 'Kode pelanggan tidak ditemukan. Beli paket kredit dulu untuk mendapatkan kode.',
            ]);
        }

        $result = DB::transaction(function () use ($customer, $data) {
            $lockedCustomer = Customer::whereKey($customer->id)
                ->lockForUpdate()
                ->firstOrFail();

            $yogaClass = YogaClass::whereKey($data['yoga_class_id'])
                ->lockForUpdate()
                ->firstOrFail();

            $classStart = Carbon::parse(
                $yogaClass->class_date . ' ' . $yogaClass->start_time
            );

            if ($classStart->isPast()) {
                return 'past';
            }

            $existing = Booking::where('customer_id', $lockedCustomer->id)
                ->where('yoga_class_id', $yogaClass->id)
                ->whereIn('status', ['confirmed', 'rescheduled'])
                ->exists();

            if ($existing) {
                return 'duplicate';
            }

            $booked = Booking::where('yoga_class_id', $yogaClass->id)
                ->whereIn('status', ['confirmed', 'rescheduled'])
                ->lockForUpdate()
                ->count();

            if ($booked >= $yogaClass->capacity) {
                return 'full';
            }

            // Pengecekan kredit sebelum membuat booking.
            if ($lockedCustomer->credit_balance < 1) {
                return 'no_credit';
            }

            $booking = Booking::create([
                'customer_id' => $lockedCustomer->id,
                'customer_name' => $lockedCustomer->name,
                'booking_code' => 'BK-' . strtoupper(Str::random(10)),
                'yoga_class_id' => $yogaClass->id,
                'status' => 'confirmed',
                'credits_used' => 1,
            ]);

            $lockedCustomer->credit_balance -= 1;
            $lockedCustomer->save();

            CreditTransaction::create([
                'customer_id' => $lockedCustomer->id,
                'purchase_id' => null,
                'booking_id' => $booking->id,
                'type' => 'use',
                'credits' => -1,
                'balance_after' => $lockedCustomer->credit_balance,
                'description' => 'Booking kelas ' . $yogaClass->name,
            ]);

            return 'success:' . $lockedCustomer->customer_code;
        });

        if ($result === 'past') {
            return back()->withErrors([
                'booking' => 'Kelas ini sudah dimulai atau telah berlalu.',
            ]);
        }

        if ($result === 'duplicate') {
            return back()->withErrors([
                'booking' => 'Kamu sudah booking kelas ini.',
            ]);
        }

        if ($result === 'full') {
            return back()->withErrors([
                'booking' => 'Maaf, kelas ini sudah penuh.',
            ]);
        }

        if ($result === 'no_credit') {
            return redirect()
                ->route('purchases.index', [
                    'customer_code' => $customer->customer_code,
                ])
                ->with('warning', 'Saldo kredit kamu tidak cukup. Beli kredit terlebih dahulu.');
        }

        $code = substr($result, strlen('success:'));

        return redirect()
            ->route('history.index', ['customer_code' => $code])
            ->with('success', 'Booking berhasil! Satu kredit telah digunakan.');
    }

    public function history(Request $request)
    {
        $customer = null;

        if ($request->filled('customer_code')) {
            $customer = Customer::where(
                'customer_code',
                strtoupper(trim($request->query('customer_code')))
            )->first();
        }

        $bookings = $customer
            ? Booking::with('yogaClass')
                ->where('customer_id', $customer->id)
                ->latest()
                ->get()
            : collect();

        $transactions = $customer
            ? CreditTransaction::where('customer_id', $customer->id)
                ->latest()
                ->get()
            : collect();

        $availableClasses = YogaClass::whereDate('class_date', '>=', now()->toDateString())
            ->orderBy('class_date')
            ->orderBy('start_time')
            ->get();

        return view('bookings.history', compact(
            'customer',
            'bookings',
            'transactions',
            'availableClasses'
        ));
    }

    public function reschedule(Request $request, $bookingId)
    {
        $data = $request->validate([
            'customer_code' => ['required', 'string', 'max:20'],
            'yoga_class_id' => ['required', 'integer', 'exists:yoga_classes,id'],
        ]);

        $customer = Customer::where(
            'customer_code',
            strtoupper(trim($data['customer_code']))
        )->first();

        if (!$customer) {
            return back()->withErrors([
                'customer_code' => 'Kode pelanggan tidak ditemukan.',
            ]);
        }

        $result = DB::transaction(function () use ($customer, $data, $bookingId) {
            $booking = Booking::whereKey($bookingId)
                ->where('customer_id', $customer->id)
                ->lockForUpdate()
                ->first();

            if (!$booking || !in_array($booking->status, ['confirmed', 'rescheduled'])) {
                return 'invalid_booking';
            }

            $oldClass = YogaClass::whereKey($booking->yoga_class_id)
                ->lockForUpdate()
                ->firstOrFail();

            $newClass = YogaClass::whereKey($data['yoga_class_id'])
                ->lockForUpdate()
                ->firstOrFail();

            $oldStart = Carbon::parse(
                $oldClass->class_date . ' ' . $oldClass->start_time
            );

            $newStart = Carbon::parse(
                $newClass->class_date . ' ' . $newClass->start_time
            );

            // Reschedule harus dilakukan minimal 12 jam sebelum kelas lama.
            if (now()->greaterThanOrEqualTo($oldStart->copy()->subHours(12))) {
                return 'too_late';
            }

            if ($newClass->id === $oldClass->id) {
                return 'same_class';
            }

            if ($newStart->isPast()) {
                return 'new_class_past';
            }

            $duplicate = Booking::where('customer_id', $customer->id)
                ->where('yoga_class_id', $newClass->id)
                ->where('id', '!=', $booking->id)
                ->whereIn('status', ['confirmed', 'rescheduled'])
                ->exists();

            if ($duplicate) {
                return 'duplicate';
            }

            $booked = Booking::where('yoga_class_id', $newClass->id)
                ->whereIn('status', ['confirmed', 'rescheduled'])
                ->lockForUpdate()
                ->count();

            if ($booked >= $newClass->capacity) {
                return 'full';
            }

            BookingReschedule::create([
                'booking_id' => $booking->id,
                'from_yoga_class_id' => $oldClass->id,
                'to_yoga_class_id' => $newClass->id,
                'rescheduled_at' => now(),
            ]);

            $booking->yoga_class_id = $newClass->id;
            $booking->status = 'rescheduled';
            $booking->save();

            // Tidak mengurangi kredit lagi saat reschedule.
            return 'success';
        });

        $messages = [
            'invalid_booking' => 'Booking tidak ditemukan atau sudah tidak aktif.',
            'too_late' => 'Reschedule hanya dapat dilakukan paling lambat 12 jam sebelum kelas dimulai.',
            'same_class' => 'Pilih kelas yang berbeda dari kelas saat ini.',
            'new_class_past' => 'Kelas tujuan sudah dimulai atau berlalu.',
            'duplicate' => 'Kamu sudah memiliki booking aktif pada kelas tujuan.',
            'full' => 'Kelas tujuan sudah penuh.',
        ];

        if (isset($messages[$result])) {
            return back()->withErrors(['reschedule' => $messages[$result]]);
        }

        return redirect()
            ->route('history.index', ['customer_code' => $customer->customer_code])
            ->with('success', 'Jadwal berhasil diubah. Kredit tidak dipotong lagi.');
    }
}