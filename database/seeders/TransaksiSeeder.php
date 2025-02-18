<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transactions')->insert([
            [
                'trip_id' => 1,
                'transaction_type' => 'fuel',
                'amount' => 100000,
                'receipt_image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
            
        ]);
    }
}
