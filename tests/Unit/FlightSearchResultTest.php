<?php


class FlightSearchResultTest extends \Tests\TestCase
{
    public function testFetchOnewayResults() {
        $helper = new \App\Http\Helpers\SearchResultHelper(
            \Carbon\Carbon::createFromDate("2021", "04", "25"),
            \App\Models\Airport::query()->where("id", 1)->firstOrFail(),
            \App\Models\Airport::query()->where("id", 2)->firstOrFail()
        );

        $results = $helper->fetchResults();
        $this->assertTrue(count($results) > 0);
        foreach ($results as $result) {
            $this->assertNull($result["return"]);
        }
    }

    public function testFetchTwowayResults() {
        $helper = new \App\Http\Helpers\SearchResultHelper(
            \Carbon\Carbon::createFromDate("2021", "04", "25"),
            \App\Models\Airport::query()->where("id", 1)->firstOrFail(),
            \App\Models\Airport::query()->where("id", 2)->firstOrFail(),
            \Carbon\Carbon::createFromDate("2021", "05", "05")
        );

        $results = $helper->fetchResults();
        $this->assertTrue(count($results) > 0);
        foreach ($results as $result) {
            $this->assertNotNull($result["return"]);
        }
    }

    public function testFetchInvalidReturnDate() {
        // Return date in past
        $helper = new \App\Http\Helpers\SearchResultHelper(
            \Carbon\Carbon::createFromDate("2021", "04", "25"),
            \App\Models\Airport::query()->where("id", 1)->firstOrFail(),
            \App\Models\Airport::query()->where("id", 2)->firstOrFail(),
            \Carbon\Carbon::createFromDate("2010", "05", "05")
        );

        $this->expectException(\App\Exceptions\InvalidParameters::class);
        $results = $helper->fetchResults();
    }

    public function testFetchResultsSameDestinationAndOrigin() {
        $helper = new \App\Http\Helpers\SearchResultHelper(
            \Carbon\Carbon::createFromDate("2021", "04", "25"),
            \App\Models\Airport::query()->where("id", 1)->firstOrFail(),
            \App\Models\Airport::query()->where("id", 1)->firstOrFail(),
            \Carbon\Carbon::createFromDate("2021", "05", "05")
        );

        $this->expectException(\App\Exceptions\InvalidParameters::class);
        $results = $helper->fetchResults();
    }
}
