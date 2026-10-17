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
       Schema::create('purchases', function (Blueprint $table) {
    $table->id();

    $table->foreignId('customer_id')
        ->constrained('customers')
        ->cascadeOnDelete();

    $table->foreignId('package_id')
        ->constrained('packages')
        ->restrictOnDelete();

    $table->unsignedInteger('credits_purchased');
    $table->decimal('amount', 12, 2);
    $table->string('payment_method')->default('simulation');
    $table->string('payment_status')->default('pending');
    $table->string('payment_reference')->nullable()->unique();
    $table->timestamp('paid_at')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
