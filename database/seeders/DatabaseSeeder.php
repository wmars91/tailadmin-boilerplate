<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seeder roles & permissions
        $this->call(RolePermissionSeeder::class);

        // Seeder menus
        $this->call(MenuSeeder::class);

        // Create admin user
        $admin = User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'nip' => '000001',
            'departement' => 'IT',
            'company' => 'Company',
            'kdcab' => '001',
        ]);

        $admin->assignRole('superadmin');
    }
}
