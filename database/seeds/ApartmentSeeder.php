<?php

use Illuminate\Database\Seeder;
// use Illuminate\Console\Command;
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
            
            $ad = Ad::inRandomOrder() -> take(1) -> get();   
        
            $start = new DateTime();
            $end = date("Y-m-d H:i:s", time() + 86400);

            $apartment -> ads() -> attach($ad,["start_time" => $start, "end_time" => $end,'active'=>true]);
            
            $services = Service::inRandomOrder() -> take(rand(0,6)) -> get();
            $apartment -> services() -> attach($services);
        });
    }
}