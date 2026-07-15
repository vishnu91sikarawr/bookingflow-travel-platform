@extends('adminlte::page')

@section('title', 'Edit Trip')

@section('content_header')
<h1>Edit Trip</h1>
@stop

@section('content')

<form action="{{ route('trips.update', $trip) }}"
      method="POST">

    @csrf
    @method('PUT')

    @include('admin.trips._form')

</form>

@stop