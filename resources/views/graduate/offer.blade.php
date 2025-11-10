@extends('layouts.app')

@section('content')
<div class="container ">

    <!-- Header with gradient background -->
    <div class="card border-0 overflow-hidden mb-5">

        <div class="card-header bg-gradient-primary text-white py-4 position-relative">
            <div class="position-absolute top-0 end-0 bg-white opacity-10 w-100 h-100"></div>
            <div class="d-flex justify-content-between align-items-center position-relative">
                <div class="mb-4">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-primary hover-lift rounded-pill">
                        <i class="fas fa-arrow-right me-2"></i> العودة
                    </a>
                </div>
                <div>
                    <h1 class="fw-bold mb-2 display-6">{{ $offer->job_title }}</h1>
                    <div class="d-flex flex-wrap gap-2 align-items-center">
                        <span class="badge bg-white text-dark fs-6 rounded-pill px-3 py-2 shadow-sm">
                            <i class="fas fa-briefcase me-1"></i> {{ $offer->job_type }}
                        </span>
                        @if($offer->is_active)
                            <span class="badge bg-success bg-opacity-90 text-white fs-6 rounded-pill px-3 py-2 shadow-sm pulse-animation">
                                <i class="fas fa-circle me-1 small"></i> نشط
                            </span>
                        @else
                            <span class="badge bg-danger bg-opacity-90 text-white fs-6 rounded-pill px-3 py-2 shadow-sm">
                                <i class="fas fa-circle me-1 small"></i> غير نشط
                            </span>
                        @endif
                    </div>
                </div>
                <div class="d-none d-md-block">
                    @if($offer->company_logo)
                        <img src="{{ asset($offer->company_logo) }}" alt="Company Logo" class="rounded-3 shadow" style="height: 80px;">
                    @endif
                </div>
            </div>
        </div>

        <!-- Card Body with modern layout -->
        <div class="card-body bg-white p-4 p-md-5">
            <!-- Salary Highlight -->
            <div class="alert alert-success bg-gradient-light-success border-0 rounded-4 mb-4">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h5 class="fw-bold mb-1">الراتب المقدم:</h5>
                        @if($offer->salary_type === 'fixed' && $offer->fixed_salary)
                            <p class="mb-0 fs-4 fw-bold">{{ $offer->fixed_salary }} {{ $offer->fixed_salary_currency }} / {{ $offer->fixed_salary_period }}</p>
                        @elseif($offer->salary_type === 'range')
                            <p class="mb-0 fs-4 fw-bold">من {{ $offer->salary_min }} إلى {{ $offer->salary_max }} {{ $offer->salary_range_currency }} / {{ $offer->salary_range_period }}</p>
                        @else
                            <p class="mb-0 fs-4 fw-bold">غير محدد</p>
                        @endif
                    </div>
                    <div class="ms-3">
                        <i class="fas fa-coins fa-3x text-success opacity-25"></i>
                    </div>
                </div>
            </div>

            <!-- Job Details Grid -->
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded-3 h-100">
                        <h6 class="fw-bold text-primary mb-3"><i class="fas fa-info-circle ms-2"></i>تفاصيل الوظيفة</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2 d-flex">
                                <span class="text-muted flex-shrink-0" style="width: 120px;"><i class="fas fa-map-marker-alt ms-2"></i>الموقع:</span>
                                <span class="fw-medium">{{ $offer->location ?? 'غير محدد' }}</span>
                            </li>
                            <li class="mb-2 d-flex">
                                <span class="text-muted flex-shrink-0" style="width: 120px;"><i class="fas fa-laptop-house ms-2"></i>نوع العمل:</span>
                                <span class="fw-medium">{{ $offer->location_type }}</span>
                            </li>
                            <li class="mb-2 d-flex">
                                <span class="text-muted flex-shrink-0" style="width: 120px;"><i class="fas fa-user-tie ms-2"></i>مستوى الخبرة:</span>
                                <span class="fw-medium">{{ $offer->experience_level }}</span>
                            </li>
                            <li class="mb-2 d-flex">
                                <span class="text-muted flex-shrink-0" style="width: 120px;"><i class="fas fa-calendar-times ms-2"></i>تاريخ الانتهاء:</span>
                                <span class="fw-medium">{{ \Carbon\Carbon::parse($offer->expiration_date)->format('Y-m-d') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded-3 h-100">
                        <h6 class="fw-bold text-primary mb-3"><i class="fas fa-tags ms-2"></i>تصنيف الوظيفة</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2 d-flex">
                                <span class="text-muted flex-shrink-0" style="width: 120px;"><i class="fas fa-layer-group ms-2"></i>التصنيف:</span>
                                <span class="fw-medium">{{ $offer->job_category }}</span>
                            </li>
                            <li class="mb-2 d-flex">
                                <span class="text-muted flex-shrink-0" style="width: 120px;"><i class="fas fa-users ms-2"></i>الشواغر:</span>
                                <span class="fw-medium">{{ $offer->vacancies }}</span>
                            </li>
                            <li class="mb-2 d-flex">
                                <span class="text-muted flex-shrink-0" style="width: 120px;"><i class="fas fa-clock ms-2"></i>نوع الدوام:</span>
                                <span class="fw-medium">{{ $offer->schedule_type ?? 'كامل' }}</span>
                            </li>
                            <li class="mb-2 d-flex">
                                <span class="text-muted flex-shrink-0" style="width: 120px;"><i class="fas fa-bolt ms-2"></i>الحالة:</span>
                                @if($offer->is_active)
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">نشط</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3">غير نشط</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Job Description Section -->
            <div class="mb-4">
                <h4 class="fw-bold border-bottom pb-2 mb-3"><i class="fas fa-align-left text-primary ms-2"></i>وصف الوظيفة</h4>
                <div class="ps-3">
                    <p class="lead">{{ $offer->job_description }}</p>
                </div>
            </div>

            <!-- Qualifications Section -->
            @if($offer->qualifications)
            <div class="mb-4">
                <h4 class="fw-bold border-bottom pb-2 mb-3"><i class="fas fa-graduation-cap text-primary ms-2"></i>المؤهلات المطلوبة</h4>
                <div class="ps-3">
                    <p class="lead">{{ $offer->qualifications }}</p>
                </div>
            </div>
            @endif

            <!-- Application Instructions -->
            @if($offer->application_instructions)
            <div class="mb-4">
                <h4 class="fw-bold border-bottom pb-2 mb-3"><i class="fas fa-paper-plane text-primary ms-2"></i>طريقة التقديم</h4>
                <div class="ps-3">
                    <p class="lead">{{ $offer->application_instructions }}</p>
                </div>
            </div>
            @endif

            <!-- Additional Info -->
            @if($offer->additional_info)
            <div class="mb-4">
                <h4 class="fw-bold border-bottom pb-2 mb-3"><i class="fas fa-info-circle text-primary ms-2"></i>معلومات إضافية</h4>
                <div class="ps-3">
                    <p class="lead">{{ $offer->additional_info }}</p>
                </div>
            </div>
            @endif

            <!-- CTA Button -->

        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%);
    }
    .bg-gradient-light-success {
        background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(40, 167, 69, 0.2) 100%);
    }
    .hover-lift {
        transition: all 0.2s ease;
    }
    .hover-lift:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }
    .pulse-animation {
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.4);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(40, 167, 69, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(40, 167, 69, 0);
        }
    }
    .lead {
        font-size: 1.1rem;
        line-height: 1.7;
    }
</style>
@endpush
