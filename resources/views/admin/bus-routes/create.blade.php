@extends('adminlte::page')

@section('title', 'Create Bus Route')

@section('content_header')
    <h1>Create Bus Route</h1>
@stop

@section('content')

<form
    action="{{ route('bus-routes.store') }}"
    method="POST">

    @include('admin.bus-routes._form')

</form>

@stop