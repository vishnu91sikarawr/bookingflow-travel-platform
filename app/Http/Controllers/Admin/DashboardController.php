<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'totalRoles' => Role::count(),
            'totalPermissions' => Permission::count(),
        ]);
    }
}