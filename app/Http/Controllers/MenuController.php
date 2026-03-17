<?php

namespace App\Http\Controllers;

use App\Models\Menu;
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
        return view('menus.create', compact('parentMenus'));
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
            'permission' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Menu::create($validated);

        return redirect()->route('menus.index')
            ->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        $parentMenus = Menu::parentMenus()
            ->where('id', '!=', $menu->id)
            ->ordered()
            ->get();

        return view('menus.edit', compact('menu', 'parentMenus'));
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
            'permission' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $menu->update($validated);

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
