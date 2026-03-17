@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Dashboard</h2>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Selamat datang, {{ auth()->user()->name }}!</p>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
        {{-- Card: Total Users --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-brand-50 text-brand-500 dark:bg-brand-500/[0.12] dark:text-brand-400">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M15.5 7.5C15.5 9.433 13.933 11 12 11C10.067 11 8.5 9.433 8.5 7.5C8.5 5.567 10.067 4 12 4C13.933 4 15.5 5.567 15.5 7.5Z" stroke="currentColor" stroke-width="1.5"/><path d="M19.5 19.5H4.5C4.5 16.186 7.186 13.5 10.5 13.5H13.5C16.814 13.5 19.5 16.186 19.5 19.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Users</p>
                    <h4 class="text-2xl font-bold text-gray-800 dark:text-white/90">{{ \App\Models\User::count() }}</h4>
                </div>
            </div>
        </div>

        {{-- Card: Total Roles --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-success-50 text-success-500 dark:bg-success-500/[0.12] dark:text-success-400">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Roles</p>
                    <h4 class="text-2xl font-bold text-gray-800 dark:text-white/90">{{ \Spatie\Permission\Models\Role::count() }}</h4>
                </div>
            </div>
        </div>

        {{-- Card: Total Permissions --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-warning-50 text-warning-500 dark:bg-warning-500/[0.12] dark:text-warning-400">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M12 15V17M6 21H18C19.1046 21 20 20.1046 20 19V13C20 11.8954 19.1046 11 18 11H6C4.89543 11 4 11.8954 4 13V19C4 20.1046 4.89543 21 6 21ZM16 11V7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7V11H16Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Permissions</p>
                    <h4 class="text-2xl font-bold text-gray-800 dark:text-white/90">{{ \Spatie\Permission\Models\Permission::count() }}</h4>
                </div>
            </div>
        </div>

        {{-- Card: Total Menus --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-error-50 text-error-500 dark:bg-error-500/[0.12] dark:text-error-400">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M4 6H20M4 12H20M4 18H20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Menus</p>
                    <h4 class="text-2xl font-bold text-gray-800 dark:text-white/90">{{ \App\Models\Menu::count() }}</h4>
                </div>
            </div>
        </div>
    </div>
@endsection
