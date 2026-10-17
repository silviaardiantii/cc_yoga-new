<?php

namespace App\Http\Controllers;

use App\Models\YogaClass;
use Carbon\Carbon;
use Illuminate\Http\Request;

class YogaClassController extends Controller
{
    public function index(Request $request)
    {
        // Menentukan bulan yang ditampilkan
        try {
            $month = $request->query('month')
                ? Carbon::createFromFormat(
                    '!Y-m',
                    $request->query('month')
                )
                : now()->startOfMonth();
        } catch (\Throwable $e) {
            $month = now()->startOfMonth();
        }

        $monthStart = $month->copy()->startOfMonth();
        $monthEnd = $month->copy()->endOfMonth();

        // Menentukan tanggal yang dipilih
        try {
            $selectedDate = $request->query('date')
                ? Carbon::parse($request->query('date'))
                : null;

            if (
                $selectedDate &&
                !$selectedDate->between(
                    $monthStart,
                    $monthEnd
                )
            ) {
                $selectedDate = null;
            }
        } catch (\Throwable $e) {
            $selectedDate = null;
        }

        // Filter jenis kelas
        $selectedType = $request->query('type', 'Semua');

        $query = YogaClass::whereBetween('class_date', [
            $monthStart->toDateString(),
            $monthEnd->toDateString(),
        ]);

        // Filter sementara berdasarkan nama kelas
        $types = [
            'Hatha' => '%Hatha%',
            'Vinyasa' => '%Vinyasa%',
            'Yin' => '%Yin%',
        ];

        if (isset($types[$selectedType])) {
            $query->where('name', 'like', $types[$selectedType]);
        } elseif ($selectedType === 'Pernapasan') {
            $query->where(function ($q) {
                $q->where('name', 'like', '%Pernapasan%')
                  ->orWhere('name', 'like', '%Breathing%');
            });
        }

        // Mengambil kelas dalam bulan tersebut
        $classes = $query
            ->orderBy('class_date')
            ->orderBy('start_time')
            ->get();

        // Mengelompokkan kelas berdasarkan tanggal
        $classesByDate = $classes->groupBy(
            fn ($class) => Carbon::parse(
                $class->class_date
            )->toDateString()
        );

        // Mengambil kelas pada tanggal yang dipilih
        $selectedClasses = $selectedDate
            ? ($classesByDate->get(
                $selectedDate->toDateString()
            ) ?? collect())
            : collect();

        return view('classes.index', [
            'month' => $monthStart,
            'monthStart' => $monthStart,
            'monthEnd' => $monthEnd,
            'classesByDate' => $classesByDate,
            'selectedDate' => $selectedDate,
            'selectedClasses' => $selectedClasses,
            'selectedType' => $selectedType,
        ]);
    }
}
