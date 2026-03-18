<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'name' => 'Nama Aplikasi',
                'key' => 'app_name',
                'value' => 'TailAdmin Boilerplate',
                'type' => 'text'
            ],
            [
                'name' => 'Nama Perusahaan',
                'key' => 'company_name',
                'value' => 'PT. Wahyudin MIS',
                'type' => 'text'
            ],
            [
                'name' => 'Logo Aplikasi',
                'key' => 'app_logo',
                'value' => '/images/logo/logo.svg',
                'type' => 'image'
            ],
        ];

        foreach ($settings as $setting) {
            \App\Models\Setting::firstOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
