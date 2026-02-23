<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class MasterTablesSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        foreach ($this->seeders as $table => $seeder) {
            if (!Schema::hasTable($table)) {
                continue;
            }

            $this->call($seeder);
        }
    }

    protected array $seeders = [
        'countries' => CountriesSeeder::class,
        'states' => StatesSeeder::class,
        'cities' => CitiesSeeder::class,
        'areas' => AreasSeeder::class,
        'languages' => LanguagesSeeder::class,
        'industries' => IndustrySeeder::class,
        'categories' => CategorySeeder::class,
        'job_roles' => JobRoleSeeder::class,
        'tags' => TagSeeder::class,
        'skills' => SkillSeeder::class,
        'job_levels' => JobLevelSeeder::class,
        'employment_types' => EmploymentTypeSeeder::class,
        'work_modes' => WorkModeSeeder::class,
        'education_levels' => EducationLevelSeeder::class,
        'education_degrees' => EducationDegreeSeeder::class,
        'education_specializations' => EducationSpecializationSeeder::class,
        'salary_ranges' => SalaryRangeSeeder::class,
        'notice_periods' => NoticePeriodSeeder::class,
        'benefits' => BenefitSeeder::class,
        'certificates' => CertificateSeeder::class,
        'shift_types' => ShiftTypeSeeder::class,
        'experience_ranges' => ExperienceRangeSeeder::class,
        'job_statuses' => JobStatusSeeder::class,
        'company_statuses' => CompanyStatusSeeder::class,
        'application_statuses' => ApplicationStatusSeeder::class,
        'user_statuses' => UserStatusSeeder::class,
        'company_sizes' => CompanySizeSeeder::class,
        'company_types' => CompanyTypeSeeder::class,
        'notification_types' => NotificationTypeSeeder::class,
        'job_preferences_types' => JobPreferencesTypeSeeder::class,
        'companies' => CompanySeeder::class,
        'recruiters' => RecruiterSeeder::class,
        'job_posts' => JobPostSeeder::class,
    ];
}
