<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DevicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('devices')->insert([
            [
                'id' => 1,
                'chip_id' => 'a4f67acd',
                'create_at' => '2024-06-03',
                'type_device' => 'ESP32',
                'user_id' => 1,
                'service' => 0,
                'temperature' => 53.33,
                'uptime' => 333,
                'memory' => 97072,
                'lastupdate' => '2024-06-06 10:33:01',
                'status' => 1,
            ]
        ]);
    }
}
