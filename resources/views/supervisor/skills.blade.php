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

                <!-- Add/Edit Skill Form -->
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>{{ isset($edit_skill) ? 'تعديل المهارة' : 'ادراج مهارة للخريج abdullah alryani' }}</span>
                        <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#skillFormCollapse" aria-expanded="true" aria-controls="skillFormCollapse">
                            عرض / إخفاء النموذج
                        </button>
                    </div>
                    <div class="collapse show" id="skillFormCollapse">
                        <div class="card-body">
                            <form action="{{ isset($edit_skill) ? route('supervisor.skills.update', $edit_skill->id) : route('supervisor.skills.store') }}" method="POST">
                                @csrf
                                @if(isset($edit_skill))
                                    @method('POST')
                                @endif

                                <input type="hidden" name="graduate_id" value="{{ $graduate->id }}">

                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label for="title" class="form-label">عنوان المهارة</label>
                                        <input type="text" name="title" class="form-control" required value="{{ $edit_skill->title ?? '' }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="technology" class="form-label">التقنية</label>
                                        <input type="text" name="technology" class="form-control" required value="{{ $edit_skill->technology ?? '' }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="accomplishment" class="form-label">الإنجاز</label>
                                        <input type="text" name="accomplishment" class="form-control" required value="{{ $edit_skill->accomplishment ?? '' }}">
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn {{ isset($edit_skill) ? 'btn-primary' : 'btn-success' }}">
                                        {{ isset($edit_skill) ? 'تحديث المهارة' : 'إضافة المهارة' }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Search and Filter -->
                <div class="card-body">
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <input type="text" id="searchInput" class="form-control" placeholder="البحث بعنوان المهارة أو التقنية">
                        </div>
                        <div class="col-md-4">
                            <select id="techFilter" class="form-select">
                                <option value="">جميع التقنيات</option>
                                @foreach($skills->pluck('technology')->unique() as $tech)
                                    <option value="{{ $tech }}">{{ $tech }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Skills Table -->
                    <div class="table-responsive">
                        <table class="table border mb-0" id="skillsTable">
                            <thead class="fw-semibold text-nowrap">
                            <tr class="align-middle">
                                <th class="bg-body-secondary">عنوان المهارة</th>
                                <th class="bg-body-secondary">التقنية</th>
                                <th class="bg-body-secondary">الإنجاز</th>
                                <th class="bg-body-secondary text-center">الإجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($skills as $skill)
                                <tr class="align-middle"
                                    data-title="{{ strtolower($skill->title) }}"
                                    data-tech="{{ strtolower($skill->technology) }}">
                                    <td>{{ $skill->title }}</td>
                                    <td>{{ $skill->technology }}</td>
                                    <td>{{ $skill->accomplishment }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('supervisor.updateskills', ['skill' => $skill->id, 'graduate' => $graduate->id]) }}" class="btn btn-sm btn-outline-primary">تعديل</a>
                                        <form action="{{ route('supervisor.skills.destroy', ['skill' => $skill, 'graduate' => $graduate->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف المهارة؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">حذف</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">لا توجد مهارات مرتبطة بهذا الخريج.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        <a href="{{route('supervisor.university-data')}}" class="btn btn-secondary">رجوع</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JS for Filtering and Search -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const techFilter = document.getElementById('techFilter');
        const rows = document.querySelectorAll('#skillsTable tbody tr');

        function filterSkills() {
            const search = searchInput.value.toLowerCase();
            const tech = techFilter.value;

            rows.forEach(row => {
                const title = row.getAttribute('data-title');
                const skillTech = row.getAttribute('data-tech');

                const matchesSearch = title.includes(search) || skillTech.includes(search);
                const matchesTech = !tech || skillTech === tech;

                if (matchesSearch && matchesTech) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        searchInput.addEventListener('input', filterSkills);
        techFilter.addEventListener('change', filterSkills);
    });
</script>
@endsection
