<?php


class FlightSearchResultTest extends \Tests\TestCase
{
    public function testFetchOnewayResults() {
        $flight = factory(\App\Models\Flight::class)->create();

        $helper = new \App\Http\Helpers\SearchResultHelper(
            \Carbon\Carbon::createFromDate("2021", "04", "25"),
            $flight->departureAirport,
            $flight->arrivalAirport
        );

        $results = $helper->fetchResults();
        $this->assertTrue(count($results) > 0);
        foreach ($results as $result) {
            $this->assertNull($result["return"]);
        }
    }

    public function testPricesInOrder() {
        $flight = factory(\App\Models\Flight::class)->create();

        $helper = new \App\Http\Helpers\SearchResultHelper(
            \Carbon\Carbon::createFromDate("2021", "04", "25"),
            $flight->departureAirport,
            $flight->arrivalAirport
        );

        $results = $helper->fetchResults();
        $lastPrice = 0;
        foreach ($results as $result) {
            $this->assertTrue($lastPrice < $result["total_cost"]);
            $lastPrice = $result["total_cost"];
        }
    }

    public function testFetchTwowayResults() {
        $flight = factory(\App\Models\Flight::class)->create();

        // Create reverse flight
        factory(\App\Models\Flight::class)->create([
            "departure_airport_id" => $flight->arrival_airport_id,
            "arrival_airport_id" => $flight->departure_airport_id
        ]);

        $helper = new \App\Http\Helpers\SearchResultHelper(
            \Carbon\Carbon::createFromDate("2021", "04", "28"),
            $flight->departureAirport,
            $flight->arrivalAirport,
            \Carbon\Carbon::createFromDate("2021", "05", "05")
        );

        $results = $helper->fetchResults();
        $this->assertTrue(count($results) > 0);
        foreach ($results as $result) {
            $this->assertNotNull($result["return"]);
        }
    }

    public function testFetchInvalidReturnDate() {
        $flight = factory(\App\Models\Flight::class)->create();

        // Return date in past
        $helper = new \App\Http\Helpers\SearchResultHelper(
            \Carbon\Carbon::createFromDate("2021", "04", "25"),
            $flight->departureAirport,
            $flight->arrivalAirport,
            \Carbon\Carbon::createFromDate("2010", "05", "05")
        );

        $this->expectException(\App\Exceptions\InvalidParameters::class);
        $results = $helper->fetchResults();
    }
}
