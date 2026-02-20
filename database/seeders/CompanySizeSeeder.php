<?php

namespace Database\Seeders;

use App\Models\CompanySize;

class CompanySizeSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(CompanySize::class, [
            ['slug' => 'micro', 'label' => '1-10 Employees', 'min_employees' => 1, 'max_employees' => 10, 'sort_order' => 1],
            ['slug' => 'enterprise', 'label' => '500+ Employees', 'min_employees' => 500, 'max_employees' => null, 'sort_order' => 2],
        ]);
    }
}
