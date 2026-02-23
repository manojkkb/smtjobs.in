<?php

use App\Http\Controllers\Admin\ApplicationStatusController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\BenefitController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\CandidateController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\CompanySizeController;
use App\Http\Controllers\Admin\CompanyTypeController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\EmploymentTypeController;
use App\Http\Controllers\Admin\ExperienceRangeController;
use App\Http\Controllers\Admin\IndustryController;
use App\Http\Controllers\Admin\EducationLevelController;
use App\Http\Controllers\Admin\JobLevelController;
use App\Http\Controllers\Admin\JobStatusController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\NoticePeriodController;
use App\Http\Controllers\Admin\RecruiterController;
use App\Http\Controllers\Admin\SalaryRangeController;
use App\Http\Controllers\Admin\ShiftTypeController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\SubscriptionPlanController;
use App\Http\Controllers\Admin\UserStatusController;
use App\Http\Controllers\Admin\WorkModeController;
use App\Http\Controllers\CandidateProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\Recruiter\DashboardController as RecruiterDashboardController;
use App\Http\Controllers\Recruiter\JobApplicationController;
use App\Http\Controllers\Recruiter\JobPostController;
use App\Http\Controllers\Recruiter\ProfileController;
use App\Http\Controllers\UserAuth;
use App\Http\Middleware\RecruiterMiddleware;
use App\Http\Middleware\CandidateMiddleware;
Use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jobs', [JobController::class, 'index'])->name('jobs');
Route::get('/jobs/suggestions', [JobController::class, 'suggestions'])->name('jobs.suggestions');
Route::get('/job/{id}', [JobController::class, 'show'])->name('job.show');


Route::get('/login',[UserAuth::class,'showLoginForm'])->name('login');
// Send OTP
Route::post('/send-otp', [UserAuth::class, 'sendOtp'])
        ->name('login.sendOtp')
        ->middleware('throttle:5,1'); // 5 per minute

// Verify OTP
Route::post('/verify-otp', [UserAuth::class, 'verifyOtp'])
        ->name('login.verifyOtp')
        ->middleware('throttle:10,1');

Route::get('candidate-register', UserAuth::class . '@showRegistrationForm')->name('candidate.register');
Route::post('candidate-register', UserAuth::class . '@registerCandidate')->name('candidate.register.submit');


Route::post('/logout', [UserAuth::class, 'logout'])->name('logout')->middleware('auth');


// Add your web routes here admin group
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('candidates', CandidateController::class);

    Route::get('industries/sample', [IndustryController::class, 'sample'])->name('industries.sample');
    Route::post('industries/import', [IndustryController::class, 'import'])->name('industries.import');
    Route::get('industries/export', [IndustryController::class, 'export'])->name('industries.export');
    Route::resource('industries', IndustryController::class);
    Route::get('categories/sample', [CategoryController::class, 'sample'])->name('categories.sample');
    Route::post('categories/import', [CategoryController::class, 'import'])->name('categories.import');
    Route::get('categories/export', [CategoryController::class, 'export'])->name('categories.export');
    Route::resource('categories', CategoryController::class);
    Route::get('tags/sample', [TagController::class, 'sample'])->name('tags.sample');
    Route::post('tags/import', [TagController::class, 'import'])->name('tags.import');
    Route::get('tags/export', [TagController::class, 'export'])->name('tags.export');
    Route::resource('tags', TagController::class);
    Route::get('skills/sample', [SkillController::class, 'sample'])->name('skills.sample');
    Route::post('skills/import', [SkillController::class, 'import'])->name('skills.import');
    Route::get('skills/export', [SkillController::class, 'export'])->name('skills.export');
    Route::resource('skills', SkillController::class);
    Route::get('employment-types/sample', [EmploymentTypeController::class, 'sample'])->name('employment-types.sample');
    Route::post('employment-types/import', [EmploymentTypeController::class, 'import'])->name('employment-types.import');
    Route::get('employment-types/export', [EmploymentTypeController::class, 'export'])->name('employment-types.export');
    Route::resource('employment-types', EmploymentTypeController::class);
    Route::get('work-modes/sample', [WorkModeController::class, 'sample'])->name('work-modes.sample');
    Route::post('work-modes/import', [WorkModeController::class, 'import'])->name('work-modes.import');
    Route::get('work-modes/export', [WorkModeController::class, 'export'])->name('work-modes.export');
    Route::resource('work-modes', WorkModeController::class);
    Route::get('shift-types/sample', [ShiftTypeController::class, 'sample'])->name('shift-types.sample');
    Route::post('shift-types/import', [ShiftTypeController::class, 'import'])->name('shift-types.import');
    Route::get('shift-types/export', [ShiftTypeController::class, 'export'])->name('shift-types.export');
    Route::resource('shift-types', ShiftTypeController::class);
    Route::get('experience-ranges/sample', [ExperienceRangeController::class, 'sample'])->name('experience-ranges.sample');
    Route::post('experience-ranges/import', [ExperienceRangeController::class, 'import'])->name('experience-ranges.import');
    Route::get('experience-ranges/export', [ExperienceRangeController::class, 'export'])->name('experience-ranges.export');
    Route::resource('experience-ranges', ExperienceRangeController::class);
    Route::get('education-levels/sample', [EducationLevelController::class, 'sample'])->name('education-levels.sample');
    Route::post('education-levels/import', [EducationLevelController::class, 'import'])->name('education-levels.import');
    Route::get('education-levels/export', [EducationLevelController::class, 'export'])->name('education-levels.export');
    Route::resource('education-levels', EducationLevelController::class);
    Route::get('salary-ranges/sample', [SalaryRangeController::class, 'sample'])->name('salary-ranges.sample');
    Route::post('salary-ranges/import', [SalaryRangeController::class, 'import'])->name('salary-ranges.import');
    Route::get('salary-ranges/export', [SalaryRangeController::class, 'export'])->name('salary-ranges.export');
    Route::resource('salary-ranges', SalaryRangeController::class);
    Route::get('notice-periods/sample', [NoticePeriodController::class, 'sample'])->name('notice-periods.sample');
    Route::post('notice-periods/import', [NoticePeriodController::class, 'import'])->name('notice-periods.import');
    Route::get('notice-periods/export', [NoticePeriodController::class, 'export'])->name('notice-periods.export');
    Route::resource('notice-periods', NoticePeriodController::class);
    Route::get('benefits/sample', [BenefitController::class, 'sample'])->name('benefits.sample');
    Route::post('benefits/import', [BenefitController::class, 'import'])->name('benefits.import');
    Route::get('benefits/export', [BenefitController::class, 'export'])->name('benefits.export');
    Route::resource('benefits', BenefitController::class);
    Route::get('certificates/sample', [CertificateController::class, 'sample'])->name('certificates.sample');
    Route::post('certificates/import', [CertificateController::class, 'import'])->name('certificates.import');
    Route::get('certificates/export', [CertificateController::class, 'export'])->name('certificates.export');
    Route::resource('certificates', CertificateController::class);
    Route::get('company-types/sample', [CompanyTypeController::class, 'sample'])->name('company-types.sample');
    Route::post('company-types/import', [CompanyTypeController::class, 'import'])->name('company-types.import');
    Route::get('company-types/export', [CompanyTypeController::class, 'export'])->name('company-types.export');
    Route::resource('company-types', CompanyTypeController::class);
    Route::get('company-sizes/sample', [CompanySizeController::class, 'sample'])->name('company-sizes.sample');
    Route::post('company-sizes/import', [CompanySizeController::class, 'import'])->name('company-sizes.import');
    Route::get('company-sizes/export', [CompanySizeController::class, 'export'])->name('company-sizes.export');
    Route::resource('company-sizes', CompanySizeController::class);
    Route::get('departments/sample', [DepartmentController::class, 'sample'])->name('departments.sample');
    Route::post('departments/import', [DepartmentController::class, 'import'])->name('departments.import');
    Route::get('departments/export', [DepartmentController::class, 'export'])->name('departments.export');
    Route::resource('departments', DepartmentController::class);
    Route::get('countries/sample', [CountryController::class, 'sample'])->name('countries.sample');
    Route::post('countries/import', [CountryController::class, 'import'])->name('countries.import');
    Route::get('countries/export', [CountryController::class, 'export'])->name('countries.export');
    Route::resource('countries', CountryController::class);
    Route::get('states/sample', [StateController::class, 'sample'])->name('states.sample');
    Route::post('states/import', [StateController::class, 'import'])->name('states.import');
    Route::get('states/export', [StateController::class, 'export'])->name('states.export');
    Route::resource('states', StateController::class);
    Route::get('cities/sample', [CityController::class, 'sample'])->name('cities.sample');
    Route::post('cities/import', [CityController::class, 'import'])->name('cities.import');
    Route::get('cities/export', [CityController::class, 'export'])->name('cities.export');
    Route::resource('cities', CityController::class);
    Route::get('areas/sample', [AreaController::class, 'sample'])->name('areas.sample');
    Route::post('areas/import', [AreaController::class, 'import'])->name('areas.import');
    Route::get('areas/export', [AreaController::class, 'export'])->name('areas.export');
    Route::resource('areas', AreaController::class);
    Route::get('languages/sample', [LanguageController::class, 'sample'])->name('languages.sample');
    Route::post('languages/import', [LanguageController::class, 'import'])->name('languages.import');
    Route::get('languages/export', [LanguageController::class, 'export'])->name('languages.export');
    Route::resource('languages', LanguageController::class);
    Route::get('user-statuses/sample', [UserStatusController::class, 'sample'])->name('user-statuses.sample');
    Route::post('user-statuses/import', [UserStatusController::class, 'import'])->name('user-statuses.import');
    Route::get('user-statuses/export', [UserStatusController::class, 'export'])->name('user-statuses.export');
    Route::resource('user-statuses', UserStatusController::class);
    Route::get('job-statuses/sample', [JobStatusController::class, 'sample'])->name('job-statuses.sample');
    Route::post('job-statuses/import', [JobStatusController::class, 'import'])->name('job-statuses.import');
    Route::get('job-statuses/export', [JobStatusController::class, 'export'])->name('job-statuses.export');
    Route::resource('job-statuses', JobStatusController::class);
    Route::get('job-levels/sample', [JobLevelController::class, 'sample'])->name('job-levels.sample');
    Route::post('job-levels/import', [JobLevelController::class, 'import'])->name('job-levels.import');
    Route::get('job-levels/export', [JobLevelController::class, 'export'])->name('job-levels.export');
    Route::resource('job-levels', JobLevelController::class);
    Route::get('application-statuses/sample', [ApplicationStatusController::class, 'sample'])->name('application-statuses.sample');
    Route::post('application-statuses/import', [ApplicationStatusController::class, 'import'])->name('application-statuses.import');
    Route::get('application-statuses/export', [ApplicationStatusController::class, 'export'])->name('application-statuses.export');
    Route::resource('application-statuses', ApplicationStatusController::class);
    Route::resource('companies', CompanyController::class);  
    Route::resource('candidates', CandidateController::class); 
    Route::resource('recruiters', RecruiterController::class);
    Route::resource('subscription-plans', SubscriptionPlanController::class);


});

Route::prefix('recruiter')->name('recruiter.')->middleware(['auth'])->group(function () {

    Route::get('complete-profile', [ProfileController::class, 'completeProfile'])->name('complete.profile');
    Route::post('complete-profile/personal', [ProfileController::class, 'submitPersonalInfo'])->name('complete.profile.personal');
    Route::post('complete-profile/details', [ProfileController::class, 'submitRecruiterDetails'])->name('complete.profile.details');
        
    //  check recruiter profile completion in middleware and redirect to profile completion if not completed
    Route::middleware([RecruiterMiddleware::class])->group(function () {
    
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
        Route::get('/dashboard',[RecruiterDashboardController::class,'index'])->name('dashboard');
        Route::resource('job-posts', JobPostController::class);
        Route::get('/job-applications', [JobApplicationController::class, 'index'])->name('job-applications');

    });

    

}); 

Route::prefix('candidate')->name('candidate.')->middleware(['auth'])->group(function () {

     Route::get('complete-profile', [CandidateProfileController::class, 'completeProfile'])->name('complete.profile');
     Route::post('complete-profile/basic', [CandidateProfileController::class, 'storeBasicDetails'])->name('complete.profile.basic');
     Route::post('complete-profile/location', [CandidateProfileController::class, 'storeLocation'])->name('complete.profile.location');
     Route::post('complete-profile/experience', [CandidateProfileController::class, 'storeExperience'])->name('complete.profile.experience');
     Route::post('complete-profile/education', [CandidateProfileController::class, 'storeEducation'])->name('complete.profile.education');
     Route::post('complete-profile/resume', [CandidateProfileController::class, 'storeResume'])->name('complete.profile.resume');
     Route::post('complete-profile/submit', [CandidateProfileController::class, 'completeProfileSubmit'])->name('complete.profile.submit');
     
      Route::middleware([CandidateMiddleware::class])->group(function () {
            
            Route::get('/profile', [CandidateProfileController::class, 'show'])->name('profile');
            
            // Education CRUD
            Route::post('/education', [CandidateProfileController::class, 'storeEducationItem'])->name('education.store');
            Route::post('/education/{id}', [CandidateProfileController::class, 'updateEducationItem'])->name('education.update');
            Route::delete('/education/{id}', [CandidateProfileController::class, 'deleteEducationItem'])->name('education.delete');
            
            // Education cascading dropdowns
            Route::get('/education-degrees/{levelId}', [CandidateProfileController::class, 'getEducationDegrees'])->name('education.degrees');
            Route::get('/education-specializations/{degreeId}', [CandidateProfileController::class, 'getEducationSpecializations'])->name('education.specializations');
            
            // Experience CRUD
            Route::post('/experience', [CandidateProfileController::class, 'storeExperienceItem'])->name('experience.store');
            Route::post('/experience/{id}', [CandidateProfileController::class, 'updateExperienceItem'])->name('experience.update');
            Route::delete('/experience/{id}', [CandidateProfileController::class, 'deleteExperienceItem'])->name('experience.delete');
            
            // Skill CRUD
            Route::post('/skill', [CandidateProfileController::class, 'storeSkillItem'])->name('skill.store');
            Route::post('/skill/{id}', [CandidateProfileController::class, 'updateSkillItem'])->name('skill.update');
            Route::delete('/skill/{id}', [CandidateProfileController::class, 'deleteSkillItem'])->name('skill.delete');
            
            // Language CRUD
            Route::post('/language', [CandidateProfileController::class, 'storeLanguageItem'])->name('language.store');
            Route::post('/language/{id}', [CandidateProfileController::class, 'updateLanguageItem'])->name('language.update');
            Route::delete('/language/{id}', [CandidateProfileController::class, 'deleteLanguageItem'])->name('language.delete');
            
            // Certification CRUD
            Route::post('/certification', [CandidateProfileController::class, 'storeCertificationItem'])->name('certification.store');
            Route::post('/certification/{id}', [CandidateProfileController::class, 'updateCertificationItem'])->name('certification.update');
            Route::delete('/certification/{id}', [CandidateProfileController::class, 'deleteCertificationItem'])->name('certification.delete');
            
            // Profile Update
            Route::post('/profile/update', [CandidateProfileController::class, 'updateBasicProfile'])->name('profile.update');
            Route::post('/profile/upload-photo', [CandidateProfileController::class, 'uploadProfilePhoto'])->name('profile.upload-photo');
            
      });
    
});


