<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // Dashboard
        Menu::create([
            'name' => 'Dashboard',
            'icon' => 'dashboard',
            'route' => 'dashboard',
            'group_name' => 'Menu',
            'order' => 1,
            'is_active' => true,
        ]);

        // User Management (parent)
        $userMgmt = Menu::create([
            'name' => 'User Management',
            'icon' => 'user-management',
            'group_name' => 'Settings',
            'order' => 10,
            'is_active' => true,
        ]);
        $userMgmt->roles()->sync([\Spatie\Permission\Models\Role::where('name', 'admin')->first()->id]);

        $users = Menu::create([
            'name' => 'Users',
            'route' => 'users.index',
            'parent_id' => $userMgmt->id,
            'group_name' => 'Settings',
            'order' => 1,
            'is_active' => true,
        ]);
        $users->roles()->sync([\Spatie\Permission\Models\Role::where('name', 'admin')->first()->id]);

        $roles = Menu::create([
            'name' => 'Roles',
            'route' => 'roles.index',
            'parent_id' => $userMgmt->id,
            'group_name' => 'Settings',
            'order' => 2,
            'is_active' => true,
        ]);
        $roles->roles()->sync([\Spatie\Permission\Models\Role::where('name', 'admin')->first()->id]);

        $settings = Menu::create([
            'name' => 'Pengaturan Aplikasi',
            'route' => 'settings.index',
            'parent_id' => $userMgmt->id,
            'group_name' => 'Settings',
            'order' => 15,
            'is_active' => true,
        ]);
        $settings->roles()->sync([\Spatie\Permission\Models\Role::where('name', 'superadmin')->first()->id]);

        $auditLogs = Menu::create([
            'name' => 'Audit Logs',
            'route' => 'activity-logs.index',
            'parent_id' => $userMgmt->id,
            'group_name' => 'Settings',
            'order' => 20,
            'is_active' => true,
        ]);
        $auditLogs->roles()->sync([\Spatie\Permission\Models\Role::where('name', 'superadmin')->first()->id]);

        // Menu Management
        Menu::create([
            'name' => 'Menu Management',
            'icon' => 'menu-management',
            'route' => 'menus.index',
            'group_name' => 'Settings',
            'order' => 20,
            'is_active' => true,
        ]);
    }
}
