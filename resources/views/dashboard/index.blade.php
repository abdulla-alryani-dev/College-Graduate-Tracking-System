@extends('layouts.app')

@section('title', 'لوحة التحكم')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-flex align-items-center justify-content-between mb-4">


        </div>

        <!-- Stats Cards Row -->
        <div class="row">
            <!-- Graduates Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-end-3 border-end-primary shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-xs font-weight-bold text-primary text-uppercase mb-1">إجمالي الخريجين</h6>
                                <h3 class="mb-0 font-weight-bold text-gray-800" id="totalGraduates">{{ $universityDataCount }}</h3>
                                <div class="mt-2">
                                <span class="badge bg-primary-light text-primary">
                                    <i class="fas fa-arrow-up me-1"></i> 12% عن العام الماضي
                                </span>
                                </div>
                            </div>
                            <div class="icon-shape icon-lg bg-primary-light text-primary rounded-3">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-top-0 pt-0">
                        <a href="#" class="text-xs text-muted d-flex align-items-center">
                            عرض التفاصيل
                            <i class="fas fa-chevron-left ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Registered Graduates Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-end-3 border-end-danger shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-xs font-weight-bold text-danger text-uppercase mb-1">الخريجين المسجلين</h6>
                                <h3 class="mb-0 font-weight-bold text-gray-800" id="registeredGraduates">{{  $graduatesCount }}</h3>
                                <div class="mt-2">
                                <span class="badge bg-danger-light text-danger">
                                    <i class="fas fa-arrow-up me-1"></i> 8% زيادة
                                </span>
                                </div>
                            </div>
                            <div class="icon-shape icon-lg bg-danger-light text-danger rounded-3">
                                <i class="fas fa-user-check"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-top-0 pt-0">
                        <a href="#" class="text-xs text-muted d-flex align-items-center">
                            عرض التفاصيل
                            <i class="fas fa-chevron-left ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Supervisors Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-end-3 border-end-success shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-xs font-weight-bold text-success text-uppercase mb-1">المشرفين</h6>


                                <h3 class="mb-0 font-weight-bold text-gray-800" id="supervisorsCount">{{  $supervisorsCount }}</h3>
                                <div class="mt-2">
                                <span class="badge bg-success-light text-success">
                                    <i class="fas fa-arrow-up me-1"></i> 5% زيادة
                                </span>
                                </div>
                            </div>
                            <div class="icon-shape icon-lg bg-success-light text-success rounded-3">
                                <i class="fas fa-user-tie"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-top-0 pt-0">
                        <a href="#" class="text-xs text-muted d-flex align-items-center">
                            عرض التفاصيل
                            <i class="fas fa-chevron-left ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Employers Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-end-3 border-end-warning shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-xs font-weight-bold text-warning text-uppercase mb-1">جهات التوظيف</h6>
                                <h3 class="mb-0 font-weight-bold text-gray-800" id="employersCount">{{  $employeersCount }}</h3>
                                <div class="mt-2">
                                <span class="badge bg-warning-light text-warning">
                                    <i class="fas fa-arrow-up me-1"></i> 15% زيادة
                                </span>
                                </div>
                            </div>
                            <div class="icon-shape icon-lg bg-warning-light text-warning rounded-3">
                                <i class="fas fa-building"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-top-0 pt-0">
                        <a href="#" class="text-xs text-muted d-flex align-items-center">
                            عرض التفاصيل
                            <i class="fas fa-chevron-left ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Employment Stats Card -->


        <!-- Charts Row -->
        <div class="row">
            <!-- Employment Stats Card -->
            <div class="col-xl-8 col-lg-7 mb-4">
                <div class="card shadow mb-4 aos-init aos-animate" data-aos="fade-up">
                    <!-- Card Header -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">إحصائيات التوظيف</h6>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="employmentDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                السنة الحالية
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="employmentDropdown">
                                <li><h6 class="dropdown-header">اختر سنة</h6></li>
                                <li><a class="dropdown-item active" href="#" data-year="2023">2023</a></li>
                                <li><a class="dropdown-item" href="#" data-year="2022">2022</a></li>
                                <li><a class="dropdown-item" href="#" data-year="2021">2021</a></li>
                                <li><a class="dropdown-item" href="#" data-year="2020">2020</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="chart-container" style="height: 320px;">
                            <canvas id="employmentChart"></canvas>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <div class="row row-cols-2 g-2" >

                        </div>
                    </div>
                </div>
            </div>

            <!-- Majors Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4 aos-init aos-animate" data-aos="fade-up">
                    <!-- Card Header -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">     <h6 class="m-0 font-weight-bold text-primary">التخصصات الدراسية</h6>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-link text-muted p-0" type="button" id="pieDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="pieDropdown">
                                <li><a class="dropdown-item d-flex align-items-center" href="#" id="exportPieChart"><i class="fas fa-download me-2"></i> تصدير</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item d-flex align-items-center" href="#" id="expandPieChart"><i class="fas fa-expand me-2"></i> عرض كامل</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body pt-10">
                        <div class="chart-pie" style="height: 250px;">
                            <canvas id="majorsChart"></canvas>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <div class="row row-cols-2 g-2" id="majorsLegend">
                            <!-- Will be populated by JS -->
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="card-title mb-0">متابعة</h4>
                                <div class="small text-body-secondary">January - July 2023</div>
                            </div>
                            <!-- Dropdown Button for Year Selection -->
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="yearDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    السنة الحالية
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="yearDropdown" id="yearDropdownMenu">
                                    <!-- Years will be populated here dynamically -->
                                </ul>
                            </div>

                        </div>
                        <div class="c-chart-wrapper">
                            <canvas id="main-chart"></canvas>
                        </div>
                    </div>
                    <!-- Card Footer -->
                    <div class="card-footer">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 row-cols-xl-5 g-4 mb-2 text-center">
                            <!-- Unemployed Graduates -->
                            <div class="col">
                                <div class="text-body-secondary">عاطلين عن العمل</div>
                                <div class="fw-semibold text-truncate">
                                    {{ number_format($graduatesWithoutJobCount) }} خريج ({{ $graduatesWithoutJobPercentage }}%)
                                </div>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-danger" role="progressbar"
                                         style="width: {{ $graduatesWithoutJobPercentage }}%"
                                         aria-valuenow="{{ $graduatesWithoutJobPercentage }}"
                                         aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                            <!-- Employment Rate -->
                            <div class="col">
                                <div class="text-body-secondary">معدل التوظيف</div>
                                <div class="fw-semibold text-truncate">
                                    {{ number_format($employedGraduates) }} خريج ({{ $employmentRatePercentage }}%)
                                </div>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-success" role="progressbar"
                                         style="width: {{ $employmentRatePercentage }}%"
                                         aria-valuenow="{{ $employmentRatePercentage }}"
                                         aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                            <!-- Employment Growth -->
                            <div class="col">
                                <div class="text-body-secondary">معدل نمو التوظيف</div>
                                <div class="fw-semibold text-truncate">
                                    @if($employmentGrowthPercentage >= 0)
                                        <span class="text-success">↑ {{ $employmentGrowthPercentage }}%</span>
                                    @else
                                        <span class="text-danger">↓ {{ abs($employmentGrowthPercentage) }}%</span>
                                    @endif
                                </div>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-primary" role="progressbar"
                                         style="width: {{ min(abs($employmentGrowthPercentage), 100) }}%"
                                         aria-valuenow="{{ abs($employmentGrowthPercentage) }}"
                                         aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                            <!-- Job Growth -->
                            <div class="col">
                                <div class="text-body-secondary">معدل نمو فرص العمل </div>
                                <div class="fw-semibold text-truncate">
                                    @if($jobGrowthPercentage >= 0)
                                        <span class="text-success">↑ {{ $jobGrowthPercentage }}%</span>
                                    @else
                                        <span class="text-danger">↓ {{ abs($jobGrowthPercentage) }}%</span>
                                    @endif
                                </div>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-warning" role="progressbar"
                                         style="width: {{ min(abs($jobGrowthPercentage), 100) }}%"
                                         aria-valuenow="{{ abs($jobGrowthPercentage) }}"
                                         aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                            <!-- Working Abroad -->
                            <div class="col d-none d-xl-block">
                                <div class="text-body-secondary">يعملون في المهجر</div>
                                <div class="fw-semibold text-truncate">
                                    {{ number_format($graduatesOutOfHomeCount) }} خريج ({{ $graduatesOutOfHomePercentage }}%)
                                </div>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar"
                                         style="width: {{ $graduatesOutOfHomePercentage }}%; background-color: purple;"
                                         aria-valuenow="{{ $graduatesOutOfHomePercentage }}"
                                         aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>

        <div class="row">
            <div class="col-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-0 d-flex align-items-center justify-content-between py-3">
                        <h6 class="m-0 font-weight-bold text-primary">المهارات التقنية المطلوبة في سوق العمل</h6>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="skillsYearDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                السنة الحالية
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="skillsYearDropdown">
                                <li><h6 class="dropdown-header">اختر سنة</h6></li>
                                <li><a class="dropdown-item active" href="#" data-year="2023">2023</a></li>
                                <li><a class="dropdown-item" href="#" data-year="2022">2022</a></li>
                                <li><a class="dropdown-item" href="#" data-year="2021">2021</a></li>
                                <li><a class="dropdown-item" href="#" data-year="2020">2020</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Technology Distribution</h5>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('charts.technologies.export') }}">
                                            <i class="fas fa-download me-2"></i>Export Data
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container" style="height: 400px;">
                                <canvas id="technicalSkillsChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3" id="skillsLegend">
                            <!-- Will be populated by JavaScript -->
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>




    <!-- Create Offer Modal -->

    <!-- Create Job Offer Modal -->

    @endsection

