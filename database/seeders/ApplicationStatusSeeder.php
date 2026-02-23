<?php

namespace Database\Seeders;

use App\Models\ApplicationStatus;

class ApplicationStatusSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(ApplicationStatus::class, [

            ['slug' => 'applied', 'label' => 'Applied', 'sort_order' => 1],
            ['slug' => 'under_review', 'label' => 'Under Review', 'sort_order' => 2],
            ['slug' => 'shortlisted', 'label' => 'Shortlisted', 'sort_order' => 3],

            ['slug' => 'interview_scheduled', 'label' => 'Interview Scheduled', 'sort_order' => 4],
            ['slug' => 'interview_completed', 'label' => 'Interview Completed', 'sort_order' => 5],

            ['slug' => 'selected', 'label' => 'Selected', 'sort_order' => 6],
            ['slug' => 'offered', 'label' => 'Offer Released', 'sort_order' => 7],
            ['slug' => 'offer_accepted', 'label' => 'Offer Accepted', 'sort_order' => 8],
            ['slug' => 'offer_rejected', 'label' => 'Offer Rejected', 'sort_order' => 9],

            ['slug' => 'rejected', 'label' => 'Rejected', 'sort_order' => 10],
            ['slug' => 'withdrawn', 'label' => 'Withdrawn by Candidate', 'sort_order' => 11],
            ['slug' => 'position_closed', 'label' => 'Position Closed', 'sort_order' => 12],
            ['slug' => 'on_hold', 'label' => 'On Hold', 'sort_order' => 13],

        ]);
    }
}
