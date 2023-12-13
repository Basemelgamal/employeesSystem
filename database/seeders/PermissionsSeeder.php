<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $roles = ['manager', 'employee'];
        foreach ($roles as $roleName) {
            Role::create(['name' => $roleName]);
        }

        // Define permissions
        $permissions = [
            'edit employees',
            'publish employees',
            'delete employees',

            'edit tasks',
            'publish tasks',
            'delete tasks',

            'edit departments',
            'publish departments',
            'delete departments',
            // Add more permissions as needed
        ];

        // Assign each permission to every role
        foreach ($roles as $roleName) {
            $role = Role::findByName($roleName);

            foreach ($permissions as $permissionName) {
                $permission = Permission::findOrCreate($permissionName);
                $role->givePermissionTo($permission);
            }
        }
    }
}
