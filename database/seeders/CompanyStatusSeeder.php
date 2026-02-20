<?php

namespace Database\Seeders;

use App\Models\CompanyStatus;

class CompanyStatusSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(CompanyStatus::class, [
            ['slug' => 'hiring', 'sort_order' => 1, 'is_active' => true],
            ['slug' => 'paused', 'sort_order' => 2, 'is_active' => true],
        ]);
    }
}
