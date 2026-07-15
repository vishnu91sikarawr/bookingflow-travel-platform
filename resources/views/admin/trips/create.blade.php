@extends('adminlte::page')

@section('title', 'Create Trip')

@section('content_header')
<h1>Create Trip</h1>
@stop

@section('content')

<form action="{{ route('trips.store') }}"
      method="POST">

    @include('admin.trips._form')

</form>

@stop