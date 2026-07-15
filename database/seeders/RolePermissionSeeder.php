<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [

            'dashboard.view',

            // Users
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',

            // Roles
            'roles.view',
            'roles.create',
            'roles.edit',
            'roles.delete',

            // Permissions
            'permissions.view',
            'permissions.create',
            'permissions.edit',
            'permissions.delete',

            // Bus Operators
            'bus-operators.view',
            'bus-operators.create',
            'bus-operators.edit',
            'bus-operators.delete',

            // Buses
            'buses.view',
            'buses.create',
            'buses.edit',
            'buses.delete',

            // Buses Route
            'bus-routes.view',
            'bus-routes.create',
            'bus-routes.edit',
            'bus-routes.delete',

            // Trip
            'trips.view',
            'trips.create',
            'trips.edit',
            'trips.delete',
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
