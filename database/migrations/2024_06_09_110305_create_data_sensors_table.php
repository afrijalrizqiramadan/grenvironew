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
        Schema::create('data_sensors', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('device_id')->nullable();
            $table->timestamp('timestamp')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->float('pressure')->nullable();
            $table->float('pressuremedium')->nullable();
            $table->float('pressurelow')->nullable();
            $table->float('temperature')->nullable();
            $table->timestamps();
                });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_sensor');
    }
};
