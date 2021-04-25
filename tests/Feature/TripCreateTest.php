<?php


class TripCreateTest extends \Tests\TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    public function testCreateTrip() {

        $user = factory(\App\Models\User::class)->make();
        $user->save();

        $response = $this->actingAs($user)->post(
            route("trips.create"),
            [
                "departure_flight_id" => 1,
                "return_flight_id" => 2,
                "departure_date" => "2021-04-25 14:03:22",
                "return_date" => "2022-12-31 12:33:22"
            ]
        );

        $response->assertRedirect(route("trips.index"));

        // Check that info is stored in the database
        $this->assertEquals(1, count($user->trips));
        $this->assertEquals(1, $user->trips[0]->flights[0]->id);
        $this->assertEquals(2, $user->trips[0]->flights[1]->id);
        $this->assertEquals("2021-04-25 14:03:22", $user->trips[0]->departure_date);
        $this->assertEquals("2022-12-31 12:33:22", $user->trips[0]->return_date);
    }
}
