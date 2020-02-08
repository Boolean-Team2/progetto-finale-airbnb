<?php

use Illuminate\Database\Seeder;

use App\Apartment;
use App\User;
use App\Ad;
use App\ApartmentInfos;

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
                    $info = new ApartmentInfos;

                    $ad->fill([
                        '24h' => 1,
                        '72h' => 0,
                        '144h' => 0,
                        'duration_time' => "24:00:00",
                        'apartment_id' => $apartment->id
                    ]);

                    $info->fill([
                        'parking' => rand(0,1), 
                        'wifi' => rand(0,1),
                        'pool' => rand(0,1),
                        'reception' => rand(0,1),
                        'sauna' => rand(0,1),
                        'sea_view'=> rand(0,1),
                        'apartment_id' => $apartment->id
                        ]);

                    $ad->save();

                    $info->save();
        });

    }
}