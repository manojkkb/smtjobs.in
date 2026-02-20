<?php

namespace Database\Seeders;

use App\Models\JobPreferencesType;

class JobPreferencesTypeSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(JobPreferencesType::class, [
            ['slug' => 'work_mode', 'label' => 'Work Mode', 'input_type' => 'select', 'is_multiple' => true, 'sort_order' => 1],
            ['slug' => 'salary', 'label' => 'Salary Range', 'input_type' => 'range', 'is_multiple' => false, 'sort_order' => 2],
            ['slug' => 'industry', 'label' => 'Industry', 'input_type' => 'multi_select', 'is_multiple' => true, 'sort_order' => 3],
        ]);
    }
}
