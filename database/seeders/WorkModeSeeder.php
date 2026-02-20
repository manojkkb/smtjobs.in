<?php

namespace Database\Seeders;

use App\Models\WorkMode;

class WorkModeSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(WorkMode::class, $this->basicSlugLabelData('work_mode', ['slug' => 'remote', 'label' => 'Remote']));
    }
}
