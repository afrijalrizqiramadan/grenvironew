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
            $table->unsignedBigInteger('driver_id');
            $table->unsignedBigInteger('kendaraan_id');
            $table->float('capacity');
            $table->dateTime('departure_time');
            $table->float('total_distance');
            $table->decimal('total_fuel_cost', 10, 2);
            $table->decimal('total_toll_cost', 10, 2);
            $table->decimal('total_driver_cost', 10, 2);
            $table->decimal('total_other_cost', 10, 2);
            $table->decimal('total_cost', 10, 2);
            $table->enum('status', ['pending', 'ongoing', 'completed'])->default('pending');

            $table->timestamps();
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
