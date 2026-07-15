@extends('adminlte::page')

@section('title', 'Bus Routes')

@section('content_header')

<div class="d-flex justify-content-between">

    <h1>Bus Routes</h1>

    @can('bus-routes.create')
    <a href="{{ route('bus-routes.create') }}"
       class="btn btn-primary">
        <i class="fas fa-plus"></i>
        Add Bus Route
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

        <form>

            <div class="input-group">

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    value="{{ request('search') }}"
                    placeholder="Search route...">

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

                <th>#</th>

                <th>Operator</th>

                <th>Route</th>

                <th>Source</th>

                <th>Destination</th>

                <th>Distance</th>

                <th>Duration</th>

                <th>Status</th>

                <th width="170">Action</th>

            </tr>

            </thead>

            <tbody>

            @forelse($busRoutes as $route)

                <tr>

                    <td>{{ $route->id }}</td>

                    <td>{{ $route->busOperator->name ?? '-' }}</td>

                    <td>{{ $route->name }}</td>

                    <td>{{ $route->source_city }}</td>

                    <td>{{ $route->destination_city }}</td>

                    <td>{{ $route->distance_km }} KM</td>

                    <td>{{ $route->estimated_duration }}</td>

                    <td>

                        @if($route->status)

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

                        @can('bus-routes.edit')

                        <a href="{{ route('bus-routes.edit',$route) }}"
                           class="btn btn-sm btn-warning">

                            <i class="fas fa-edit"></i>

                        </a>

                        @endcan

                        @can('bus-routes.delete')

                        <form
                            action="{{ route('bus-routes.destroy',$route) }}"
                            method="POST"
                            style="display:inline;">

                            @csrf
                            @method('DELETE')

                            <button
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Delete this route?')">

                                <i class="fas fa-trash"></i>

                            </button>

                        </form>

                        @endcan

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="9" class="text-center">
                        No routes found.
                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    <div class="card-footer">

        {{ $busRoutes->links() }}

    </div>

</div>

@stop