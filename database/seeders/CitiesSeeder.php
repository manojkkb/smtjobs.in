<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\State;

class CitiesSeeder extends MasterSeeder
{
    public function run(): void
    {
        $states = State::pluck('id', 'slug')->all();
        $cities = [
            ['slug' => 'los-angeles', 'name' => 'Los Angeles', 'state_slug' => 'california', 'latitude' => 34.0522, 'longitude' => -118.2437],
            ['slug' => 'toronto', 'name' => 'Toronto', 'state_slug' => 'ontario', 'latitude' => 43.6532, 'longitude' => -79.3832],
            ['slug' => 'london', 'name' => 'London', 'state_slug' => 'england', 'latitude' => 51.5074, 'longitude' => -0.1278],
        ];

        foreach ($cities as $city) {
            $stateId = $states[$city['state_slug']] ?? null;
            if (!$stateId) {
                continue;
            }

            City::updateOrCreate(
                ['slug' => $city['slug']],
                [
                    'state_id' => $stateId,
                    'name' => $city['name'],
                    'latitude' => $city['latitude'],
                    'longitude' => $city['longitude'],
                ]
            );
        }
    }
}
