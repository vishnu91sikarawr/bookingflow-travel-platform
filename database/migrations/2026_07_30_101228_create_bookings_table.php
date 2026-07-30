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
       Schema::create('bookings', function (Blueprint $table) {
    $table->id();

    $table->string('booking_number')->unique();

    $table->foreignId('trip_id')
          ->constrained()
          ->cascadeOnDelete();

    $table->foreignId('user_id')
          ->nullable()
          ->constrained()
          ->nullOnDelete();

    $table->string('contact_name');
    $table->string('contact_email')->nullable();
    $table->string('contact_phone');

    $table->decimal('total_amount', 10, 2);

    $table->enum('booking_status', [
        'pending',
        'confirmed',
        'cancelled'
    ])->default('pending');

    $table->enum('payment_status', [
        'pending',
        'paid',
        'failed'
    ])->default('pending');

    $table->string('payment_reference')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
