
@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3f37c9;
        --accent-color: #4895ef;
        --light-color: #f8f9fa;
        --dark-color: #212529;
        --success-color: #4cc9f0;
        --warning-color: #f72585;
    }


    #wrapper {
        display: flex;
    }

    #content-wrapper {

        overflow-x: hidden;
    }


    .welcome-card {
        background: linear-gradient(135deg, #4361ee 0%, #3f37c9 100%);
        border-radius: 16px;
        color: white;
        box-shadow: 0 10px 30px rgba(67, 97, 238, 0.2);
        overflow: hidden;
        position: relative;
    }

    .welcome-card::before {
        content: "";
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
        transform: rotate(30deg);
    }

    .action-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        border: none;
        overflow: hidden;
        position: relative;
    }

    .card-icon {
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: rgba(67, 97, 238, 0.1);
        color: var(--primary-color);
        font-size: 36px;
    }


    .badge-tag {
        background-color: rgba(67, 97, 238, 0.1);
        color: var(--primary-color);
        border-radius: 20px;
        padding: 5px 12px;
        font-size: 0.8rem;
        margin-right: 8px;
    }

    .action-link {
        color: var(--primary-color);
        font-weight: 500;
        text-decoration: none;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
    }

    .action-link:hover {
        color: var(--secondary-color);
        text-decoration: none;
    }

    .action-link i {
        transition: transform 0.3s ease;
    }

    .action-link:hover i {
        transform: translateX(-5px);
    }

    .progress-container {
        position: relative;
        height: 8px;
        background-color: #e9ecef;
        border-radius: 4px;
        overflow: hidden;
        margin-top: 20px;
    }

    .progress-bar {
        height: 100%;
        background: linear-gradient(90deg, var(--primary-color) 0%, var(--accent-color) 100%);
        border-radius: 4px;
        transition: width 1s ease;
    }

    h4, h5, h6 {
        font-weight: 700;
    }

    .content-container {
        padding: 20px;
        transition: all 0.3s;
    }

    @media (max-width: 768px) {
        .sidebar {
            margin-right: -250px;
        }

        .sidebar.active {
            margin-right: 0;
        }

        .content-container {
            margin-right: 0;
        }
    }
</style>
    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid p-0" dir="rtl">

            <!-- Page Heading -->


            <!-- Content Row -->


            <!-- Earnings (Monthly) Card Example -->
            <div class="content-container" dir="rtl">
                <div class="container py-4" style="max-width: 100%;">
                    <!-- Welcome Card -->
                    <div class="welcome-card p-4 mb-4">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <h4 class="mb-3 text-white">مرحبًا بك في نظام متابعة الخريجين</h4>
                                <p class="mb-0">لضمان حصولك على أفضل الفرص، يرجى تحديث معلوماتك الشخصية والمهنية</p>
                            </div>
                            <div class="col-3 text-start">
                                <i class="fas fa-user-graduate fa-3x opacity-25"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Completion Progress -->
                    <div class="bg-white p-4 rounded-3 shadow-sm mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">اكتمال الملف الشخصي</span>
                            <span class="font-weight-bold">65%</span>
                        </div>
                        <div class="progress-container">
                            <div class="progress-bar" style="width: 65%"></div>
                        </div>
                    </div>

                    <!-- Action Cards -->
                    <div class="action-card p-4 mb-4 d-flex align-items-center">
                        <div class="card-icon ms-3">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="flex-grow-1  card-body">
                            <span class="text-muted small">المعلومات الوظيفية</span>
                            <h5 class="mb-2">بيانات وظيفتك الحالية</h5>
                            <div class="d-flex flex-wrap">
                                <span class="badge-tag">موظف</span>
                                <span class="badge-tag">باحث عن عمل</span>
                                <span class="badge-tag">عمل حر</span>
                            </div>
                        </div>
                        <a href="{{ route('job.job-form') }}" class="action-link">
                            ابدأ هنا <i class="fas fa-arrow-left ms-2"></i>
                        </a>
                    </div>

                    <div class="action-card p-4 mb-4 d-flex align-items-center">
                        <div class="card-icon ms-3">
                            <i class="fas fa-code"></i>
                        </div>
                        <div class="flex-grow-1 card-body">
                            <span class="text-muted small">التطوير المهني</span>
                            <h5 class="mb-2">المهارات والخبرات</h5>
                            <div class="d-flex flex-wrap">
                                <span class="badge-tag">برمجة</span>
                                <span class="badge-tag">تصميم</span>
                                <span class="badge-tag">لغات</span>
                            </div>
                        </div>
                        <a href="{{ route('skill.skill-form') }}" class="action-link">
                            ابدأ هنا <i class="fas fa-arrow-left ms-2"></i>
                        </a>
                    </div>

                    <div class="action-card p-4 d-flex align-items-center">
                        <div class="card-icon ms-3">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="flex-grow-1  card-body">
                            <span class="text-muted small">المسار الأكاديمي</span>
                            <h5 class="mb-2">المؤهلات التعليمية</h5>
                            <div class="d-flex flex-wrap">
                                <span class="badge-tag">بكالوريوس</span>
                                <span class="badge-tag">ماجستير</span>
                                <span class="badge-tag">دكتوراه</span>
                            </div>
                        </div>
                        <a href="{{ route('course.course-form') }}" class="action-link">
                            ابدأ هنا <i class="fas fa-arrow-left ms-2"></i>
                        </a>
                    </div>

                    <!-- Additional Resources -->
                    <div class="mt-4 pt-3">
                        <h6 class="text-muted mb-3">موارد إضافية</h6>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="bg-white p-3 rounded-3 text-center h-100">
                                    <i class="fas fa-file-alt text-primary mb-2" style="font-size: 24px;"></i>
                                    <h6 class="mb-1">السيرة الذاتية</h6>
                                    <p class="text-muted small mb-0">نموذج سيرة ذاتية جاهز</p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="bg-white p-3 rounded-3 text-center h-100">
                                    <i class="fas fa-calendar-check text-success mb-2" style="font-size: 24px;"></i>
                                    <h6 class="mb-1">الفعاليات</h6>
                                    <p class="text-muted small mb-0">فعاليات قادمة للخريجين</p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="bg-white p-3 rounded-3 text-center h-100">
                                    <i class="fas fa-bullhorn text-warning mb-2" style="font-size: 24px;"></i>
                                    <h6 class="mb-1">الوظائف</h6>
                                    <p class="text-muted small mb-0">فرص عمل متاحة</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





            <!-- Content Row -->



            <!-- Content Row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->



@endsection
