@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>BookingFlow Dashboard</h1>
@stop

@section('content')

<div class="row">

    <div class="col-lg-4">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $totalUsers }}</h3>
                <p>Total Users</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalRoles }}</h3>
                <p>Total Roles</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-shield"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $totalPermissions }}</h3>
                <p>Total Permissions</p>
            </div>
            <div class="icon">
                <i class="fas fa-key"></i>
            </div>
        </div>
    </div>

</div>

@stop