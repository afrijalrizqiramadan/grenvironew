<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HistorySensorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('history_sensors')->insert([
            [
                'device_id' => 1,
                'timestamp' => '2024-06-06 03:11:44',
                'pressure' => 150,
                'pressuremedium' => 0,
                'pressurelow' => 0,
                'temperature' => 28,
            ],
           
        ]);
    }
}
