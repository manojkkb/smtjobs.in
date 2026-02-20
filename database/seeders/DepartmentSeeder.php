<?php

namespace Database\Seeders;

use App\Models\Department;

class DepartmentSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(Department::class, $this->basicSlugLabelData('department', ['slug' => 'operations', 'label' => 'Operations']));
    }
}
