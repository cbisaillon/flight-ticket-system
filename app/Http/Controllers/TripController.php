<?php


namespace App\Http\Controllers;


use App\Models\Trip;
use Illuminate\Http\Client\Request;

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
        return view("trips.index");
    }

    /**
     * Create a new trip
     * @param Request $request
     */
    public function create(Request $request) {

    }

    /**
     * Cancel an existing trip
     * @param Request $request
     * @param Trip $trip
     */
    public function cancel(Request $request, Trip $trip) {

    }
}
