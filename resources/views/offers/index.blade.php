<!-- resources/views/offers/index.blade.php -->
@extends('layouts.app')

@section('title', 'عروضي الوظيفية')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">عروضي الوظيفية</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('offers.create') }}" class="btn btn-success">
                <i class="fas fa-plus me-1"></i> نشر عرض جديد
            </a>
        </div>
    </div>

    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('offers') ? 'active' : '' }}" href="{{ route('offers.index') }}">الكل</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->query('status') == 'active' ? 'active' : '' }}"
               href="{{ route('offers.index', ['status' => 'active']) }}">نشطة</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->query('status') == 'expired' ? 'active' : '' }}"
               href="{{ route('offers.index', ['status' => 'expired']) }}">منتهية</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->query('status') == 'inactive' ? 'active' : '' }}"
               href="{{ route('offers.index', ['status' => 'inactive']) }}">متوقفة</a>
        </li>
    </ul>

    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>المسمى الوظيفي</th>
                        <th>الوصف</th>
                        <th>تاريخ النشر</th>
                        <th>تاريخ الانتهاء</th>
                        <th>الحالة</th>
                        <th>طلبات التوظيف</th>
                        <th>إجراءات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($offers as $offer)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $offer->job_title }}</td>
                            <td>{{ Str::limit($offer->job_description, 50) }}</td>
                            <td>{{ $offer->created_at->format('Y-m-d') }}</td>
                            <td>{{ $offer->expiration_date->format('Y-m-d') }}</td>
                            <td>
                                @if($offer->expiration_date < now())
                                    <span class="badge bg-danger">منتهي</span>
                                @elseif(!$offer->is_active)
                                    <span class="badge bg-secondary">متوقف</span>
                                @else
                                    <span class="badge bg-success">نشط</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('applications.index', ['offer_id' => $offer->id]) }}" class="btn btn-sm btn-info">
                                    {{ $offer->applications_count }} طلب
                                </a>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('offers.show', $offer->id) }}" class="btn btn-sm btn-info" title="عرض">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('offers.edit', $offer->id) }}" class="btn btn-sm btn-primary" title="تعديل">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if($offer->is_active && $offer->expiration_date > now())
                                        <form action="{{ route('offers.deactivate', $offer->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-warning" title="إيقاف" onclick="return confirm('هل تريد إيقاف هذا العرض؟')">
                                                <i class="fas fa-pause"></i>
                                            </button>
                                        </form>
                                    @elseif(!$offer->is_active && $offer->expiration_date > now())
                                        <form action="{{ route('offers.activate', $offer->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-success" title="تفعيل" onclick="return confirm('هل تريد تفعيل هذا العرض؟')">
                                                <i class="fas fa-play"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('offers.destroy', $offer->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="حذف" onclick="return confirm('هل أنت متأكد من حذف هذا العرض؟')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $offers->links() }}
            </div>
        </div>
    </div>
@endsection
