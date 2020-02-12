<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Apartment;
use Faker\Generator as Faker;

$factory->define(Apartment::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'img' => '',
        'rooms' => rand(1, 3),
        'beds' => rand(1, 4),
        'baths' => rand(1, 2),
        'mq' => rand(20, 40),
        'latitude' => $faker->latitude($min = -90, $max = 90),
        'longitude' => $faker->longitude($min = -180, $max = 180),
        'address' => $faker->address,
        'views' => rand(0, 100)
    ];
});
