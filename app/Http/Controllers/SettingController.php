<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the settings.
     */
    public function index()
    {
        $settings = Setting::all();
        return view('settings.index', compact('settings'));
    }

    /**
     * Update all settings in storage.
     */
    public function update(Request $request)
    {
        $settings = Setting::all();

        foreach ($settings as $setting) {
            $key = $setting->key;

            if ($setting->type === 'image') {
                if ($request->hasFile($key)) {
                    // Hanya memproses upload jika file baru diberikan
                    $file = $request->file($key);
                    $path = $file->store('images/logo', 'public');
                    $setting->update(['value' => '/storage/' . $path]);
                }
            } else {
                // Untuk text dan textarea
                if ($request->has($key)) {
                    $setting->update(['value' => $request->input($key)]);
                }
            }
        }

        // Membersihkan Cache agar sistem merender ualng nilai setting terbaru
        Cache::forget('app_settings');

        return redirect()->route('settings.index')->with('success', 'Pengaturan aplikasi berhasil diperbarui.');
    }
}
