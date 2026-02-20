<?php

namespace Database\Seeders;

use App\Models\UserStatus;

class UserStatusSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(UserStatus::class, [
            ['slug' => 'active', 'sort_order' => 1, 'is_active' => true],
            ['slug' => 'inactive', 'sort_order' => 2, 'is_active' => true],
        ]);
    }
}
