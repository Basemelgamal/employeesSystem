<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ManagerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $managerRole = Role::firstOrCreate(['name' => 'manager']);

        // Create fake users with the "manager" role
        $user = User::create([
            'first_name'=> 'Manager',
            'last_name' => 'Manager',
            'phone'     => '01000000000',
            'email'     => 'admin@admin.com',
            'password'  => Hash::make('P@ssw0rd'),
        ]);

        $user->assignRole($managerRole);
    }
}
