<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB; // Import DB facade
use Illuminate\Database\Seeder;

class CenterPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('centre_points')->insert([
            [
                'id' => 1,
                'location' => '-0.5541142868348498,113.95052909249071',
            ],
        ]);
    }
}
