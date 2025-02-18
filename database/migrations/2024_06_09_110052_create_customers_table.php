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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name', 25);
            $table->text('address');
            $table->string('telp', 13);
            $table->string('email', 30)->nullable();
            $table->string('images', 100)->nullable();
            $table->date('registration_date');
            $table->string('type', 20);
            $table->float('capacity');
            $table->unsignedInteger('province');
            $table->unsignedInteger('regency');
            $table->unsignedInteger('district');
            $table->unsignedInteger('village');
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
