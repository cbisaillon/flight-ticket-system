<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $airport_json = json_decode(
            file_get_contents("https://raw.githubusercontent.com/algolia/datasets/master/airports/airports.json"),
            true
        );

        foreach ($airport_json as $json) {
            DB::table("airports")->insert([
                "code" => $json["iata_code"],
                "city_code" => $json["city"],
                "name" => $json["name"],
                "city" => $json["city"],
                "country_code" => $json["country"],
                "region_code" => $json["iata_code"],
                "latitude" => $json["_geoloc"]["lat"],
                "longitude" => $json["_geoloc"]["lng"],
                "timezone" => $faker->timezone
            ]);
        }

    }
}
