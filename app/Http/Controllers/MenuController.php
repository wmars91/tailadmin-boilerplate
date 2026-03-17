<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('parent')
            ->ordered()
            ->paginate(20);

        return view('menus.index', compact('menus'));
    }

    public function create()
    {
        $parentMenus = Menu::parentMenus()->ordered()->get();
        $roles = Role::all();
        return view('menus.create', compact('parentMenus', 'roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'route' => 'nullable|string|max:255',
            'url' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:menus,id',
            'group_name' => 'required|string|max:255',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $menu = Menu::create([
            'name' => $validated['name'],
            'icon' => $validated['icon'] ?? null,
            'route' => $validated['route'] ?? null,
            'url' => $validated['url'] ?? null,
            'parent_id' => $validated['parent_id'] ?? null,
            'group_name' => $validated['group_name'],
            'order' => $validated['order'],
            'is_active' => $validated['is_active'],
        ]);

        if (in_array('roles', array_keys($validated)) && !empty($validated['roles'])) {
            $menu->roles()->sync($validated['roles']);
        }

        return redirect()->route('menus.index')
            ->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        $parentMenus = Menu::parentMenus()
            ->where('id', '!=', $menu->id)
            ->ordered()
            ->get();

        $roles = Role::all();
        $menuRoles = $menu->roles->pluck('id')->toArray();

        return view('menus.edit', compact('menu', 'parentMenus', 'roles', 'menuRoles'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'route' => 'nullable|string|max:255',
            'url' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:menus,id',
            'group_name' => 'required|string|max:255',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $menu->update([
            'name' => $validated['name'],
            'icon' => $validated['icon'] ?? null,
            'route' => $validated['route'] ?? null,
            'url' => $validated['url'] ?? null,
            'parent_id' => $validated['parent_id'] ?? null,
            'group_name' => $validated['group_name'],
            'order' => $validated['order'],
            'is_active' => $validated['is_active'],
        ]);

        $menu->roles()->sync($validated['roles'] ?? []);

        return redirect()->route('menus.index')
            ->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('menus.index')
            ->with('success', 'Menu berhasil dihapus.');
    }
}
