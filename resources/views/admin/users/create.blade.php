@extends('adminlte::page')

@section('title', 'Add User')

@section('content_header')
<h1>Add User</h1>
@stop

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <h5>
        <i class="fas fa-exclamation-triangle"></i>
        Please fix the following errors:
    </h5>

    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="card">

    <div class="card-body">

        <form action="{{ route('users.store') }}" method="POST">

            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Name</label>

                    <input
                    type="text"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}"
                    required>

                    @error('name')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">

                    <label>Email</label>

                    <input
                    type="email"
                    name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}"
                    required>

                    @error('email')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">

                    <label>Password</label>

                    <input
                    type="password"
                    name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    required>

                    @error('password')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                    @enderror

                <div class="col-md-6 mb-3">

                    <label>Confirm Password</label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Role</label>

                    <select
                    name="role"
                    class="form-control @error('role') is-invalid @enderror"
                    required>

                    @foreach($roles as $role)
                    <option
                    value="{{ $role->name }}"
                    {{ old('role') == $role->name ? 'selected' : '' }}>
                    {{ $role->name }}
                    </option>
                    @endforeach

                    </select>

                    @error('role')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                    @enderror

                </div>

                <div class="col-md-6 mb-3">

                    <label>Status</label>

                    <select
                    name="status"
                    class="form-control @error('status') is-invalid @enderror">

                    <option value="1" {{ old('status',1)==1 ? 'selected' : '' }}>
                    Active
                    </option>

                    <option value="0" {{ old('status')==='0' ? 'selected' : '' }}>
                    Inactive
                    </option>

                    </select>

                    @error('status')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                    @enderror
                </div>

            </div>

            <button class="btn btn-success">
                Save User
            </button>

            <a href="{{ route('users.index') }}" class="btn btn-secondary">
                Cancel
            </a>

        </form>

    </div>

</div>

@stop