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
        Schema::create('administrators', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->date('join_date')->nullable();
            $table->unsignedInteger('province')->nullable();
            $table->unsignedInteger('regency')->nullable();
            $table->unsignedInteger('district')->nullable();
            $table->unsignedInteger('village')->nullable();
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('aktif');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrators');
    }
};
