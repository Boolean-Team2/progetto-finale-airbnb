<?php

use Illuminate\Database\Seeder;

use App\Apartment;
use App\User;
use App\Ad;

class ApartmentSeeder extends Seeder
{
    public function run()
    {
        factory(Apartment::class, 30) 
                -> make() 
                -> each(function($apartment){
                    $user = User::inRandomOrder() -> first();
                    $apartment -> user() -> associate($user);
                    $apartment -> save();
                    
                    $ad = new Ad;

                    $ad->fill([
                        '24h' => 1,
                        '72h' => 0,
                        '144h' => 0,
                        'duration_time' => "24:00:00",
                        'apartment_id' => $apartment->id
                    ]);

                    $ad->save();
        });
    }
}