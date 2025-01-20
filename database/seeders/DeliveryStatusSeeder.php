<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('delivery_status')->insert([
            [
                'id' => 1,
                'customer_id' => 1,
                'total' => 50,
                'delivery_date' => '2024-06-01',
                'status' => 'Dalam Perjalanan',
            ],           
        ]);
    }
}
