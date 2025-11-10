<x-app-layout>
    <x-slot name="header">
        ''
    </x-slot>
    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
{{--        <x-dashboard.topbar/>--}}
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">الادارة</h1>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> تقارير</a>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        الخريجين
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $universityDataCount }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        الخريحين المسجلين
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{  $graduatesCount }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        المشرفين
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{  $supervisorsCount }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        جهات التوظيف
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{  $employeersCount }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-building fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->

            <div class="row">

                <!-- Area Chart graduates visualize -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">الخريجين حسب السنة</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                     aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="">Action</a>
                                    <a class="dropdown-item" href="">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="myAreaChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Pie Chart -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">التخصصات</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                     aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="myPieChart"></canvas>
                            </div>
                            <div class="mt-4 text-center small" id="dynamicLegend">
                                @foreach($jsonMajors as $index => $major)
                                    <span class="mr-2">
            <i class="fas fa-circle" style="color: {{ $majorColors[$index] ?? '#000' }}"></i> {{ $major }}
        </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->
            <div class="row" >

                <!-- Content Column -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="card-title mb-0">Traffic</h4>
                                <div class="small text-body-secondary">January - July 2023</div>
                            </div>
                            <!-- Dropdown Button for Year Selection -->
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="yearDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    Select Year
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
                            <div class="col">
                                <div class="text-body-secondary">عاطلين عن العمل</div>
                                <div class="fw-semibold text-truncate">29.703 Users (40%)</div>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-body-secondary">معدل التوظيف</div>
                                <div class="fw-semibold text-truncate">24.093 Users (20%)</div>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-body-secondary">معدل نمو التوظيف (العمالة)</div>
                                <div class="fw-semibold text-truncate">78.706 Views (60%)</div>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-body-secondary">معدل نمو الوظائف (فرص العمل)</div>
                                <div class="fw-semibold text-truncate">22.123 Users (80%)</div>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col d-none d-xl-block">
                                <div class="text-body-secondary">يعملون في مجال غير مجالهم</div>
                                <div class="fw-semibold text-truncate">40.15%</div>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar" role="progressbar" style="width: 40%; background-color: purple;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>



        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <x-slot name="sideBar">
        <!-- Sidebar -->
        @include('sideBar.sideBar')
        <!-- End of Sidebar -->

    </x-slot>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const majorNames = @json($jsonMajors); // Pass major names
            const percentages = @json($jsonPercentages); // Pass major percentages
            // Pass major percentages
            // Extract data from the Laravel controller

            updatePieChartData(percentages, majorNames);
        });
        {{--let jobTitles = @json($jobTitles);--}}

        let jobGraduateData = @json($jobGraduateData);
        let graduateData = @json($graduateData);
        const majorColors = @json($majorColors);



    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get the dropdown button and menu items
            const dropdownButton = document.getElementById('yearDropdown');
            const dropdownItems = document.querySelectorAll('.dropdown-item');

            // Add event listener to each dropdown item
            dropdownItems.forEach(item => {
                item.addEventListener('click', function (e) {
                  // e.preventDefault(); // Prevent default link behavior
                    const selectedYear = this.getAttribute('data-year'); // Get the selected year
                    dropdownButton.textContent = selectedYear; // Update the button text

                    // You can add additional logic here to handle the selected year
                    console.log(`Selected Year: ${selectedYear}`);
                });
            });
        });
    </script>

</x-app-layout>
```

