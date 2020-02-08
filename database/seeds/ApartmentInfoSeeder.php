<?php

use Illuminate\Database\Seeder;

use App\ApartmentInfos;
use App\Apartment;

class ApartmentInfoSeeder extends Seeder
{
    public function run()
    {
        factory(ApartmentInfos::class, 30) 
                -> make() 
                -> each(function ($apartmentInfo)
                {
                    $apartment  = Apartment::inRandomOrder() -> first();
                    $apartmentInfo -> apartment() -> associate($apartment);
                    $apartmentInfo -> save();
                });
    }
}
