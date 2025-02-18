<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BufferCustomerHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('buffer_customers_histories')->insert([
            [
                'id' => 1,
                'buffer_id' => 2,
                'timestamp' => now(),
                'pressure' => 100,
                'pressure_medium' => 0,
                'pressure_low' => 0,
                'temperature' => 25.0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
            
        ]);
    }
}
