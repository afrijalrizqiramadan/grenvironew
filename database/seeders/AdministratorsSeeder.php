<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdministratorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('administrators')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'name' => 'Administrator',
                'email' => 'administrator@gmail.com',
                'telp' => '081234567890',
                'join_date' => '2024-06-05',
                'province' => 35,
                'regency' => 3573,
                'district' => 3507,
                'village' => 350723,
                'status' => 'aktif',
            ],
        ]);
    }
}
