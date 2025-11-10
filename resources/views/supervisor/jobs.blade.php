@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    @if (session('success'))
                        <div class="container mt-4">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <div class="card mb-4">

                        <!-- Add/Edit Job Form -->

                        <div class="card mb-4">

                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span>{{ isset($edit_job) ? 'تعديل الوظيفة' : '  ادراج وظيفة للخريج abdullah alryani' }}</span>
                                <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#jobFormCollapse" aria-expanded="true" aria-controls="jobFormCollapse">
                                    عرض / إخفاء النموذج
                                </button>
                            </div>
                            <div class="collapse show" id="jobFormCollapse">
                                <div class="card-body">
                                    <form
                                        action="{{ isset($edit_job) ? route('supervisor.jobs.update', $edit_job->id) : route('supervisor.jobs.store') }}"
                                        method="POST">
                                        @csrf
                                        @if (isset($edit_job))
                                            @method('POST')
                                        @endif

                                        <input type="hidden" name="graduate_id" value="{{ $graduate->id }}">

                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label for="title" class="form-label">عنوان الوظيفة</label>
                                                <input type="text" name="title" class="form-control" required
                                                    value="{{ $edit_job->title ?? '' }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="compony" class="form-label">الشركة</label>
                                                <input type="text" name="compony" class="form-control" required
                                                    value="{{ $edit_job->compony ?? '' }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="location" class="form-label">الموقع</label>
                                                <input type="text" name="location" class="form-control" required
                                                    value="{{ $edit_job->location ?? '' }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="field_of_work" class="form-label">مجال العمل</label>
                                                <input type="text" name="field_of_work" class="form-control" required
                                                    value="{{ $edit_job->field_of_work ?? '' }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="technology" class="form-label">التقنية المستخدمة</label>
                                                <input type="text" name="technology" class="form-control" required
                                                    value="{{ $edit_job->technology ?? '' }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label for="start_date" class="form-label">تاريخ البدء</label>
                                                <input type="date" name="start_date" class="form-control" required
                                                    value="{{ $edit_job->pivot->start_date ?? '' }}">
                                            </div>
                                            <div class="col-md-2">

                                                <div class="mb-3">
                                                    <label for="end_date" class="form-label">وظيفة حالية</label>
                                                    <div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="job_ended"
                                                                   id="jobEndedNo" value="no"
                                                                   {{ isset($edit_job->pivot) && is_null($edit_job->pivot->end_date) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="jobEndedNo">لا</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="job_ended"
                                                                   id="jobEndedYes" value="yes"
                                                                   {{ isset($edit_job->pivot) && !is_null($edit_job->pivot->end_date) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="jobEndedYes">نعم</label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="mt-3">
                                            <button type="submit"
                                                class="btn {{ isset($edit_job) ? 'btn-primary' : 'btn-success' }}">
                                                {{ isset($edit_job) ? 'تحديث الوظيفة' : 'إضافة الوظيفة' }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <div class="card-body">

                            <!-- Search and Filter -->
                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <input type="text" id="searchInput" class="form-control"
                                        placeholder="البحث بعنوان الوظيفة أو التقنية">
                                </div>
                                <div class="col-md-4">
                                    <select id="companyFilter" class="form-select">
                                        <option value="">جميع الشركات</option>
                                        @foreach ($jobs->pluck('compony')->unique() as $company)
                                            <option value="{{ $company }}">{{ $company }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select id="fieldFilter" class="form-select">
                                        <option value="">جميع المجالات</option>
                                        @foreach ($jobs->pluck('field_of_work')->unique() as $field)
                                            <option value="{{ $field }}">{{ $field }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Jobs Table -->
                            <div class="table-responsive">
                                <table class="table border mb-0" id="jobsTable">
                                    <thead class="fw-semibold text-nowrap">
                                        <tr class="align-middle">
                                            <th class="bg-body-secondary">العنوان</th>
                                            <th class="bg-body-secondary">الشركة</th>
                                            <th class="bg-body-secondary">الموقع</th>
                                            <th class="bg-body-secondary">مجال العمل</th>
                                            <th class="bg-body-secondary">التقنية</th>
                                            <th class="bg-body-secondary">ادخلت بواسطة موظف</th>
                                            <th class="bg-body-secondary">تاريخ البدء</th>
                                            <th class="bg-body-secondary">وظيفة حالية </th>
                                            <th class="bg-body-secondary text-center">الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($jobs as $job)
                                            <tr class="align-middle" data-title="{{ strtolower($job->title) }}"
                                                data-tech="{{ strtolower($job->technology) }}"
                                                data-company="{{ $job->compony }}"
                                                data-field="{{ $job->field_of_work }}">
                                                <td>{{ $job->title }}</td>
                                                <td>{{ $job->compony }}</td>
                                                <td>{{ $job->location }}</td>
                                                <td>{{ $job->field_of_work }}</td>
                                                <td>{{ $job->technology }}</td>
                                                <td class="text-center">
                                                    @if ($job->created_by == 1)
                                                        <img width="20px"
                                                            src="{{ asset('assets/icons/CilCheckCircle.svg') }}"
                                                            class="icon">
                                                    @else
                                                        <img width="20px"
                                                            src="{{ asset('assets/icons/CilXCircle.svg') }}"
                                                            class="icon">
                                                    @endif
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($job->pivot->start_date)->format('Y-m-d') }}
                                                </td>
                                                <td>{{ $job->pivot->end_date ? 'yes' : 'no' }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('supervisor.updatejobs', ['job' => $job->id, 'graduate' => $graduate->id]) }}"
                                                        class="btn btn-sm btn-outline-primary">تعديل</a>
                                                    <form
                                                        action="{{ route('supervisor.jobs.destroy', ['job' => $job, 'graduate' => $graduate->id]) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('هل أنت متأكد من حذف الوظيفة؟')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-outline-danger">حذف</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">لا توجد وظائف مرتبطة بهذا الخريج.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-4">
                                <a href="{{ route('supervisor.university-data') }}" class="btn btn-secondary">رجوع</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- JS for Filtering and Search -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('searchInput');
                const companyFilter = document.getElementById('companyFilter');
                const fieldFilter = document.getElementById('fieldFilter');
                const rows = document.querySelectorAll('#jobsTable tbody tr');

                function filterJobs() {
                    const search = searchInput.value.toLowerCase();
                    const company = companyFilter.value;
                    const field = fieldFilter.value;

                    rows.forEach(row => {
                        const title = row.getAttribute('data-title');
                        const tech = row.getAttribute('data-tech');
                        const jobCompany = row.getAttribute('data-company');
                        const jobField = row.getAttribute('data-field');

                        const matchesSearch = title.includes(search) || tech.includes(search);
                        const matchesCompany = !company || jobCompany === company;
                        const matchesField = !field || jobField === field;

                        if (matchesSearch && matchesCompany && matchesField) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                }

                searchInput.addEventListener('input', filterJobs);
                companyFilter.addEventListener('change', filterJobs);
                fieldFilter.addEventListener('change', filterJobs);
            });
        </script>
    @endsection
