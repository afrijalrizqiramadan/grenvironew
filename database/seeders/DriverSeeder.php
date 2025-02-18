<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Driver;
use Carbon\Carbon;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $drivers = [
            [
                'user_id' => '4',
                'name' => 'John Doe',
                'email' => '',
                'telp' => '081234567890',
                'address' => 'Jl. Merdeka No. 1, Jakarta',
                'license_number' => 'A12345678',
                'license_expiry' => '2025-12-31',
                'kendaraan_id' => 1,
                'availability_status' => 'Available',
                'assigned_area' => 'Jakarta',
                'experience_years' => 5,
                'photo' => 'drivers/johndoe.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

            foreach ($drivers as $driver) {
                Driver::create($driver);
            }
    }
}
