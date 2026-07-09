@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>BookingFlow Dashboard</h1>
@stop

@section('content')
<div class="row">

    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>0</h3>
                <p>Total Users</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>0</h3>
                <p>Total Buses</p>
            </div>
            <div class="icon">
                <i class="fas fa-bus"></i>
            </div>
        </div>
    </div>

</div>
@stop