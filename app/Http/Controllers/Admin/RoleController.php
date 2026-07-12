<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of roles.
     */
    public function index()
    {
        $roles = Role::withCount(['users', 'permissions'])
            ->latest()
            ->paginate(10);

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        $permissions = Permission::orderBy('name')
            ->get()
            ->groupBy(function ($permission) {
                return ucfirst(explode('.', $permission->name)[0]);
            });

        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store new role.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        $role = Role::create([
            'name' => $validated['name'],
        ]);

        if (! empty($validated['permissions'])) {
            $role->syncPermissions($validated['permissions']);
        }

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role created successfully.');
    }

    /**
     * Show edit form.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::orderBy('name')
            ->get()
            ->groupBy(function ($permission) {
                return ucfirst(explode('.', $permission->name)[0]);
            });

        $rolePermissions = $role->permissions
            ->pluck('name')
            ->toArray();

        return view(
            'admin.roles.edit',
            compact(
                'role',
                'permissions',
                'rolePermissions'
            )
        );
    }

    /**
     * Update role.
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,'.$role->id,
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        $role->update([
            'name' => $validated['name'],
        ]);

        $role->syncPermissions(
            $validated['permissions'] ?? []
        );

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role updated successfully.');
    }

    /**
     * Delete role.
     */
    public function destroy(Role $role)
    {
        // Protect Super Admin role
        if (strtolower($role->name) === 'super admin') {
            return redirect()
                ->route('roles.index')
                ->with('error', 'Super Admin role cannot be deleted.');
        }

        // Prevent deleting roles assigned to users
        if ($role->users()->count() > 0) {
            return redirect()
                ->route('roles.index')
                ->with(
                    'error',
                    'This role has assigned users and cannot be deleted.'
                );
        }

        $role->delete();

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role deleted successfully.');
    }
}
