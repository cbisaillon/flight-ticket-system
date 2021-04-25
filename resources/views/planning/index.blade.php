@extends('layouts.app')

@section('content')

<h1>Trip Planner</h1>

<trip-planner-form
    result-endpoint="{{route("planning.result")}}"
    :airports="{{json_encode($airports)}}"
></trip-planner-form>

@endsection
