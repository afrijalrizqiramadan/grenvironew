<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('deliveries')->insert([
            [
                'buffer_id' => 1,
                'customer_id' => 1,
                'trip_id' => 1,
                'vehicle_id' => 1,
                'delivery_date' => now(),
                'pressure_before' => 50,
                'pressure_after' => 100,
                'total' => 50,
                'price_per_m3' => 1000,
                'total_price' => 50000,
            ]
            
        ]);
    }
}
