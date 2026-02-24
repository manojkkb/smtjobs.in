<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\State;
use Illuminate\Support\Str;

class StatesSeeder extends MasterSeeder
{
    public function run(): void
    {
        $india = Country::where('iso2', 'IN')->first();

        if (!$india) {
            $this->command->error('India country not found. Please seed countries first.');
            return;
        }

       $states = [

                // States
                ['name' => 'Andhra Pradesh', 'code' => 'AP', 'type' => 'state', 'latitude' => 15.91290000, 'longitude' => 79.73999000],
                ['name' => 'Arunachal Pradesh', 'code' => 'AR', 'type' => 'state', 'latitude' => 28.21800000, 'longitude' => 94.72780000],
                ['name' => 'Assam', 'code' => 'AS', 'type' => 'state', 'latitude' => 26.20060000, 'longitude' => 92.93760000],
                ['name' => 'Bihar', 'code' => 'BR', 'type' => 'state', 'latitude' => 25.09610000, 'longitude' => 85.31310000],
                ['name' => 'Chhattisgarh', 'code' => 'CG', 'type' => 'state', 'latitude' => 21.27870000, 'longitude' => 81.86610000],
                ['name' => 'Goa', 'code' => 'GA', 'type' => 'state', 'latitude' => 15.29930000, 'longitude' => 74.12400000],
                ['name' => 'Gujarat', 'code' => 'GJ', 'type' => 'state', 'latitude' => 22.25870000, 'longitude' => 71.19240000],
                ['name' => 'Haryana', 'code' => 'HR', 'type' => 'state', 'latitude' => 29.05880000, 'longitude' => 76.08560000],
                ['name' => 'Himachal Pradesh', 'code' => 'HP', 'type' => 'state', 'latitude' => 31.10480000, 'longitude' => 77.17340000],
                ['name' => 'Jharkhand', 'code' => 'JH', 'type' => 'state', 'latitude' => 23.61020000, 'longitude' => 85.27990000],
                ['name' => 'Karnataka', 'code' => 'KA', 'type' => 'state', 'latitude' => 15.31730000, 'longitude' => 75.71390000],
                ['name' => 'Kerala', 'code' => 'KL', 'type' => 'state', 'latitude' => 10.85050000, 'longitude' => 76.27110000],
                ['name' => 'Madhya Pradesh', 'code' => 'MP', 'type' => 'state', 'latitude' => 22.97340000, 'longitude' => 78.65690000],
                ['name' => 'Maharashtra', 'code' => 'MH', 'type' => 'state', 'latitude' => 19.75150000, 'longitude' => 75.71390000],
                ['name' => 'Manipur', 'code' => 'MN', 'type' => 'state', 'latitude' => 24.66370000, 'longitude' => 93.90630000],
                ['name' => 'Meghalaya', 'code' => 'ML', 'type' => 'state', 'latitude' => 25.46700000, 'longitude' => 91.36620000],
                ['name' => 'Mizoram', 'code' => 'MZ', 'type' => 'state', 'latitude' => 23.16450000, 'longitude' => 92.93760000],
                ['name' => 'Nagaland', 'code' => 'NL', 'type' => 'state', 'latitude' => 26.15840000, 'longitude' => 94.56240000],
                ['name' => 'Odisha', 'code' => 'OR', 'type' => 'state', 'latitude' => 20.95170000, 'longitude' => 85.09850000],
                ['name' => 'Punjab', 'code' => 'PB', 'type' => 'state', 'latitude' => 31.14710000, 'longitude' => 75.34120000],
                ['name' => 'Rajasthan', 'code' => 'RJ', 'type' => 'state', 'latitude' => 27.02380000, 'longitude' => 74.21790000],
                ['name' => 'Sikkim', 'code' => 'SK', 'type' => 'state', 'latitude' => 27.53300000, 'longitude' => 88.51220000],
                ['name' => 'Tamil Nadu', 'code' => 'TN', 'type' => 'state', 'latitude' => 11.12710000, 'longitude' => 78.65690000],
                ['name' => 'Telangana', 'code' => 'TG', 'type' => 'state', 'latitude' => 18.11240000, 'longitude' => 79.01930000],
                ['name' => 'Tripura', 'code' => 'TR', 'type' => 'state', 'latitude' => 23.94080000, 'longitude' => 91.98820000],
                ['name' => 'Uttar Pradesh', 'code' => 'UP', 'type' => 'state', 'latitude' => 26.84670000, 'longitude' => 80.94620000],
                ['name' => 'Uttarakhand', 'code' => 'UK', 'type' => 'state', 'latitude' => 30.06680000, 'longitude' => 79.01930000],
                ['name' => 'West Bengal', 'code' => 'WB', 'type' => 'state', 'latitude' => 22.98680000, 'longitude' => 87.85500000],

                // Union Territories
                ['name' => 'Delhi', 'code' => 'DL', 'type' => 'union_territory', 'latitude' => 28.70410000, 'longitude' => 77.10250000],
                ['name' => 'Jammu and Kashmir', 'code' => 'JK', 'type' => 'union_territory', 'latitude' => 33.77820000, 'longitude' => 76.57620000],
                ['name' => 'Ladakh', 'code' => 'LA', 'type' => 'union_territory', 'latitude' => 34.15260000, 'longitude' => 77.57710000],
                ['name' => 'Puducherry', 'code' => 'PY', 'type' => 'union_territory', 'latitude' => 11.94160000, 'longitude' => 79.80830000],
                ['name' => 'Chandigarh', 'code' => 'CH', 'type' => 'union_territory', 'latitude' => 30.73330000, 'longitude' => 76.77940000],
                ['name' => 'Andaman and Nicobar Islands', 'code' => 'AN', 'type' => 'union_territory', 'latitude' => 11.74010000, 'longitude' => 92.65860000],
                ['name' => 'Lakshadweep', 'code' => 'LD', 'type' => 'union_territory', 'latitude' => 10.56670000, 'longitude' => 72.64170000],
                ['name' => 'Dadra and Nagar Haveli and Daman and Diu', 'code' => 'DN', 'type' => 'union_territory', 'latitude' => 20.39740000, 'longitude' => 72.83280000],
            ];

        foreach ($states as &$state) {
            $state['country_id'] = $india->id;
            $state['slug'] = Str::slug($state['name']);
            $state['is_active'] = true;
            $state['created_at'] = now();
            $state['updated_at'] = now();
        }

        State::upsert(
            $states,
            ['code'], // unique key
            ['name', 'slug', 'type', 'is_active', 'updated_at']
        );
    }
}
