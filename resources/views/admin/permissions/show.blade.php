@extends('adminlte::page')

@section('title','Permission Details')

@section('content_header')

<h1>Permission Details</h1>

@stop

@section('content')

<div class="card">

    <div class="card-body">

        @php

            $parts = explode('.', $permission->name);

        @endphp

        <table class="table table-bordered">

            <tr>

                <th width="200">Module</th>

                <td>

                    <span class="badge badge-info">

                        {{ ucfirst($parts[0]) }}

                    </span>

                </td>

            </tr>

            <tr>

                <th>Permission</th>

                <td>

                    {{ ucfirst($parts[1] ?? '') }}

                </td>

            </tr>

            <tr>

                <th>Permission Key</th>

                <td>

                    <code>{{ $permission->name }}</code>

                </td>

            </tr>

            <tr>

                <th>Assigned Roles</th>

                <td>

                    @forelse($permission->roles as $role)

                        <span class="badge badge-success mr-2">

                            {{ $role->name }}

                        </span>

                    @empty

                        <span class="text-muted">

                            No Role Assigned

                        </span>

                    @endforelse

                </td>

            </tr>

            <tr>

                <th>Created</th>

                <td>

                    {{ $permission->created_at->format('d M Y h:i A') }}

                </td>

            </tr>

        </table>

        <a
            href="{{ route('permissions.index') }}"
            class="btn btn-secondary">

            <i class="fas fa-arrow-left"></i>

            Back

        </a>

    </div>

</div>

@stop