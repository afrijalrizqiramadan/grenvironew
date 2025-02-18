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
        Schema::create('technicians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name', 255);
            $table->string('address', 255)->nullable();
            $table->string('telp', 20)->nullable();
            $table->string('email', 255)->nullable();
            $table->date('join_date')->nullable();
            $table->string('specialization', 100)->nullable();
            $table->string('license_number', 50)->nullable();
            $table->enum('employment_status', ['Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->string('work_schedule', 255)->nullable();
            $table->text('additional_info')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technicians');
    }
};
