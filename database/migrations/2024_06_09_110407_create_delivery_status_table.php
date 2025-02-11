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
        Schema::create('delivery_status', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('customer_id')->nullable();
            $table->unsignedInteger('device_id')->nullable();
            $table->float('pressure_before')->nullable();
            $table->float('pressure_after')->nullable();
            $table->float('total')->nullable();
            $table->dateTime('delivery_time')->nullable();
            $table->enum('status', ['Disiapkan', 'Dalam Perjalanan', 'Ditunda', 'Selesai', 'Batal'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_status');
    }
};
