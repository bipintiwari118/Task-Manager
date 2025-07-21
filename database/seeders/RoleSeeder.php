<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Create roles
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $user = Role::firstOrCreate(['name' => 'User']);

        // Assign all permissions to superadmin
        $allPermissions = Permission::all();
        $admin->syncPermissions($allPermissions);


           // Create or update a superadmin user
        $user = User::updateOrCreate(
            ['email' => 'bipintiwari118@gmail.com'],
            [
                'name' => 'Bipin Tiwari',
                'password' => Hash::make('bipin@2002'), // Change after seeding!
            ]
        );


        $user->assignRole($admin);
    }
}
