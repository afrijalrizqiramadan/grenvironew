<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            [
                'id' => 1,
                'user_id' => 2,
                'name' => 'Al Mahira',
                'address' => 'Jalan Raya Karanglo, Karangploso Wetan, Kepuharjo, Kec. Karang Ploso, Kabupaten Malang, Jawa Timur 65153',
                'telp' => '6281381301310',
                'email' => 'info@al-maahiraiibs.sch.id',
                'images' => 'almahira.jpg',
                'registration_date' => '2024-01-01',
                'type' => 'Sekolah',
                'capacity' => 200,
                'province' => 35,
                'regency' => 259,
                'district' => 3410,
                'village' => 42538,
                'status' => 'Aktif',
            ]
            
        ]);
        DB::table('customers')->insert([
            [
                'id' => 2,
                'user_id' => 6,
                'name' => 'Bakpia Cap Mangkok',
                'address' => 'Bakpia Cap Mangkok Malang',
                'telp' => '081234567890',
                'email' => 'bakpiacapmangkok@gmail.com',
                'images' => 'bakpiacapmangkok.jpg',
                'registration_date' => '2024-01-01',
                'type' => 'Resto',
                'capacity' => 200,
                'province' => 35,
                'regency' => 259,
                'district' => 3410,
                'village' => 42538,
                'status' => 'Aktif',
            ]
            
        ]);
    }
}
