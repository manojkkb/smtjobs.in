<?php

namespace Database\Seeders;

use App\Models\JobStatus;

class JobStatusSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(JobStatus::class, [
            ['slug' => 'open', 'sort_order' => 1, 'is_active' => true],
            ['slug' => 'closed', 'sort_order' => 2, 'is_active' => true],
        ]);
    }
}
