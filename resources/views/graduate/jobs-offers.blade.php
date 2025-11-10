@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">قائمة الوظائف</div>
        <div class="card-body">
            <!-- Search -->
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <input type="text" id="offerSearchInput" class="form-control" placeholder="ابحث عن وظيفة">
                </div>
                <div class="col-md-6">
                    <button id="resetOfferFilters" class="btn btn-secondary">إعادة تعيين</button>
                </div>
            </div>

            <!-- Offers Table -->
            <div class="table-responsive">
                <table class="table border mb-0" id="offersTable">
                    <thead>
                        <tr>
                            <th>العنوان الوظيفي</th>
                            <th>نوع الوظيفة</th>
                            <th>مستوى الخبرة</th>
                            <th>الموقع</th>
                            <th>الراتب</th>
                            <th>الحالة</th>
                            <th>الخيارات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($offers as $offer)
                            <tr data-title="{{ $offer->job_title }}" data-type="{{ $offer->job_type }}">
                                <td>{{ $offer->job_title }}</td>
                                <td>{{ $offer->job_type }}</td>
                                <td>{{ $offer->experience_level }}</td>
                                <td>{{ $offer->location ?? 'غير محدد' }}</td>
                                <td>
                                    @if($offer->fixed_salary)
                                        {{ $offer->fixed_salary }} {{ $offer->fixed_salary_currency }}
                                        <small>/ {{ $offer->fixed_salary_period }}</small>
                                    @elseif($offer->salary_min && $offer->salary_max)
                                        {{ $offer->salary_min }} - {{ $offer->salary_max }} {{ $offer->salary_range_currency }}
                                        <small>/ {{ $offer->salary_range_period }}</small>
                                    @else
                                        غير محدد
                                    @endif
                                </td>
                                <td>
                                    <span class="badge {{ $offer->is_active ? 'bg-success' : 'bg-danger' }}">
                                        {{ $offer->is_active ? 'نشط' : 'غير نشط' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('offers.show-offer', $offer->id) }}" class="btn btn-outline-primary btn-sm">عرض</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('offerSearchInput');
        const resetBtn = document.getElementById('resetOfferFilters');
        const rows = document.querySelectorAll('#offersTable tbody tr');

        function filterOffers() {
            const search = searchInput.value.toLowerCase();
            rows.forEach(row => {
                const title = row.dataset.title.toLowerCase();
                const type = row.dataset.type.toLowerCase();
                if (title.includes(search) || type.includes(search)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        searchInput.addEventListener('input', filterOffers);
        resetBtn.addEventListener('click', () => {
            searchInput.value = '';
            filterOffers();
        });
    });
</script>
@endsection
