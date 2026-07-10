<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(Request $request)
{
    $permissions = Permission::with('roles')
        ->when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%');
        })
        ->orderBy('name')
        ->paginate(10);

    return view('admin.permissions.index', compact('permissions'));
}

    public function show(Permission $permission)
    {
        $permission->load('roles');

        return view(
            'admin.permissions.show',
            compact('permission')
        );
    }
}