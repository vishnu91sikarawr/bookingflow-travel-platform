@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>User Management</h1>

   @can('users.create')
<a href="{{ route('users.create') }}" class="btn btn-primary">
    <i class="fas fa-plus"></i> Add User
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

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            All Users
        </h3>

    </div>

    <div class="card-body table-responsive p-0">

        <table class="table table-hover text-nowrap">

            <thead>

                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th width="150">Actions</th>
                </tr>

            </thead>

            <tbody>

            @forelse($users as $user)

                <tr>

                    <td>
                        {{ $users->firstItem() + $loop->index }}
                    </td>

                    <td>
                        {{ $user->name }}
                    </td>

                    <td>
                        {{ $user->email }}
                    </td>

                    <td>

                        @forelse($user->roles as $role)

                            <span class="badge badge-primary">
                                {{ $role->name }}
                            </span>

                        @empty

                            <span class="badge badge-secondary">
                                No Role
                            </span>

                        @endforelse

                    </td>

                    <td>

                        @if($user->status)

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
                        {{ $user->created_at->format('d M Y') }}
                    </td>

                    <td>

                        @can('users.edit')
<a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm">
    <i class="fas fa-edit"></i>
</a>
@endcan

                      @can('users.delete')
<form action="{{ route('users.destroy',$user) }}"
      method="POST"
      style="display:inline;">

    @csrf
    @method('DELETE')

    <button
        type="submit"
        class="btn btn-danger btn-sm"
        onclick="return confirm('Delete this user?')">

        <i class="fas fa-trash"></i>

    </button>

</form>
@endcan

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7" class="text-center">

                        No users found.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    <div class="card-footer clearfix">

        {{ $users->links() }}

    </div>

</div>

@stop