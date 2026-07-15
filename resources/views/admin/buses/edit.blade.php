@extends('adminlte::page')

@section('title', 'Edit Bus ')

@section('content_header')
<h1>Edit Bus </h1>
@stop

@section('content')

<form action="{{ route('buses.update', $bus) }}" method="POST" enctype="multipart/form-data">

    @method('PUT')

    @include('admin.buses._form', ['bus' => $bus])

</form>

@stop
