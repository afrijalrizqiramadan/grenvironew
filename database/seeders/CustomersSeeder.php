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
                'location' => 'Al Mahira',
                'maps' => 'https://maps.app.goo.gl/c6drFmSpX675DxA8A',
                'latitude' => -7.907229801212323,
                'longitude' => 112.62704532698568,
                'images' => 'almahira.jpg',
                'registration_date' => '2024-01-01',
                'type' => 'Sekolah',
                'capacity' => 200,
                'device_id' => 1,
                'province' => 35,
                'regency' => 3573,
                'district' => 3507,
                'village' => 350723,
                'status' => 'aktif',
            ]
            
        ]);
    }
}
