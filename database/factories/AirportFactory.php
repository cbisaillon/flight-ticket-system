<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Airport::class, function (Faker $faker) {

    return [
        'code' => $faker->asciify("****"),
        "city_code" => $faker->asciify("****"),
        "name" => $faker->name,
        "city" => $faker->city,
        "country_code" => $faker->countryCode,
        "region_code" => $faker->state,
        "latitude" => $faker->latitude,
        "longitude" => $faker->longitude,
        "timezone" => $faker->timezone
    ];
});
