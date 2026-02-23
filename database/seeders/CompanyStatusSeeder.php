<?php

namespace Database\Seeders;

use App\Models\CompanyStatus;

class CompanyStatusSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(CompanyStatus::class, [

                // 🟢 Active Hiring
                [
                    'slug' => 'hiring',
                    'label' => 'Actively Hiring',
                    'sort_order' => 1,
                    'is_active' => true,
                ],

                // 🟡 Temporarily Paused
                [
                    'slug' => 'paused',
                    'label' => 'Hiring Paused',
                    'sort_order' => 2,
                    'is_active' => true,
                ],

                // 🔵 Not Hiring
                [
                    'slug' => 'not-hiring',
                    'label' => 'Not Hiring',
                    'sort_order' => 3,
                    'is_active' => true,
                ],

                // ⚪ Inactive Account
                [
                    'slug' => 'inactive',
                    'label' => 'Inactive',
                    'sort_order' => 4,
                    'is_active' => false,
                ],

                // 🔴 Suspended
                [
                    'slug' => 'suspended',
                    'label' => 'Suspended',
                    'sort_order' => 5,
                    'is_active' => false,
                ],

                // ⚫ Blacklisted
                [
                    'slug' => 'blacklisted',
                    'label' => 'Blacklisted',
                    'sort_order' => 6,
                    'is_active' => false,
                ],

            ]);
    }
}
