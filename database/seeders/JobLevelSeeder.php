<?php

namespace Database\Seeders;

use App\Models\JobLevel;

class JobLevelSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(JobLevel::class, [

            ['slug'=>'entry_level','label'=>'Entry Level','sort_order'=>1,'is_active'=>true],
            ['slug'=>'junior','label'=>'Junior','sort_order'=>2,'is_active'=>true],

            ['slug'=>'mid_level','label'=>'Mid Level','sort_order'=>3,'is_active'=>true],
            ['slug'=>'associate','label'=>'Associate','sort_order'=>4,'is_active'=>true],

            ['slug'=>'senior','label'=>'Senior','sort_order'=>5,'is_active'=>true],
            ['slug'=>'lead','label'=>'Team Lead','sort_order'=>6,'is_active'=>true],

            ['slug'=>'assistant_manager','label'=>'Assistant Manager','sort_order'=>7,'is_active'=>true],
            ['slug'=>'manager','label'=>'Manager','sort_order'=>8,'is_active'=>true],
            ['slug'=>'senior_manager','label'=>'Senior Manager','sort_order'=>9,'is_active'=>true],

            ['slug'=>'director','label'=>'Director','sort_order'=>10,'is_active'=>true],
            ['slug'=>'vice_president','label'=>'Vice President','sort_order'=>11,'is_active'=>true],
            ['slug'=>'senior_vice_president','label'=>'Senior Vice President','sort_order'=>12,'is_active'=>true],
            ['slug'=>'c_level','label'=>'C-Level Executive','sort_order'=>13,'is_active'=>true],

        ]);
    }
}
