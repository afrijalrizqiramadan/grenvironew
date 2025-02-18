<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TripsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trips')->insert([
            [
                'driver_id' => 1,
                'kendaraan_id' => 1,
                'capacity' => 200,
                'departure_time' => now(),
                'total_distance' => 100,
                'total_fuel_cost' => 10000,
                'total_toll_cost' => 5000,
                'total_driver_cost' => 20000,
                'total_other_cost' => 5000,
                'total_cost' => 45000,
                'status' => 'pending'
            ]
            
        ]);
    }
}
