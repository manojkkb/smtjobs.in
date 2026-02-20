<?php

namespace Database\Seeders;

use App\Models\JobLevel;

class JobLevelSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(JobLevel::class, $this->basicSlugLabelData('job_level', ['slug' => 'entry', 'label' => 'Entry']));
    }
}
