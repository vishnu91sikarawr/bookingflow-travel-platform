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
        Schema::create('trips', function (Blueprint $table) {

            $table->id();

            $table->foreignId('bus_operator_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('bus_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('bus_route_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('trip_code')->unique();

            $table->date('departure_date');

            $table->time('departure_time');

            $table->time('arrival_time');

            $table->decimal('fare', 10, 2);

            $table->integer('available_seats');

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
        Schema::dropIfExists('trips');
    }
};
