@extends('layouts.app', ['title' => 'لوحة التحكم'])
@section('content')
 <style>


        .offer-container {
            max-width: 1200px;
            margin: 2rem auto;
            background: white;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }

        .section-header {
            border-right: 4px solid var(--primary-color);
            padding-right: 1rem;
            margin-bottom: 1.5rem;
        }

        .offer-section {
            background-color: #f8f9fc;
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid #e9ecef;
        }

        .badge-custom {
            font-size: 0.9rem;
            padding: 0.5rem 0.75rem;
        }

        .salary-display {
            background-color: #e8f4fd;
            padding: 1rem;
            border-radius: 0.5rem;
            border-left: 4px solid var(--secondary-color);
        }

        .status-badge {
            font-size: 1rem;
            padding: 0.5rem 1rem;
        }

        .skill-badge {
            background-color: #e9ecef;
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            margin: 0.25rem;
        }
    </style>

<div class="container py-4">
    <div class="offer-container p-4">
        <header class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h2 text-primary fw-bold mb-1">
                    <i class="fas fa-file-contract ms-2"></i>{{ $offer->job_title }}
                </h1>
                <div class="d-flex align-items-center gap-3">
                    <span class="badge bg-primary badge-custom">
                        <i class="fas fa-briefcase ms-1"></i> {{ $offer->job_category }}
                    </span>
                    <span class="badge bg-secondary badge-custom">
                        <i class="fas fa-clock ms-1"></i> {{ $offer->job_type }}
                    </span>
                    <span class="badge {{ $offer->is_active ? 'bg-success' : 'bg-danger' }} status-badge">
                        {{ $offer->is_active ? 'نشط' : 'غير نشط' }}
                    </span>
                </div>
            </div>
            <div>
                <a href="{{ route('offers.edit', $offer->id) }}" class="btn btn-primary ms-2">
                    <i class="fas fa-edit ms-1"></i> تعديل
                </a>
                <a href="{{ route('employerDashboard') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left ms-1"></i> العودة
                </a>
            </div>
        </header>

        <!-- Basic Information Section -->
        <div class="offer-section">
            <div class="section-header">
                <h3 class="h4 text-primary fw-semibold">
                    <i class="fas fa-info-circle ms-3"></i>المعلومات الأساسية
                </h3>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <p class="fw-bold mb-1">وصف الوظيفة:</p>
                    <p class="text-muted">{{ $offer->job_description }}</p>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <p class="fw-bold mb-1">مستوى الخبرة:</p>
                            <p class="text-muted">{{ $offer->experience_level }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <p class="fw-bold mb-1">تاريخ الانتهاء:</p>
                            <p class="text-muted">{{ $offer->expiration_date }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <p class="fw-bold mb-1">عدد الشواغر:</p>
                            <p class="text-muted">{{ $offer->vacancies }}</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <p class="fw-bold mb-1">نوع الموقع:</p>
                            <p class="text-muted">
                                @if($offer->location_type == 'remote')
                                    <i class="fas fa-laptop-house text-success ms-1"></i> عن بُعد
                                @elseif($offer->location_type == 'hybrid')
                                    <i class="fas fa-random text-warning ms-1"></i> هجين
                                @else
                                    <i class="fas fa-building text-primary ms-1"></i> حضور
                                @endif
                            </p>
                        </div>

                        @if($offer->location)
                            <div class="col-12 mb-3">
                                <p class="fw-bold mb-1">الموقع الجغرافي:</p>
                                <p class="text-muted">
                                    <i class="fas fa-map-marker-alt text-danger ms-1"></i> {{ $offer->location }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Salary Information Section -->
        <div class="offer-section">
            <div class="section-header">
                <h3 class="h4 text-primary fw-semibold">
                    <i class="fas fa-money-bill-wave ms-2"></i>تفاصيل الراتب
                </h3>
            </div>

            <div class="salary-display">
                @if($offer->salary_type == 'fixed')
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-money-check-alt fa-2x text-success"></i>
                        <div>
                            <h5 class="mb-1">راتب ثابت</h5>
                            <p class="mb-0 h4 fw-bold">
                                {{ number_format($offer->fixed_salary) }} {{ $offer->fixed_salary_currency }}
                                <span class="text-muted fs-6">/ {{ $offer->fixed_salary_period }}</span>
                            </p>
                        </div>
                    </div>
                @else
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-money-bill-trend-up fa-2x text-primary"></i>
                        <div>
                            <h5 class="mb-1">نطاق رواتب</h5>
                            <p class="mb-0 h4 fw-bold">
                                {{ number_format($offer->salary_min) }} - {{ number_format($offer->salary_max) }} {{ $offer->salary_range_currency }}
                                <span class="text-muted fs-6">/ {{ $offer->salary_range_period }}</span>
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Requirements Section -->
        <div class="offer-section">
            <div class="section-header">
                <h3 class="h4 text-primary fw-semibold">
                    <i class="fas fa-tasks ms-2"></i>متطلبات الوظيفة
                </h3>
            </div>

            <div class="row">
                @if($offer->qualifications)
                    <div class="col-md-6 mb-4">
                        <p class="fw-bold mb-2">المؤهلات العلمية:</p>
                        <p class="text-muted">{{ $offer->qualifications }}</p>
                    </div>
                @endif


            </div>
        </div>

        <!-- Additional Information Section -->
        <div class="offer-section">
            <div class="section-header">
                <h3 class="h4 text-primary fw-semibold">
                    <i class="fas fa-info-circle ms-2"></i>معلومات إضافية
                </h3>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <p class="fw-bold mb-2">تعليمات التقديم:</p>
                    <p class="text-muted">{{ $offer->application_instructions }}</p>
                </div>

                @if($offer->additional_info)
                    <div class="col-md-6 mb-4">
                        <p class="fw-bold mb-2">معلومات إضافية:</p>
                        <p class="text-muted">{{ $offer->additional_info }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Offer Meta -->
        <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
            <div class="text-muted small">
                <i class="fas fa-calendar-alt ms-1"></i>
                تم الإنشاء في: {{ $offer->created_at->format('Y/m/d') }} |
                آخر تحديث: {{ $offer->updated_at->format('Y/m/d') }}
            </div>
            <div>
                <a href="{{ route('offers.edit', $offer->id) }}" class="btn btn-primary ms-2">
                    <i class="fas fa-edit ms-1"></i> تعديل العرض
                </a>
                <form action="{{ route('offers.destroy', $offer->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('هل أنت متأكد من حذف هذا العرض؟')">
                        <i class="fas fa-trash-alt ms-1"></i> حذف
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
