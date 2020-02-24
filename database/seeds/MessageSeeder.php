<?php

use Illuminate\Database\Seeder;

use App\Message;
use App\Apartment;

class MessageSeeder extends Seeder
{
    public function run()
    {
        factory(Message::class, 30) 
        -> make() 
        -> each(function ($message)
        {
            $apartment  = Apartment::inRandomOrder() -> first();
            $message -> apartment() -> associate($apartment);
            $message -> save();
        });
    }
}
