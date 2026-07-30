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
        Schema::create('booking_passengers', function (Blueprint $table) {

    $table->id();

    $table->foreignId('booking_id')
          ->constrained()
          ->cascadeOnDelete();

    $table->string('seat_number');

    $table->string('passenger_name');

    $table->unsignedTinyInteger('age');

    $table->enum('gender', [
        'male',
        'female',
        'other'
    ]);

    $table->decimal('fare', 10, 2);

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_passengers');
    }
};
