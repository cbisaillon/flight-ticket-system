<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Trip::class, function (Faker $faker) {

    $user = factory(\App\Models\User::class)->create();

    return [
        'user_id' => $user->id,
        'departure_date' => $faker->dateTimeBetween("now", "+1 month") ,
        'return_date' => $faker->dateTimeBetween("+1 month", "+2 month"),
        'total_cost' => '300',
    ];
});
