<?php

use Illuminate\Database\Seeder;

use App\Ad;
use App\Apartment;

class AdSeeder extends Seeder
{
    public function run()
    {
        factory(Ad::class, 30) 
                -> make() 
                -> each(function($ad){
                    $apartment = Apartment::inRandomOrder() -> first();
                    $ad -> apartment() -> associate($apartment);
                    $ad -> save();
        });

        $apartments = Apartment::all();
        $ads = Ad::all();

        foreach ($apartments as $apartment)
        {
            $newAd = new Ad;
            $newAd -> fill($apartment);
            $newAd -> save();

            $newAd -> apartment() -> attach($apartment);
        }

    }
}
