@extends('layouts.app')

@section('content')

    <h1>Trips</h1>

    <table class="table">
        <thead>
            <tr>
                <th>From</th>
                <th>To</th>
                <th>Date</th>
                <th>Return Date</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trips as $trip)
                <tr>
                    <td>{{ $trip->flights[0]->departureAirport->city }}</td>
                    <td>{{ $trip->flights[0]->arrivalAirport->city }}</td>
                    <td>{{ $trip->departure_date }}</td>
                    <td>{{ $trip->return_date }}</td>
                    <td>
                        <!-- Delete Button -->
                        <form method="POST" action="{{ route("trips.delete", $trip) }}">
                            @csrf
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $trips->links() }}

@endsection
