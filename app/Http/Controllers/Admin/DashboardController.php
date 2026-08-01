<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Bus;
use App\Models\BusOperator;
use App\Models\BusRoute;
use App\Models\Trip;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index()
    {

        return view('admin.dashboard', [

            // User & RBAC
            'totalUsers' => User::count(),

            'totalCustomers' => User::role('Customer')->count(),

            'totalRoles' => Role::count(),

            'totalPermissions' => Permission::count(),

            // Travel Management
            'totalOperators' => BusOperator::count(),

            'totalBuses' => Bus::count(),

            'totalRoutes' => BusRoute::count(),

            'totalTrips' => Trip::count(),

            // Booking Management
            'totalBookings' => Booking::count(),

            'totalRevenue' => Booking::where('payment_status', 'paid')
                ->sum('total_amount'),

            'latestBookings' => Booking::with([
                'user',
                'trip.busRoute',
            ])
                ->latest()
                ->take(5)
                ->get(),

            // Demo Revenue Chart
            'revenueChart' => [
                12000,
                18000,
                15000,
                24000,
                30000,
                42000,
                38000,
                46000,
                51000,
                48000,
                62000,
                70000,
            ],

        ]);
    }
}
