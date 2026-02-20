<?php

namespace Database\Seeders;

use App\Models\EmploymentType;

class EmploymentTypeSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(EmploymentType::class, $this->basicSlugLabelData('employment_type', ['slug' => 'full-time', 'label' => 'Full Time']));
    }
}
