@php $input = 'h-11 w-full rounded-lg border border-gray-200 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-800 dark:bg-white/3 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800'; @endphp

<div class="grid grid-cols-1 gap-4 md:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Nama <span class="text-error-500">*</span></label>
        <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" class="{{ $input }}" required />
        @error('name') <p class="mt-1 text-sm text-error-500">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Username <span class="text-error-500">*</span></label>
        <input type="text" name="username" value="{{ old('username', $user->username ?? '') }}" class="{{ $input }}" required />
        @error('username') <p class="mt-1 text-sm text-error-500">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" class="{{ $input }}" />
        @error('email') <p class="mt-1 text-sm text-error-500">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">NIP</label>
        <input type="text" name="nip" value="{{ old('nip', $user->nip ?? '') }}" class="{{ $input }}" />
        @error('nip') <p class="mt-1 text-sm text-error-500">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Departement</label>
        <input type="text" name="departement" value="{{ old('departement', $user->departement ?? '') }}" class="{{ $input }}" />
        @error('departement') <p class="mt-1 text-sm text-error-500">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Company</label>
        <input type="text" name="company" value="{{ old('company', $user->company ?? '') }}" class="{{ $input }}" />
        @error('company') <p class="mt-1 text-sm text-error-500">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Kode Cabang</label>
        <input type="text" name="kdcab" value="{{ old('kdcab', $user->kdcab ?? '') }}" class="{{ $input }}" />
        @error('kdcab') <p class="mt-1 text-sm text-error-500">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Password {{ $user ? '(kosongkan jika tidak diubah)' : '' }} @if(!$user)<span class="text-error-500">*</span>@endif</label>
        <input type="password" name="password" class="{{ $input }}" {{ !$user ? 'required' : '' }} />
        @error('password') <p class="mt-1 text-sm text-error-500">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="{{ $input }}" />
    </div>

    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Role</label>
        <div class="flex flex-wrap gap-3">
            @foreach($roles as $role)
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="roles[]" value="{{ $role->name }}" {{ in_array($role->name, old('roles', $userRoles ?? [])) ? 'checked' : '' }}
                        class="h-4 w-4 rounded border-gray-300 text-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-800" />
                    <span class="text-sm text-gray-700 dark:text-gray-300">{{ $role->name }}</span>
                </label>
            @endforeach
        </div>
        @error('roles') <p class="mt-1 text-sm text-error-500">{{ $message }}</p> @enderror
    </div>
</div>
