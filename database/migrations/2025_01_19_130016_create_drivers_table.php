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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();  // Primary Key (Auto Increment)
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name', 100);
            $table->string('email', 100)->nullable();
            $table->string('telp', 20)->nullable();
            $table->text('address')->nullable();
            $table->string('license_number', 50)->unique();
            $table->date('license_expiry');
            $table->unsignedBigInteger('kendaraan_id')->nullable();
            $table->enum('availability_status', ['Available', 'On Duty', 'Inactive'])->default('Available');
            $table->string('assigned_area', 100)->nullable();
            $table->integer('experience_years')->default(0);
            $table->string('photo', 255)->nullable();
            $table->timestamps();  // created_at & updated_at
            $table->softDeletes(); // deleted_at untuk soft delete

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
