@extends('adminlte::page')

@section('title', 'Edit Bus Operator')

@section('content_header')
<h1>Edit Bus Operator</h1>
@stop

@section('content')

<form action="{{ route('bus-operators.update', $busOperator) }}" method="POST" enctype="multipart/form-data">

    @method('PUT')

    @include('admin.bus-operators._form', ['busOperator' => $busOperator])

</form>

@stop
