@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">بيانات الجامعة</div>
                <div class="card-body">
                    <!-- Search and Filter Form -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <input type="text" id="searchInput" class="form-control" placeholder="البحث بالاسم أو البريد الإلكتروني">
                        </div>
                        <div class="col-md-4">
                            <select id="majorFilter" class="form-select">
                                <option value="">جميع التخصصات</option>
                                @foreach($majors as $major)
                                    <option value="{{ $major }}">{{ $major }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select id="honoursFilter" class="form-select">
                                <option value="">جميع الدرجات</option>
                                <option value="1">مرتبة الشرف</option>
                                <option value="0">عادي</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button id="resetFilters" class="btn btn-secondary">إعادة تعيين</button>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table border mb-0" id="universityDataTable">
                            <thead class="fw-semibold text-nowrap">
                            <tr class="align-middle">
                                <th class="bg-body-secondary text-center">
                                    <img src="{{ asset('assets/icons/people.svg') }}" class="icon">
                                </th>
                                <th class="bg-body-secondary">الطالب</th>
                                <th class="bg-body-secondary text-center">التخصص</th>
                                <th class="bg-body-secondary text-center">رقم الهاتف الايميل</th>
                                <th class="bg-body-secondary">المعدل التراكمي</th>
                                <th class="bg-body-secondary text-center">مرتبة الشرف</th>
                                <th class="bg-body-secondary">سنة التخرج</th>
                                <th class="bg-body-secondary">الجنس</th>
                                <th class="bg-body-secondary">الاجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($universityData as $data)
                                <tr class="align-middle"
                                    data-name="{{ $data->full_name }}"
                                    data-email="{{ $data->email }}"
                                    data-major="{{ $data->major }}"
                                    data-honours="{{ $data->honours_degree }}">
                                    <td class="text-center">
                                        <div class="avatar avatar-md">
                                            <img class="avatar-img" src="{{ asset('img/undraw_profile.svg') }}" alt="user@email.com">
                                            <span class="avatar-status bg-success"></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-nowrap">{{ $data->full_name }}</div>
                                        <div class="small text-body-secondary text-nowrap">
                                            <span>{{ $data->email }}</span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        {{ $data->major }}
                                    </td>
                                    <td>
                                        <div class="text-nowrap">{{ $data->personal_email }}</div>
                                        <div class="small text-body-secondary text-nowrap">
                                            <span> {{ $data->phone }}</span>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex justify-content-between align-items-baseline">
                                            <div class="fw-semibold">{{ $data->GPA }}</div>
                                        </div>
                                        <div class="progress progress-thin" style="height:4px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ ($data->GPA/4)*100 }}%" aria-valuenow="{{ $data->GPA }}" aria-valuemin="0" aria-valuemax="4"></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if($data->honours_degree)
                                            <img width="20px" src="{{ asset('assets/icons/CilCheckCircle.svg') }}" class="icon">
                                        @else
                                            <img width="20px" src="{{ asset('assets/icons/CilXCircle.svg') }}" class="icon">
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        {{ $data->graduation_year }}
                                    </td>
                                    <td class="text-center">
                                        {{ $data->sex == 'Male' ? 'ذكر' : 'أنثى' }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('supervisor.jobs', $data->id) }}" class="btn btn-outline-success btn-sm rounded-pill">
                                            <i class="fas fa-briefcase"></i> وظائف
                                        </a>

                                        <a href="{{ route('supervisor.skils', $data->id) }}" class="btn btn-outline-warning btn-sm rounded-pill">
                                            <i class="fas fa-cogs"></i> مهارات
                                        </a>

                                        <a href="{{ route('supervisor.courses', $data->id) }}" class="btn btn-outline-info btn-sm rounded-pill">
                                            <i class="fas fa-graduation-cap"></i> تعليم
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $universityData->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.3.1/dist/js/coreui.bundle.min.js" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const majorFilter = document.getElementById('majorFilter');
        const honoursFilter = document.getElementById('honoursFilter');
        const resetFilters = document.getElementById('resetFilters');
        const tableRows = document.querySelectorAll('#universityDataTable tbody tr');

        // Function to filter rows
        function filterRows() {
            const searchText = searchInput.value.toLowerCase();
            const major = majorFilter.value;
            const honours = honoursFilter.value;

            tableRows.forEach(row => {
                const name = row.getAttribute('data-name').toLowerCase();
                const email = row.getAttribute('data-email').toLowerCase();
                const rowMajor = row.getAttribute('data-major');
                const rowHonours = row.getAttribute('data-honours');

                const matchesSearch = name.includes(searchText) || email.includes(searchText);
                const matchesMajor = major === '' || rowMajor === major;
                const matchesHonours = honours === '' || rowHonours === honours;

                if (matchesSearch && matchesMajor && matchesHonours) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Event listeners
        searchInput.addEventListener('input', filterRows);
        majorFilter.addEventListener('change', filterRows);
        honoursFilter.addEventListener('change', filterRows);
        resetFilters.addEventListener('click', () => {
            searchInput.value = '';
            majorFilter.value = '';
            honoursFilter.value = '';
            filterRows();
        });
    });
</script>
@endsection
