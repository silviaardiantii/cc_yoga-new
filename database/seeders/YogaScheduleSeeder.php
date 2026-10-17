<?php

namespace Database\Seeders;

use App\Models\YogaClass;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class YogaScheduleSeeder extends Seeder
{
    /** Berapa minggu jadwal dibuat ke depan, dihitung dari Senin 19 Oktober 2026. */
    private const WEEKS = 12;

    public function run(): void
    {
        $firstMonday = Carbon::parse('2026-10-19');

        // Guru per jenis kelas (ganti sesuai guru yang sebenarnya).
        $instructors = [
            'Morning Flow'    => 'Ayu Pratiwi',
            'Morning Stretch' => 'Ayu Pratiwi',
            'Hatha Yoga'      => 'Dewi Lestari',
            'Yin Yoga'        => 'Dewi Lestari',
            'Gentle Yoga'     => 'Sari Wulandari',
            'Relaxing Yoga'   => 'Sari Wulandari',
            'Vinyasa Flow'    => 'Raka Wijaya',
            'Weekend Flow'    => 'Raka Wijaya',
            'Power Yoga'      => 'Bima Saputra',
        ];

        // Jadwal mingguan yang diulang: [hari (0 = Senin ... 6 = Minggu), kelas, mulai, selesai, kapasitas]
        $weekly = [
            [0, 'Morning Flow',    '07:00:00', '08:00:00', 15],
            [0, 'Hatha Yoga',      '12:00:00', '13:00:00', 15],
            [0, 'Gentle Yoga',     '17:00:00', '18:00:00', 15],

            [1, 'Vinyasa Flow',    '07:00:00', '08:00:00', 15],
            [1, 'Power Yoga',      '12:00:00', '13:00:00', 12],
            [1, 'Relaxing Yoga',   '18:00:00', '19:00:00', 10],

            [2, 'Morning Stretch', '07:00:00', '08:00:00', 15],
            [2, 'Hatha Yoga',      '12:00:00', '13:00:00', 15],
            [2, 'Yin Yoga',        '18:00:00', '19:00:00', 12],

            [3, 'Morning Flow',    '07:00:00', '08:00:00', 15],
            [3, 'Gentle Yoga',     '12:00:00', '13:00:00', 15],
            [3, 'Vinyasa Flow',    '17:00:00', '18:00:00', 15],

            [4, 'Hatha Yoga',      '07:00:00', '08:00:00', 15],
            [4, 'Power Yoga',      '12:00:00', '13:00:00', 12],
            [4, 'Relaxing Yoga',   '18:00:00', '19:00:00', 10],

            [5, 'Weekend Flow',    '08:00:00', '09:00:00', 15],
            [5, 'Yin Yoga',        '13:00:00', '14:00:00', 12],
            [5, 'Gentle Yoga',     '17:00:00', '18:00:00', 15],

            [6, 'Morning Stretch', '08:00:00', '09:00:00', 15],
            [6, 'Hatha Yoga',      '13:00:00', '14:00:00', 15],
            [6, 'Relaxing Yoga',   '17:00:00', '18:00:00', 10],
        ];

        for ($week = 0; $week < self::WEEKS; $week++) {
            foreach ($weekly as [$day, $name, $start, $end, $capacity]) {
                $date = $firstMonday->copy()->addWeeks($week)->addDays($day)->toDateString();

                // Aman dijalankan berulang: kelas yang sudah ada hanya diperbarui, tidak digandakan.
                YogaClass::updateOrCreate(
                    ['name' => $name, 'class_date' => $date, 'start_time' => $start],
                    [
                        'description' => 'Kelas yoga untuk semua tingkat pengalaman.',
                        'instructor'  => $instructors[$name],
                        'end_time'    => $end,
                        'capacity'    => $capacity,
                    ]
                );
            }
        }
    }
}
