<?php

namespace Database\Seeders;

use App\Models\EducationLevel;

class EducationLevelSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(EducationLevel::class, $this->basicSlugLabelData('education_level', ['slug' => 'bachelors', 'label' => 'Bachelors']));
    }
}
