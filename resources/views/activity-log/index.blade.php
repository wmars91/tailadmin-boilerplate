@extends('layouts.app')

@section('content')
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-semibold text-gray-800 dark:text-white/90">
            Audit Log / Activity Log
        </h2>
    </div>

    <!-- Data Table -->
    <div class="rounded-2xl border border-gray-200 bg-white shadow-theme-sm dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="max-w-full overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-50 text-left dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800">
                        <th class="min-w-[150px] px-5 py-4 font-medium text-gray-500 xl:pl-7">Waktu Kejadian</th>
                        <th class="min-w-[150px] px-5 py-4 font-medium text-gray-500">Aktor (Causer)</th>
                        <th class="px-5 py-4 font-medium text-gray-500">Event Aksi</th>
                        <th class="px-5 py-4 font-medium text-gray-500">Module (Subject)</th>
                        <th class="px-5 py-4 font-medium text-gray-500">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($activities as $log)
                        <tr>
                            <td class="border-b border-gray-100 px-5 py-4 dark:border-gray-800 xl:pl-7">
                                <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                    {{ $log->created_at->format('d M Y, H:i') }}
                                </p>
                                <p class="text-xs text-gray-500">{{ $log->created_at->diffForHumans() }}</p>
                            </td>
                            <td class="border-b border-gray-100 px-5 py-4 dark:border-gray-800">
                                <p class="text-sm text-gray-800 dark:text-white/90">
                                    {{ $log->causer ? $log->causer->name : 'System / Guest' }}
                                </p>
                                @if($log->causer)
                                <p class="text-xs text-gray-500">{{ $log->causer->username }}</p>
                                @endif
                            </td>
                            <td class="border-b border-gray-100 px-5 py-4 dark:border-gray-800">
                                @php
                                    $badgeColor = match ($log->event) {
                                        'created' => 'bg-success-500/10 text-success-600',
                                        'updated' => 'bg-warning-500/10 text-warning-600',
                                        'deleted' => 'bg-error-500/10 text-error-600',
                                        default => 'bg-gray-500/10 text-gray-600',
                                    };
                                @endphp
                                <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium {{ $badgeColor }}">
                                    {{ ucfirst($log->event) }}
                                </span>
                            </td>
                            <td class="border-b border-gray-100 px-5 py-4 dark:border-gray-800">
                                <p class="text-sm text-gray-800 dark:text-white/90">
                                    {{ $log->log_name }} 
                                    <span class="text-xs text-gray-500">(ID: {{ $log->subject_id }})</span>
                                </p>
                                <p class="text-xs text-brand-500">{{ class_basename($log->subject_type) }}</p>
                            </td>
                            <td class="border-b border-gray-100 px-5 py-4 dark:border-gray-800 relative" x-data="{ open: false }">
                                <button @click="open = !open" type="button" class="text-sm text-brand-500 hover:text-brand-600 font-medium">
                                    Lihat Detail Perubahan &rarr;
                                </button>
                                
                                <!-- JSON Details Viewer Modal Style Inline-->
                                <div x-show="open" @click.away="open = false" style="display: none;" class="mt-3 bg-gray-50 dark:bg-gray-800 rounded p-3 text-xs w-full overflow-x-auto border border-gray-200 dark:border-gray-700">
                                    <p class="font-medium mb-1">Properties:</p>
                                    @if ($log->properties->count() > 0)
                                        @if($log->properties->has('old'))
                                            <div class="mb-2">
                                                <span class="text-error-500 font-medium">OLD (Sebelum):</span>
                                                <pre class="bg-gray-100 dark:bg-gray-900 p-2 rounded mt-1 overflow-x-auto max-w-[200px] sm:max-w-md">@json($log->properties->get('old'), JSON_PRETTY_PRINT)</pre>
                                            </div>
                                        @endif
                                        @if($log->properties->has('attributes'))
                                            <div>
                                                <span class="text-success-500 font-medium">NEW (Sesudah / Attributes):</span>
                                                <pre class="bg-gray-100 dark:bg-gray-900 p-2 rounded mt-1 overflow-x-auto max-w-[200px] sm:max-w-md">@json($log->properties->get('attributes'), JSON_PRETTY_PRINT)</pre>
                                            </div>
                                        @endif
                                        @if(!$log->properties->has('old') && !$log->properties->has('attributes'))
                                             <pre class="bg-gray-100 dark:bg-gray-900 p-2 rounded mt-1 overflow-x-auto max-w-sm">@json($log->properties, JSON_PRETTY_PRINT)</pre>
                                        @endif
                                    @else
                                        <p class="text-gray-500 italic">Tidak ada detail properties terekam.</p>
                                    @endif
                                    <button @click="open = false" class="mt-2 text-error-500 text-xs text-right w-full">Tutup Detail</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-4 text-center text-gray-500 dark:text-gray-400">
                                Belum ada riwayat log aktivitas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if ($activities->hasPages())
            <div class="border-t border-gray-200 px-5 py-4 dark:border-gray-800">
                {{ $activities->links() }}
            </div>
        @endif
    </div>
@endsection
