<?php

use App\Http\Controllers\AdminNotificationController;
use App\Http\Controllers\Charts\EmploymentChartController;
use App\Http\Controllers\Charts\MajorChartController;
use App\Http\Controllers\Charts\TechnologyChartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeerController;
use App\Http\Controllers\GraduateController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\GraduateStoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\Charts\MainChartController;

use App\Http\Controllers\UniversityDataController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\UserController;



Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard',[DashboardController::class,'index'])->middleware(['auth'])->name('dashboard');
Route::get('graduate/dashboard',[DashboardController::class,'index'])->middleware(['auth'])->name('graduate.dashboard');

//supervisor
Route::get('supervisor/dashboard',[DashboardController::class,'index'])->middleware(['auth'])->name('supervisor.dashboard');

Route::get('supervisor/divisons',[DivisionController::class,'showDivisions'])->middleware(['auth'])->name('supervisor.divisons');
Route::get('supervisor/divisons/{id}/show-graduates',[DivisionController::class,'showGraduates'])->middleware(['auth'])->name('supervisor.divisions.show-graduates');
Route::get('supervisor/divisions/{division}/chat-room/{graduate}',
[DivisionController::class, 'showGraduatesChatRoom'])
->middleware(['auth'])
->name('supervisor.divisions.chat-room');
Route::post('supervisor/divisons/{division}/chat-room/{graduate}/save', [InquiryController::class, 'storeSupervisiorText'])->name('supervisor.save-inquiry');
//graduate
Route::get('graduate/dashboard',[DashboardController::class,'graduateDashboard'])->middleware(['auth'])->name('graduate.dashboard');
Route::get('graduate/info-forms',[GraduateController::class,'getInfoForms'])->middleware(['auth'])->name('graduate.info-forms');


//UniversityData
Route::get('supervisor/university-data',[UniversityDataController::class,'showUniversityData'])->middleware(['auth'])->name('supervisor.university-data');
Route::get('supervisor/university-data/jobs-info/{id}',[UniversityDataController::class,'getGraduateJobs'])->middleware(['auth'])->name('supervisor.jobs');
Route::get('supervisor/university-data/skils-info/{id}',[UniversityDataController::class,'getGraduateSkills'])->middleware(['auth'])->name('supervisor.skils');
Route::get('supervisor/university-data/courses-info/{id}',[UniversityDataController::class,'getGraduateCourses'])->middleware(['auth'])->name('supervisor.courses');
Route::get('supervisor/university-data/jobs-update/{job}/{graduate}',[UniversityDataController::class,'updateGraduateJobs'])->middleware(['auth'])->name('supervisor.updatejobs');
Route::post('supervisor/university-data/jobs-store',[UniversityDataController::class,'storeJob'])->middleware(['auth'])->name('supervisor.jobs.store');
Route::post('supervisor/university-data/jobs-update/{id}',[UniversityDataController::class,'jobUpdate'])->middleware(['auth'])->name('supervisor.jobs.update');
Route::delete('/supervisor/jobs/{job}/{graduate}', [UniversityDataController::class, 'destroyJob'])->name('supervisor.jobs.destroy');

Route::get('supervisor/university-data/skils-update/{skill}/{graduate}',[UniversityDataController::class,'updateGraduateSkill'])->middleware(['auth'])->name('supervisor.updateskills');
Route::post('supervisor/university-data/skils-store',[UniversityDataController::class,'storeSkill'])->middleware(['auth'])->name('supervisor.skills.store');
Route::post('supervisor/university-data/skils-update/{id}',[UniversityDataController::class,'skillUpdate'])->middleware(['auth'])->name('supervisor.skills.update');
Route::delete('/supervisor/skils/{skill}/{graduate}', [UniversityDataController::class, 'destroySkill'])->name('supervisor.skills.destroy');

// Courses for Graduates

Route::post('/courses/store', [UniversityDataController::class, 'storeCourse'])->name('supervisor.courses.store');
Route::post('/courses/update/{id}', [UniversityDataController::class, 'courseUpdate'])->name('supervisor.courses.update');
Route::delete('/courses/destroy/{course}/{graduate}', [UniversityDataController::class, 'destroyCourse'])->name('supervisor.courses.destroy');
Route::get('/courses/edit/{course}/{graduate}', [UniversityDataController::class, 'updateGraduateCourse'])->name('supervisor.updatecourses');

//jobs



Route::get('graduate/info-forms/job-form',[JobController::class,'getJobForm'])->middleware(['auth'])->name('job.job-form');
Route::get('graduate/info-forms/job-form/{id}',[JobController::class,'updateJobForm'])->middleware(['auth'])->name('job.updateJobForm');
Route::post('graduate/info-forms/job-form/{id}',[JobController::class,'update'])->middleware(['auth'])->name('job.update');
Route::post('graduate/info-forms/job-form',[JobController::class,'store'])->middleware(['auth'])->name('job.store');
Route::delete('graduate/info-forms/job-form/{id}',[JobController::class,'destroy'])->middleware(['auth'])->name('job.delete');

//skills
Route::get('graduate/info-forms/skill-form',[SkillController::class,'getSkillForm'])->middleware(['auth'])->name('skill.skill-form');
Route::get('graduate/info-forms/skill-form/{id}',[SkillController::class,'updateSkillForm'])->middleware(['auth'])->name('skill.updateSkillForm');
Route::post('graduate/info-forms/skill-form/{id}',[SkillController::class,'update'])->middleware(['auth'])->name('skill.update');
Route::post('graduate/info-forms/skill-form',[SkillController::class,'store'])->middleware(['auth'])->name('skill.store');
Route::delete('graduate/info-forms/skill-form/{id}',[SkillController::class,'destroy'])->middleware(['auth'])->name('skill.delete');


//courses
Route::get('graduate/info-forms/course-form',[CourseController::class,'getCourseForm'])->middleware(['auth'])->name('course.course-form');
Route::post('graduate/info-forms/course-form/{id}',[CourseController::class,'update'])->middleware(['auth'])->name('course.update');
Route::delete('graduate/info-forms/course-form/{id}',[CourseController::class,'destroy'])->middleware(['auth'])->name('course.delete');
Route::post('graduate/info-forms/course-form',[CourseController::class,'store'])->middleware(['auth'])->name('course.store');
Route::get('graduate/info-forms/course-form/{id}',[CourseController::class,'updateCourseForm'])->middleware(['auth'])->name('course.updateCourseForm');

//job-offers

Route::get('graduate/offers/',[OfferController::class,'showOffers'])->middleware(['auth'])->name('offers.show-offers');
Route::get('graduate/offers/{id}',[OfferController::class,'showOffer'])->middleware(['auth'])->name('offers.show-offer');


//storys


Route::get('graduate/stories', [GraduateStoryController::class, 'getAllStorys'])->name('story.getAllStorys');
Route::get('graduate/add-stories', [GraduateStoryController::class, 'addStory'])->name('story.create');
Route::get('graduate/add-stories/{id}', [GraduateStoryController::class, 'editStory'])->name('story.edit');
Route::post('graduate/stories', [GraduateStoryController::class, 'store'])->name('story.store');
Route::post('graduate/update/{id}', [GraduateStoryController::class, 'update'])->name('story.update');


//chat


Route::get('graduate/chats', [DivisionController::class, 'showChats'])->name('division.chats');
Route::get('graduate/chatRoom/{id}', [DivisionController::class, 'showChat'])->name('division.chat-room');
Route::post('graduate/chatRoom/{id}', [InquiryController::class, 'store'])->name('save.inquiry');



// Route for the chart data
Route::get('/chart-data', [MainChartController::class, 'getChartData']);
// Route to fetch distinct years
Route::get('/years', [MainChartController::class, 'getYears']);


Route::get('/graduate',[GraduateController::class,'index'])->name('graduate.index');
Route::get('/graduate/info/{id}',[GraduateController::class,'showGraduateInfo'])->name('graduate.info');
Route::get('/employer',[EmployeerController::class,'index'])->name('employer.index');
Route::get('/employer/info/{id}',[EmployeerController::class,'showEmployerInfo'])->name('employer.info');
Route::patch('/supervisor', [SupervisorController::class, 'updateStatus'])->name('supervisor.updateStatus');
Route::get('/supervisor',[SupervisorController::class,'index'])->name('supervisor.index');
Route::get('/graduate/{id}',[GraduateController::class,'show'])->name('graduate.show');

// Profile


Route::get('/chart',function()
{
    return view('chart');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','admin'])->group(function () {
    Route::get('/admin/notifications', [AdminNotificationController::class, 'index'])->name('admin.notifications.index');
        Route::get('/admin/notifications/{notification}', [AdminNotificationController::class, 'show'])->name('admin.notifications.show');
    Route::post('/admin/notifications/mark-all-read', [AdminNotificationController::class, 'markAllAsRead'])->name('admin.notifications.markAllAsRead');

    // Approve or reject an employer
    Route::post('/admin/notifications/{notification}/approve', [AdminNotificationController::class, 'approve'])->name('admin.notifications.approve');
    Route::post('/admin/notifications/{notification}/reject', [AdminNotificationController::class, 'reject'])->name('admin.notifications.reject');

});



Route::prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/', [ProfileController::class, 'update'])->name('profile.update');
});
// routes/web.php
Route::prefix('charts')->group(function () {
    Route::get('majors', [MajorChartController::class, 'getMajorsData']);
    Route::get('majors/export', [MajorChartController::class, 'exportMajorsData'])
        ->name('charts.majors.export');
    Route::get('technologies', [TechnologyChartController::class, 'getTechnologiesData']);
    Route::get('technologies/export', [TechnologyChartController::class, 'exportTechnologiesData'])
        ->name('charts.technologies.export');
});

Route::get('/employment-stats', [EmploymentChartController::class, 'getEmploymentStatistics']);
Route::get('/setting',function(){return view('setting');})->name('setting');

//division
Route::get('/divisions',[DivisionController::class,'index'])->name('divisions.index');
Route::get('/divistion/show/{id}',[DivisionController::class,'show'])->name('divisions.show');
Route::post('/divistion/store',[DivisionController::class,'store'])->name('divisions.store');
Route::get('/divistion/create',[DivisionController::class,'create'])->name('divisions.create');
Route::get('/divistion/edit/{id}',[DivisionController::class,'edit'])->name('divisions.edit');
Route::post('/divistion/update/{id}', [DivisionController::class, 'update'])->name('divisions.update');
Route::post('/divisions/toggle-status/{id}', [DivisionController::class, 'toggleStatus'])->name('divisions.toggleStatus');




// إدارة العروض
Route::prefix('offers')->group(function () {
    Route::get('/dashboard', [OfferController::class, 'dashboard'])->name('employerDashboard');
    Route::get('/', [OfferController::class, 'index'])->name('offers.index');
    Route::get('/create', [OfferController::class, 'create'])->name('offers.create');
    Route::get('/{offer}/edit', [OfferController::class, 'edit'])->name('offers.edit');
    Route::post('/', [OfferController::class, 'store'])->name('offers.store');
    Route::get('/{offer}', [OfferController::class, 'show'])->name('offers.show');
    Route::post('/{offer}', [OfferController::class, 'update'])->name('offers.update');
    Route::delete('/{offer}', [OfferController::class, 'destroy'])->name('offers.destroy');
    Route::POST('/{offer}/status', [OfferController::class, 'toggleStatus'])->name('offers.status');});
require __DIR__.'/auth.php';
