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
        Schema::create('buffer_customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedInteger('customer_id');
            $table->timestamp('timestamp')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->float('latitude');
            $table->float('longitude');
            $table->float('pressure')->nullable();
            $table->float('pressure_medium')->nullable();
            $table->float('pressure_low')->nullable();
            $table->float('temperature')->nullable();
            $table->string('telp_device')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buffer_customers');
    }
};
