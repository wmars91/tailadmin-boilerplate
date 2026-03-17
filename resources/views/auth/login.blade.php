<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login | {{ config('app.name', 'TailAdmin') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme');
            const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            const theme = savedTheme || systemTheme;
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
</head>
<body class="font-outfit bg-gray-50 dark:bg-gray-900">
    <div class="flex min-h-screen items-center justify-center p-4">
        <div class="w-full max-w-md">
            <div class="rounded-2xl border border-gray-200 bg-white p-8 shadow-theme-sm dark:border-gray-800 dark:bg-gray-900">
                <div class="mb-8 text-center">
                    <a href="/">
                        <img class="mx-auto dark:hidden" src="/images/logo/logo.svg" alt="Logo" width="150" height="40" />
                        <img class="mx-auto hidden dark:block" src="/images/logo/logo-dark.svg" alt="Logo" width="150" height="40" />
                    </a>
                    <h2 class="mt-6 text-xl font-semibold text-gray-800 dark:text-white/90">Sign In</h2>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Masukkan username dan password Anda</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="username" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Username</label>
                        <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus
                            class="h-11 w-full rounded-lg border border-gray-200 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-800 dark:bg-white/3 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                            placeholder="Masukkan username" />
                        @error('username')
                            <p class="mt-1 text-sm text-error-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                        <input id="password" type="password" name="password" required
                            class="h-11 w-full rounded-lg border border-gray-200 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-800 dark:bg-white/3 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800"
                            placeholder="Masukkan password" />
                        @error('password')
                            <p class="mt-1 text-sm text-error-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6 flex items-center justify-between">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="remember"
                                class="h-4 w-4 rounded border-gray-300 text-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-800" />
                            <span class="text-sm text-gray-600 dark:text-gray-400">Remember me</span>
                        </label>
                    </div>

                    <button type="submit"
                        class="flex w-full items-center justify-center rounded-lg bg-brand-500 px-4 py-3 text-sm font-medium text-white shadow-theme-xs transition hover:bg-brand-600 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10">
                        Sign In
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
