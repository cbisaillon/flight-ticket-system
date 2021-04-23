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
        $flights = [
            [
                "airline_id" => \App\Models\Airline::query()
                    ->where("code", "AC")->first()->id,
                "departure_airport_id" => \App\Models\Airport::query()
                    ->where("code", "YUL")->first()->id,
                "arrival_airport_id" => \App\Models\Airport::query()
                    ->where("code", "YVR")->first()->id,
                "number" => 301,
                "departure_time" => "07:35",
                "arrival_time" => "10:05",
                "price" => 27323
            ],
            [
                "airline_id" => \App\Models\Airline::query()
                    ->where("code", "AC")->first()->id,
                "departure_airport_id" => \App\Models\Airport::query()
                    ->where("code", "YVR")->first()->id,
                "arrival_airport_id" => \App\Models\Airport::query()
                    ->where("code", "YUL")->first()->id,
                "number" => 302,
                "departure_time" => "11:30",
                "arrival_time" => "19:11",
                "price" => 22063
            ]
        ];

        foreach ($flights as $flight) {
            DB::table("flights")->insert($flight);
        }
    }
}
