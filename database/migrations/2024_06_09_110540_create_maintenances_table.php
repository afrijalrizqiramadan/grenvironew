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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('buffer_id');
            $table->unsignedInteger('technician_id');
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->text('problem');
            $table->text('description')->nullable();
            $table->enum('status', ['Dijadwalkan', 'Dalam Progress', 'Selesai'])->default('Dijadwalkan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
