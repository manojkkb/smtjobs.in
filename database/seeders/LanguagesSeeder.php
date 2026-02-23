<?php

namespace Database\Seeders;

use App\Models\Language;

class LanguagesSeeder extends MasterSeeder
{
    public function run(): void
    {
        $languages = [

    [
        'name' => 'English',
        'native_name' => 'English',
        'iso_code' => 'en',
        'is_rtl' => false,
        'is_default' => true,
        'sort_order' => 1,
    ],
    [
        'name' => 'Hindi',
        'native_name' => 'हिन्दी',
        'iso_code' => 'hi',
        'is_rtl' => false,
        'is_default' => false,
        'sort_order' => 2,
    ],
    [
        'name' => 'Bengali',
        'native_name' => 'বাংলা',
        'iso_code' => 'bn',
        'is_rtl' => false,
        'is_default' => false,
        'sort_order' => 3,
    ],
    [
        'name' => 'Telugu',
        'native_name' => 'తెలుగు',
        'iso_code' => 'te',
        'is_rtl' => false,
        'is_default' => false,
        'sort_order' => 4,
    ],
    [
        'name' => 'Marathi',
        'native_name' => 'मराठी',
        'iso_code' => 'mr',
        'is_rtl' => false,
        'is_default' => false,
        'sort_order' => 5,
    ],
    [
        'name' => 'Tamil',
        'native_name' => 'தமிழ்',
        'iso_code' => 'ta',
        'is_rtl' => false,
        'is_default' => false,
        'sort_order' => 6,
    ],
    [
        'name' => 'Urdu',
        'native_name' => 'اردو',
        'iso_code' => 'ur',
        'is_rtl' => true,
        'is_default' => false,
        'sort_order' => 7,
    ],
    [
        'name' => 'Gujarati',
        'native_name' => 'ગુજરાતી',
        'iso_code' => 'gu',
        'is_rtl' => false,
        'is_default' => false,
        'sort_order' => 8,
    ],
    [
        'name' => 'Kannada',
        'native_name' => 'ಕನ್ನಡ',
        'iso_code' => 'kn',
        'is_rtl' => false,
        'is_default' => false,
        'sort_order' => 9,
    ],
    [
        'name' => 'Odia',
        'native_name' => 'ଓଡ଼ିଆ',
        'iso_code' => 'or',
        'is_rtl' => false,
        'is_default' => false,
        'sort_order' => 10,
    ],
    [
        'name' => 'Malayalam',
        'native_name' => 'മലയാളം',
        'iso_code' => 'ml',
        'is_rtl' => false,
        'is_default' => false,
        'sort_order' => 11,
    ],
    [
        'name' => 'Punjabi',
        'native_name' => 'ਪੰਜਾਬੀ',
        'iso_code' => 'pa',
        'is_rtl' => false,
        'is_default' => false,
        'sort_order' => 12,
    ],
    [
        'name' => 'Assamese',
        'native_name' => 'অসমীয়া',
        'iso_code' => 'as',
        'is_rtl' => false,
        'is_default' => false,
        'sort_order' => 13,
    ],
    [
        'name' => 'Maithili',
        'native_name' => 'मैथिली',
        'iso_code' => 'mai', // ISO 639-2
        'is_rtl' => false,
        'is_default' => false,
        'sort_order' => 14,
    ],
    [
        'name' => 'Nepali',
        'native_name' => 'नेपाली',
        'iso_code' => 'ne',
        'is_rtl' => false,
        'is_default' => false,
        'sort_order' => 15,
    ],
    [
        'name' => 'Kashmiri',
        'native_name' => 'कॉशुर',
        'iso_code' => 'ks',
        'is_rtl' => false,
        'is_default' => false,
        'sort_order' => 16,
    ],
    [
        'name' => 'Sindhi',
        'native_name' => 'سنڌي',
        'iso_code' => 'sd',
        'is_rtl' => true,
        'is_default' => false,
        'sort_order' => 17,
    ],
    [
        'name' => 'Konkani',
        'native_name' => 'कोंकणी',
        'iso_code' => 'kok',
        'is_rtl' => false,
        'is_default' => false,
        'sort_order' => 18,
    ],
    [
        'name' => 'Manipuri',
        'native_name' => 'ꯃꯤꯇꯩꯂꯣꯟ',
        'iso_code' => 'mni',
        'is_rtl' => false,
        'is_default' => false,
        'sort_order' => 19,
    ],
    [
        'name' => 'Bodo',
        'native_name' => 'बड़ो',
        'iso_code' => 'brx',
        'is_rtl' => false,
        'is_default' => false,
        'sort_order' => 20,
    ],
    [
        'name' => 'Dogri',
        'native_name' => 'डोगरी',
        'iso_code' => 'doi',
        'is_rtl' => false,
        'is_default' => false,
        'sort_order' => 21,
    ],

];
        $this->upsertRecords(Language::class,  $languages);
    }
}
