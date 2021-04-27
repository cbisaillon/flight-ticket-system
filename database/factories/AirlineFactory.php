<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Airline::class, function (Faker $faker) {

    return [
        'code' => $faker->asciify("****"),
        'name' => $faker->name,
    ];
});
