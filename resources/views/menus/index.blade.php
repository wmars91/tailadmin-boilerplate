@extends('layouts.app')

@section('content')
    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <div>
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Menu Management</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kelola menu navigasi sistem</p>
        </div>
        <a href="{{ route('menus.create') }}"
            class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600">
            <svg width="20" height="20" fill="none" viewBox="0 0 20 20"><path d="M10 4.167v11.666M4.167 10h11.666" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
            Tambah Menu
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-lg border border-success-200 bg-success-50 p-4 text-sm text-success-700 dark:border-success-500/20 dark:bg-success-500/10 dark:text-success-400">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-gray-800">
                        <th class="px-5 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Nama</th>
                        <th class="px-5 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Icon</th>
                        <th class="px-5 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Route/URL</th>
                        <th class="px-5 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Group</th>
                        <th class="px-5 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Parent</th>
                        <th class="px-5 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Order</th>
                        <th class="px-5 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Status</th>
                        <th class="px-5 py-3 text-right text-sm font-medium text-gray-500 dark:text-gray-400">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                    @forelse($menus as $menu)
                        <tr>
                            <td class="px-5 py-4 text-sm text-gray-800 dark:text-white/90">{{ $menu->name }}</td>
                            <td class="px-5 py-4 text-sm text-gray-500">{{ $menu->icon ?? '-' }}</td>
                            <td class="px-5 py-4 text-sm text-gray-500">{{ $menu->route ?? $menu->url ?? '-' }}</td>
                            <td class="px-5 py-4 text-sm text-gray-500">{{ $menu->group_name }}</td>
                            <td class="px-5 py-4 text-sm text-gray-500">{{ $menu->parent?->name ?? '-' }}</td>
                            <td class="px-5 py-4 text-sm text-gray-500">{{ $menu->order }}</td>
                            <td class="px-5 py-4">
                                @if($menu->roles->count() > 0)
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($menu->roles as $role)
                                            <span class="inline-flex rounded-full bg-brand-50 px-2 py-1 text-xs font-medium text-brand-700 dark:bg-brand-500/10 dark:text-brand-400">{{ $role->name }}</span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-xs text-gray-400">Semua (Publik)</span>
                                @endif
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('menus.edit', $menu) }}" class="rounded-lg p-1.5 text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white">
                                        <svg width="20" height="20" fill="none" viewBox="0 0 20 20"><path d="M14.166 2.5l3.334 3.334M2.5 17.5l.833-3.75L13.75 3.333l3.333 3.334L6.667 17.083 2.5 17.5z" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </a>
                                    <form action="{{ route('menus.destroy', $menu) }}" method="POST" onsubmit="return confirm('Yakin hapus menu ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-lg p-1.5 text-gray-500 hover:bg-error-50 hover:text-error-600 dark:text-gray-400 dark:hover:bg-error-500/10 dark:hover:text-error-400">
                                            <svg width="20" height="20" fill="none" viewBox="0 0 20 20"><path d="M6.667 5V3.333A1.667 1.667 0 018.333 1.667h3.334a1.667 1.667 0 011.666 1.666V5m2.5 0v11.667a1.667 1.667 0 01-1.666 1.666H5.833a1.667 1.667 0 01-1.666-1.666V5h11.666z" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-5 py-8 text-center text-sm text-gray-500 dark:text-gray-400">Belum ada menu</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($menus->hasPages())
            <div class="border-t border-gray-200 px-5 py-3 dark:border-gray-800">
                {{ $menus->links() }}
            </div>
        @endif
    </div>
@endsection
