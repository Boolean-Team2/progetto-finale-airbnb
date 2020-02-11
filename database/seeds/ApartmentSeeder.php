<?php

use Illuminate\Database\Seeder;

use App\Apartment;
use App\User;
use App\Ad;
use App\ApartmentInfo;

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
                    $info = new ApartmentInfo;

                    $ad->fill([
                        '24h' => 1,
                        '72h' => 0,
                        '144h' => 0,
                        'start_time' => '2020-02-11 09:53:10',
                        'end_time' => '2020-03-11 09:53:10'
                    ]);

                    $ad->save();

                    $info->fill([
                        'parking' => rand(0,1), 
                        'wifi' => rand(0,1),
                        'pool' => rand(0,1),
                        'reception' => rand(0,1),
                        'sauna' => rand(0,1),
                        'sea_view'=> rand(0,1),
                        'apartment_id' => $apartment->id
                    ]);

                    $apartment -> ads() -> attach($ad);

                    $info->save();
        });
    }
}