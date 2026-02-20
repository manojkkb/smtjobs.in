<?php

namespace Database\Seeders;

use App\Models\ExperienceRange;

class ExperienceRangeSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(ExperienceRange::class, [
            ['min_years' => 0, 'max_years' => 2, 'label' => '0-2 Years', 'priority' => 1],
            ['min_years' => 3, 'max_years' => 5, 'label' => '3-5 Years', 'priority' => 2],
            ['min_years' => 6, 'max_years' => null, 'label' => '6+ Years', 'priority' => 3],
        ], ['min_years', 'max_years']);
    }
}
