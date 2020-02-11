<?php

use Illuminate\Database\Seeder;

use App\Apartment;
use App\User;
use App\Ad;
use App\Service;

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
                    
                    $ads = Ad::inRandomOrder() -> take(rand(0,3)) -> get();   
                    $apartment -> ads() -> attach($ads);

                    $services = Service::inRandomOrder() -> take(rand(0,6)) -> get();
                    $apartment -> services() -> attach($services);
                    
        });
    }
}