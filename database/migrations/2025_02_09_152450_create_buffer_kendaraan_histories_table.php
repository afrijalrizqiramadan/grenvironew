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
        Schema::create('buffer_kendaraan_histories', function (Blueprint $table) {
        $table->id();
        $table->unsignedInteger('buffer_id');
        $table->unsignedInteger('trip_id');
        $table->float('latitude', 10, 6);
        $table->float('longitude', 10, 6);
        $table->float('pressure', 5, 2);
        $table->timestamp('timestamp')->useCurrent();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buffer_kendaraan_histories');
    }
};
