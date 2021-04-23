<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flight_trip', function (Blueprint $table) {
            $table->id();
            $table->foreignId("flight_id")
                ->references("id")
                ->on("flights")
                ->onDelete("CASCADE");
            $table->foreignId("trip_id")
                ->references("id")
                ->on("trips")
                ->onDelete("CASCADE");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("flight_trip", function(Blueprint  $table){
            $table->dropForeign(["flight_id"]);
            $table->dropForeign(["trip_id"]);
        });
        Schema::dropIfExists('flight_trip');
    }
}
