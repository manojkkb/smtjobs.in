<?php

namespace Database\Seeders;

use App\Models\WorkMode;

class WorkModeSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(WorkMode::class, [

                [
                    'slug' => 'onsite',
                    'label' => 'Onsite',
                    'sort_order' => 1,
                    'is_active' => true,
                ],

                [
                    'slug' => 'remote',
                    'label' => 'Remote',
                    'sort_order' => 2,
                    'is_active' => true,
                ],

                [
                    'slug' => 'hybrid',
                    'label' => 'Hybrid',
                    'sort_order' => 3,
                    'is_active' => true,
                ],

                [
                    'slug' => 'field',
                    'label' => 'Field Work',
                    'sort_order' => 4,
                    'is_active' => true,
                ],

                [
                    'slug' => 'travel_required',
                    'label' => 'Travel Required',
                    'sort_order' => 5,
                    'is_active' => true,
                ],

                [
                    'slug' => 'work_from_anywhere',
                    'label' => 'Work From Anywhere',
                    'sort_order' => 6,
                    'is_active' => true,
                ],

            ]);
    }
}
