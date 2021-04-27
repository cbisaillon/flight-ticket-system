<?php


class TripListTest extends \Tests\TestCase
{
    public function testListResult() {

        $user = factory(\App\Models\User::class)->create();

        $trips = factory(\App\Models\Trip::class, 30)
            ->create()
            ->each(function (\App\Models\Trip $trip) use ($user) {
               $trip->flights()->save(factory(\App\Models\Flight::class)->make());
               $trip->user()->associate($user);
            });

        $response = $this->actingAs($user)->get(
            route("trips.index")
        );

        $response->assertOk();
    }
}
