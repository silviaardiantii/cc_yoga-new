<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!DB::table('packages')->where('name', 'Drop In')->exists()) {
            DB::table('packages')->insert([
                'name' => 'Drop In',
                'credits' => 1,
                'price' => 75000,
                'description' => 'Coba satu kelas tanpa komitmen',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        DB::table('packages')->where('name', 'Drop In')->delete();
    }
};
