<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('themes')->insert([
            [
                'data_layout' => 'vertical',
                'data_topbar' => 'light',
                'data_sidebar' => 'dark',
                'data_sidebar_size' => 'lg',
                'data_preloader' => 'disable',
                'data_layout_width' => 'fluid',
                'data_layout_style' => 'detached',
                'data_layout_position' => 'fixed',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
            
        ]);
    }
}
