<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

             $permissions = [

            // Team
            'task.create',
            'task.store',
            'task.list',
            'task.edit',
            'task.update',
            'task.delete',


            // Permission
            'permission.create',
            'permission.store',
            'permission.list',
            'permission.edit',
            'permission.update',
            'permission.delete',

             // Role
            'role.create',
            'role.store',
            'role.list',
            'role.edit',
            'role.update',
            'role.delete',
            'add.role.permission',
            'give.role.permission',

            // Users
            'users.list',
            'users.create',
            'users.store',
            'users.edit',
            'users.update',
            'users.delete',
            'users.show',

    ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

    }
}
