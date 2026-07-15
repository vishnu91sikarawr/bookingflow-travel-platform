@extends('adminlte::page')

@section('title', 'Trips')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h1>Trips</h1>

    @can('trips.create')
    <a href="{{ route('trips.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Trip
    </a>
    @endcan

</div>

@stop

@section('content')

@if(session('success'))

<div class="alert alert-success">
    {{ session('success') }}
</div>

@endif

<div class="card">

    <div class="card-header">

        <form method="GET">

            <div class="input-group">

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search Trip..."
                    value="{{ request('search') }}">

                <button class="btn btn-primary">
                    Search
                </button>

            </div>

        </form>

    </div>

    <div class="card-body table-responsive">

        <table class="table table-bordered table-hover">

            <thead>

            <tr>

                <th>ID</th>

                <th>Trip Code</th>

                <th>Operator</th>

                <th>Bus</th>

                <th>Route</th>

                <th>Departure</th>

                <th>Arrival</th>

                <th>Fare</th>

                <th>Seats</th>

                <th>Status</th>

                <th width="160">Action</th>

            </tr>

            </thead>

            <tbody>

            @forelse($trips as $trip)

                <tr>

                    <td>{{ $trip->id }}</td>

                    <td>
                        <strong>{{ $trip->trip_code }}</strong>
                    </td>

                    <td>
                        {{ $trip->busOperator->name ?? '-' }}
                    </td>

                    <td>
                        {{ $trip->bus->name ?? '-' }}
                    </td>

                    <td>
                        {{ $trip->busRoute->name ?? '-' }}
                    </td>

                    <td>
                        {{ $trip->departure_date?->format('d M Y') }}

                        <br>

                        <small class="text-muted">
                            {{ $trip->departure_time }}
                        </small>

                    </td>

                    <td>
                        {{ $trip->arrival_time }}
                    </td>

                    <td>
                        ₹{{ number_format($trip->fare, 2) }}
                    </td>

                    <td>
                        {{ $trip->available_seats }}
                    </td>

                    <td>

                        @if($trip->status)

                            <span class="badge bg-success">
                                Active
                            </span>

                        @else

                            <span class="badge bg-danger">
                                Inactive
                            </span>

                        @endif

                    </td>

                    <td>

                        @can('trips.edit')

                        <a href="{{ route('trips.edit', $trip) }}"
                           class="btn btn-sm btn-warning">

                            <i class="fas fa-edit"></i>

                        </a>

                        @endcan

                        @can('trips.delete')

                        <form
                            action="{{ route('trips.destroy', $trip) }}"
                            method="POST"
                            style="display:inline;">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Delete this trip?')">

                                <i class="fas fa-trash"></i>

                            </button>

                        </form>

                        @endcan

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="11" class="text-center">
                        No trips found.
                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    <div class="card-footer">

        {{ $trips->links() }}

    </div>

</div>

@stop