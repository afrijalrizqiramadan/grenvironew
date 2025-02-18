<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FuelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fuel_prices')->insert([
            [
                'fuel_type' => 'solar',
                'price_per_liter' => 9000.00,
            ]
            
        ]);
    }
}
