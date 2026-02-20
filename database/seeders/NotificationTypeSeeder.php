<?php

namespace Database\Seeders;

use App\Models\NotificationType;

class NotificationTypeSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(NotificationType::class, [
            [
                'slug' => 'job-applied',
                'label' => 'Job Applied',
                'description' => 'Notify candidates when their application status changes',
                'email_enabled' => true,
                'push_enabled' => false,
                'sms_enabled' => false,
                'in_app_enabled' => true,
                'is_system' => true,
                'sort_order' => 1,
            ],
            [
                'slug' => 'profile-viewed',
                'label' => 'Profile Viewed',
                'description' => 'Alert recruiters when a profile they follow gets viewed',
                'email_enabled' => false,
                'push_enabled' => true,
                'sms_enabled' => false,
                'in_app_enabled' => true,
                'is_system' => true,
                'sort_order' => 2,
            ],
        ]);
    }
}
