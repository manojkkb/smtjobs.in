<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\State;

class StatesSeeder extends MasterSeeder
{
    public function run(): void
    {
        $countries = Country::pluck('id', 'slug')->all();
        $states = [
            ['slug' => 'california', 'name' => 'California', 'country_slug' => 'usa', 'code' => 'CA', 'latitude' => 36.7783, 'longitude' => -119.4179],
            ['slug' => 'ontario', 'name' => 'Ontario', 'country_slug' => 'canada', 'code' => 'ON', 'latitude' => 51.2538, 'longitude' => -85.3232],
            ['slug' => 'england', 'name' => 'England', 'country_slug' => 'uk', 'code' => 'ENG', 'latitude' => 52.3555, 'longitude' => -1.1743],
        ];

        foreach ($states as $state) {
            $countryId = $countries[$state['country_slug']] ?? null;
            if (!$countryId) {
                continue;
            }

            State::updateOrCreate(
                ['slug' => $state['slug']],
                [
                    'country_id' => $countryId,
                    'name' => $state['name'],
                    'code' => $state['code'],
                    'latitude' => $state['latitude'],
                    'longitude' => $state['longitude'],
                ]
            );
        }
    }
}
