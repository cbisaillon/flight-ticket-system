<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AirlineSeeder::class);
        $this->call(AirportSeeder::class);
        $this->call(FlightSeeder::class);
        $this->call(UserSeeder::class);
    }
}
