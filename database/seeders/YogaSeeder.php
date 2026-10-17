<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class YogaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('packages')->insert([
            [
                'name' => 'Starter',
                'credits' => 3,
                'price' => 150000,
                'description' => 'Paket untuk pemula',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Regular',
                'credits' => 8,
                'price' => 350000,
                'description' => 'Paket latihan rutin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Premium',
                'credits' => 15,
                'price' => 600000,
                'description' => 'Paket untuk latihan intensif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('yoga_classes')->insert([
            [
                'name' => 'Morning Yoga',
                'description' => 'Latihan yoga untuk memulai hari',
                'class_date' => '2026-10-19',
                'start_time' => '07:00:00',
                'end_time' => '08:00:00',
                'capacity' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hatha Yoga',
                'description' => 'Latihan keseimbangan dan fleksibilitas',
                'class_date' => '2026-10-20',
                'start_time' => '16:00:00',
                'end_time' => '17:00:00',
                'capacity' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Relaxing Yoga',
                'description' => 'Latihan relaksasi tubuh dan pikiran',
                'class_date' => '2026-10-21',
                'start_time' => '18:00:00',
                'end_time' => '19:00:00',
                'capacity' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
