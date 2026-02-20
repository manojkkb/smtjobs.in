<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Industry;

class CategorySeeder extends MasterSeeder
{
   public function run(): void
    {
        $industryCategories = [

            'information-technology' => [
                ['slug' => 'software-development', 'label' => 'Software Development'],
                ['slug' => 'web-development', 'label' => 'Web Development'],
                ['slug' => 'mobile-development', 'label' => 'Mobile Development'],
                ['slug' => 'devops-cloud', 'label' => 'DevOps & Cloud'],
                ['slug' => 'cyber-security', 'label' => 'Cyber Security'],
                ['slug' => 'data-science-ai', 'label' => 'Data Science & AI'],
                ['slug' => 'ui-ux-design', 'label' => 'UI/UX Design'],
                ['slug' => 'it-support', 'label' => 'IT Support'],
            ],

            'banking-finance-insurance' => [
                ['slug' => 'retail-banking', 'label' => 'Retail Banking'],
                ['slug' => 'corporate-banking', 'label' => 'Corporate Banking'],
                ['slug' => 'insurance', 'label' => 'Insurance'],
                ['slug' => 'investment-banking', 'label' => 'Investment Banking'],
                ['slug' => 'accounting-taxation', 'label' => 'Accounting & Taxation'],
                ['slug' => 'risk-compliance', 'label' => 'Risk & Compliance'],
            ],

            'manufacturing' => [
                ['slug' => 'production', 'label' => 'Production'],
                ['slug' => 'quality-control', 'label' => 'Quality Control'],
                ['slug' => 'maintenance', 'label' => 'Maintenance'],
                ['slug' => 'supply-chain', 'label' => 'Supply Chain'],
                ['slug' => 'plant-operations', 'label' => 'Plant Operations'],
            ],

            'healthcare-pharma' => [
                ['slug' => 'doctors', 'label' => 'Doctors'],
                ['slug' => 'nursing', 'label' => 'Nursing'],
                ['slug' => 'medical-representative', 'label' => 'Medical Representative'],
                ['slug' => 'lab-technician', 'label' => 'Lab Technician'],
                ['slug' => 'hospital-admin', 'label' => 'Hospital Administration'],
            ],

            'retail-ecommerce' => [
                ['slug' => 'store-operations', 'label' => 'Store Operations'],
                ['slug' => 'sales', 'label' => 'Sales'],
                ['slug' => 'inventory', 'label' => 'Inventory Management'],
                ['slug' => 'customer-support', 'label' => 'Customer Support'],
                ['slug' => 'warehouse', 'label' => 'Warehouse'],
            ],

            'construction-real-estate' => [
                ['slug' => 'civil-engineering', 'label' => 'Civil Engineering'],
                ['slug' => 'site-supervision', 'label' => 'Site Supervision'],
                ['slug' => 'architecture', 'label' => 'Architecture'],
                ['slug' => 'project-management', 'label' => 'Project Management'],
            ],

            'logistics-transportation' => [
                ['slug' => 'transport-operations', 'label' => 'Transport Operations'],
                ['slug' => 'delivery', 'label' => 'Delivery'],
                ['slug' => 'fleet-management', 'label' => 'Fleet Management'],
                ['slug' => 'warehouse-operations', 'label' => 'Warehouse Operations'],
            ],

            'hospitality-tourism' => [
                ['slug' => 'hotel-management', 'label' => 'Hotel Management'],
                ['slug' => 'food-beverage', 'label' => 'Food & Beverage'],
                ['slug' => 'travel-operations', 'label' => 'Travel Operations'],
                ['slug' => 'housekeeping', 'label' => 'Housekeeping'],
            ],

        ];

        foreach ($industryCategories as $industrySlug => $categories) {

            $industry = Industry::firstWhere('slug', $industrySlug);
            if (!$industry) {
                continue;
            }

            $records = array_map(
                fn ($category) => array_merge(
                    $category,
                    ['industry_id' => $industry->id]
                ),
                $categories
            );

            $this->upsertRecords(Category::class, $records);
        }
    }
}
