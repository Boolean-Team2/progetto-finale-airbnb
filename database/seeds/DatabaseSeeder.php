<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ServiceSeeder::class,
            AdSeeder::class,
            ApartmentSeeder::class,
            MessageSeeder::class,
            ViewSeeder::class
        ]);
    }
}
