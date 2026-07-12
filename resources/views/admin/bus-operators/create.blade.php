@extends('adminlte::page')

@section('title', 'Add Bus Operator')

@section('content_header')
<h1>Add Bus Operator</h1>
@stop

@section('content')

<form action="{{ route('bus-operators.store') }}" method="POST" enctype="multipart/form-data">
    @include('admin.bus-operators._form')
</form>

@stop
