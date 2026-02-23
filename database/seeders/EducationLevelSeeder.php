<?php

namespace Database\Seeders;

use App\Models\EducationLevel;

class EducationLevelSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(EducationLevel::class, [

    [
        'slug' => 'school',
        'label' => 'School Level',
        'sort_order' => 1,
    ],

    [
        'slug' => 'diploma',
        'label' => 'Diploma / ITI',
        'sort_order' => 2,
    ],

    [
        'slug' => 'bachelor',
        'label' => 'Bachelor’s Degree',
        'sort_order' => 3,
    ],

    [
        'slug' => 'master',
        'label' => 'Master’s Degree',
        'sort_order' => 4,
    ],

    [
        'slug' => 'doctorate',
        'label' => 'Doctorate / PhD',
        'sort_order' => 5,
    ],

    [
        'slug' => 'professional',
        'label' => 'Professional Qualification',
        'sort_order' => 6,
    ],

]);
    }
}
