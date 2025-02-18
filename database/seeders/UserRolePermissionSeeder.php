<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * @return void
     */

    public function run()
    {
        $default_user_value = [
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
       
        $administrator = User::create(array_merge([
            'email' => 'administrator@gmail.com',
            'name' => 'Administrator',
        ], $default_user_value));
        $customer = User::create(array_merge([
            'email' => 'customer@gmail.com',
            'name' => 'Customer',
        ], $default_user_value));
        $technician = User::create(array_merge([
            'email' => 'technician@gmail.com',
            'name' => 'Teknisi',
        ], $default_user_value));
        $driver = User::create(array_merge([
            'email' => 'driver@gmail.com',
            'name' => 'Driver',
        ], $default_user_value));
        $superadmin = User::create(array_merge([
            'email' => 'superadmin@gmail.com',
            'name' => 'Super Admin',
        ], $default_user_value));
        $role_superadmin = Role::create(['name' => 'superadmin']);
        $role_administrator = Role::create(['name' => 'administrator']);
        $role_customer = Role::create(['name' => 'customer']);
        $role_technician = Role::create(['name' => 'technician']);
        $role_driver = Role::create(['name' => 'driver']);


        $permissions = [
            'create user',
            'edit user',
            'delete user',
            'read user',
        ];


        $superadmin->assignRole($role_superadmin);
        $administrator->assignRole($role_administrator);
        $customer->assignRole($role_customer);
        $technician->assignRole($role_technician);
        $driver->assignRole($role_driver);
    }
}
