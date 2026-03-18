@extends('layouts.app')

@section('content')
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-semibold text-gray-800 dark:text-white/90">
            Profile Settings
        </h2>
    </div>

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">
        <div class="flex flex-col gap-6">
            <!-- Update Profile Info Card -->
            <div class="rounded-2xl border border-gray-200 bg-white shadow-theme-sm dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-200 px-5 py-4 dark:border-gray-800">
                    <h3 class="font-medium text-gray-800 dark:text-white/90">
                        Informasi Profil
                    </h3>
                </div>
                <div class="p-5">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-6">
            <!-- Update Password Card -->
            <div class="rounded-2xl border border-gray-200 bg-white shadow-theme-sm dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-200 px-5 py-4 dark:border-gray-800">
                    <h3 class="font-medium text-gray-800 dark:text-white/90">
                        Ganti Password
                    </h3>
                </div>
                <div class="p-5">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
@endsection
