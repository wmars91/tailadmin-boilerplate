<section>
    <header class="mb-6">
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Pastikan akun Anda menggunakan kombinasi kata sandi unik yang sulit ditebak.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Password Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" class="h-11 w-full rounded-lg border border-gray-200 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-800 dark:bg-white/3 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" autocomplete="current-password" />
            @if($errors->updatePassword->has('current_password'))
                <p class="mt-1 text-sm text-error-500">{{ $errors->updatePassword->first('current_password') }}</p>
            @endif
        </div>

        <div>
            <label for="update_password_password" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Password Baru</label>
            <input id="update_password_password" name="password" type="password" class="h-11 w-full rounded-lg border border-gray-200 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-800 dark:bg-white/3 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" autocomplete="new-password" />
            @if($errors->updatePassword->has('password'))
                <p class="mt-1 text-sm text-error-500">{{ $errors->updatePassword->first('password') }}</p>
            @endif
        </div>

        <div>
            <label for="update_password_password_confirmation" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Konfirmasi Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="h-11 w-full rounded-lg border border-gray-200 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-800 dark:bg-white/3 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" autocomplete="new-password" />
            @if($errors->updatePassword->has('password_confirmation'))
                <p class="mt-1 text-sm text-error-500">{{ $errors->updatePassword->first('password_confirmation') }}</p>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white shadow-theme-xs hover:bg-brand-600">
                Ganti Password
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm font-medium text-success-600 dark:text-success-400">
                    Password diganti.
                </p>
            @endif
        </div>
    </form>
</section>
