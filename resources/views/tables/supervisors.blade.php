@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header" data-coreui-i18n="trafficAndSales">بيانات المشرفين </div>
                    <div class="card-body">
                        <!-- Search and Filter Form -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <input type="text" id="searchInput" class="form-control" placeholder="Search by name or email">
                            </div>
                            <div class="col-md-4">
                                <select id="StatusFilter" class="form-select">
                                    <option value="">All Status</option>
                                    <option value="1">Approved</option>
                                    <option value="0">Banned</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button id="resetFilters" class="btn btn-secondary">Reset</button>
                            </div>
                        </div>

                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table border mb-0" id="employerTable">
                                <thead class="fw-semibold text-nowrap">
                                <tr class="align-middle">
                                    <th class="bg-body-secondary text-center">
                                        <img src="{{ asset('assets/icons/people.svg') }}" class="icon">
                                    </th>
                                    <th class="bg-body-secondary">المستخدم</th>

                                    <th class="bg-body-secondary text-center">القسم</th>
                                    <th class="bg-body-secondary">Activity</th>
                                    <th class="bg-body-secondary">status</th>
                                    <th class="bg-body-secondary">الاجراء</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($supervisors as $supervisor)
                                    <tr class="align-middle"
                                        data-name="{{ $supervisor->name??'none' }}"
                                        data-email="{{ $supervisor->email??'none' }}"
                                        data-status="{{$supervisor->status == 'approved' ? 1 : 0}}">
                                        <td class="text-center">
                                            <div class="avatar avatar-md">
                                                <img class="avatar-img" src="{{ asset('img/undraw_profile.svg') }}" alt="user@email.com">
                                                <span class="avatar-status bg-success"></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-nowrap">{{  $supervisor->name  }}</div>
                                            <div class="small text-body-secondary text-nowrap">
                                                <span>{{ $supervisor->email??'none' }}</span> | Register Date : {{ $supervisor->created_at }} | id : {{ $supervisor->id }}
                                            </div>
                                        </td>
                                        <td>
                                            <div style="display: flex; flex-wrap: wrap; gap: 0.25rem;">
                                                @forelse($divisions as $division)

                                                    <span class="badge bg-info text-dark" style="font-size: 0.75rem; padding: 0.4em 0.6em;">
                                                        {{ $supervisor->id == $division->id ? $division->name : null }}
                                                    </span>
                                                @empty
                                                    <span class="text-muted">لا يوجد قسم</span>
                                                @endforelse
                                            </div>
                                        </td>




                                        <td>
                                            <div class="small text-body-secondary">Last login</div>
                                            <div class="fw-semibold text-nowrap">10 sec ago</div>
                                        </td>

                                        @php
                                            $supervisorStatus = $supervisor->status ?? 'null';

                                        @endphp

                                        @if($supervisorStatus == "approved")
                                            <td><span class="badge bg-success">Active</span></td>
                                        @elseif($supervisorStatus =="pending")
                                            <td><span class="badge bg-warning">Pending </span></td>
                                        @else
                                            <td><span class="badge bg-danger">Banned</span></td>
                                        @endif






                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <img src="{{ asset('assets/icons/options.svg') }}" class="icon" alt="Options" style="height:1rem; width: 3rem">
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Info</a>
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <a class="dropdown-item text-danger" href="#">Delete</a>
                                                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.3.1/dist/js/coreui.bundle.min.js" crossorigin="anonymous"></script>
    <script>
        // JavaScript for Search and Filter
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const StatusFilter = document.getElementById('StatusFilter');
            const resetFilters = document.getElementById('resetFilters');
            const tableRows = document.querySelectorAll('#employerTable tbody tr');

            // Function to filter rows
            function filterRows() {
                const searchText = searchInput.value.toLowerCase();
                const Status = StatusFilter.value;

                tableRows.forEach(row => {
                    const name = row.getAttribute('data-name').toLowerCase();
                    const email = row.getAttribute('data-email').toLowerCase();
                    const s = row.getAttribute('data-status');

                    const matchesSearch = name.includes(searchText) || email.includes(searchText);
                    const matchesStatus = Status === '' || s === Status;

                    if (matchesSearch && matchesStatus) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            // Event listeners
            searchInput.addEventListener('input', filterRows);
            StatusFilter.addEventListener('change', filterRows);
            resetFilters.addEventListener('click', () => {
                searchInput.value = '';
                StatusFilter.value = '';
                filterRows();
            });
        });
    </script>
@endsection
