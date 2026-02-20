<?php

namespace Database\Seeders;

use App\Models\Language;

class LanguagesSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(Language::class, [
            ['name' => 'English', 'native_name' => 'English', 'iso_code' => 'en', 'is_rtl' => false, 'is_default' => true, 'sort_order' => 1],
            ['name' => 'French', 'native_name' => 'Français', 'iso_code' => 'fr', 'is_rtl' => false, 'sort_order' => 2],
            ['name' => 'Arabic', 'native_name' => 'العربية', 'iso_code' => 'ar', 'is_rtl' => true, 'sort_order' => 3],
        ], ['iso_code']);
    }
}
