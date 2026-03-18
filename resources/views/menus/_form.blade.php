@php $input = 'h-11 w-full rounded-lg border border-gray-200 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-800 dark:bg-white/3 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800'; @endphp

<div class="grid grid-cols-1 gap-4 md:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Menu <span class="text-error-500">*</span></label>
        <input type="text" name="name" value="{{ old('name', $menu->name ?? '') }}" class="{{ $input }}" required />
        @error('name') <p class="mt-1 text-sm text-error-500">{{ $message }}</p> @enderror
    </div>

    <div x-data="{ selectedIcon: '{{ old('icon', $menu->icon ?? '') }}' }">
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Icon</label>
        <div class="flex items-center gap-3">
            <select name="icon" x-model="selectedIcon" class="{{ $input }} cursor-pointer">
                <option value="">-- Tanpa Icon / Default --</option>
                @foreach(\App\Helpers\MenuHelper::getAvailableIcons() as $iconKey)
                    <option value="{{ $iconKey }}">{{ ucwords(str_replace('-', ' ', $iconKey)) }}</option>
                @endforeach
            </select>
            
            <!-- Icon Preview Box -->
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg border border-gray-200 bg-gray-50 text-gray-500 shadow-theme-xs dark:border-gray-800 dark:bg-gray-900/50 dark:text-gray-400">
                <template x-if="selectedIcon">
                    <span class="[&>svg]:h-5 [&>svg]:w-5" x-html="getIconSvg(selectedIcon)"></span>
                </template>
                <template x-if="!selectedIcon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                </template>
            </div>
        </div>
        @error('icon') <p class="mt-1 text-sm text-error-500">{{ $message }}</p> @enderror
        
        <!-- Alpine JS helper for fetching SVG string (static fallback in JS to avoid large payload, but passing it from PHP is better if small) -->
        <script>
            function getIconSvg(iconName) {
                const icons = {
                    @foreach(\App\Helpers\MenuHelper::getAvailableIcons() as $iconKey)
                    '{{ $iconKey }}': `{!! addslashes(\App\Helpers\MenuHelper::getIconSvg($iconKey)) !!}`,
                    @endforeach
                };
                
                return icons[iconName] || `{!! addslashes(\App\Helpers\MenuHelper::getIconSvg('default')) !!}`;
            }
        </script>
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

    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Hak Akses Role</label>
        <div class="flex flex-wrap gap-3">
            @foreach($roles as $role)
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="roles[]" value="{{ $role->id }}" {{ in_array($role->id, old('roles', $menuRoles ?? [])) ? 'checked' : '' }}
                        class="h-4 w-4 rounded border-gray-300 text-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-800" />
                    <span class="text-sm text-gray-700 dark:text-gray-300">{{ $role->name }}</span>
                </label>
            @endforeach
        </div>
        @error('roles') <p class="mt-1 text-sm text-error-500">{{ $message }}</p> @enderror
        <p class="mt-2 text-xs text-gray-500">Kosongkan jika menu ini bersifat publik (bisa diakses semua user yang login).</p>
    </div>

    <div class="flex items-center gap-3 pt-6">
        <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $menu->is_active ?? true) ? 'checked' : '' }}
                class="h-4 w-4 rounded border-gray-300 text-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-800" />
            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Aktif</span>
        </label>
    </div>
</div>
