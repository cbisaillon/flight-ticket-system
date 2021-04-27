<?php


namespace App\Http\Controllers;


use App\Exceptions\InvalidParameters;
use App\Http\Helpers\SearchResultHelper;
use App\Models\Airport;
use App\Models\Flight;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * Controller used to allow the customer to
 * plan their trip and review them before creation.
 * Class PlanningController
 * @package App\Http\Controllers
 */
class PlanningController extends Controller
{
    /**
     * Display a form to the user for them to
     * search available flights
     * @param Request $request
     */
    public function index(Request $request){
        $airports = Airport::query()
            ->orderBy("country_code")
            ->orderBy("code")
            ->has("departureFlights")
            ->orHas("arrivalFlights")
            ->with(["departureFlights", "arrivalFlights"])
            ->get();

        return view("planning.index", compact(
            "airports"
        ));
    }

    /**
     * Show the flight search result
     * @param Request $request
     */
    public function result(Request $request){
        $this->validate($request, [
           "origin" => "required|exists:airports,id",
           "destination" => "required|exists:airports,id",
           "departure_date" => "required|date|date_format:Y-m-d",
           "return_date" => "nullable|date|date_format:Y-m-d"
        ]);

        $origin = Airport::query()->where("id", $request->get("origin"))->firstOrFail();
        $destination = Airport::query()->where("id", $request->get("destination"))->firstOrFail();

        $departureDate = Carbon::parse($request->get("departure_date"));

        $returnDate = null;
        if ($request->has("return_date") && !empty($request->get("return_date"))) {
            $returnDate = Carbon::parse($request->get("return_date"));
        }

        $searchResultHelper = new SearchResultHelper(
            $departureDate,
            $origin,
            $destination,
            $returnDate
        );

        try {
            $results = $searchResultHelper->fetchResults();
        } catch (InvalidParameters $exception) {
            Session::flash("error", "Wrong parameters");
            return redirect()->back();
        }

        return view("planning.result",
            compact("results"));
    }
}
