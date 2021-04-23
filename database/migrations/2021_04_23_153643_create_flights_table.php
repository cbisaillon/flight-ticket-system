<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->foreignId("airline_id")
                ->references("id")
                ->on("airlines")
                ->onDelete("CASCADE");
            $table->foreignId("departure_airport_id")
                ->references("id")
                ->on("airports")
                ->onDelete("CASCADE");
            $table->foreignId("arrival_airport_id")
                ->references("id")
                ->on("airports")
                ->onDelete("CASCADE");
            $table->string("number");
            $table->time("departure_time");
            $table->time("arrival_time");
            $table->integer("price");
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
        Schema::table("flights", function(Blueprint $table) {
            $table->dropForeign(["airline_id"]);
            $table->dropForeign(["departure_airport_id"]);
        });
        Schema::dropIfExists('flights');
    }
}
