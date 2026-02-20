<?php

namespace Database\Seeders;

use App\Models\Country;

class CountriesSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(Country::class, [
            ['slug' => 'usa', 'name' => 'United States', 'iso_code' => 'US', 'phone_code' => '+1', 'latitude' => 37.09024, 'longitude' => -95.71289],
            ['slug' => 'canada', 'name' => 'Canada', 'iso_code' => 'CA', 'phone_code' => '+1', 'latitude' => 56.13037, 'longitude' => -106.34677],
            ['slug' => 'uk', 'name' => 'United Kingdom', 'iso_code' => 'GB', 'phone_code' => '+44', 'latitude' => 55.3781, 'longitude' => -3.4360],
        ]);
    }
}
