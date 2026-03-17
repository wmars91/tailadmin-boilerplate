@php $input = 'h-11 w-full rounded-lg border border-gray-200 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-800 dark:bg-white/3 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800'; @endphp

<div class="grid grid-cols-1 gap-4 md:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Menu <span class="text-error-500">*</span></label>
        <input type="text" name="name" value="{{ old('name', $menu->name ?? '') }}" class="{{ $input }}" required />
        @error('name') <p class="mt-1 text-sm text-error-500">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Icon</label>
        <input type="text" name="icon" value="{{ old('icon', $menu->icon ?? '') }}" class="{{ $input }}" placeholder="e.g. dashboard, user-management" />
        @error('icon') <p class="mt-1 text-sm text-error-500">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Route Name</label>
        <input type="text" name="route" value="{{ old('route', $menu->route ?? '') }}" class="{{ $input }}" placeholder="e.g. dashboard, users.index" />
        @error('route') <p class="mt-1 text-sm text-error-500">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">URL (jika bukan route)</label>
        <input type="text" name="url" value="{{ old('url', $menu->url ?? '') }}" class="{{ $input }}" placeholder="e.g. /custom-page" />
        @error('url') <p class="mt-1 text-sm text-error-500">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Parent Menu</label>
        <select name="parent_id" class="{{ $input }}">
            <option value="">-- Tidak ada (Menu Utama) --</option>
            @foreach($parentMenus as $parent)
                <option value="{{ $parent->id }}" {{ old('parent_id', $menu->parent_id ?? '') == $parent->id ? 'selected' : '' }}>{{ $parent->name }}</option>
            @endforeach
        </select>
        @error('parent_id') <p class="mt-1 text-sm text-error-500">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Group Name <span class="text-error-500">*</span></label>
        <input type="text" name="group_name" value="{{ old('group_name', $menu->group_name ?? 'Menu') }}" class="{{ $input }}" required />
        @error('group_name') <p class="mt-1 text-sm text-error-500">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Order <span class="text-error-500">*</span></label>
        <input type="number" name="order" value="{{ old('order', $menu->order ?? 0) }}" class="{{ $input }}" min="0" required />
        @error('order') <p class="mt-1 text-sm text-error-500">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Permission</label>
        <input type="text" name="permission" value="{{ old('permission', $menu->permission ?? '') }}" class="{{ $input }}" placeholder="e.g. manage-users" />
        @error('permission') <p class="mt-1 text-sm text-error-500">{{ $message }}</p> @enderror
    </div>

    <div class="flex items-center gap-3 pt-6">
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $menu->is_active ?? true) ? 'checked' : '' }}
                class="h-4 w-4 rounded border-gray-300 text-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-800" />
            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Aktif</span>
        </label>
    </div>
</div>
