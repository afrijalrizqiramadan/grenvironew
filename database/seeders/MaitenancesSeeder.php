<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaitenancesSeeder extends Seeder
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
                'buffer_id' => 1,
                'technician_id' => 1,
                'start_date' => now(),
                'end_date' => now()->addDays(7),
                'problem' => 'Problem Dummy',
                'description' => 'Deskripsi dummy',
                'status' => 'Dijadwalkan',
            ]
        ]);
    }
}
