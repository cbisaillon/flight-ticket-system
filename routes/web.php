<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware("auth")->group(function() {
    Route::name("planning")->group(function() {
        Route::get("/", "PlanningController@index")->name("index");
        Route::get("/results", "PlanningController@result")->name("result");
    });

    Route::name("trips")->prefix("trips")->group(function() {
        Route::get("/", "TripController@index")->name("index");
        Route::post("/create", "TripController@create")->name("create");
        Route::post("/{trip}/delete", "TripController@delete")->name("delete");
    });

});

Auth::routes();
