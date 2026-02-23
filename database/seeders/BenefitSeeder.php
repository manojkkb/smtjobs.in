<?php

namespace Database\Seeders;

use App\Models\Benefit;

class BenefitSeeder extends MasterSeeder
{
    public function run(): void
    {
       $this->upsertRecords(Benefit::class, [

            // 🏥 Health
            ['slug' => 'health-insurance', 'label' => 'Health Insurance', 'category' => 'health', 'icon' => 'health', 'sort_order' => 1],
            ['slug' => 'dental-insurance', 'label' => 'Dental Insurance', 'category' => 'health', 'icon' => 'tooth', 'sort_order' => 2],
            ['slug' => 'life-insurance', 'label' => 'Life Insurance', 'category' => 'health', 'icon' => 'shield', 'sort_order' => 3],
            ['slug' => 'mental-health-support', 'label' => 'Mental Health Support', 'category' => 'health', 'icon' => 'brain', 'sort_order' => 4],

            // 💰 Financial
            ['slug' => 'provident-fund', 'label' => 'Provident Fund (PF)', 'category' => 'financial', 'icon' => 'bank', 'sort_order' => 5],
            ['slug' => 'gratuity', 'label' => 'Gratuity', 'category' => 'financial', 'icon' => 'wallet', 'sort_order' => 6],
            ['slug' => 'performance-bonus', 'label' => 'Performance Bonus', 'category' => 'financial', 'icon' => 'trophy', 'sort_order' => 7],
            ['slug' => 'annual-bonus', 'label' => 'Annual Bonus', 'category' => 'financial', 'icon' => 'gift', 'sort_order' => 8],
            ['slug' => 'joining-bonus', 'label' => 'Joining Bonus', 'category' => 'financial', 'icon' => 'star', 'sort_order' => 9],
            ['slug' => 'esop', 'label' => 'Stock Options (ESOP)', 'category' => 'financial', 'icon' => 'chart', 'sort_order' => 10],

            // 🏖 Leave
            ['slug' => 'paid-leave', 'label' => 'Paid Leave', 'category' => 'leave', 'icon' => 'calendar', 'sort_order' => 11],
            ['slug' => 'sick-leave', 'label' => 'Sick Leave', 'category' => 'leave', 'icon' => 'medkit', 'sort_order' => 12],
            ['slug' => 'maternity-leave', 'label' => 'Maternity Leave', 'category' => 'leave', 'icon' => 'baby', 'sort_order' => 13],
            ['slug' => 'paternity-leave', 'label' => 'Paternity Leave', 'category' => 'leave', 'icon' => 'family', 'sort_order' => 14],
            ['slug' => 'comp-off', 'label' => 'Compensatory Off', 'category' => 'leave', 'icon' => 'refresh', 'sort_order' => 15],

            // 🏠 Flexibility
            ['slug' => 'work-from-home', 'label' => 'Work From Home', 'category' => 'flexibility', 'icon' => 'home', 'sort_order' => 16],
            ['slug' => 'hybrid-work', 'label' => 'Hybrid Work', 'category' => 'flexibility', 'icon' => 'laptop', 'sort_order' => 17],
            ['slug' => 'flexible-hours', 'label' => 'Flexible Hours', 'category' => 'flexibility', 'icon' => 'clock', 'sort_order' => 18],
            ['slug' => 'five-day-week', 'label' => '5-Day Work Week', 'category' => 'flexibility', 'icon' => 'briefcase', 'sort_order' => 19],

            // 🚗 Allowance
            ['slug' => 'travel-allowance', 'label' => 'Travel Allowance', 'category' => 'allowance', 'icon' => 'car', 'sort_order' => 20],
            ['slug' => 'internet-reimbursement', 'label' => 'Internet Reimbursement', 'category' => 'allowance', 'icon' => 'wifi', 'sort_order' => 21],
            ['slug' => 'food-allowance', 'label' => 'Food Allowance', 'category' => 'allowance', 'icon' => 'utensils', 'sort_order' => 22],
            ['slug' => 'relocation-assistance', 'label' => 'Relocation Assistance', 'category' => 'allowance', 'icon' => 'map', 'sort_order' => 23],

            // 📚 Growth
            ['slug' => 'training-programs', 'label' => 'Training Programs', 'category' => 'growth', 'icon' => 'book', 'sort_order' => 24],
            ['slug' => 'certification-reimbursement', 'label' => 'Certification Reimbursement', 'category' => 'growth', 'icon' => 'award', 'sort_order' => 25],
            ['slug' => 'career-growth', 'label' => 'Career Growth Opportunities', 'category' => 'growth', 'icon' => 'arrow-up', 'sort_order' => 26],

            // 🎉 Perks
            ['slug' => 'free-snacks', 'label' => 'Free Snacks', 'category' => 'perks', 'icon' => 'coffee', 'sort_order' => 27],
            ['slug' => 'team-outings', 'label' => 'Team Outings', 'category' => 'perks', 'icon' => 'users', 'sort_order' => 28],
            ['slug' => 'gym-membership', 'label' => 'Gym Membership', 'category' => 'perks', 'icon' => 'dumbbell', 'sort_order' => 29],
            ['slug' => 'employee-discount', 'label' => 'Employee Discounts', 'category' => 'perks', 'icon' => 'tag', 'sort_order' => 30],

        ]);
    }
}
