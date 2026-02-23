<?php

namespace Database\Seeders;

use App\Models\NoticePeriod;

class NoticePeriodSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(NoticePeriod::class, [

    ['slug'=>'immediate','label'=>'Immediate Joiner','days'=>0,'sort_order'=>1,'is_active'=>true],

    ['slug'=>'7_days','label'=>'7 Days','days'=>7,'sort_order'=>2,'is_active'=>true],
    ['slug'=>'15_days','label'=>'15 Days','days'=>15,'sort_order'=>3,'is_active'=>true],

    ['slug'=>'30_days','label'=>'30 Days','days'=>30,'sort_order'=>4,'is_active'=>true],
    ['slug'=>'45_days','label'=>'45 Days','days'=>45,'sort_order'=>5,'is_active'=>true],

    ['slug'=>'60_days','label'=>'60 Days','days'=>60,'sort_order'=>6,'is_active'=>true],
    ['slug'=>'75_days','label'=>'75 Days','days'=>75,'sort_order'=>7,'is_active'=>true],

    ['slug'=>'90_days','label'=>'90 Days','days'=>90,'sort_order'=>8,'is_active'=>true],

    ['slug'=>'more_than_90','label'=>'More than 90 Days','days'=>120,'sort_order'=>9,'is_active'=>true],

]);
    }
}
