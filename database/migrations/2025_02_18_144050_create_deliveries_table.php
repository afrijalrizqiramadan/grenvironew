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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buffer_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('trip_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->date('delivery_date');
            $table->float('pressure_before')->nullable();
            $table->float('pressure_after')->nullable();
            $table->decimal('total', 10, 2);
            $table->decimal('price_per_m3', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
