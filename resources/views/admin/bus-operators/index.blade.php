@extends('adminlte::page')

@section('title', 'Bus Operators')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>Bus Operator Management</h1>

    @can('bus_operators.create')
    <a href="{{ route('bus-operators.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Bus Operator
    </a>
    @endcan
</div>
@stop

@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}

    <button type="button" class="close" data-dismiss="alert">
        <span>&times;</span>
    </button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show">
    {{ session('error') }}

    <button type="button" class="close" data-dismiss="alert">
        <span>&times;</span>
    </button>
</div>
@endif

<div class="card">

    <div class="card-header">

        <form method="GET">

            <div class="row">

                <div class="col-md-4">

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search by name, code, email or phone..."
                        value="{{ request('search') }}">

                </div>

                <div class="col-md-2">

                    <button class="btn btn-primary">
                        <i class="fas fa-search"></i> Search
                    </button>

                </div>

            </div>

        </form>

    </div>

    <div class="card-body table-responsive p-0">

        <table class="table table-hover text-nowrap">

            <thead>

                <tr>
                    <th>#</th>
                    <th>Logo</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th width="150">Actions</th>
                </tr>

            </thead>

            <tbody>

            @forelse($busOperators as $busOperator)

                <tr>

                    <td>
                        {{ $busOperators->firstItem() + $loop->index }}
                    </td>

                    <td>

                        @if($busOperator->logo)

                            <img
                                src="{{ asset('storage/' . $busOperator->logo) }}"
                                alt="{{ $busOperator->name }}"
                                class="img-thumbnail"
                                style="max-height: 40px;">

                        @else

                            <span class="text-muted">—</span>

                        @endif

                    </td>

                    <td>
                        {{ $busOperator->name }}
                    </td>

                    <td>
                        <span class="badge badge-secondary">
                            {{ $busOperator->code }}
                        </span>
                    </td>

                    <td>
                        {{ $busOperator->email ?? '—' }}
                    </td>

                    <td>
                        {{ $busOperator->phone ?? '—' }}
                    </td>

                    <td>

                        @if($busOperator->status)

                            <span class="badge badge-success">
                                Active
                            </span>

                        @else

                            <span class="badge badge-danger">
                                Inactive
                            </span>

                        @endif

                    </td>

                    <td>
                        {{ $busOperator->created_at->format('d M Y') }}
                    </td>

                    <td>

                       

                        @can('bus_operators.edit')
                        <a
                            href="{{ route('bus-operators.edit', $busOperator) }}"
                            class="btn btn-warning btn-sm"
                            title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        @endcan

                        @can('bus_operators.delete')
                        <form
                            action="{{ route('bus-operators.destroy', $busOperator) }}"
                            method="POST"
                            style="display:inline;">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-danger btn-sm"
                                title="Delete"
                                onclick="return confirm('Delete this bus operator?')">
                                <i class="fas fa-trash"></i>
                            </button>

                        </form>
                        @endcan

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="9" class="text-center">
                        No bus operators found.
                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    <div class="card-footer clearfix">

        {{ $busOperators->links() }}

    </div>

</div>

@stop
