@extends('adminlte::page')

@section('title', 'Role Management')

@section('content_header')

<div class="d-flex justify-content-between">

    <h1>Role Management</h1>
   @can('roles.create')
    <a href="{{ route('roles.create') }}" class="btn btn-primary">

        <i class="fas fa-plus"></i>

        Add Role

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

@if(session('error'))

<div class="alert alert-danger">

    {{ session('error') }}

</div>

@endif

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            All Roles

        </h3>

    </div>

    <div class="card-body table-responsive p-0">

        <table class="table table-hover">

            <thead>

                <tr>

                    <th>#</th>

                    <th>Role</th>

                    <th>Users</th>

                    <th>Permissions</th>

                    <th>Created</th>

                    <th width="150">Actions</th>

                </tr>

            </thead>

            <tbody>

            @forelse($roles as $role)

                <tr>

                    <td>{{ $roles->firstItem()+$loop->index }}</td>

                    <td>

                        <span class="badge badge-primary">

                            {{ $role->name }}

                        </span>

                    </td>

                    <td>

                        {{ $role->users_count }}

                    </td>

                    <td>

                        {{ $role->permissions_count }}

                    </td>

                    <td>

                        {{ $role->created_at->format('d M Y') }}

                    </td>

                    <td>
                         @can('roles.edit')
                        <a
                            href="{{ route('roles.edit',$role) }}"
                            class="btn btn-warning btn-sm">

                            <i class="fas fa-edit"></i>

                        </a>
                        @endcan
                         @can('roles.delete')
                       <form action="{{ route('roles.destroy', $role) }}"
      method="POST"
      style="display:inline;">

    @csrf
    @method('DELETE')

    <button
        type="submit"
        class="btn btn-danger btn-sm"
        onclick="return confirm('Are you sure you want to delete this role?')">

        <i class="fas fa-trash"></i>

    </button>

</form>
@endcan

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6" class="text-center">

                        No Roles Found.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    <div class="card-footer">

        {{ $roles->links() }}

    </div>

</div>

@stop