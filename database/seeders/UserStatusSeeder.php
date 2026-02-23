<?php

namespace Database\Seeders;

use App\Models\UserStatus;

class UserStatusSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(UserStatus::class, [
            ['slug' => 'active', 'label' => 'Active', 'sort_order' => 1, 'is_active' => true],
            ['slug' => 'inactive', 'label' => 'Inactive', 'sort_order' => 2, 'is_active' => true],
        ]);
    }
}
