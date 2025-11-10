@extends('layouts.app', ['title' => 'لوحة التحكم'])
@section('style')

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{asset("css/offer.css")}}">
@endsection
@section('content')



    <div class="container-fluid py-4">
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <h1 class="h3 mb-0 text-gray-800">
                    <i class="fas fa-briefcase text-primary me-2"></i> إدارة العروض الوظيفية
                </h1>
                <a href="{{route("offers.create")}}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> إنشاء عرض جديد
                </a>
            </div>
        </div>
        <div class="row">
            <!-- Total Job Offers Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-end-3 border-end-info shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-xs font-weight-bold text-info text-uppercase mb-1">إجمالي العروض الوظيفية</h6>
                                <h3 class="mb-0 font-weight-bold text-gray-800" id="totalJobOffers">{{$offers->count()}}</h3>
                                <div class="mt-2">
                            <span class="badge bg-info-light text-info">
                                <i class="fas fa-arrow-up me-1"></i> جميع العروض التى تم نشرها
                            </span>
                                </div>
                            </div>
                            <div class="icon-shape icon-lg bg-info-light text-info rounded-3">
                                <i class="fas fa-briefcase"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Active Job Offers Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-end-3 border-end-danger shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-xs font-weight-bold text-danger text-uppercase mb-1"> العروض المنتهية </h6>
                                <h3 class="mb-0 font-weight-bold text-gray-800" id="activeJobOffers">{{ $offers->count() - $activeOffers }}</h3>
                                <div class="mt-2">
                            <span class="badge bg-danger-light text-danger">
                                <i class="fas fa-arrow-down me-1"></i> جميع العروض المنتهية
                            </span>
                                </div>
                            </div>
                            <div class="icon-shape icon-lg bg-danger-light text-danger rounded-3">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Applications Received Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-end-3 border-end-success shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-xs font-weight-bold text-success text-uppercase mb-1">العروض الفعالة </h6>
                                <h3 class="mb-0 font-weight-bold text-gray-800" id="applicationsReceived">{{ $activeOffers }}</h3>
                                <div class="mt-2">
                            <span class="badge bg-success-light text-success">
                                <i class="fas fa-arrow-up me-1"></i> جميع العروض الفعالة
                            </span>
                                </div>
                            </div>
                            <div class="icon-shape icon-lg bg-success-light text-success rounded-3">
                                <i class="fas fa-file-alt"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Filled Positions Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-end-3 border-end-warning shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-xs font-weight-bold text-warning text-uppercase mb-1">جميع العروض  </h6>
                                <h3 class="mb-0 font-weight-bold text-gray-800" id="filledPositions">{{ $totalOffers }}</h3>
                                <div class="mt-2">
                            <span class="badge bg-warning-light text-warning">
                                <i class="fas fa-arrow-up me-1"></i> جميع العروض في النظام
                            </span>
                                </div>
                            </div>
                            <div class="icon-shape icon-lg bg-warning-light text-warning rounded-3">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs mb-4" id="offersTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab">
                    جميع العروض
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="active-tab" data-bs-toggle="tab" data-bs-target="#active" type="button" role="tab">
                    نشطة
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="expired-tab" data-bs-toggle="tab" data-bs-target="#expired" type="button" role="tab">
                    منتهية
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="inactive-tab" data-bs-toggle="tab" data-bs-target="#inactive" type="button" role="tab">
                    متوقفة
                </button>
            </li>
        </ul>

        <!-- Tabs Content -->
        <div class="tab-content" id="offersTabContent">
            <!-- All Offers Tab -->
            <div class="tab-pane fade show active" id="all" role="tabpanel">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">جميع العروض الوظيفية</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-file-export me-1"></i> تصدير البيانات</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-print me-1"></i> طباعة</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body" dir="ltr">
                        <div class="table-responsive">
                            <table class="table table-hover" id="allOffersTable" style="width:100%" dir="rtl">
                                <thead>
                                    <tr>
                                        <th style="text-align: start; padding-right:23px">المسمى الوظيفي</th>
                                        <th style="text-align: start; padding-right:23px">التصنيف</th>
                                        <th style="text-align: start; padding-right:23px">النوع</th>
                                        <th style="text-align: start; padding-right:23px">تاريخ النشر</th>
                                        <th style="text-align: start; padding-right:23px">الانتهاء</th>
                                        <th style="text-align: start; padding-right:23px">الحالة</th>
                                        <th style="text-align: start; padding-right:23px">طلبات</th>
                                        <th style="text-align: start; padding-right:23px">إجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($offers as $offer)
                                        <tr>
                                            <td>
                                                <a href="{{ route('offers.show', $offer->id) }}">{{ $offer->job_title }}</a>
                                                <div class="text-muted small">{{ $offer->location }}</div>
                                            </td>
                                            <td>{{ $offer->job_category }}</td>
                                            <td>{{ $offer->job_type }}</td>
                                            <td>{{ \Carbon\Carbon::parse($offer->created_at) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($offer->expiration_date) }}</td>

                                            {{-- الحالة --}}
                                            <td>
                                                @if($offer->is_active)
                                                    <span class="badge bg-success">نشط</span>
                                                @elseif(!$offer->is_active && \Carbon\Carbon::now()->gt($offer->expiration_date))
                                                    <span class="badge bg-danger">منتهي</span>
                                                @else
                                                    <span class="badge bg-secondary">متوقف</span>
                                                @endif
                                            </td>

                                            {{-- عدد الطلبات (افتراضياً placeholder) --}}
                                            <td>
                                                <span class="badge bg-primary">{{ $offer->applications_count ?? '0' }} طلب</span>
                                            </td>

                                            {{-- الإجراءات --}}
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group" dir="ltr">
                                                    <a href="{{ route('offers.show', $offer->id) }}" class="btn btn-info" title="عرض">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('offers.edit', $offer->id) }}" class="btn btn-primary" title="تعديل">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    @if($offer->is_active)
                                                        <form method="POST" action="{{ route('offers.status', $offer->id) }}">
                                                            @csrf
                                                            @method('POST')
                                                            <button class="btn btn-warning" title="إيقاف">
                                                                <i class="fas fa-pause"></i>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form method="POST" action="{{ route('offers.status', $offer->id) }}">
                                                            @csrf
                                                            @method('POST')
                                                            <button class="btn btn-success" title="تفعيل">
                                                                <i class="fas fa-play"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted">لا توجد عروض حالياً.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Active Offers Tab -->
            <div class="tab-pane fade" id="active" role="tabpanel">
                <div class="row">
                    @foreach($offers as $offer)
                        @if($offer->is_active)
                            <div class="col-lg-4 mb-4">
                                <div class="card offer-card h-100">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="mb-0">{{ $offer->job_title }}</h5>
                                            <span class="badge bg-success offer-status-badge">نشط</span>
                                        </div>
                                        <div class="text-muted small mt-1">
                                            <i class="fas fa-map-marker-alt me-1"></i>
                                            {{ $offer->location ?? 'عن بُعد' }}
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between">
                                                <span class="text-muted">نوع الوظيفة:</span>
                                                <strong>{{ $offer->job_type }}</strong>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span class="text-muted">تاريخ النشر:</span>
                                                <strong>{{ $offer->created_at }}</strong>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span class="text-muted">تاريخ الانتهاء:</span>
                                                <strong>{{ $offer->expiration_date }}</strong>
                                            </div>
                                        </div>



                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="#" class="btn btn-sm btn-outline-primary">
                                                {{ $offer->applications_count ?? 0 }} طلب
                                            </a>
                                            <div dir="ltr" class="btn-group">
                                                <a href="{{ route('offers.show', $offer->id) }}" class="btn btn-sm btn-outline-info" title="عرض">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('offers.edit', $offer->id) }}" class="btn btn-sm btn-outline-primary" title="تعديل">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('offers.status', $offer->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" class="btn btn-sm btn-outline-warning" title="إيقاف">
                                                        <i class="fas fa-pause"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

          <!-- Expired Offers Tab -->
<div class="tab-pane fade" id="expired" role="tabpanel">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">العروض المنتهية</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="expiredOffersTable" style="width:100%">
                    <thead class="table-light">
                        <tr>
                            <th width="20%">المسمى الوظيفي</th>
                            <th width="12%">التصنيف</th>
                            <th width="12%">النوع</th>
                            <th width="12%">تاريخ النشر</th>
                            <th width="12%">الانتهاء</th>
                            <th width="10%">الحالة</th>
                            <th width="10%">طلبات</th>
                            <th width="12%">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($offers as $offer)
                            @php
                                // Convert expiration_date to Carbon instance
                                $expirationDate = \Carbon\Carbon::parse($offer->expiration_date);
                                $isExpired = $expirationDate->isPast();
                                $isInactive = !$offer->is_active;
                            @endphp

                            @if($isExpired || $isInactive)
                                <tr>
                                    <td>
                                        <a href="{{ route('offers.show', $offer->id) }}" class="fw-bold">
                                            {{ $offer->job_title }}
                                        </a>
                                        <div class="text-muted small">
                                            <i class="fas fa-map-marker-alt me-1"></i>
                                            {{ $offer->location ?? 'عن بُعد' }}
                                        </div>
                                    </td>
                                    <td>{{ $offer->job_category }}</td>
                                    <td>{{ $offer->job_type }}</td>
                                    <td>{{ \Carbon\Carbon::parse($offer->created_at) }}</td>
                                    <td>
                                        <span class="{{ $isExpired ? 'text-danger' : 'text-muted' }}">
                                            {{ $expirationDate }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($isExpired)
                                            <span class="badge bg-danger">منتهي</span>
                                        @else
                                            <span class="badge bg-secondary">موقوف</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">
                                            {{ $offer->applications_count ?? 0 }} طلب
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('offers.show', $offer->id) }}" class="btn btn-info" title="عرض">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('offers.edit', $offer->id) }}" class="btn btn-primary" title="تعديل">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


            <!-- Inactive Offers Tab -->
            <div class="tab-pane fade" id="inactive" role="tabpanel">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">العروض المتوقفة</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" style="width:100%">
                                <thead class="table-light">
                                    <tr>
                                        <th style="text-align: start; padding-right:23px">المسمى الوظيفي</th>
                                        <th style="text-align: start; padding-right:23px">التصنيف</th>
                                        <th style="text-align: start; padding-right:23px">النوع</th>
                                        <th style="text-align: start; padding-right:23px">تاريخ النشر</th>
                                        <th style="text-align: start; padding-right:23px">الانتهاء</th>
                                        <th style="text-align: start; padding-right:23px">الحالة</th>
                                        <th style="text-align: start; padding-right:23px">طلبات</th>
                                        <th style="text-align: start; padding-right:23px">إجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($offers as $offer)
                                        @php
                                            $expirationDate = \Carbon\Carbon::parse($offer->expiration_date);
                                            $isExpired = $expirationDate->isPast();
                                            $isManuallyInactive = !$offer->is_active && !$isExpired;
                                        @endphp

                                        @if(!$offer->is_active)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('offers.show', $offer->id) }}" class="fw-bold">
                                                        {{ $offer->job_title }}
                                                    </a>
                                                    <div class="text-muted small">
                                                        <i class="fas fa-map-marker-alt me-1"></i>
                                                        {{ $offer->location ?? 'عن بُعد' }}
                                                    </div>
                                                </td>
                                                <td>{{ $offer->job_category }}</td>
                                                <td>{{ $offer->job_type }}</td>
                                                <td>{{ \Carbon\Carbon::parse($offer->created_at) }}</td>
                                                <td>
                                                    <span class="{{ $isExpired ? 'text-danger' : 'text-muted' }}">
                                                        {{ $expirationDate }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if($isExpired)
                                                        <span class="badge bg-danger">منتهي</span>
                                                    @else
                                                        <span class="badge bg-secondary">متوقف</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="badge bg-primary">
                                                        {{ $offer->applications_count ?? 0 }} طلب
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <a href="{{ route('offers.show', $offer->id) }}" class="btn btn-info" title="عرض">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('offers.edit', $offer->id) }}" class="btn btn-primary" title="تعديل">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('offers.status', $offer->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('POST')
                                                            <button type="submit" class="btn btn-success" title="تفعيل">
                                                                <i class="fas fa-play"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
{{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>--}}
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <!-- Custom JavaScript -->
    <script>
        $(document).ready(function() {
            // Initialize DataTables
            $('#allOffersTable').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/ar.json"
                },
                responsive: true
            });

            $('#expiredOffersTable').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/ar.json"
                },
                responsive: true
            });

            $('#inactiveOffersTable').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/ar.json"
                },
                responsive: true
            });

            // Switch between table and card view
            $('.view-toggle-btn').click(function() {
                $('.view-toggle-btn').toggleClass('btn-primary btn-outline-primary');
                $('#offersTableView').toggleClass('d-none');
                $('#offersCardView').toggleClass('d-none');
            });
        });
    </script>
@endsection
