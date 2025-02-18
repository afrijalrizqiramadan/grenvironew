<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('invoices')->insert([
            [
                'customer_id' => 1,
                'buffer_id' => 1,
                'month' => 2022,
                'total_gas' => 1000,
                'total_amount' => 1000000,
                'due_date' => now()->addDays(30),
                'status' => 'UNPAID',
            ]
            
        ]);
    }
}
