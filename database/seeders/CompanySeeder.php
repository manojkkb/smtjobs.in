<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Company;
use App\Models\CompanyLocation;
use App\Models\CompanyProfile;
use App\Models\CompanySize;
use App\Models\CompanySocialLink;
use App\Models\CompanyType;
use App\Models\Industry;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class CompanySeeder extends MasterSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $industries = Industry::pluck('id')->all();
        $types = CompanyType::pluck('id')->all();
        $sizes = CompanySize::pluck('id')->all();
        $cities = City::pluck('id')->all();

        if (empty($industries) || empty($types) || empty($sizes) || empty($cities)) {
            return;
        }

        $faker = \Faker\Factory::create();

        $companies = collect(range(1, 6))->map(function (int $seed) use ($faker, $industries, $types, $sizes, $cities) {
            $name = $faker->company();
            return [
                'name' => $name,
                'slug' => Str::slug($name) . "-{$seed}",
                'industry_id' => Arr::random($industries),
                'company_type_id' => Arr::random($types),
                'company_size_id' => Arr::random($sizes),
                'city_id' => Arr::random($cities),
                'is_verified' => $faker->boolean(30),
                'is_active' => true,
            ];
        })->all();

        $this->upsertRecords(Company::class, $companies);

        foreach ($companies as $record) {
            $company = Company::firstWhere('slug', $record['slug']);
            if (!$company) {
                continue;
            }

            CompanyProfile::updateOrCreate(
                ['company_id' => $company->id],
                [
                    'description' => $faker->paragraphs(3, true),
                    'website' => "https://" . Str::slug($company->name) . ".example.com",
                    'logo' => "logos/{$company->slug}.png",
                    'cover_image' => "covers/{$company->slug}.jpg",
                    'email' => $faker->companyEmail,
                    'phone' => $faker->e164PhoneNumber,
                    'founded_year' => $faker->numberBetween(2000, 2024),
                ]
            );

            CompanyLocation::updateOrCreate(
                ['company_id' => $company->id, 'city_id' => $record['city_id']],
                ['address' => $faker->streetAddress]
            );

            foreach (['linkedin', 'twitter', 'facebook'] as $platform) {
                CompanySocialLink::updateOrCreate(
                    ['company_id' => $company->id, 'platform' => $platform],
                    ['url' => "https://{$platform}.com/" . Str::slug($company->name)]
                );
            }
        }
    }
}
