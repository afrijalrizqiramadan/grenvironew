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
        Schema::create('trip_destinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trip_id')->nullable();
            $table->unsignedBigInteger('buffer_customers');
            $table->float('latitude');
            $table->float('longitude');
            $table->float('pressure_before')->nullable();
            $table->float('pressure_after')->nullable();
            $table->float('total')->nullable();
            $table->dateTime('delivered_at')->nullable();
            $table->enum('status', ['Disiapkan', 'Dalam Perjalanan', 'Ditunda', 'Selesai', 'Batal'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_destinations');
    }
};
