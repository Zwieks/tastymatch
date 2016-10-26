<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class FoodstandsTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('foodstandtypes')->insert([
            [
                'name' => 'Amerikaans',
                'name_en' => 'American',
                'description' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Aziatisch',
                'name_en' => 'Asian',
                'description' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'BBQ',
                'name_en' => 'BBQ',
                'description' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Biologisch',
                'name_en' => 'Bio Food',
                'description' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Broodjes',
                'name_en' => 'Bread',
                'description' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],           [
                'name' => 'Drank',
                'name_en' => 'Drinks',
                'description' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],          [
                'name' => 'Fingerfood',
                'name_en' => 'Fingerfood',
                'description' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],           [
                'name' => 'Frituur',
                'name_en' => 'Frying Pan',
                'description' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],           [
                'name' => 'Fruit',
                'name_en' => 'Fruit',
                'description' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],           [
                'name' => 'Fusion',
                'name_en' => 'Fusion',
                'description' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],           [
                'name' => 'Hamburgers',
                'name_en' => 'Hamburgers',
                'description' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],           [
                'name' => 'Hollands',
                'name_en' => 'Dutch',
                'description' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],           [
                'name' => 'IJs',
                'name_en' => 'Ice Cream',
                'description' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],           [
                'name' => 'Koffie',
                'name_en' => 'Coffee',
                'description' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],           [
                'name' => 'Mexicaans',
                'name_en' => 'Mexican',
                'description' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],           [
                'name' => 'Non-Food',
                'name_en' => 'Non-Food',
                'description' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],           [
                'name' => 'Pannenkoeken',
                'name_en' => 'Pancakes',
                'description' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],           [
                'name' => 'Pasta',
                'name_en' => 'Pasta',
                'description' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],           [
                'name' => 'Pizza',
                'name_en' => 'Pizza',
                'description' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],           [
                'name' => 'Sapjes',
                'name_en' => 'Juicing',
                'description' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],           [
                'name' => 'Soep',
                'name_en' => 'Soup',
                'description' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],           [
                'name' => 'Tapas',
                'name_en' => 'Tapas',
                'description' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],           [
                'name' => 'Vegetarisch',
                'name_en' => 'Vegetarian',
                'description' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],           [
                'name' => 'Vis',
                'name_en' => 'Fish',
                'description' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],           [
                'name' => 'Worst',
                'name_en' => 'Sausage',
                'description' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],           [
                'name' => 'Zoet',
                'name_en' => 'Sweet',
                'description' => null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
