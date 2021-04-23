<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

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
        return view("planning.index");
    }

    /**
     * Show the flight search result
     * @param Request $request
     */
    public function result(Request $request){
        return view("planning.result");
    }
}
