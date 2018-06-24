<?php

use Faker\Generator as Faker;
use App\House;

$factory->define(House::class, function (Faker $faker) {
    return [
        "name" => $faker->name,
	    "lat" => $faker->latitude,
	    "lng" => $faker->longitude,
	    "owner_phone" => $faker->phoneNumber,
	    "owner_telegram" => $faker->word
    ];
});
