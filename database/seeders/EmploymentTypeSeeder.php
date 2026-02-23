<?php

namespace Database\Seeders;

use App\Models\EmploymentType;

class EmploymentTypeSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(EmploymentType::class, [

            ['slug'=>'full_time','label'=>'Full Time','sort_order'=>1,'is_active'=>true],
            ['slug'=>'part_time','label'=>'Part Time','sort_order'=>2,'is_active'=>true],
            ['slug'=>'contract','label'=>'Contract','sort_order'=>3,'is_active'=>true],
            ['slug'=>'temporary','label'=>'Temporary','sort_order'=>4,'is_active'=>true],
            ['slug'=>'internship','label'=>'Internship','sort_order'=>5,'is_active'=>true],
            ['slug'=>'freelance','label'=>'Freelance','sort_order'=>6,'is_active'=>true],
            ['slug'=>'apprenticeship','label'=>'Apprenticeship','sort_order'=>7,'is_active'=>true],

        ]);
    }
}
