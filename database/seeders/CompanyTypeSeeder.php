<?php

namespace Database\Seeders;

use App\Models\CompanyType;

class CompanyTypeSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(CompanyType::class, [

                ['slug' => 'private-limited', 'label' => 'Private Limited Company', 'description' => 'Registered private limited company', 'sort_order' => 1],

                ['slug' => 'public-limited', 'label' => 'Public Limited Company', 'description' => 'Public limited or listed company', 'sort_order' => 2],

                ['slug' => 'llp', 'label' => 'Limited Liability Partnership (LLP)', 'description' => 'Registered LLP entity', 'sort_order' => 3],

                ['slug' => 'partnership', 'label' => 'Partnership Firm', 'description' => 'Business owned by two or more partners', 'sort_order' => 4],

                ['slug' => 'sole-proprietorship', 'label' => 'Sole Proprietorship', 'description' => 'Business owned and operated by a single individual', 'sort_order' => 5],

                ['slug' => 'one-person-company', 'label' => 'One Person Company (OPC)', 'description' => 'Single promoter registered company', 'sort_order' => 6],

                ['slug' => 'government', 'label' => 'Government Organization', 'description' => 'Central or State Government entity', 'sort_order' => 7],

                ['slug' => 'psu', 'label' => 'Public Sector Undertaking (PSU)', 'description' => 'Government controlled corporate entity', 'sort_order' => 8],

                ['slug' => 'ngo', 'label' => 'NGO / Non-Profit Organization', 'description' => 'Trust, Society or Section 8 company', 'sort_order' => 9],

                ['slug' => 'foreign-company', 'label' => 'Foreign Company', 'description' => 'Company registered outside India', 'sort_order' => 10],

            ]);
    }
}
