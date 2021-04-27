<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FlightSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0 ; $i < 50 ; $i++) {
            $airports = \App\Models\Airport::all()->random(2)->all();

            for ($x = 0; $x < 4 ; $x++) {
                // Do multiple airlines to compare prices
                $airlineId = \App\Models\Airline::all()->random(1)->first()->id;
                DB::table("flights")->insert([
                    "airline_id" => $airlineId,
                    "departure_airport_id" => $airports[0]->id,
                    "arrival_airport_id" => $airports[1]->id,
                    "number" => $faker->numerify("###"),
                    "departure_time" => $faker->time(),
                    "arrival_time" => $faker->time(),
                    "price" => $faker->numberBetween(10000, 64000)
                ]);

                // Also insert the return flight
                DB::table("flights")->insert([
                    "airline_id" => $airlineId,
                    "departure_airport_id" => $airports[1]->id,
                    "arrival_airport_id" => $airports[0]->id,
                    "number" => $faker->numerify("###"),
                    "departure_time" => $faker->time(),
                    "arrival_time" => $faker->time(),
                    "price" => $faker->numberBetween(10000, 64000)
                ]);
            }
        }
    }
}
