@extends('layouts.app')

@section('title', 'لوحة التحكم')

@section('content')


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


                    <!-- Completion Progress -->


                    <!-- Action Cards -->

                    @foreach ($activeDivisions as $division)
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-start">
                                <!-- Icon Section -->
                                <div class="bg-primary bg-opacity-10 p-3 rounded mx-4">
                                    <i class="fas fa-briefcase fa-lg text-primary"></i>
                                </div>

                                <!-- Main Content -->
                                <div class="flex-grow-1">
                                    <span class="badge bg-light text-muted mb-2">اسم القسم</span>
                                    <h4 class="mb-3">{{ $division->title }}</h4>

                                    <p class="text-muted mb-4">
                                        {{ $division->description }}
                                    </p>

                                    <div class="d-flex small text-muted">
                                        <div class="me-3">
                                            <i class="fas fa-door-open me-1"></i> {{ $division->room }}
                                        </div>
                                        <div>
                                            <i class="fas fa-user-tie me-1"></i> المشرف: {{ $division->user->name ?? 'N/A' }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Button -->
                                <div class="d-flex align-items-center ms-4">
                                    <a href="{{ route('supervisor.divisions.show-graduates', $division) }}"
                                    class="btn btn-outline-primary px-4 py-2">
                                     ابدأ هنا <i class="fas fa-arrow-left ms-2"></i>
                                 </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


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
    <!-- Create Offer Modal -->

    <!-- Create Job Offer Modal -->

@endsection
