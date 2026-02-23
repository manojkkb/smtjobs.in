<?php

namespace Database\Seeders;

use App\Models\JobStatus;

class JobStatusSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(JobStatus::class, [

                [
                    'slug' => 'draft',
                    'label' => 'Draft',
                    'sort_order' => 1,
                    'is_active' => true,
                ],

                [
                    'slug' => 'pending',
                    'label' => 'Pending Approval',
                    'sort_order' => 2,
                    'is_active' => true,
                ],

                [
                    'slug' => 'active',
                    'label' => 'Active',
                    'sort_order' => 3,
                    'is_active' => true,
                ],

                [
                    'slug' => 'paused',
                    'label' => 'Paused',
                    'sort_order' => 4,
                    'is_active' => true,
                ],

                [
                    'slug' => 'closed',
                    'label' => 'Closed',
                    'sort_order' => 5,
                    'is_active' => true,
                ],

                [
                    'slug' => 'expired',
                    'label' => 'Expired',
                    'sort_order' => 6,
                    'is_active' => true,
                ],

                [
                    'slug' => 'rejected',
                    'label' => 'Rejected',
                    'sort_order' => 7,
                    'is_active' => false,
                ],

]);
    }
}
