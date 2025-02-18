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
        Schema::create('buffer_kendaraans', function (Blueprint $table) {
            $table->id();            
            $table->unsignedInteger('name')->unique();
            $table->integer('kendaraan_id')->nullable();
            $table->timestamp('timestamp')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->float('pressure')->nullable();
            $table->double('latitude', 10, 6)->nullable();
            $table->double('longitude', 10, 6)->nullable();
            $table->integer('telp_device')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buffer_kendaraans');
    }
};
