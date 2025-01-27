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
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('data_layout')->default('vertical');
            $table->string('data_topbar')->default('light');
            $table->string('data_sidebar')->default('dark');
            $table->string('data_sidebar_size')->default('lg');
            $table->string('data_preloader')->default('disable');
            $table->string('data_layout_width')->default('fluid');
            $table->string('data_layout_style')->default('detached');
            $table->string('data_layout_position')->default('fixed');
            $table->unsignedInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('themes');
    }
};
