<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('costs')->insert([
            [
                'trip_id' => 1,
                'fuel_cost' => 100000,
                'toll_cost' => 50000,
                'driver_cost' => 200000,
                'other_cost' => 100000,
                'total_cost' => 420000,
                'created_at' => now(),
                'updated_at' => now(),
            ]
            
        ]);
    }
}
