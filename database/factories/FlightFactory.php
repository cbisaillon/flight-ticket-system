<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Flight::class, function (Faker $faker) {

    return [
        'airline_id' => factory(\App\Models\Airline::class)->create(),
        "departure_airport_id" => factory(\App\Models\Airport::class)->create(),
        "arrival_airport_id" => factory(\App\Models\Airport::class)->create(),
        "number" => $faker->numerify("###"),
        "departure_time" => $faker->time(),
        "arrival_time" => $faker->time(),
        "price" => $faker->randomNumber(5)
    ];
});
