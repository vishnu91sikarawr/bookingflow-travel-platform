@extends('adminlte::page')

@section('title', 'Buses')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Buses</h1>

        @can('buses.create')
            <a href="{{ route('buses.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Bus
            </a>
        @endcan
    </div>
@stop

@section('content')

<div class="card">

    <div class="card-header">

        <form action="{{ route('buses.index') }}" method="GET">

            <div class="row">

                <div class="col-md-4">
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search by Bus Name or Number"
                        value="{{ request('search') }}">
                </div>

                <div class="col-md-3">
                    <button class="btn btn-primary">
                        <i class="fas fa-search"></i> Search
                    </button>

                    <a href="{{ route('buses.index') }}" class="btn btn-secondary">
                        Reset
                    </a>
                </div>

            </div>

        </form>

    </div>

    <div class="card-body p-0">

        <table class="table table-bordered table-hover">

            <thead>

                <tr>
                    <th width="60">#</th>
                    <th>Operator</th>
                    <th>Bus Name</th>
                    <th>Bus Number</th>
                    <th>Type</th>
                    <th>Seats</th>
                    <th>Status</th>
                    <th width="160">Action</th>
                </tr>

            </thead>

            <tbody>

               @forelse($bus as $item)

<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $item->busOperator->name ?? '-' }}</td>
    <td>{{ $item->name }}</td>
    <td>{{ $item->bus_number }}</td>
    <td>{{ $item->bus_type }}</td>
    <td>{{ $item->total_seats }}</td>

    <td>
        @if($item->status)
            <span class="badge badge-success">Active</span>
        @else
            <span class="badge badge-danger">Inactive</span>
        @endif
    </td>

    <td>
        <a href="{{ route('buses.edit', $item) }}" class="btn btn-warning btn-sm">
            <i class="fas fa-edit"></i>
        </a>

        <form action="{{ route('buses.destroy', $item) }}"
              method="POST"
              class="d-inline">
            @csrf
            @method('DELETE')

            <button class="btn btn-danger btn-sm"
                    onclick="return confirm('Are you sure?')">
                <i class="fas fa-trash"></i>
            </button>
        </form>
    </td>
</tr>

@empty

<tr>
    <td colspan="8" class="text-center">
        No buses found.
    </td>
</tr>

@endforelse

            </tbody>

        </table>

    </div>

    @if($bus->hasPages())

        <div class="card-footer">

            {{ $bus->links() }}

        </div>

    @endif

</div>

@stop