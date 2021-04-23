<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")
                ->references("id")
                ->on("users")
                ->onDelete("CASCADE");
            $table->dateTime("departure_date");
            $table->dateTime("return_date")->nullable();
            $table->integer("total_cost");
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
        Schema::table("trips", function(Blueprint  $table){
            $table->dropForeign(["user_id"]);
        });
        Schema::dropIfExists('trips');
    }
}
