<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel customers sekarang sudah punya customer_code (lihat create_customers_table),
        // dan kolom phone / pin_hash tidak dipakai lagi. Hanya tambah kolom jika belum ada.
        if (!Schema::hasColumn('customers', 'customer_code')) {
            Schema::table('customers', function (Blueprint $table) {
                $table->string('customer_code', 20)->nullable()->unique();
            });
        }
    }

    public function down(): void
    {
        // Sengaja kosong: customer_code dibuat oleh create_customers_table.
    }
};
