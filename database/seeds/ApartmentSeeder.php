<?php

use Illuminate\Database\Seeder;

use App\Apartment;
use App\User;

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
        });
    }
}