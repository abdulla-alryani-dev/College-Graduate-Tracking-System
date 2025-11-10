
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
                <!-- Skills Card -->
                <div class="card mb-4">
                    <div class="card-header py-3" style="background-color: #3F37DF">
                        <h6 class="m-0 font-weight-bold text-white">
                            <i class="fas fa-code mr-2"></i> هل يمكنك كتابة مهاراتك؟
                        </h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ isset($skill) ? route('skill.update', $skill->id) : route('skill.store') }}" id="skillsForm">
                            @csrf


                            <!-- Skill Name -->
                            <div class="form-group row mb-4">
                                <label class="col-md-4 col-form-label text-md-right">
                                    <i class="fas fa-user-tie mr-2 text-primary"></i> ما هو اسم المهارة التي اكتسبتها؟
                                </label>
                                <div class="col-md-8">
                                    <input type="text" name="title" class="form-control skill-input"
                                           value="{{ isset($skill) ? $skill->title : old('title') }}" autocomplete="off">
                                    @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Technology -->
                            <div class="form-group row mb-4">
                                <label class="col-md-4 col-form-label text-md-right">
                                    <i class="fas fa-laptop-code mr-2 text-primary"></i> ما هي التقنية التي استخدمتها لهذه المهارة؟
                                </label>
                                <div class="col-md-8">
                                    <input type="text" name="technology" class="form-control skill-input"
                                           value="{{ isset($skill) ? $skill->technology : old('technology') }}" autocomplete="off">
                                    @error('technology')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Accomplishment -->
                            <div class="form-group row mb-4">
                                <label class="col-md-4 col-form-label text-md-right">
                                    <i class="fas fa-star mr-2 text-primary"></i> ما هو مستوى إتقانك لهذه المهارة؟
                                </label>
                                <div class="col-md-8">
                                    <input type="text" name="accomplishment" class="form-control skill-input"
                                           value="{{ isset($skill) ? $skill->accomplishment : old('accomplishment') }}">
                                    @error('accomplishment')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4 text-left">
                                    <button type="submit" class="btn text-white px-5 py-2" style="background-color: #3F37DF">
                                        <i class="fas fa-save mr-2"></i> {{ isset($skill) ? 'تحديث المهارة' : 'حفظ المهارة' }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mb-4 animate__animated animate__fadeInRight">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-cogs me-2"></i> المهارات التقنية</span>
                        <a href="{{ route('skill.skill-form') }}" class="btn btn-icon text-white"
                            title="إضافة مهارة">
                            <i class="fas fa-plus text-black"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        @if ($graduate->skills->count() > 0)
                            <div class="table-responsive">
                                <table class="table border mb-0">
                                    <thead>
                                        <tr>
                                            <th>المهارة</th>
                                            <th>التقنية</th>
                                            <th>الإنجاز</th>
                                            <th>المستوى</th>
                                            <th width="40px"></th>
                                            <th width="40px"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($graduate->skills as $skill)
                                            <tr class="animate__animated animate__fadeIn">
                                                <td>
                                                    <i
                                                        class="fas fa-check-circle text-success me-2"></i>
                                                    {{ $skill->title }}
                                                </td>
                                                <td>{{ $skill->technology ?? '--' }}</td>
                                                <td>{{ $skill->accomplishment ?? '--' }}</td>
                                                <td>
                                                    <div class="proficiency-level">
                                                        <span class="text-muted">
                                                            @switch($skill->proficiency)
                                                                @case(1)
                                                                    مبتدئ
                                                                @break

                                                                @case(2)
                                                                    متوسط
                                                                @break

                                                                @case(3)
                                                                    متقدم
                                                                @break

                                                                @case(4)
                                                                    خبير
                                                                @break

                                                                @case(5)
                                                                    محترف
                                                                @break

                                                                @default
                                                                    مبتدئ
                                                            @endswitch
                                                        </span>
                                                        <div class="proficiency-bar">
                                                            <div class="proficiency-fill"
                                                                style="width: {{ $skill->proficiency * 20 }}%">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <a
                                                        href="{{ route('skill.updateSkillForm', $skill->id) }}">
                                                        <button class="btn btn-icon" title="تعديل">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button></a>
                                                </td>
                                                <td class="text-center">
                                                    <form
                                                        action="{{ route('skill.delete', $skill->id) }}"
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
                                <i class="fas fa-cogs"></i>
                                <h5>لا توجد مهارات مسجلة</h5>
                                <p class="mb-0">يمكنك إضافة مهاراتك لتكمل ملفك الشخصي</p>
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
                            <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> فهم المهارات التي اكتسبتها خلال مسيرتك المهنية</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> توجيهك نحو فرص تطوير مهاراتك</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i> تحسين خدمات الدعم للخريجين</li>
                            <li><i class="fas fa-check-circle text-success mr-2"></i> مساعدتك في تحديد مجالات التطوير المهني</li>
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
