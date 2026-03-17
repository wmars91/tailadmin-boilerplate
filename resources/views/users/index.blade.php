@extends('layouts.app')

@section('content')
    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <div>
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">User Management</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kelola pengguna sistem</p>
        </div>
        <a href="{{ route('users.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600">
            <svg width="20" height="20" fill="none" viewBox="0 0 20 20"><path d="M10 4.167v11.666M4.167 10h11.666" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
            Tambah User
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-lg border border-success-200 bg-success-50 p-4 text-sm text-success-700 dark:border-success-500/20 dark:bg-success-500/10 dark:text-success-400">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 rounded-lg border border-error-200 bg-error-50 p-4 text-sm text-error-700 dark:border-error-500/20 dark:bg-error-500/10 dark:text-error-400">{{ session('error') }}</div>
    @endif

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-gray-800">
                        <th class="px-5 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Nama</th>
                        <th class="px-5 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Username</th>
                        <th class="px-5 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">NIP</th>
                        <th class="px-5 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Departement</th>
                        <th class="px-5 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-400">Role</th>
                        <th class="px-5 py-3 text-right text-sm font-medium text-gray-500 dark:text-gray-400">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                    @forelse($users as $user)
                        <tr>
                            <td class="px-5 py-4 text-sm text-gray-800 dark:text-white/90">{{ $user->name }}</td>
                            <td class="px-5 py-4 text-sm text-gray-500">{{ $user->username }}</td>
                            <td class="px-5 py-4 text-sm text-gray-500">{{ $user->nip ?? '-' }}</td>
                            <td class="px-5 py-4 text-sm text-gray-500">{{ $user->departement ?? '-' }}</td>
                            <td class="px-5 py-4">
                                @foreach($user->roles as $role)
                                    <span class="inline-flex rounded-full bg-brand-50 px-2 py-1 text-xs font-medium text-brand-700 dark:bg-brand-500/10 dark:text-brand-400">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td class="px-5 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('users.edit', $user) }}" class="rounded-lg p-1.5 text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white">
                                        <svg width="20" height="20" fill="none" viewBox="0 0 20 20"><path d="M14.166 2.5l3.334 3.334M2.5 17.5l.833-3.75L13.75 3.333l3.333 3.334L6.667 17.083 2.5 17.5z" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </a>
                                    @if($user->id !== auth()->id())
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Yakin hapus user ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="rounded-lg p-1.5 text-gray-500 hover:bg-error-50 hover:text-error-600 dark:text-gray-400 dark:hover:bg-error-500/10 dark:hover:text-error-400">
                                            <svg width="20" height="20" fill="none" viewBox="0 0 20 20"><path d="M6.667 5V3.333A1.667 1.667 0 018.333 1.667h3.334a1.667 1.667 0 011.666 1.666V5m2.5 0v11.667a1.667 1.667 0 01-1.666 1.666H5.833a1.667 1.667 0 01-1.666-1.666V5h11.666z" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-8 text-center text-sm text-gray-500 dark:text-gray-400">Belum ada user</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
            <div class="border-t border-gray-200 px-5 py-3 dark:border-gray-800">{{ $users->links() }}</div>
        @endif
    </div>
@endsection
