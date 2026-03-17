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
            'permission' => 'manage-users',
            'is_active' => true,
        ]);

        Menu::create([
            'name' => 'Users',
            'route' => 'users.index',
            'parent_id' => $userMgmt->id,
            'group_name' => 'Settings',
            'order' => 1,
            'permission' => 'manage-users',
            'is_active' => true,
        ]);

        Menu::create([
            'name' => 'Roles',
            'route' => 'roles.index',
            'parent_id' => $userMgmt->id,
            'group_name' => 'Settings',
            'order' => 2,
            'permission' => 'manage-roles',
            'is_active' => true,
        ]);

        // Menu Management
        Menu::create([
            'name' => 'Menu Management',
            'icon' => 'menu-management',
            'route' => 'menus.index',
            'group_name' => 'Settings',
            'order' => 20,
            'permission' => 'manage-menus',
            'is_active' => true,
        ]);
    }
}
