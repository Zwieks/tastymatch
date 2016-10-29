<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class GlobalInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('global_info')->insert([
        [
            'title' => 'TastyMatch',
            'subtitle' => '',
            'description' => 'Wij brengen foodstands en evenementen samen op een online platform, daarnaast bieden wij vele voordelen voor uw bedrijf.',
            'facebook' => '',
            'email' => 'info@tastymatch.nl',
            'phone' => '',
            'adress' => 'Dobbe 36',
            'postcode' => '9351 ZH',
            'city' => 'Leek',
            'country' => 'Nederland',
            'kvk' => '341241234',
            'url_nl' => 'www.tastymatch.nl',
            'url_en' => '',
            'logo' => '/img/logo.png',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]]);
    }
}
