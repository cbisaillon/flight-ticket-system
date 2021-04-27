<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $airline_json = json_decode(
            file_get_contents("https://raw.githubusercontent.com/npow/airline-codes/master/airlines.json"),
            true
        );

        foreach ($airline_json as $json) {
            DB::table("airlines")->insert([
                "code" => $json["icao"],
                "name" => $json["name"]
            ]);
        }
    }
}
