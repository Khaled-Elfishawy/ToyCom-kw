<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BusinessSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('business_settings')->insert([
            'key' => 'dinar_points',
            'value' => '5'
        ]);

        DB::table('business_settings')->insert([
            'key' => 'points_dinar',
            'value' => '1000'
        ]);
    }
}
