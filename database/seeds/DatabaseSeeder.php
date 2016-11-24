<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EntertainersTableSeeder::class);
        $this->call(EntertainerTypesSeeder::class);

        $this->call(EventsTableSeeder::class);
        $this->call(EventTypesSeeder::class);

        $this->call(FoodstandsTableSeeder::class);
        $this->call(FoodstandsTypesSeeder::class);

        $this->call(GlobalInfoTableSeeder::class);

        $this->call(UserRolesSeeder::class);
        $this->call(UserTypesSeeder::class);
    }
}
