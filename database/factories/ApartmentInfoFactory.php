<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ApartmentInfos;
use Faker\Generator as Faker;

$factory->define(ApartmentInfos::class, function (Faker $faker) {
    return [
        'wifi' => rand(0, 1),
        'parking' => rand(0, 1),
        'pool' => rand(0, 1),
        'reception' => rand(0, 1),
        'sauna' => rand(0, 1),
        'sea_view' => rand(0, 1)
    ];
});
