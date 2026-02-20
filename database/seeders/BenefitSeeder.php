<?php

namespace Database\Seeders;

use App\Models\Benefit;

class BenefitSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(Benefit::class, [
            ['slug' => 'health-insurance', 'label' => 'Health Insurance', 'icon' => 'health', 'sort_order' => 1],
            ['slug' => 'flexible-hours', 'label' => 'Flexible Hours', 'icon' => 'clock', 'sort_order' => 2],
        ]);
    }
}
