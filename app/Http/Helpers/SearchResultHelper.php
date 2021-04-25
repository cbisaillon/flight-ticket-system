<?php


namespace App\Http\Helpers;


use App\Exceptions\InvalidParameters;
use App\Models\Airport;
use App\Models\Flight;
use Carbon\CarbonInterface;

class SearchResultHelper
{
    /**
     * @var CarbonInterface
     */
    private $departureDate;

    /**
     * @var CarbonInterface
     */
    private $returnDate;

    /**
     * @var Airport
     */
    private $from;

    /**
     * @var Airport
     */
    private $to;


    public function __construct(
        CarbonInterface $departureDate,
        Airport $from,
        Airport $to,
        CarbonInterface $returnDate=null) {

        $this->departureDate = $departureDate;
        $this->returnDate = $returnDate;
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * Fetch a list of potential trips with the
     * provided origin and destination airport and dates
     * @return array
     */
    public function fetchResults(): array {
        // Make sure parameters are good
        if ($this->returnDate !== null && $this->returnDate->lessThan($this->departureDate)) {
            throw new InvalidParameters("returnDate");
        }

        if ($this->from->id === $this->to->id) {
            throw new InvalidParameters("to");
        }

        // Find possible departures
        $flightsDeparture = Flight::query()
            ->where("departure_airport_id", $this->from->id)
            ->where("arrival_airport_id", $this->to->id)
            ->get();

        // Find possible returns
        if ($this->returnDate !== null) {
            // Customer is asking for a round trip
            $flightsReturn = Flight::query()
                ->where("departure_airport_id", $this->to->id)
                ->where("arrival_airport_id", $this->from->id)
                ->get();
        }

        $results = [];
        foreach ($flightsDeparture as $departure) {

            if (!isset($flightsReturn)) {
                // One way
                $results[] = [
                    "departure" => [
                        "flight_id" => $departure->id,
                        "origin_airport" => $departure->departureAirport,
                        "arrival_airport" => $departure->arrivalAirport,
                        "departure_date" => $this->departureDate->copy()->setTimeFrom($departure->departure_time)->format("Y-m-d H:i:s"),
                        "arrival_date" => $this->departureDate->copy()->setTimeFrom($departure->arrival_time)->format("Y-m-d H:i:s")
                    ],
                    "return" => null,
                    "total_cost" => $departure->price
                ];
            } else {
                // Round trip
                foreach ($flightsReturn as $return) {
                    $results[] = [
                        "departure" => [
                            "flight_id" => $departure->id,
                            "origin_airport" => $departure->departureAirport,
                            "arrival_airport" => $departure->arrivalAirport,
                            "departure_date" => $this->departureDate->copy()->setTimeFrom($departure->departure_time)->format("Y-m-d H:i:s"),
                            "arrival_date" => $this->departureDate->copy()->setTimeFrom($departure->arrival_time)->format("Y-m-d H:i:s")
                        ],
                        "return" => [
                            "flight_id" => $return->id,
                            "origin_airport" => $return->departureAirport,
                            "arrival_airport" => $return->arrivalAirport,
                            "departure_date" => $this->returnDate->copy()->setTimeFrom($departure->departure_time)->format("Y-m-d H:i:s"),
                            "arrival_date" => $this->returnDate->copy()->setTimeFrom($departure->arrival_time)->format("Y-m-d H:i:s")
                        ],
                        "total_cost" => $departure->price + $return->price
                    ];
                }
            }
        }

        return $results;
    }
}
