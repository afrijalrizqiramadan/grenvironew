<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BufferCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('buffer_customers')->insert([
            [
                'id' => 1,
                'name' => 'Almahira Putra',
                'customer_id' => 1,
                'timestamp' => now(),
                'latitude' => -7.966309,
                'longitude' => 112.629339,
                'pressure' => 100,
                'pressure_medium' => 0,
                'pressure_low' => 0,
                'temperature' => 25.0,
                'telp_device' => '123-456-7890',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            
        ]);
        DB::table('buffer_customers')->insert([
            [
                'id' => 2,
                'name' => 'Almahira Kantin',
                'customer_id' => 1,
                'timestamp' => now(),
                'latitude' => -7.966309,
                'longitude' => 112.629339,
                'pressure' => 100,
                'pressure_medium' => 0,
                'pressure_low' => 0,
                'temperature' => 25.0,
                'telp_device' => '123-456-7890',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            
        ]);
        DB::table('buffer_customers')->insert([
            [
                'id' => 3,
                'name' => 'Bakpia Mangkok',
                'customer_id' => 2,
                'timestamp' => now(),
                'latitude' => -7.966309,
                'longitude' => 112.629339,
                'pressure' => 100,
                'pressure_medium' => 0,
                'pressure_low' => 0,
                'temperature' => 25.0,
                'telp_device' => '123-456-7890',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            
        ]);
    }
}
