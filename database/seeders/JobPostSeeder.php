<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\City;
use App\Models\EmploymentType;
use App\Models\ExperienceRange;
use App\Models\Industry;
use App\Models\JobPost;
use App\Models\JobPostDetail;
use App\Models\JobPostProfile;
use App\Models\Recruiter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class JobPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recruiters = Recruiter::whereNotNull('company_id')->get();
        if ($recruiters->isEmpty()) {
            return;
        }

        $industries = Industry::pluck('id')->all();
        $categories = Category::pluck('id')->all();
        $cities = City::pluck('id')->all();
        $employmentTypes = EmploymentType::pluck('id')->all();
        $experienceRanges = ExperienceRange::pluck('id')->all();

        if (empty($industries) || empty($categories) || empty($cities) || empty($employmentTypes) || empty($experienceRanges)) {
            return;
        }

        $faker = \Faker\Factory::create();

        foreach (range(1, 1000) as $index) {
            $recruiter = $recruiters->random();
            $companyId = $recruiter->company_id;

            $publishedAt = Carbon::now()->subDays($faker->numberBetween(1, 30));
            $expiresAt = (clone $publishedAt)->addDays($faker->numberBetween(14, 90));

            $minSalary = $faker->numberBetween(400000, 900000);
            $maxSalary = $minSalary + $faker->numberBetween(50000, 200000);

            $jobPost = JobPost::create([
                'title' => $faker->jobTitle,
                'company_id' => $companyId,
                'recruiter_id' => $recruiter->id,
                'industry_id' => Arr::random($industries),
                'category_id' => Arr::random($categories),
                'city_id' => Arr::random($cities),
                'employment_type_id' => Arr::random($employmentTypes),
                'experience_range_id' => Arr::random($experienceRanges),
                'min_salary' => $minSalary,
                'max_salary' => $maxSalary,
                'is_remote' => $faker->boolean(40),
                'is_featured' => $faker->boolean(15),
                'is_active' => $faker->boolean(90),
                'published_at' => $publishedAt,
                'expires_at' => $expiresAt,
            ]);

            JobPostDetail::updateOrCreate(
                ['job_post_id' => $jobPost->id],
                [
                    'description' => $faker->paragraphs(4, true),
                    'requirements' => collect(range(1, 4))
                        ->map(fn () => '- ' . $faker->sentence())
                        ->implode("\n"),
                    'responsibilities' => collect(range(1, 4))
                        ->map(fn () => '- ' . $faker->sentence())
                        ->implode("\n"),
                ]
            );

            if ($index % 50 === 0) {
                usleep(10000);
            }
        }
    }
}
