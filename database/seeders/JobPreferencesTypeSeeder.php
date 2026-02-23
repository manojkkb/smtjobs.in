<?php

namespace Database\Seeders;

use App\Models\JobPreferencesType;

class JobPreferencesTypeSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(JobPreferencesType::class, [

            [
                'slug' => 'employment_type',
                'label' => 'Employment Type Preference',
                'description' => 'Preferred type of employment (Full-time, Contract, etc.)',
                'sort_order' => 1,
                'is_active' => true,
            ],

            [
                'slug' => 'work_mode',
                'label' => 'Work Mode Preference',
                'description' => 'Preferred work mode (Onsite, Remote, Hybrid)',
                'sort_order' => 2,
                'is_active' => true,
            ],

            [
                'slug' => 'shift_type',
                'label' => 'Shift Preference',
                'description' => 'Preferred shift timing',
                'sort_order' => 3,
                'is_active' => true,
            ],

            [
                'slug' => 'location',
                'label' => 'Preferred Location',
                'description' => 'Preferred job location(s)',
                'sort_order' => 4,
                'is_active' => true,
            ],

            [
                'slug' => 'salary_range',
                'label' => 'Expected Salary Range',
                'description' => 'Preferred salary expectation',
                'sort_order' => 5,
                'is_active' => true,
            ],

            [
                'slug' => 'industry',
                'label' => 'Preferred Industry',
                'description' => 'Preferred industry to work in',
                'sort_order' => 6,
                'is_active' => true,
            ],

            [
                'slug' => 'department',
                'label' => 'Preferred Department',
                'description' => 'Preferred functional department',
                'sort_order' => 7,
                'is_active' => true,
            ],

            [
                'slug' => 'job_level',
                'label' => 'Preferred Job Level',
                'description' => 'Preferred role hierarchy level',
                'sort_order' => 8,
                'is_active' => true,
            ],

        ]);
    }
}
