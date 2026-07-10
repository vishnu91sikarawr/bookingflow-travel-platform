@extends('adminlte::page')

@section('title', 'Permission Management')

@section('content_header')

<div class="d-flex justify-content-between">

    <h1>Permission Management</h1>

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

            <div class="row">

                <div class="col-md-4">

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search Permission..."
                        value="{{ request('search') }}">

                </div>

                <div class="col-md-2">

                    <button class="btn btn-primary">

                        <i class="fas fa-search"></i>

                        Search

                    </button>

                </div>

            </div>

        </form>

    </div>

    <div class="card-body table-responsive p-0">

        <table class="table table-hover">

            <thead>

                <tr>

                    <th>#</th>
                    <th>Module</th>
                    <th>Permission</th>
                    <th>Assigned Roles</th>
                    <th>Created</th>
                    <th width="120">Action</th>

                </tr>

            </thead>

            <tbody>

            @forelse($permissions as $permission)

                @php

                    $parts = explode('.', $permission->name);

                    $module = ucfirst($parts[0]);

                    $action = ucfirst($parts[1] ?? '');

                @endphp

                <tr>

                    <td>{{ $permissions->firstItem() + $loop->index }}</td>

                    <td>

                        <span class="badge badge-info">

                            {{ $module }}

                        </span>

                    </td>

                    <td>

                        {{ $action }}

                    </td>

                    <td>

                        @foreach($permission->roles as $role)

                            <span class="badge badge-success">

                                {{ $role->name }}

                            </span>

                        @endforeach

                    </td>

                    <td>

                        {{ $permission->created_at->format('d M Y') }}

                    </td>

                    <td>

                        <a
                            href="{{ route('permissions.show',$permission) }}"
                            class="btn btn-primary btn-sm">

                            <i class="fas fa-eye"></i>

                        </a>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6" class="text-center">

                        No Permissions Found.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    <div class="card-footer">

        {{ $permissions->withQueryString()->links() }}

    </div>

</div>

@stop