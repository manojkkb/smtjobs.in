<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Support\Str;

class CountriesSeeder extends MasterSeeder
{
    public function run(): void
    {
        $countries = [
            ['name' => 'India', 'iso2' => 'IN', 'iso3' => 'IND', 'phone_code' => '+91', 'latitude' => 20.593684, 'longitude' => 78.962880],
        ];

        foreach ($countries as &$country) {
            $country['slug'] = Str::slug($country['name']);
            $country['is_active'] = true;
            $country['created_at'] = now();
            $country['updated_at'] = now();
        }

        Country::upsert(
            $countries,
            ['iso2'], // unique key
            ['name', 'iso3', 'phone_code', 'latitude', 'longitude', 'slug', 'is_active', 'updated_at']
        );
    }
}
