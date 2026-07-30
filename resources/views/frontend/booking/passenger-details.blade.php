@extends('frontend.layouts.app')

@section('title', 'Passenger Details')

@section('content')

<div class="container py-5">

    <div class="row">

        <div class="col-lg-8">
                @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4 class="mb-0">Passenger Details</h4>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('booking.store', $trip->id) }}">
                        @csrf

                        <input type="hidden" name="trip_id" value="{{ $trip->id }}">

                        @foreach($seats as $index => $seat)

                            <input
                                type="hidden"
                                name="seats[]"
                                value="{{ $seat }}"
                            >

                            <div class="border rounded p-3 mb-4">

                                <h5 class="mb-3">
                                    Passenger {{ $index + 1 }}
                                    <span class="badge bg-secondary">
                                        Seat {{ $seat }}
                                    </span>
                                </h5>

                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            Full Name
                                        </label>

                                        <input
                                            type="text"
                                            name="passengers[{{ $index }}][name]"
                                            class="form-control"
                                            value="{{ old("passengers.$index.name") }}"
                                            required
                                        >

                                        @error("passengers.$index.name")
                                            <div class="text-danger small">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            Age
                                        </label>

                                        <input
                                            type="number"
                                            name="passengers[{{ $index }}][age]"
                                            class="form-control"
                                            value="{{ old("passengers.$index.age") }}"
                                            min="1"
                                            max="120"
                                            required
                                        >

                                        @error("passengers.$index.age")
                                            <div class="text-danger small">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            Gender
                                        </label>

                                        <select
                                            name="passengers[{{ $index }}][gender]"
                                            class="form-select"
                                            required
                                        >
                                            <option value="">Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>

                                        @error("passengers.$index.gender")
                                            <div class="text-danger small">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                </div>

                            </div>

                        @endforeach

                        <button type="submit" class="btn btn-primary">
                            Continue to Review
                        </button>

                    </form>

                </div>
            </div>

        </div>

        <div class="col-lg-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    <h5 class="mb-0">Booking Summary</h5>
                </div>

                <div class="card-body">

                    <p>
                        <strong>Route:</strong>
                        {{ $trip->route->source ?? '' }}
                        →
                        {{ $trip->route->destination ?? '' }}
                    </p>

                    <p>
                        <strong>Selected Seats:</strong>
                        {{ implode(', ', $seats) }}
                    </p>

                    <p>
                        <strong>Passengers:</strong>
                        {{ $seatCount }}
                    </p>

                    <p>
                        <strong>Fare / Seat:</strong>
                        ${{ number_format($farePerSeat, 2) }}
                    </p>

                    <hr>

                    <h5>
                        Total:
                        ${{ number_format($totalFare, 2) }}
                    </h5>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

