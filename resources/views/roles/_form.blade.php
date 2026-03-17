@php $input = 'h-11 w-full rounded-lg border border-gray-200 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-800 dark:bg-white/3 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800'; @endphp

<div class="space-y-4">
    <div class="max-w-md">
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Role <span class="text-error-500">*</span></label>
        <input type="text" name="name" value="{{ old('name', $role->name ?? '') }}" class="{{ $input }}" required />
        @error('name') <p class="mt-1 text-sm text-error-500">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Permissions</label>
        <div class="flex flex-wrap gap-3">
            @foreach($permissions as $permission)
                <label class="flex items-center gap-2 cursor-pointer rounded-lg border border-gray-200 px-3 py-2 hover:bg-gray-50 dark:border-gray-800 dark:hover:bg-gray-800">
                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" {{ in_array($permission->name, old('permissions', $rolePermissions ?? [])) ? 'checked' : '' }}
                        class="h-4 w-4 rounded border-gray-300 text-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-800" />
                    <span class="text-sm text-gray-700 dark:text-gray-300">{{ $permission->name }}</span>
                </label>
            @endforeach
        </div>
        @error('permissions') <p class="mt-1 text-sm text-error-500">{{ $message }}</p> @enderror
    </div>
</div>
