@extends('adminlte::page')

@section('title', 'Edit Bus Route')

@section('content_header')
<h1>Edit Bus Route</h1>
@stop

@section('content')

<form action="{{ route('bus-routes.update', $busRoute) }}"
      method="POST">

    @method('PUT')

    @include('admin.bus-routes._form')

</form>

@stop