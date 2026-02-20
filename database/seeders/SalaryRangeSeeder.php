<?php

namespace Database\Seeders;

use App\Models\SalaryRange;

class SalaryRangeSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(SalaryRange::class, [
            ['min_salary' => 50000, 'max_salary' => 80000, 'label' => 'Entry (50k-80k)'],
            ['min_salary' => 90000, 'max_salary' => 130000, 'label' => 'Mid (90k-130k)'],
        ], ['min_salary', 'max_salary']);
    }
}
