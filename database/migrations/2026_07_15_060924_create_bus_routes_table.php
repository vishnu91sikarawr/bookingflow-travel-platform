<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bus_routes', function (Blueprint $table) {

            $table->id();

            $table->foreignId('bus_operator_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('name');

            $table->string('source_city');

            $table->string('destination_city');

            $table->integer('distance_km')->nullable();

            $table->string('estimated_duration')->nullable();

            $table->boolean('status')->default(true);

            $table->foreignId('created_by')->nullable()->constrained('users');

            $table->foreignId('updated_by')->nullable()->constrained('users');

            $table->timestamps();

            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bus_routes');
    }
};
