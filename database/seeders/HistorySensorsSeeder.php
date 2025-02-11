<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HistorySensorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $device_id = 1; // Ganti dengan ID device yang ingin diuji
        $pressure = rand(50, 80); // Tekanan awal random

        for ($i = 0; $i < 100; $i++) { // Simulasi 100 data
            $created_at = Carbon::now()->subMinutes(100 - $i); // Simulasi data lama

            // Kadang-kadang ada pengisian gas
            if ($i % 20 == 0) {
                $pressure += rand(15, 25); // Simulasi pengisian gas (15 - 25 bar)
            } else {
                $pressure -= rand(1, 3); // Simulasi konsumsi gas
            }

            DB::table('history_sensors')->insert([
                'device_id' => $device_id,
                'pressure' => $pressure,
                'created_at' => $created_at,
                'updated_at' => $created_at,
            ]);

            echo "Inserted: Device $device_id - Pressure: $pressure at $created_at\n";
        }
    }

}
