
@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<script>
    $(document).ready(function() {
        const titles = @json($titles ?? []);
        const technology = @json($technology ?? []);

        const uniqueTitles = [...new Set(titles.filter(Boolean))];
        const uniqueTechnology = [...new Set(technology.filter(Boolean))];

        $("#jobTitle").autocomplete({
            source: uniqueTitles,
            minLength: 1,
            delay: 100
        });

        $("#technology").autocomplete({
            source: uniqueTechnology,
            minLength: 1,
            delay: 100
        });

        $('form[method="POST"]').on('submit', function(e) {
            if (!confirm('هل أنت متأكد من أنك تريد حفظ هذه المعلومات؟')) {
                e.preventDefault();
            }
        });
    });
</script>

    <!-- Main Content -->
    <div id="content">
        <!-- Topbar -->
        <!-- End of Topbar -->
        <!-- Back Button - Right Side (RTL) -->
        <div class="container-fluid pt-4">
            <div class="d-flex justify-content-start mb-4">
                <a href="{{ route('graduate.info-forms') }}" class="btn btn-light back-btn border">
                    <i class="fas fa-arrow-left ml-2"></i> الرجوع
                </a>
            </div>
        </div>
        @if(session('success'))
        <div class="container-fluid">
            <div class="alert alert-success alert-dismissible fade show" role="alert" data-aos="fade-down">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endif
        <!-- Begin Page Content -->
        <div class="container-fluid" >
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Header -->


                    <!-- Job Information Card -->
                    <div class="card mb-4" >
                        <div class="card-header py-3 " style="background-color: #3F37DF">
                            <h6 class="m-0 font-weight-bold  text-white">
                                <i class="fas fa-briefcase mr-2"></i> المعلومات الوظيفية الحالية
                            </h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ isset($job) ? route('job.update', $job->id) : route('job.store') }}" id="jobForm">
                                @csrf


                                <!-- Job Title -->
                                <div class="form-group row mb-4">
                                    <label for="jobTitle" class="col-md-4 col-form-label text-md-right">
                                        <i class="fas fa-user-tie mr-2 text-primary"></i> المسمى الوظيفي
                                    </label>
                                    <div class="col-md-8">
                                        <input type="text" name="title" id="jobTitle" class="form-control job-input"
                                               value="{{ isset($job) ? $job->title : old('title') }}" autocomplete="off" >
                                        @error('title')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Company -->
                                <div class="form-group row mb-4">
                                    <label class="col-md-4 col-form-label text-md-right">
                                        <i class="fas fa-building mr-2 text-primary"></i> اسم الشركة
                                    </label>

                                    <div class="col-md-8">
                                        <input type="text" name="company_name" id="jobTitle" class="form-control job-input"
                                               value="{{ isset($job) ? $job->compony : old('compony') }}"  >
                                        @error('company_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Location -->
                                <div class="form-group row mb-4">
                                    <label class="col-md-4 col-form-label text-md-right">
                                        <i class="fas fa-map-marker-alt mr-2 text-primary"></i> موقع العمل
                                    </label>
                                    <div class="col-md-8">
                                        <input type="text" name="location" class="form-control job-input"
                                               value="{{ isset($job) ? $job->location : old('location') }}" >
                                        @error('location')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Field of Work -->
                                <div class="form-group row mb-4">
                                    <label for="technology" class="col-md-4 col-form-label text-md-right">
                                        <i class="fas fa-code mr-2 text-primary"></i> التقنيات المستخدمة
                                    </label>
                                    <div class="col-md-8">
                                        <input type="text" name="technology" id="technology" class="form-control job-input"
                                               value="{{ isset($job) ? $job->technology : old('technology') }}" autocomplete="off" >
                                        @error('technology')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Technology -->
                                <div class="form-group row mb-4">
                                    <label class="col-md-4 col-form-label text-md-right">
                                        <i class="fas fa-laptop-code mr-2 text-primary"></i> مجال التخصص
                                    </label>
                                    <div class="col-md-8">
                                        <input type="text" name="field_of_work" class="form-control job-input"
                                               value="{{ isset($job) ? $job->field_of_work : old('field_of_work') }}" >
                                        @error('field_of_work')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Dates Section -->
                                <div class="row">
                                    <!-- Start Date -->
                                    <div class="form-group col-md-6 mb-4">
                                        <label class="col-form-label">
                                            <i class="fas fa-calendar-alt mr-2 text-primary"></i> تاريخ البدء
                                        </label>
                                        <input type="date" name="start_date" class="form-control job-input"
                                               value="{{ isset($job) ? $job->start_date : old('start_date') }}" >
                                        @error('start_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- End Date -->
                                    <div class="form-group col-md-6 mb-4">
                                        <label class="col-form-label">
                                            <i class="fas fa-calendar-times mr-2 text-primary"></i> تاريخ الانتهاء
                                        </label>
                                        <input type="date" name="end_datetime" class="form-control job-input"
                                               value="{{ isset($job) ? $job->end_date : old('end_date') }}">
                                        @error('end_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Hidden field for employment status -->
                                <input type="hidden" name="submit" id="employmentStatus"
                                       value="{{ isset($job) ? $job->employment_status : '' }}">

                                <!-- Submit Button -->
                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4 text-left">
                                        <button type="submit" class="btn  px-5 py-2 text-white" style="background-color: #3F37DF">
                                            <i class="fas fa-save mr-2"></i> {{ isset($job) ? 'تحديث المعلومات' : 'حفظ المعلومات' }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card mb-4 animate__animated animate__fadeInRight ">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-briefcase me-2"></i> الخبرة العملية</span>
                            <a href="{{ route('job.job-form') }}" class="btn btn-icon text-white"
                                title="إضافة خبرة عمل">
                                <i class="fas fa-plus text-black"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            @if ($graduate->jobs->count() > 0)
                                <div class="table-responsive">
                                    <table class="table border mb-0">
                                        <thead>
                                            <tr>
                                                <th>الوظيفة</th>
                                                <th>الشركة</th>
                                                <th>تاريخ البداية</th>
                                                <th>تاريخ النهاية</th>
                                                <th>المجال</th>
                                                <th width="40px"></th>
                                                <th width="40px"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($graduate->jobs as $job)
                                                <tr class="animate__animated animate__fadeIn">
                                                    <td>{{ $job->title }}</td>
                                                    <td>{{ $job->compony }}</td>
                                                    <td>{{ $job->pivot->start_date }}</td>
                                                    <td>{{ $job->pivot->end_date ?? 'حتى الآن' }}</td>
                                                    <td>{{ $job->field_of_work }}</td>
                                                    <td class="text-center">
                                                        <a
                                                            href="{{ route('job.updateJobForm', $job->id) }}">
                                                            <button class="btn btn-icon" title="تعديل">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </button>
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        <form action="{{ route('job.delete', $job->id) }}"
                                                            method="POST" class="d-inline delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-icon text-danger delete-btn"
                                                                title="حذف">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="empty-state animate__animated animate__fadeIn">
                                    <i class="fas fa-briefcase"></i>
                                    <h5>لا توجد خبرات عمل مسجلة</h5>
                                    <p class="mb-0">يمكنك إضافة خبراتك العملية لتكمل ملفك الشخصي</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- Information Card -->
                    <div class="card info-card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-info rounded-circle p-3 mr-3">
                                    <i class="fas fa-info-circle text-white fa-2x"></i>
                                </div>
                                <h5 class="mb-0 text-info">لماذا نطلب هذه المعلومات؟</h5>
                            </div>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> توفير فرص عمل تناسب خبراتك</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> تحديث السجلات الأكاديمية</li>
                                <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> تحسين خدمات الخريجين</li>
                                <li><i class="fas fa-check-circle text-success mr-2"></i> التواصل معك بسهولة عند الحاجة</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Your Website 2021</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

@endsection
