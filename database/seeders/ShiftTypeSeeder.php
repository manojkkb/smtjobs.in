<?php

namespace Database\Seeders;

use App\Models\ShiftType;

class ShiftTypeSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(ShiftType::class, [
            ['slug' => 'day', 'label' => 'Day', 'start_time' => '08:00', 'end_time' => '17:00', 'sort_order' => 1],
            ['slug' => 'night', 'label' => 'Night', 'start_time' => '20:00', 'end_time' => '06:00', 'sort_order' => 2],
        ]);
    }
}
