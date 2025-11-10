@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">الـ Divisions</div>
                <div class="card-body">
                    <!-- Search and Filter Form -->
                    <div class="row g-3 mb-4">
                        <div class="mb-3 text-end">
                            <a href="{{ route('divisions.create') }}" class="btn btn-success">
                                <i class="fas fa-plus"></i> إضافة قسم
                            </a>
                        </div>
                        <div class="col-md-4">
                            <input type="text" id="searchInput" class="form-control" placeholder="Search by title or room">
                        </div>
                        <div class="col-md-4">
                            <select id="statusFilter" class="form-select">
                                <option value="">All Statuses</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button id="resetFilters" class="btn btn-secondary">Reset</button>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table border mb-0" id="divisionsTable">
                            <thead class="fw-semibold text-nowrap">
                                <tr class="align-middle">
                                    <th class="bg-body-secondary">العنوان</th>
                                    <th class="bg-body-secondary">الوصف</th>
                                    <th class="bg-body-secondary">الغرفة</th>
                                    <th class="bg-body-secondary text-center">الحالة</th>
                                    <th class="bg-body-secondary">المستخدم المسؤول</th>
                                    <th class="bg-body-secondary">الإجراء</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($divisions as $division)
                                    <tr class="align-middle"
                                        data-title="{{ $division->title }}"
                                        data-room="{{ $division->room }}"
                                        data-status="{{ $division->active }}">
                                        <td>{{ $division->title }}</td>
                                        <td>{{ $division->description }}</td>
                                        <td>{{ $division->room }}</td>
                                        <td class="text-center">
                                            @if($division->active)
                                                <span class="badge bg-success">نشط</span>
                                            @else
                                                <span class="badge bg-danger">غير نشط</span>
                                            @endif
                                        </td>
                                        <td>{{ $division->user->name ?? 'غير محدد' }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group" dir="ltr">
                                                <a href="{{ route('divisions.show', $division->id) }}" class="btn btn-info" title="عرض">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('divisions.edit', $division->id) }}" class="btn btn-primary" title="تعديل">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @if($division->active)
                                                    <form method="POST" action="{{ route('divisions.toggleStatus', $division->id) }}">
                                                        @csrf
                                                        @method('POST')
                                                        <button class="btn btn-warning" title="إيقاف">
                                                            <i class="fas fa-pause"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <form method="POST" action="{{ route('divisions.toggleStatus', $division->id) }}">
                                                        @csrf
                                                        @method('POST')
                                                        <button class="btn btn-success" title="تفعيل">
                                                            <i class="fas fa-play"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript for Search and Filter
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const statusFilter = document.getElementById('statusFilter');
        const resetFilters = document.getElementById('resetFilters');
        const tableRows = document.querySelectorAll('#divisionsTable tbody tr');

        function filterRows() {
            const searchText = searchInput.value.toLowerCase();
            const status = statusFilter.value;

            tableRows.forEach(row => {
                const title = row.getAttribute('data-title').toLowerCase();
                const room = row.getAttribute('data-room').toLowerCase();
                const rowStatus = row.getAttribute('data-status');

                const matchesSearch = title.includes(searchText) || room.includes(searchText);
                const matchesStatus = status === '' || rowStatus === status;

                row.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
            });
        }

        searchInput.addEventListener('input', filterRows);
        statusFilter.addEventListener('change', filterRows);
        resetFilters.addEventListener('click', () => {
            searchInput.value = '';
            statusFilter.value = '';
            filterRows();
        });
    });
</script>

@endsection
