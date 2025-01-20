<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaintenancesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('maintenances')->insert([
            [
                'id' => 1,
                'device_id' => 4736757,
                'technician_id' => 1,
                'start_date' => '2024-06-07 08:58:47',
                'end_date' => NULL,
                'problem' => 'koneksi gagal',
                'description' => NULL,
                'status' => 'Dijadwalkan',
            ],
        ]);
    }
}
