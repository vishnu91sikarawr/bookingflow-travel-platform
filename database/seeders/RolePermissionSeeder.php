<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [

            'dashboard.view',

            'users.view',
            'users.create',
            'users.edit',
            'users.delete',

            'roles.view',
            'roles.create',
            'roles.edit',
            'roles.delete',

            'permissions.view',
            'permissions.create',
            'permissions.edit',
            'permissions.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
            ]);
        }

        $superAdmin = Role::firstOrCreate([
            'name' => 'Super Admin',
        ]);

        $admin = Role::firstOrCreate([
            'name' => 'Admin',
        ]);

        $travelAgent = Role::firstOrCreate([
            'name' => 'Travel Agent',
        ]);

        $operator = Role::firstOrCreate([
            'name' => 'Operator',
        ]);

        $customer = Role::firstOrCreate([
            'name' => 'Customer',
        ]);

        $superAdmin->givePermissionTo(Permission::all());
    }
}