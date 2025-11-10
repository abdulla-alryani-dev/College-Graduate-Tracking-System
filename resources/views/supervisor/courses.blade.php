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

                <!-- Add/Edit Course Form -->
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>{{ isset($edit_course) ? 'تعديل الدورة' : 'ادراج دورة abdullah alryani' }}</span>
                        <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#courseFormCollapse" aria-expanded="true" aria-controls="courseFormCollapse">
                            عرض / إخفاء النموذج
                        </button>
                    </div>
                    <div class="collapse show" id="courseFormCollapse">
                        <div class="card-body">
                            <form action="{{ isset($edit_course) ? route('supervisor.courses.update', $edit_course->id) : route('supervisor.courses.store') }}" method="POST">
                                @csrf
                                @if(isset($edit_course))
                                    @method('POST')
                                @endif

                                <input type="hidden" name="graduate_id" value="{{ $graduate->id }}">

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="title" class="form-label">اسم الدورة</label>
                                        <input type="text" name="title" class="form-control" required value="{{ isset($edit_course) ? $edit_course->title : old('title') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="school" class="form-label">المدرسة</label>
                                        <input type="text" name="school" class="form-control" required value="{{ isset($edit_course) ? $edit_course->school : old('school') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="duration" class="form-label">المدة</label>
                                        <input type="text" name="duration" class="form-control" required value="{{ isset($edit_course) ? $edit_course->duration : old('duration') }}">
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn {{ isset($edit_course) ? 'btn-primary' : 'btn-success' }}">
                                        {{ isset($edit_course) ? 'تحديث الدورة' : 'إضافة الدورة' }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Courses Table -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table border mb-0">
                            <thead class="fw-semibold text-nowrap">
                            <tr class="align-middle">
                                <th class="bg-body-secondary">اسم الدورة</th>
                                <th class="bg-body-secondary">المدرسة</th>
                                <th class="bg-body-secondary">المدة</th>
                                <th class="bg-body-secondary text-center">الإجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($courses as $course)
                                <tr class="align-middle">
                                    <td>{{ $course->title }}</td>
                                    <td>{{ $course->school }}</td>
                                    <td>{{ $course->duration }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('supervisor.updatecourses', ['course' => $course->id, 'graduate' => $graduate->id]) }}" class="btn btn-sm btn-outline-primary">تعديل</a>
                                        <form action="{{ route('supervisor.courses.destroy', ['course' => $course, 'graduate' => $graduate->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف الدورة؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">حذف</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">لا توجد دورات مرتبطة بهذا الخريج.</td>
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
@endsection
