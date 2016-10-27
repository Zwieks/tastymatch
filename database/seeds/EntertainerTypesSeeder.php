<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class EntertainerTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('entertainertypes')->insert([
            [
                'name' => 'DJ',
                'name_en' => 'DJ',
                'description' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Clown',
                'name_en' => 'Clown',
                'description' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],           [
                'name' => 'Kok',
                'name_en' => 'Cook',
                'description' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
