<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kendaraan;
use Carbon\Carbon;

class BufferKendaraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kendaraans = [
            [
                'buffer_id' => 1,
                'plat_nomor' => 'B 1234 ABC',
                'tipe_kendaraan' => 'Mobil',
                'fuel_type' => 1,
                'fuel_consumption' => 10,
                'capacity' => 250,
                'active_trip_id' => null,
                'status' => 'Aktif',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ];

            foreach ($kendaraans as $kendaraans) {
                Kendaraan::create($kendaraans);
            }
    }
}
