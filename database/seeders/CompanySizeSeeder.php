<?php

namespace Database\Seeders;

use App\Models\CompanySize;

class CompanySizeSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(CompanySize::class, [

                ['slug' => 'micro', 'label' => '1–10 Employees', 'min_employees' => 1, 'max_employees' => 10, 'sort_order' => 1],

                ['slug' => 'small', 'label' => '11–50 Employees', 'min_employees' => 11, 'max_employees' => 50, 'sort_order' => 2],

                ['slug' => 'growing', 'label' => '51–200 Employees', 'min_employees' => 51, 'max_employees' => 200, 'sort_order' => 3],

                ['slug' => 'mid-size', 'label' => '201–500 Employees', 'min_employees' => 201, 'max_employees' => 500, 'sort_order' => 4],

                ['slug' => 'large', 'label' => '501–1000 Employees', 'min_employees' => 501, 'max_employees' => 1000, 'sort_order' => 5],

                ['slug' => 'corporate', 'label' => '1001–5000 Employees', 'min_employees' => 1001, 'max_employees' => 5000, 'sort_order' => 6],

                ['slug' => 'enterprise', 'label' => '5001+ Employees', 'min_employees' => 5001, 'max_employees' => null, 'sort_order' => 7],

            ]);
    }
}
