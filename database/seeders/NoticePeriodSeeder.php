<?php

namespace Database\Seeders;

use App\Models\NoticePeriod;

class NoticePeriodSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(NoticePeriod::class, [
            ['slug' => 'immediate', 'label' => 'Immediate Joiner', 'days' => 0, 'sort_order' => 0],
            ['slug' => 'one-month', 'label' => '30 Days', 'days' => 30, 'sort_order' => 1],
            ['slug' => 'two-months', 'label' => '60 Days', 'days' => 60, 'sort_order' => 2],
        ]);
    }
}
