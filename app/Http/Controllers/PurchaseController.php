<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Package;
use App\Models\Purchase;
use App\Models\CreditTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PurchaseController extends Controller
{
    public function index()
    {
        $packages = Package::orderBy('price')->get();

        return view('purchases.index', compact('packages'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'package_id' => ['required', 'integer', 'exists:packages,id'],
            'customer_code' => ['nullable', 'string', 'max:20'],
            'name' => ['nullable', 'string', 'max:100', 'required_without:customer_code'],
        ], [
            'package_id.required' => 'Pilih paket kredit terlebih dahulu.',
            'name.required_without' => 'Isi nama lengkap, atau masukkan kode pelanggan jika kamu sudah punya.',
        ]);

        // Pelanggan lama: tambah kredit ke kodenya. Pelanggan baru: kode dibuat setelah bayar.
        $existing = null;
        $code = strtoupper(trim($data['customer_code'] ?? ''));

        if ($code !== '') {
            $existing = Customer::where('customer_code', $code)->first();

            if (!$existing) {
                return back()->withInput()->withErrors([
                    'customer_code' => 'Kode pelanggan tidak ditemukan. Pilih "Pelanggan baru" dan isi nama jika belum punya kode.',
                ]);
            }
        }

        $reference = DB::transaction(function () use ($data, $existing) {
            $customer = $existing
                ? Customer::whereKey($existing->id)->lockForUpdate()->firstOrFail()
                : Customer::create([
                    'name' => trim($data['name']),
                    'customer_code' => Customer::generateCode(),
                    'credit_balance' => 0,
                ]);

            $package = Package::findOrFail($data['package_id']);

            // Simulasi pembayaran langsung dianggap berhasil.
            $purchase = Purchase::create([
                'customer_id' => $customer->id,
                'package_id' => $package->id,
                'credits_purchased' => $package->credits,
                'amount' => $package->price,
                'payment_method' => 'simulation',
                'payment_status' => 'paid',
                'payment_reference' => 'SIM-' . strtoupper(Str::random(12)),
                'paid_at' => now(),
            ]);

            $customer->credit_balance += $package->credits;
            $customer->save();

            CreditTransaction::create([
                'customer_id' => $customer->id,
                'purchase_id' => $purchase->id,
                'booking_id' => null,
                'type' => 'purchase',
                'credits' => $package->credits,
                'balance_after' => $customer->credit_balance,
                'description' => 'Pembelian paket ' . $package->name,
            ]);

            return $purchase->payment_reference;
        });

        return redirect()->route('purchases.success', $reference);
    }

    public function success($reference)
    {
        $purchase = Purchase::with(['customer', 'package'])
            ->where('payment_reference', $reference)
            ->firstOrFail();

        return view('purchases.success', compact('purchase'));
    }
}
