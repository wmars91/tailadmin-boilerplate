<section>
    <header class="mb-6">
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Perbarui informasi dasar profil dan preferensi nama pengguna Anda.
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Lengkap</label>
            <input id="name" name="name" type="text" class="h-11 w-full rounded-lg border border-gray-200 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-800 dark:bg-white/3 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            @error('name')<p class="mt-1 text-sm text-error-500">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="username" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Username</label>
            <input id="username" type="text" class="h-11 w-full cursor-not-allowed rounded-lg border border-gray-200 bg-gray-100 px-4 py-2.5 text-sm text-gray-500 shadow-theme-xs dark:border-gray-800 dark:bg-gray-800 dark:text-gray-400" value="{{ $user->username }}" disabled />
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Username permanen dan tidak dapat diubah.</p>
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600">
                Simpan Profil
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm font-medium text-success-600 dark:text-success-400">
                    Berhasil disimpan.
                </p>
            @endif
        </div>
    </form>
</section>
