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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('buffer_id');
            $table->year('month');
            $table->decimal('total_gas', 10, 2); // Total m³ gas dikirim dalam bulan tersebut
            $table->decimal('total_amount', 10, 2); // Total harga berdasarkan pemakaian gas
            $table->date('due_date'); // Tanggal jatuh tempo
            $table->enum('status', ['UNPAID', 'PAID', 'OVERDUE'])->default('UNPAID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
