@extends('layouts.app')

@section('content')

<h1>Search results</h1>
<div class="search-results">
    @foreach ($results as $result)
        <div class="card result">
            <div class="result-header">
                <p class="price">{{ $result["total_cost"] / 100 }}$ + taxes</p>
                <form method="post" action="{{ route("trips.create") }}">
                    @csrf
                    <input type="hidden" name="departure_flight_id" value="{{ $result["departure"]["flight_id"] }}"/>
                    <input type="hidden" name="departure_date" value="{{ $result["departure"]["departure_date"] }}" />
                    @if ($result["return"])
                        <input type="hidden" name="return_flight_id" value="{{ $result["return"]["flight_id"] }}"/>
                        <input type="hidden" name="return_date" value="{{ $result["return"]["departure_date"] }}" />
                    @endif

                    <button class="btn btn-success">{{__("Buy before its too late !")}}</button>
                </form>

            </div>

            <flight-description
                :flight="{{ json_encode($result["departure"]) }}"
            ></flight-description>

            @if ($result["return"])
                <!-- Return information -->
                <hr/>
                <flight-description
                        :flight="{{ json_encode($result["return"]) }}"
                ></flight-description>
            @endif

        </div>
    @endforeach
</div>

@endsection
<script>
  import FlightDescription from "../../js/components/FlightDescription";
  export default {
    components: {FlightDescription}
  }
</script>
