<?php

namespace Database\Seeders;

use App\Models\CompanyType;

class CompanyTypeSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(CompanyType::class, [
            ['slug' => 'startup', 'label' => 'Startup', 'description' => 'Early-stage technology company', 'sort_order' => 1],
            ['slug' => 'enterprise', 'label' => 'Enterprise', 'description' => 'Large scaled organization', 'sort_order' => 2],
        ]);
    }
}
