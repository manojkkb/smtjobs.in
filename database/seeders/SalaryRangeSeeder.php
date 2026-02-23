<?php

namespace Database\Seeders;

use App\Models\SalaryRange;

class SalaryRangeSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(SalaryRange::class, [

    ['slug' => '0-1-lpa', 'label' => '0 - 1 LPA', 'min_salary' => 0, 'max_salary' => 100000, 'sort_order' => 1 ,'is_active' => true],
    ['slug' => '1-2-lpa', 'label' => '1 - 2 LPA', 'min_salary' => 100000, 'max_salary' => 200000, 'sort_order' => 2, 'is_active' => true],
    ['slug' => '2-3-lpa', 'label' => '2 - 3 LPA', 'min_salary' => 200000, 'max_salary' => 300000, 'sort_order' => 3, 'is_active' => true],

    ['slug' => '3-5-lpa', 'label' => '3 - 5 LPA', 'min_salary' => 300000, 'max_salary' => 500000, 'sort_order' => 4, 'is_active' => true],
    ['slug' => '5-8-lpa', 'label' => '5 - 8 LPA', 'min_salary' => 500000, 'max_salary' => 800000, 'sort_order' => 5, 'is_active' => true],
    ['slug' => '8-10-lpa', 'label' => '8 - 10 LPA', 'min_salary' => 800000, 'max_salary' => 1000000, 'sort_order' => 6, 'is_active' => true],

    ['slug' => '10-15-lpa', 'label' => '10 - 15 LPA', 'min_salary' => 1000000, 'max_salary' => 1500000, 'sort_order' => 7, 'is_active' => true],
    ['slug' => '15-20-lpa', 'label' => '15 - 20 LPA', 'min_salary' => 1500000, 'max_salary' => 2000000, 'sort_order' => 8, 'is_active' => true],
    ['slug' => '20-30-lpa', 'label' => '20 - 30 LPA', 'min_salary' => 2000000, 'max_salary' => 3000000, 'sort_order' => 9, 'is_active' => true],

    ['slug' => '30-50-lpa', 'label' => '30 - 50 LPA', 'min_salary' => 3000000, 'max_salary' => 5000000, 'sort_order' => 10, 'is_active' => true],
    ['slug' => '50-75-lpa', 'label' => '50 - 75 LPA', 'min_salary' => 5000000, 'max_salary' => 7500000, 'sort_order' => 11, 'is_active' => true],
    ['slug' => '75-lpa-1-cr', 'label' => '75 LPA - 1 Cr', 'min_salary' => 7500000, 'max_salary' => 10000000, 'sort_order' => 12, 'is_active' => true],
    ['slug' => '1-cr-plus', 'label' => '1 Cr+', 'min_salary' => 10000000, 'max_salary' => 90000000, 'sort_order' => 13, 'is_active' => true],

]);
    }
}
