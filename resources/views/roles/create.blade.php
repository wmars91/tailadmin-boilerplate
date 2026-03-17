@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Tambah Role</h2>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Tambahkan role baru ke sistem</p>
    </div>

    <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03]">
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            @include('roles._form', ['role' => null, 'rolePermissions' => []])

            <div class="mt-6 flex items-center gap-3">
                <button type="submit" class="rounded-lg bg-brand-500 px-5 py-2.5 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600">Simpan</button>
                <a href="{{ route('roles.index') }}" class="rounded-lg border border-gray-200 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-800 dark:text-gray-300 dark:hover:bg-gray-800">Batal</a>
            </div>
        </form>
    </div>
@endsection
