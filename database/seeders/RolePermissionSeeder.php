<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Seed Roles
        $rolesData = [
            ['name' => 'super admin'], // 1
            ['name' => 'admin'], // 2
            ['name' => 'manager'], // 3
            ['name' => 'staff'], // 4
            ['name' => 'user'], // 5
        ];

        foreach($rolesData as $roleData){
            Role::create($roleData);
        }

        $this->createPermissions();

        // Assign Permissions to Roles
        $superAdmin = Role::where('name', 'super admin')->first();
        $admin = Role::where('name', 'admin')->first();
        $manager = Role::where('name', 'manager')->first();
        $staff = Role::where('name', 'staff')->first();
        $user = Role::where('name', 'user')->first();

        // Assign All Permissions to Role
        $superAdmin->givePermissionTo(Permission::all());
        $admin->givePermissionTo(Permission::all());
        $manager->givePermissionTo(Permission::all());
        $staff->givePermissionTo(Permission::all());
        $user->givePermissionTo(Permission::all());
    }

    Private function createPermissions(): void
    {
        /**
         * Read Permissions
         */
        $read_permissions = [
            ['name' => 'read post'],
        ];

        foreach ($read_permissions as $permissionData){
            Permission::create($permissionData);
        }

         /**
          * Create Permissions
          */
        $create_permissions = [
            ['name' => 'create post'],
        ];

        foreach ($create_permissions as $permissionData){
            Permission::create($permissionData);
        }

          /**
           * Update Permissions
           */
        $update_permissions = [
            ['name' => 'update post'],
        ];

        foreach ($update_permissions as $permissionData){
            Permission::create($permissionData);
        }

           /**
            * Delete Permissions
            */
            $delete_permissions = [
                ['name' => 'delete post'],
            ];

            foreach ($delete_permissions as $permissionData){
                Permission::create($permissionData);
            }
    }
}
