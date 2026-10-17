<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('booking_reschedules', function (Blueprint $table) {
    $table->id();

    $table->foreignId('booking_id')
        ->constrained('bookings')
        ->cascadeOnDelete();

    $table->foreignId('from_yoga_class_id')
        ->constrained('yoga_classes')
        ->restrictOnDelete();

    $table->foreignId('to_yoga_class_id')
        ->constrained('yoga_classes')
        ->restrictOnDelete();

    $table->timestamp('rescheduled_at');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_reschedules');
    }
};
