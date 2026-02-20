<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\JobRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
class JobRoleSeeder extends MasterSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [

            // IT Industry Roles
            'software-development' => [
                ['slug' => 'php-developer', 'label' => 'PHP Developer'],
                ['slug' => 'laravel-developer', 'label' => 'Laravel Developer'],
                ['slug' => 'react-developer', 'label' => 'React Developer'],
                ['slug' => 'nodejs-developer', 'label' => 'Node.js Developer'],
                ['slug' => 'full-stack-developer', 'label' => 'Full Stack Developer'],
                ['slug' => 'backend-developer', 'label' => 'Backend Developer'],
                ['slug' => 'frontend-developer', 'label' => 'Frontend Developer'],
            ],

            'devops-cloud' => [
                ['slug' => 'devops-engineer', 'label' => 'DevOps Engineer'],
                ['slug' => 'cloud-engineer', 'label' => 'Cloud Engineer'],
                ['slug' => 'aws-engineer', 'label' => 'AWS Engineer'],
                ['slug' => 'site-reliability-engineer', 'label' => 'Site Reliability Engineer'],
            ],

            'data-science-ai' => [
                ['slug' => 'data-analyst', 'label' => 'Data Analyst'],
                ['slug' => 'data-scientist', 'label' => 'Data Scientist'],
                ['slug' => 'machine-learning-engineer', 'label' => 'Machine Learning Engineer'],
                ['slug' => 'ai-engineer', 'label' => 'AI Engineer'],
            ],

            'it-support' => [
                ['slug' => 'it-support-executive', 'label' => 'IT Support Executive'],
                ['slug' => 'system-administrator', 'label' => 'System Administrator'],
                ['slug' => 'network-engineer', 'label' => 'Network Engineer'],
            ],

            // Banking Roles
            'retail-banking' => [
                ['slug' => 'relationship-manager', 'label' => 'Relationship Manager'],
                ['slug' => 'bank-cashier', 'label' => 'Bank Cashier'],
                ['slug' => 'loan-officer', 'label' => 'Loan Officer'],
            ],

            'accounting-taxation' => [
                ['slug' => 'accountant', 'label' => 'Accountant'],
                ['slug' => 'chartered-accountant', 'label' => 'Chartered Accountant'],
                ['slug' => 'tax-consultant', 'label' => 'Tax Consultant'],
            ],

            // Manufacturing Roles
            'production' => [
                ['slug' => 'production-supervisor', 'label' => 'Production Supervisor'],
                ['slug' => 'machine-operator', 'label' => 'Machine Operator'],
                ['slug' => 'assembly-worker', 'label' => 'Assembly Worker'],
            ],

            'quality-control' => [
                ['slug' => 'quality-analyst', 'label' => 'Quality Analyst'],
                ['slug' => 'quality-inspector', 'label' => 'Quality Inspector'],
            ],

            // Healthcare Roles
            'doctors' => [
                ['slug' => 'general-physician', 'label' => 'General Physician'],
                ['slug' => 'surgeon', 'label' => 'Surgeon'],
                ['slug' => 'dentist', 'label' => 'Dentist'],
            ],

            'nursing' => [
                ['slug' => 'staff-nurse', 'label' => 'Staff Nurse'],
                ['slug' => 'icu-nurse', 'label' => 'ICU Nurse'],
            ],

            // Retail Roles
            'sales' => [
                ['slug' => 'sales-executive', 'label' => 'Sales Executive'],
                ['slug' => 'store-manager', 'label' => 'Store Manager'],
            ],

            'warehouse' => [
                ['slug' => 'warehouse-executive', 'label' => 'Warehouse Executive'],
                ['slug' => 'picker-packer', 'label' => 'Picker & Packer'],
            ],

            // Logistics Roles
            'delivery' => [
                ['slug' => 'delivery-executive', 'label' => 'Delivery Executive'],
                ['slug' => 'truck-driver', 'label' => 'Truck Driver'],
            ],

            // Hospitality Roles
            'hotel-management' => [
                ['slug' => 'hotel-manager', 'label' => 'Hotel Manager'],
                ['slug' => 'front-office-executive', 'label' => 'Front Office Executive'],
            ],

            'food-beverage' => [
                ['slug' => 'chef', 'label' => 'Chef'],
                ['slug' => 'waiter', 'label' => 'Waiter'],
            ],
        ];

        foreach ($roles as $categorySlug => $jobRoles) {

            $category = Category::firstWhere('slug', $categorySlug);
            if (!$category) {
                continue;
            }

            $records = array_map(
                fn ($role) => array_merge(
                    Arr::only($role, ['slug']),
                    ['label' => $role['label'] ?? null, 'category_id' => $category->id]
                ),
                $jobRoles
            );

            $this->upsertRecords(JobRole::class, $records);
        }
    }
}
