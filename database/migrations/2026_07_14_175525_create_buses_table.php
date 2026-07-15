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
        Schema::create('buses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('bus_operator_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('name');

            $table->string('bus_number')->unique();

            $table->string('registration_number')->nullable();

            $table->enum('bus_type', [
                'AC',
                'Non AC',
                'Sleeper',
                'Semi Sleeper',
                'Luxury',
            ]);

            $table->integer('total_seats');

            $table->boolean('status')->default(true);

            $table->foreignId('created_by')->nullable()->constrained('users');

            $table->foreignId('updated_by')->nullable()->constrained('users');

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buses');
    }
};
