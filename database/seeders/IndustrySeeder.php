<?php

namespace Database\Seeders;

use App\Models\Industry;

class IndustrySeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(Industry::class, [

            ['slug' => 'information-technology', 'label' => 'Information Technology', 'description' => 'Software, SaaS, Cloud, AI, IT Services', 'icon' => 'code', 'sort_order' => 1],

            ['slug' => 'banking-finance-insurance', 'label' => 'Banking, Finance & Insurance', 'description' => 'Banking, NBFC, Insurance, FinTech', 'icon' => 'bank', 'sort_order' => 2],

            ['slug' => 'manufacturing', 'label' => 'Manufacturing', 'description' => 'Automobile, Textile, FMCG, Heavy Industry', 'icon' => 'factory', 'sort_order' => 3],

            ['slug' => 'construction-real-estate', 'label' => 'Construction & Real Estate', 'description' => 'Infrastructure, Real Estate, Architecture', 'icon' => 'building', 'sort_order' => 4],

            ['slug' => 'healthcare-pharma', 'label' => 'Healthcare & Pharmaceuticals', 'description' => 'Hospitals, Pharma, Diagnostics', 'icon' => 'heart', 'sort_order' => 5],

            ['slug' => 'education-training', 'label' => 'Education & Training', 'description' => 'Schools, Universities, EdTech, Coaching', 'icon' => 'graduation-cap', 'sort_order' => 6],

            ['slug' => 'retail-ecommerce', 'label' => 'Retail & E-commerce', 'description' => 'Retail Stores, Online Marketplaces', 'icon' => 'shopping-cart', 'sort_order' => 7],

            ['slug' => 'logistics-transportation', 'label' => 'Logistics & Transportation', 'description' => 'Courier, Warehousing, Aviation, Shipping', 'icon' => 'truck', 'sort_order' => 8],

            ['slug' => 'hospitality-tourism', 'label' => 'Hospitality & Tourism', 'description' => 'Hotels, Travel, Restaurants, Events', 'icon' => 'hotel', 'sort_order' => 9],

            ['slug' => 'media-entertainment', 'label' => 'Media & Entertainment', 'description' => 'Film, TV, Advertising, Gaming', 'icon' => 'film', 'sort_order' => 10],

            ['slug' => 'energy-utilities', 'label' => 'Energy & Utilities', 'description' => 'Power, Renewable Energy, Oil & Gas', 'icon' => 'bolt', 'sort_order' => 11],

            ['slug' => 'agriculture-allied', 'label' => 'Agriculture & Allied', 'description' => 'Farming, Dairy, Fisheries, AgriTech', 'icon' => 'leaf', 'sort_order' => 12],

            ['slug' => 'bpo-kpo-call-center', 'label' => 'BPO / KPO / Call Center', 'description' => 'Customer Support, ITES, Outsourcing', 'icon' => 'headphones', 'sort_order' => 13],

            ['slug' => 'government-public-sector', 'label' => 'Government & Public Sector', 'description' => 'PSU, Railways, Municipal Services', 'icon' => 'landmark', 'sort_order' => 14],

            ['slug' => 'research-development', 'label' => 'Research & Development', 'description' => 'Biotech, Scientific Research, Space Tech', 'icon' => 'flask', 'sort_order' => 15],

            ['slug' => 'home-services', 'label' => 'Home & Facility Services', 'description' => 'Security, Housekeeping, Maintenance', 'icon' => 'home', 'sort_order' => 16],

        ]);
    }
}
