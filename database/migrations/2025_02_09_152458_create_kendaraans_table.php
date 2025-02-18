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
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buffer_id');
            $table->string('plat_nomor')->unique();
            $table->string('tipe_kendaraan');
            $table->integer('fuel_type')->nullable();
            $table->integer('fuel_consumption')->nullable();
            $table->float('capacity');
            $table->integer('active_trip_id')->nullable();
            $table->enum('status', ['Aktif', 'Nonaktif'])->default('Aktif');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraans');
    }
};
