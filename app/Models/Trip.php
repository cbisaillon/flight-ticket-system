<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        "user_id",
        "departure_date",
        "return_date",
        "total_cost"
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function flights() {
        return $this->belongsToMany(
            Flight::class,
            "flight_trip"
        );
    }
}
