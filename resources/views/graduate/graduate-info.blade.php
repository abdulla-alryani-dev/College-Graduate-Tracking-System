@extends('layouts.app')

@section('content')
<div class="container-fluid" dir="rtl">
    <!-- Graduate Profile Section -->
    <div class="container py-4">
        <!-- Header Section -->
        <div class="card text-white mb-5" style="background-color: #3F37DF">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-2 text-center">
                        @if($graduate->user->img)
                            <img src="{{ asset('storage/' . $graduate->user->img) }}" alt="صورة الخريج" class="img-fluid rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <img src="{{ asset('assets/img/profile-image.png') }}" alt="صورة الخريج" class="img-fluid rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover;">
                        @endif
                    </div>
                    <div class="col-md-7">
                        <h2 class="mb-2">{{ $graduate->user->name ?? 'الاسم غير متوفر' }}</h2>
                        <p class="mb-2"><i class="fas fa-graduation-cap me-2"></i> {{ $graduate->universityData->major ?? 'التخصص غير متوفر' }}</p>
                        <p class="mb-3"><i class="fas fa-university me-2"></i> {{ $graduate->universityData->school ?? 'الجامعة غير متوفر' }}</p>
                        <span class="badge {{ $graduate->job_status ? 'bg-success' : 'bg-danger' }}">
                            <i class="fas {{ $graduate->job_status ? 'fa-briefcase' : 'fa-search' }} me-2"></i>
                            {{ $graduate->job_status ? 'موظف حالياً' : 'باحث عن عمل' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Left Column -->
            <div class="col-md-4">
                <!-- About Section -->
                <div class="card mb-4">
                    <div class="card-header  text-white" style="background-color: #3F37DF">
                        <i class="fas fa-user me-2"></i> معلومات شخصية
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <strong><i class="fas fa-envelope me-2 text-primary"></i> البريد الإلكتروني:</strong>
                                <p class="mb-0 text-muted">{{ $graduate->user->email ?? 'غير متوفر' }}</p>
                            </li>
                            <li class="mb-3">
                                <strong><i class="fas fa-phone me-2 text-primary"></i> الهاتف:</strong>
                                <p class="mb-0 text-muted">{{ $graduate->user->phone ?? 'غير متوفر' }}</p>
                            </li>
                            <li class="mb-3">
                                <strong><i class="fas fa-venus-mars me-2 text-primary"></i> الجنس:</strong>
                                <p class="mb-0 text-muted">{{ $graduate->universityData->sex ?? 'غير متوفر' }}</p>
                            </li>
                            <li class="mb-3">
                                <strong><i class="fas fa-calendar-alt me-2 text-primary"></i> سنة التخرج:</strong>
                                <p class="mb-0 text-muted">{{ $graduate->universityData->graduation_year ?? 'غير متوفر' }}</p>
                            </li>
                            <li>
                                <strong><i class="fas fa-star me-2 text-primary"></i> المعدل التراكمي:</strong>
                                <p class="mb-0 text-muted">{{ $graduate->universityData->GPA ?? 'غير متوفر' }}</p>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Education Section -->
                <div class="card mb-4">
                    <div class="card-header  text-white" style="background-color: #3F37DF">
                        <i class="fas fa-graduation-cap me-2"></i> المؤهلات التعليمية
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td width="30%"><strong>التخصص</strong></td>
                                    <td class="text-muted">{{ $graduate->universityData->major ?? 'غير متوفر' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>الجامعة</strong></td>
                                    <td class="text-muted">{{ $graduate->universityData->school ?? 'غير متوفر' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>سنة التخرج</strong></td>
                                    <td class="text-muted">{{ $graduate->universityData->graduation_year ?? 'غير متوفر' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>المعدل التراكمي</strong></td>
                                    <td class="text-muted">
                                        {{ $graduate->universityData->GPA ?? 'غير متوفر' }}
                                        @if($graduate->universityData->honours_degree ?? false)
                                            <span class="badge bg-success ms-2">درجة امتياز</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-8">
                <!-- Jobs Table -->
                <div class="card mb-4">
                    <div class="card-header  text-white" style="background-color: #3F37DF">
                        <i class="fas fa-briefcase me-2"></i> الخبرة العملية
                    </div>
                    <div class="card-body">
                        @if($graduate->jobs->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>الوظيفة</th>
                                            <th>الشركة</th>
                                            <th>تاريخ البداية</th>
                                            <th>تاريخ النهاية</th>
                                            <th>المجال</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($graduate->jobs as $job)
                                        <tr>
                                            <td>{{ $job->title }}</td>
                                            <td>{{ $job->compony }}</td>
                                            <td>{{ $job->pivot->start_date }}</td>
                                            <td>{{ $job->pivot->end_date ?? 'حتى الآن' }}</td>
                                            <td>{{ $job->field_of_work }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4 text-muted">
                                <i class="fas fa-briefcase fa-2x mb-3"></i>
                                <h5>لا توجد خبرات عمل مسجلة</h5>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Skills Table -->
                <div class="card mb-4">
                    <div class="card-header  text-white" style="background-color: #3F37DF">
                        <i class="fas fa-cogs me-2"></i> المهارات التقنية
                    </div>
                    <div class="card-body">
                        @if($graduate->skills->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>المهارة</th>
                                            <th>التقنية</th>
                                            <th>الإنجاز</th>
                                            <th>المستوى</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($graduate->skills as $skill)
                                        <tr>
                                            <td>
                                                <i class="fas fa-check-circle text-success me-2"></i>
                                                {{ $skill->title }}
                                            </td>
                                            <td>{{ $skill->technology ?? '--' }}</td>
                                            <td>{{ $skill->accomplishment ?? '--' }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="text-muted me-2">
                                                        @switch($skill->proficiency)
                                                            @case(1) مبتدئ @break
                                                            @case(2) متوسط @break
                                                            @case(3) متقدم @break
                                                            @case(4) خبير @break
                                                            @case(5) محترف @break
                                                            @default مبتدئ
                                                        @endswitch
                                                    </span>
                                                    <div class="progress flex-grow-1" style="height: 8px;">
                                                        <div class="progress-bar bg-primary" style="width: {{ $skill->proficiency * 20 }}%"></div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4 text-muted">
                                <i class="fas fa-cogs fa-2x mb-3"></i>
                                <h5>لا توجد مهارات مسجلة</h5>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Courses Table -->
                <div class="card mb-4">
                    <div class="card-header  text-white" style="background-color: #3F37DF">
                        <i class="fas fa-certificate me-2"></i> الدورات التدريبية
                    </div>
                    <div class="card-body">
                        @if($graduate->courses->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>اسم الدورة</th>
                                            <th>المؤسسة</th>
                                            <th>السنة</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($graduate->courses as $course)
                                        <tr>
                                            <td>{{ $course->title }}</td>
                                            <td>{{ $course->school }}</td>
                                            <td>{{ $course->year ?? '--' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4 text-muted">
                                <i class="fas fa-certificate fa-2x mb-3"></i>
                                <h5>لا توجد دورات مسجلة</h5>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Projects Section -->
                <div class="card mb-4">
                    <div class="card-header  text-white" style="background-color: #3F37DF">
                        <i class="fas fa-project-diagram me-2"></i> المشاريع والإنجازات
                    </div>
                    <div class="card-body">
                        @if($graduate->story)
                            <h5 class="mb-3">{{ $graduate->story->title ?? 'قصة النجاح' }}</h5>
                            <p class="mb-0">{{ $graduate->story->content ?? 'لا توجد معلومات عن المشاريع أو الإنجازات' }}</p>
                        @else
                            <div class="text-center py-4 text-muted">
                                <i class="fas fa-project-diagram fa-2x mb-3"></i>
                                <h5>لا توجد معلومات عن المشاريع أو الإنجازات</h5>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
