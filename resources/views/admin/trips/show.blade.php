@extends('adminlte::page')

@section('title', 'Bus Operator Details')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h1>Bus Operator Details</h1>

    @can('bus_operators.edit')
    <a href="{{ route('bus-operators.edit', $busOperator) }}" class="btn btn-warning">
        <i class="fas fa-edit"></i> Edit
    </a>
    @endcan

</div>

@stop

@section('content')

<div class="card">

    <div class="card-body">

        <div class="row mb-4">

            <div class="col-md-12">

                @if($busOperator->logo)

                    <img
                        src="{{ asset('storage/' . $busOperator->logo) }}"
                        alt="{{ $busOperator->name }}"
                        class="img-thumbnail"
                        style="max-height: 120px;">

                @endif

            </div>

        </div>

        <table class="table table-bordered">

            <tr>
                <th width="200">Name</th>
                <td>{{ $busOperator->name }}</td>
            </tr>

            <tr>
                <th>Code</th>
                <td>
                    <span class="badge badge-secondary">
                        {{ $busOperator->code }}
                    </span>
                </td>
            </tr>

            <tr>
                <th>Email</th>
                <td>{{ $busOperator->email ?? '—' }}</td>
            </tr>

            <tr>
                <th>Phone</th>
                <td>{{ $busOperator->phone ?? '—' }}</td>
            </tr>

            <tr>
                <th>Website</th>
                <td>

                    @if($busOperator->website)

                        <a href="{{ $busOperator->website }}" target="_blank" rel="noopener noreferrer">
                            {{ $busOperator->website }}
                        </a>

                    @else

                        —

                    @endif

                </td>
            </tr>

            <tr>
                <th>Address</th>
                <td>{{ $busOperator->address ?? '—' }}</td>
            </tr>

            <tr>
                <th>Description</th>
                <td>{{ $busOperator->description ?? '—' }}</td>
            </tr>

            <tr>
                <th>Status</th>
                <td>

                    @if($busOperator->status)

                        <span class="badge badge-success">Active</span>

                    @else

                        <span class="badge badge-danger">Inactive</span>

                    @endif

                </td>
            </tr>

            <tr>
                <th>Created By</th>
                <td>{{ $busOperator->creator?->name ?? '—' }}</td>
            </tr>

            <tr>
                <th>Updated By</th>
                <td>{{ $busOperator->updater?->name ?? '—' }}</td>
            </tr>

            <tr>
                <th>Created At</th>
                <td>{{ $busOperator->created_at->format('d M Y h:i A') }}</td>
            </tr>

            <tr>
                <th>Updated At</th>
                <td>{{ $busOperator->updated_at->format('d M Y h:i A') }}</td>
            </tr>

        </table>

        <a href="{{ route('bus-operators.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>

    </div>

</div>

@stop
