
@extends('layouts.app')

@section('content')
<div id="content">

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
    <div class="container-fluid" dir="rtl">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Education Information Card -->
                <div class="card mb-4">
                    <div class="card-header py-3" style="background-color: #3F37DF">
                        <h6 class="m-0 font-weight-bold text-white">
                            <i class="fas fa-graduation-cap mr-2"></i> هل يمكنك تقديم معلوماتك التعليمية؟
                        </h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ isset($course) ? route('course.update', $course->id) : route('course.store') }}" id="courseForm">
                            @csrf


                            <!-- Degree -->
                            <div class="form-group row mb-4">
                                <label class="col-md-4 col-form-label text-md-right">
                                    <i class="fas fa-certificate mr-2 text-primary"></i> ما هي الدرجة العلمية التي حصلت عليها؟
                                </label>
                                <div class="col-md-8">
                                    <input type="text" name="title" class="form-control education-input"
                                           value="{{ isset($course) ? $course->title : old('title') }}" autocomplete="off">
                                    @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- School -->
                            <div class="form-group row mb-4">
                                <label class="col-md-4 col-form-label text-md-right">
                                    <i class="fas fa-university mr-2 text-primary"></i> ما اسم المؤسسة التي درست بها؟
                                </label>
                                <div class="col-md-8">
                                    <input type="text" name="school" class="form-control education-input"
                                           value="{{ isset($course) ? $course->school : old('school') }}" autocomplete="off">
                                    @error('school')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Duration -->
                            <div class="form-group row mb-4">
                                <label class="col-md-4 col-form-label text-md-right">
                                    <i class="fas fa-calendar-alt mr-2 text-primary"></i> ما هي مدة دراستك؟
                                </label>
                                <div class="col-md-8">
                                    <input type="text" name="duration" class="form-control education-input"
                                           value="{{ isset($course) ? $course->duration : old('duration') }}">
                                    @error('duration')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4 text-left">
                                    <button type="submit" class="btn text-white px-5 py-2" style="background-color: #3F37DF">
                                        <i class="fas fa-save mr-2"></i> {{ isset($course) ? 'تحديث المعلومات' : 'حفظ المعلومات' }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mb-4 animate__animated animate__fadeInRight">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-certificate me-2"></i> الدورات التدريبية</span>
                        <a href="{{ route('course.course-form') }}"
                            class="btn btn-icon text-white" title="إضافة دورة">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        @if ($graduate->courses->count() > 0)
                            <div class="table-responsive">
                                <table class="table border mb-0">
                                    <thead>
                                        <tr>
                                            <th>اسم الدورة</th>
                                            <th>المؤسسة</th>
                                            <th>السنة</th>
                                            <th width="40px"></th>
                                            <th width="40px"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($graduate->courses as $course)
                                            <tr class="animate__animated animate__fadeIn">
                                                <td>{{ $course->title }}</td>
                                                <td>{{ $course->school }}</td>
                                                <td>{{ $course->year ?? '--' }}</td>
                                                <td class="text-center">
                                                    <a
                                                        href="{{ route('course.updateCourseForm', $course->id) }}">
                                                        <button class="btn btn-icon" title="تعديل">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button></a>
                                                </td>
                                                <td class="text-center">
                                                    <form
                                                        action="{{ route('course.delete', $course->id) }}"
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
                                <i class="fas fa-certificate"></i>
                                <h5>لا توجد دورات مسجلة</h5>
                                <p class="mb-0">يمكنك إضافة الدورات التدريبية لتكمل ملفك الشخصي</p>
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
                            <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> تحديث السجلات الأكاديمية للخريجين</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> تحسين خدمات متابعة الخريجين</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> توفير إحصائيات دقيقة عن مسارات الخريجين</li>
                            <li><i class="fas fa-check-circle text-success mr-2"></i> التواصل معك بخصوص برامج تطويرية تناسب مؤهلاتك</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<script>
    $(document).ready(function() {
        // Form submission confirmation
        $('form[method="POST"]').on('submit', function(e) {
            if (!confirm('هل أنت متأكد من أنك تريد حفظ هذه المعلومات؟')) {
                e.preventDefault();
            }
        });

        // Auto-dismiss alerts after 5 seconds
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);
    });
</script>
@endsection
