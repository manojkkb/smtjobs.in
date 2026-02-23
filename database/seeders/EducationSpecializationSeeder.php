<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EducationDegree;
use App\Models\EducationSpecialization;
class EducationSpecializationSeeder extends MasterSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


$degreeMap = EducationDegree::pluck('id', 'slug');

$this->upsertRecords(EducationSpecialization::class, [

    /* ================= B.TECH / BE ================= */
    ['slug'=>'computer-science','label'=>'Computer Science Engineering','education_degree_id'=>$degreeMap['btech'],'sort_order'=>1],
    ['slug'=>'information-technology','label'=>'Information Technology','education_degree_id'=>$degreeMap['btech'],'sort_order'=>2],
    ['slug'=>'mechanical-engineering','label'=>'Mechanical Engineering','education_degree_id'=>$degreeMap['btech'],'sort_order'=>3],
    ['slug'=>'civil-engineering','label'=>'Civil Engineering','education_degree_id'=>$degreeMap['btech'],'sort_order'=>4],
    ['slug'=>'electronics-communication','label'=>'Electronics & Communication Engineering','education_degree_id'=>$degreeMap['btech'],'sort_order'=>5],
    ['slug'=>'electrical-engineering','label'=>'Electrical Engineering','education_degree_id'=>$degreeMap['btech'],'sort_order'=>6],
    ['slug'=>'automobile-engineering','label'=>'Automobile Engineering','education_degree_id'=>$degreeMap['btech'],'sort_order'=>7],

    /* ================= BSC ================= */
    ['slug'=>'physics','label'=>'Physics','education_degree_id'=>$degreeMap['bsc'],'sort_order'=>20],
    ['slug'=>'chemistry','label'=>'Chemistry','education_degree_id'=>$degreeMap['bsc'],'sort_order'=>21],
    ['slug'=>'mathematics','label'=>'Mathematics','education_degree_id'=>$degreeMap['bsc'],'sort_order'=>22],
    ['slug'=>'computer-science-bsc','label'=>'Computer Science','education_degree_id'=>$degreeMap['bsc'],'sort_order'=>23],

    /* ================= BCOM ================= */
    ['slug'=>'accounting','label'=>'Accounting','education_degree_id'=>$degreeMap['bcom'],'sort_order'=>30],
    ['slug'=>'finance','label'=>'Finance','education_degree_id'=>$degreeMap['bcom'],'sort_order'=>31],
    ['slug'=>'taxation','label'=>'Taxation','education_degree_id'=>$degreeMap['bcom'],'sort_order'=>32],

    /* ================= BA ================= */
    ['slug'=>'english','label'=>'English','education_degree_id'=>$degreeMap['ba'],'sort_order'=>40],
    ['slug'=>'history','label'=>'History','education_degree_id'=>$degreeMap['ba'],'sort_order'=>41],
    ['slug'=>'political-science','label'=>'Political Science','education_degree_id'=>$degreeMap['ba'],'sort_order'=>42],
    ['slug'=>'sociology','label'=>'Sociology','education_degree_id'=>$degreeMap['ba'],'sort_order'=>43],

    /* ================= BBA ================= */
    ['slug'=>'marketing','label'=>'Marketing','education_degree_id'=>$degreeMap['bba'],'sort_order'=>50],
    ['slug'=>'human-resource','label'=>'Human Resource','education_degree_id'=>$degreeMap['bba'],'sort_order'=>51],
    ['slug'=>'international-business','label'=>'International Business','education_degree_id'=>$degreeMap['bba'],'sort_order'=>52],

    /* ================= MBA ================= */
    ['slug'=>'mba-finance','label'=>'Finance','education_degree_id'=>$degreeMap['mba'],'sort_order'=>60],
    ['slug'=>'mba-marketing','label'=>'Marketing','education_degree_id'=>$degreeMap['mba'],'sort_order'=>61],
    ['slug'=>'mba-hr','label'=>'Human Resource','education_degree_id'=>$degreeMap['mba'],'sort_order'=>62],
    ['slug'=>'mba-operations','label'=>'Operations Management','education_degree_id'=>$degreeMap['mba'],'sort_order'=>63],
    ['slug'=>'mba-it','label'=>'Information Technology','education_degree_id'=>$degreeMap['mba'],'sort_order'=>64],

    /* ================= MCA ================= */
    ['slug'=>'software-development','label'=>'Software Development','education_degree_id'=>$degreeMap['mca'],'sort_order'=>70],
    ['slug'=>'data-science','label'=>'Data Science','education_degree_id'=>$degreeMap['mca'],'sort_order'=>71],
    ['slug'=>'cyber-security','label'=>'Cyber Security','education_degree_id'=>$degreeMap['mca'],'sort_order'=>72],

    /* ================= MBBS ================= */
    ['slug'=>'general-medicine','label'=>'General Medicine','education_degree_id'=>$degreeMap['mbbs'],'sort_order'=>80],
    ['slug'=>'surgery','label'=>'Surgery','education_degree_id'=>$degreeMap['mbbs'],'sort_order'=>81],

    /* ================= MTECH ================= */
    ['slug'=>'mtech-cse','label'=>'Computer Science Engineering','education_degree_id'=>$degreeMap['mtech'],'sort_order'=>90],
    ['slug'=>'mtech-mechanical','label'=>'Mechanical Engineering','education_degree_id'=>$degreeMap['mtech'],'sort_order'=>91],
    ['slug'=>'mtech-civil','label'=>'Civil Engineering','education_degree_id'=>$degreeMap['mtech'],'sort_order'=>92],

    /* ================= PHD ================= */
    ['slug'=>'phd-computer-science','label'=>'Computer Science','education_degree_id'=>$degreeMap['phd'],'sort_order'=>100],
    ['slug'=>'phd-management','label'=>'Management Studies','education_degree_id'=>$degreeMap['phd'],'sort_order'=>101],
    ['slug'=>'phd-finance','label'=>'Finance','education_degree_id'=>$degreeMap['phd'],'sort_order'=>102],

]);
    }
}
