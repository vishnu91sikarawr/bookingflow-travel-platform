<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    
    public function index()
{
    $users = User::with('roles')
                ->latest()
                ->paginate(10);

    return view('admin.users.index', compact('users'));
}
    public function create()
{
    $roles = Role::orderBy('name')->get();

    return view('admin.users.create', compact('roles'));
}

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed|min:8',
        'role' => 'required|exists:roles,name',
        'status' => 'required|boolean',
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'status' => $validated['status'],
    ]);

    $user->assignRole($validated['role']);

    return redirect()
        ->route('users.index')
        ->with('success', 'User created successfully.');
}

        public function edit(User $user)
{
    $roles = Role::orderBy('name')->get();

    return view('admin.users.edit', compact('user', 'roles'));
}

        public function update(Request $request, User $user)
{
    $validated = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role' => 'required|exists:roles,name',
        'status' => 'required|boolean',
    ]);

    $user->update([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'status' => $validated['status'],
    ]);

    if ($request->filled('password')) {

        $request->validate([
            'password' => 'confirmed|min:8'
        ]);

        $user->update([
            'password' => Hash::make($request->password)
        ]);
    }

    $user->syncRoles([$validated['role']]);

    return redirect()
        ->route('users.index')
        ->with('success', 'User updated successfully.');
}

        public function destroy(User $user)
{
    if (auth()->id() == $user->id) {

        return back()->with('error',
            'You cannot delete your own account.');
    }

    $user->delete();

    return redirect()
        ->route('users.index')
        ->with('success', 'User deleted successfully.');
}
}
