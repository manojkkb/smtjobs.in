<?php

namespace Database\Seeders;

use App\Models\ExperienceRange;

class ExperienceRangeSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(ExperienceRange::class, [

            ['slug'=>'fresher','label'=>'Fresher (0 Years)','min_years'=>0,'max_years'=>0,'sort_order'=>1,'is_active'=>true],
            ['slug'=>'0_1_year','label'=>'0 - 1 Year','min_years'=>0,'max_years'=>1,'sort_order'=>2,'is_active'=>true],
            ['slug'=>'1_2_years','label'=>'1 - 2 Years','min_years'=>1,'max_years'=>2,'sort_order'=>3,'is_active'=>true],
            ['slug'=>'2_3_years','label'=>'2 - 3 Years','min_years'=>2,'max_years'=>3,'sort_order'=>4,'is_active'=>true],
            ['slug'=>'3_5_years','label'=>'3 - 5 Years','min_years'=>3,'max_years'=>5,'sort_order'=>5,'is_active'=>true],
            ['slug'=>'5_7_years','label'=>'5 - 7 Years','min_years'=>5,'max_years'=>7,'sort_order'=>6,'is_active'=>true],
            ['slug'=>'7_10_years','label'=>'7 - 10 Years','min_years'=>7,'max_years'=>10,'sort_order'=>7,'is_active'=>true],
            ['slug'=>'10_12_years','label'=>'10 - 12 Years','min_years'=>10,'max_years'=>12,'sort_order'=>8,'is_active'=>true],
            ['slug'=>'12_15_years','label'=>'12 - 15 Years','min_years'=>12,'max_years'=>15,'sort_order'=>9,'is_active'=>true],
            ['slug'=>'15_20_years','label'=>'15 - 20 Years','min_years'=>15,'max_years'=>20,'sort_order'=>10,'is_active'=>true],
            ['slug'=>'20_plus_years','label'=>'20+ Years','min_years'=>20,'max_years'=>50,'sort_order'=>11,'is_active'=>true],

        ]);
    }
}
