<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    public function departureFlights(){
        return $this->hasMany(Flight::class, "departure_airport_id");
    }

    public function arrivalFlights(){
        return $this->hasMany(Flight::class, "arrival_airport_id");
    }
}
