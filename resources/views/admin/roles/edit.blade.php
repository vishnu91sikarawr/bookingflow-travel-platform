@extends('adminlte::page')

@section('title','Edit Role')

@section('content_header')

<h1>Edit Role</h1>

@stop

@section('content')

<form action="{{ route('roles.update',$role) }}" method="POST">

    @method('PUT')

    @include('admin.roles._form')

</form>

@stop