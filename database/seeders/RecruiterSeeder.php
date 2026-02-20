<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Recruiter;
use App\Models\RecruiterProfile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RecruiterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companyIds = Company::pluck('id')->all();
        if (empty($companyIds)) {
            return;
        }

        $faker = \Faker\Factory::create();

        foreach (range(1, 4) as $index) {
            $fullName = $faker->name();
            $email = "recruiter{$index}@example.local";

            $user = User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => $fullName,
                    'phone' => $faker->e164PhoneNumber,
                    'password' => Hash::make('welcome123'),
                ]
            );

            $companyId = Arr::random($companyIds);
            $recruiter = Recruiter::updateOrCreate(
                ['user_id' => $user->id, 'company_id' => $companyId],
                [
                    'role' => Arr::random(['owner', 'hr', 'interviewer']),
                    'is_active' => true,
                    'is_verified' => $faker->boolean(50),
                    'last_active_at' => now()->subDays($faker->numberBetween(1, 15)),
                ]
            );

            RecruiterProfile::updateOrCreate(
                ['recruiter_id' => $recruiter->id],
                [
                    'first_name' => $faker->firstName,
                    'last_name' => $faker->lastName,
                    'designation' => $faker->jobTitle,
                    'department' => Str::title($faker->word),
                    'phone' => $faker->phoneNumber,
                    'bio' => $faker->paragraphs(2, true),
                    'profile_photo' => "recruiters/{$recruiter->id}.jpg",
                ]
            );
        }
    }
}
