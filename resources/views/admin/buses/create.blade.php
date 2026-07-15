@extends('adminlte::page')

@section('title', 'Add Bus ')

@section('content_header')
<h1>Add Bus </h1>
@stop

@section('content')

<form action="{{ route('buses.store') }}" method="POST" enctype="multipart/form-data">
    @include('admin.buses._form')
</form>

@stop
