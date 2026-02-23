<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EducationLevel;
use App\Models\EducationDegree;
class EducationDegreeSeeder extends MasterSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levelMap = EducationLevel::pluck('id', 'slug');

$this->upsertRecords(EducationDegree::class, [

    /* ================= SCHOOL ================= */
    [
        'slug' => '10th',
        'label' => '10th Pass',
        'education_level_id' => $levelMap['school'],
        'sort_order' => 1,
    ],
    [
        'slug' => '12th',
        'label' => '12th Pass',
        'education_level_id' => $levelMap['school'],
        'sort_order' => 2,
    ],

    /* ================= DIPLOMA ================= */
    [
        'slug' => 'diploma-engineering',
        'label' => 'Diploma in Engineering',
        'education_level_id' => $levelMap['diploma'],
        'sort_order' => 10,
    ],
    [
        'slug' => 'iti',
        'label' => 'ITI',
        'education_level_id' => $levelMap['diploma'],
        'sort_order' => 11,
    ],

    /* ================= BACHELOR ================= */
    [
        'slug' => 'btech',
        'label' => 'B.Tech',
        'education_level_id' => $levelMap['bachelor'],
        'sort_order' => 20,
    ],
    [
        'slug' => 'bcom',
        'label' => 'Bachelor of Commerce (BCom)',
        'education_level_id' => $levelMap['bachelor'],
        'sort_order' => 21,
    ],
    [
        'slug' => 'bsc',
        'label' => 'Bachelor of Science (BSc)',
        'education_level_id' => $levelMap['bachelor'],
        'sort_order' => 22,
    ],
    [
        'slug' => 'ba',
        'label' => 'Bachelor of Arts (BA)',
        'education_level_id' => $levelMap['bachelor'],
        'sort_order' => 23,
    ],
    [
        'slug' => 'bba',
        'label' => 'Bachelor of Business Administration (BBA)',
        'education_level_id' => $levelMap['bachelor'],
        'sort_order' => 24,
    ],
    [
        'slug' => 'bca',
        'label' => 'Bachelor of Computer Applications (BCA)',
        'education_level_id' => $levelMap['bachelor'],
        'sort_order' => 25,
    ],
    [
        'slug' => 'mbbs',
        'label' => 'MBBS',
        'education_level_id' => $levelMap['bachelor'],
        'sort_order' => 26,
    ],

    /* ================= MASTER ================= */
    [
        'slug' => 'mtech',
        'label' => 'M.Tech',
        'education_level_id' => $levelMap['master'],
        'sort_order' => 40,
    ],
    [
        'slug' => 'mba',
        'label' => 'MBA',
        'education_level_id' => $levelMap['master'],
        'sort_order' => 41,
    ],
    [
        'slug' => 'msc',
        'label' => 'Master of Science (MSc)',
        'education_level_id' => $levelMap['master'],
        'sort_order' => 42,
    ],
    [
        'slug' => 'mca',
        'label' => 'Master of Computer Applications (MCA)',
        'education_level_id' => $levelMap['master'],
        'sort_order' => 43,
    ],

    /* ================= DOCTORATE ================= */
    [
        'slug' => 'phd',
        'label' => 'PhD',
        'education_level_id' => $levelMap['doctorate'],
        'sort_order' => 60,
    ],

    /* ================= PROFESSIONAL ================= */
    [
        'slug' => 'ca',
        'label' => 'Chartered Accountant (CA)',
        'education_level_id' => $levelMap['professional'],
        'sort_order' => 70,
    ],
    [
        'slug' => 'cs',
        'label' => 'Company Secretary (CS)',
        'education_level_id' => $levelMap['professional'],
        'sort_order' => 71,
    ],
    [
        'slug' => 'cma',
        'label' => 'Cost & Management Accountant (CMA)',
        'education_level_id' => $levelMap['professional'],
        'sort_order' => 72,
    ],
]); 
    }
}
