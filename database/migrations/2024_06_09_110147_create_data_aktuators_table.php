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
        Schema::create('data_aktuators', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('buffer_id');
            $table->tinyInteger('buzzer')->default(0);
            $table->tinyInteger('heater')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_aktuator');
    }
};
