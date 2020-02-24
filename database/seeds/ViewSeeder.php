<?php

use Illuminate\Database\Seeder;
use App\View;
use App\Apartment;

class ViewSeeder extends Seeder
{
    public function run()
    {
        for ($i=0; $i < 30 ; $i++) { 
            $view = new View ;
            $apartment  = Apartment::inRandomOrder() -> first();
            $view -> apartment() -> associate($apartment);
            $view -> save();
        }
    }
}
