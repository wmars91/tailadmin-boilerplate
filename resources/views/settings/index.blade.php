@extends('layouts.app')

@section('content')
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-semibold text-gray-800 dark:text-white/90">
            Pengaturan Aplikasi
        </h2>
    </div>

    @if (session('success'))
        <div class="mb-6 flex w-full border-l-6 border-success bg-success/10 px-7 py-4 shadow-md dark:bg-success/20 dark:border-success-500 rounded-md">
            <div class="mr-5 mt-1 flex h-9 w-9 items-center justify-center rounded-lg bg-success/20 dark:bg-success/30">
                <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M15.2984 0.826822L15.2868 0.811822L15.2741 0.797751C14.9173 0.401867 14.3238 0.400754 13.9657 0.794406L5.91888 9.45376L2.05667 5.2868C1.69856 4.89287 1.10487 4.89389 0.747996 5.28987C0.417335 5.65675 0.417335 6.22337 0.747996 6.59026L0.747959 6.59029L0.752701 6.59541L4.86742 11.0348C5.14445 11.3405 5.52858 11.5 5.89581 11.5C6.29242 11.5 6.65178 11.3355 6.92401 11.035L15.2162 2.11161C15.5833 1.74452 15.576 1.18615 15.2984 0.826822Z"
                        fill="#34D399" stroke="#34D399" />
                </svg>
            </div>
            <div class="w-full">
                <h5 class="mb-3 text-lg font-semibold text-success-700 dark:text-success-400">
                    Berhasil Menyimpan
                </h5>
                <p class="text-base text-[#637381]">
                    {{ session('success') }}
                </p>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 gap-9 sm:grid-cols-2">
        <div class="flex flex-col gap-9">
            <!-- Settings Form -->
            <div class="rounded-2xl border border-gray-200 bg-white shadow-theme-sm dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-800">
                    <h3 class="font-medium text-gray-800 dark:text-white/90">
                        Atur Detail Identitas Aplikasi
                    </h3>
                </div>
                <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="p-6">
                        @foreach ($settings as $setting)
                            <div class="mb-5 relative">
                                <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ $setting->name }}
                                </label>

                                @if ($setting->type === 'text')
                                    <input type="text" name="{{ $setting->key }}" value="{{ old($setting->key, $setting->value) }}"
                                        class="h-11 w-full rounded-lg border border-gray-200 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-800 dark:bg-white/3 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
                                @elseif($setting->type === 'textarea')
                                    <textarea name="{{ $setting->key }}" rows="4"
                                        class="w-full rounded-lg border border-gray-200 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-800 dark:bg-white/3 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">{{ old($setting->key, $setting->value) }}</textarea>
                                @elseif($setting->type === 'image')
                                    @if ($setting->value)
                                        <div class="mb-3">
                                            <p class="text-sm font-medium mb-1 text-gray-700 dark:text-gray-400">Gambar Saat Ini:</p>
                                            <img src="{{ asset($setting->value) }}" alt="{{ $setting->name }}" class="h-16 w-auto object-contain rounded border border-gray-200 p-1 dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
                                        </div>
                                    @endif
                                    <input type="file" name="{{ $setting->key }}" accept="image/*"
                                        class="w-full rounded-md border border-stroke p-3 outline-none transition file:mr-4 file:rounded file:border-[0.5px] file:border-stroke file:bg-[#EEEEEE] file:px-2.5 file:py-1 file:text-sm focus:border-primary file:focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:file:border-strokedark dark:file:bg-white/30 dark:file:text-white" />
                                    <span class="text-xs text-gray-500">Biarkan kosong jika tidak ingin mengubah tipe {{ $setting->type }}.</span>
                                @endif
                                
                            </div>
                        @endforeach

                        <div class="flex items-center gap-4 mt-6">
                            <button type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-lg bg-brand-500 px-6 py-3 font-medium text-white shadow-theme-xs hover:bg-brand-600 w-full sm:w-auto">
                                <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10 2.5C5.85786 2.5 2.5 5.85786 2.5 10C2.5 14.1421 5.85786 17.5 10 17.5C14.1421 17.5 17.5 14.1421 17.5 10C17.5 5.85786 14.1421 2.5 10 2.5ZM1 10C1 5.02944 5.02944 1 10 1C14.9706 1 19 5.02944 19 10C19 14.9706 14.9706 19 10 19C5.02944 19 1 14.9706 1 10ZM14.4105 7.91053C14.6546 7.66649 14.6546 7.27083 14.4105 7.02679C14.1665 6.78274 13.7708 6.78274 13.5268 7.02679L9.16667 11.3869L7.47321 9.69344C7.22917 9.44939 6.8335 9.44939 6.58946 9.69344C6.34541 9.93749 6.34541 10.3332 6.58946 10.5772L8.72499 12.7127C8.96903 12.9568 9.36431 12.9568 9.60835 12.7127L14.4105 7.91053Z" />
                                </svg>
                                Simpan Pengaturan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
