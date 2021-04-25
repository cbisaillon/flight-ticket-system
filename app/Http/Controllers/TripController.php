<?php


namespace App\Http\Controllers;


use App\Models\Flight;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controller for the user to manage their trips
 * Class TripController
 * @package App\Http\Controllers
 */
class TripController extends Controller
{

    /**
     * Show the list of future trips of the
     * user
     * @param Request $request
     */
    public function index(Request $request) {
        $trips = Auth::user()->trips()
            ->orderBy("departure_date", "ASC")
            ->paginate(2);

        return view("trips.index", compact("trips"));
    }

    /**
     * Create a new trip
     * @param Request $request
     */
    public function create(Request $request) {
        $this->validate($request, [
            "departure_flight_id" => "required|numeric|exists:flights,id",
            "return_flight_id" => "nullable|numeric|exists:flights,id",
            "departure_date" => "required|date|date_format:Y-m-d H:i:s",
            "return_date" => "nullable|date|date_format:Y-m-d H:i:s"
        ]);

        $departureFlight = Flight::query()
            ->where("id", $request->get("departure_flight_id"))
            ->firstOrFail();
        $totalCost = $departureFlight->price;

        if ($request->has("return_flight_id")) {
            $returnFlight = Flight::query()
                ->where("id", $request->get("return_flight_id"))
                ->firstOrFail();
            $totalCost += $returnFlight->price;
        }

        // Create the trip
        $trip = new Trip([
            "user_id" => Auth::user()->id,
            "departure_date" => $request->get("departure_date"),
            "return_date" => $request->get("return_date"),
            "total_cost" => $totalCost
        ]);

        $trip->save();

        // Associate the flights
        $trip->flights()->attach($departureFlight->id);

        if (isset($returnFlight)) {
            $trip->flights()->attach($returnFlight->id);
        }

        return redirect(route("trips.index"));
    }

    /**
     * Cancel an existing trip
     * @param Request $request
     * @param Trip $trip
     */
    public function delete(Request $request, Trip $trip) {
        $this->authorize("delete", $trip);
        $trip->delete();
        return redirect()->back();
    }
}
