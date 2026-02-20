<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\City;

class AreasSeeder extends MasterSeeder
{
    public function run(): void
    {
        $cities = City::pluck('id', 'slug')->all();
        $areas = [
            ['slug' => 'downtown-la', 'name' => 'Downtown', 'city_slug' => 'los-angeles', 'postal_code' => '90012'],
            ['slug' => 'midtown-toronto', 'name' => 'Midtown', 'city_slug' => 'toronto', 'postal_code' => 'M5R'],
            ['slug' => 'soho-london', 'name' => 'Soho', 'city_slug' => 'london', 'postal_code' => 'W1D'],
        ];

        foreach ($areas as $area) {
            $cityId = $cities[$area['city_slug']] ?? null;
            if (!$cityId) {
                continue;
            }

            Area::updateOrCreate(
                ['slug' => $area['slug']],
                ['city_id' => $cityId, 'name' => $area['name'], 'postal_code' => $area['postal_code']]
            );
        }
    }
}
