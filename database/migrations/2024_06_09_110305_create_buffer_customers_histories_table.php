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
        Schema::create('buffer_customers_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buffer_id')->nullable();
            $table->timestamp('timestamp')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->float('pressure')->nullable();
            $table->float('pressure_medium')->nullable();
            $table->float('pressure_low')->nullable();
            $table->float('temperature')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buffer_customers_histories');
    }
};
