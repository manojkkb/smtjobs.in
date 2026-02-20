<?php

namespace Database\Seeders;

use App\Models\ApplicationStatus;

class ApplicationStatusSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(ApplicationStatus::class, [
            ['slug' => 'applied', 'sort_order' => 1, 'is_active' => true],
            ['slug' => 'review', 'sort_order' => 2, 'is_active' => true],
        ]);
    }
}
