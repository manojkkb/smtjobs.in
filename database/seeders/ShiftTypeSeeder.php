<?php

namespace Database\Seeders;

use App\Models\ShiftType;

class ShiftTypeSeeder extends MasterSeeder
{
    public function run(): void
    {
       $this->upsertRecords(ShiftType::class, [
            [
                'slug'        => 'day',
                'label'       => 'Day Shift',
                'start_time'  => '08:00',
                'end_time'    => '17:00',
    
                'sort_order'  => 1,
            ],
            [
                'slug'        => 'night',
                'label'       => 'Night Shift',
                'start_time'  => '20:00',
                'end_time'    => '06:00',
               
                'sort_order'  => 2,
            ],
            [
                'slug'        => 'rotational',
                'label'       => 'Rotational Shift',
                'start_time'  => null,
                'end_time'    => null,
                'sort_order'  => 3,
            ],
            [
                'slug'        => 'flexible',
                'label'       => 'Flexible Shift',
                'start_time'  => null,
                'end_time'    => null,
                'sort_order'  => 4,
            ],
            [
                'slug'        => 'split',
                'label'       => 'Split Shift',
                'start_time'  => null,
                'end_time'    => null,
                'sort_order'  => 5,
            ],
            [
                'slug'        => 'on-call',
                'label'       => 'On-Call Shift',
                'start_time'  => null,
                'end_time'    => null,
                'sort_order'  => 6,
            ],
            [
                'slug'        => 'weekend',
                'label'       => 'Weekend Shift',
                'start_time'  => '09:00',
                'end_time'    => '18:00',
                'sort_order'  => 7,
            ],
        ]);
    }
}
