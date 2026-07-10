@extends('adminlte::page')

@section('title', 'Create Role')

@section('content_header')
    <h1>Create Role</h1>
@stop

@section('content')

<form action="{{ route('roles.store') }}" method="POST">
    @include('admin.roles._form')
</form>

@stop