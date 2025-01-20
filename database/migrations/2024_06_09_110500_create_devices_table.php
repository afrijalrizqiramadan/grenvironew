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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('chip_id', 20);
            $table->date('create_at');
            $table->text('type_device')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedSmallInteger('service');
            $table->float('temperature');
            $table->integer('uptime');
            $table->integer('memory');
            $table->datetime('lastupdate');
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
