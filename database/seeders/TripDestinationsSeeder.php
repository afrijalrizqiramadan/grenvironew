<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TripDestinationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trip_destinations')->insert([
            [
                'trip_id' => 1,
                'buffer_customers' => 1,
                'latitude' => -6.175392,
                'longitude' => 106.824695,
                'pressure_before' => 50,
                'pressure_after' => 100,
                'total' => 50,
                'delivered_at' => now(),
                'status' => 'Selesai',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            
        ]);
    }
}
