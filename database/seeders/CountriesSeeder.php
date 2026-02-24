<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Support\Str;

class CountriesSeeder extends MasterSeeder
{
    public function run(): void
    {
        $countries = [
            ['slug' => 'india', 'name' => 'India',  'iso_code' => 'IND','phone_code' => '+91', 'latitude' => 20.593684, 'longitude' => 78.962880],
        ];

        Country::upsert(
            $countries
        );
    }
}
