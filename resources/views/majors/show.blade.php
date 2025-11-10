@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">تفاصيل Division</div>

                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label fw-bold">العنوان:</label>
                        <div>{{ $division->title }}</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">الوصف:</label>
                        <div>{{ $division->description }}</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">رقم الغرفة:</label>
                        <div>{{ $division->room }}</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">الحالة:</label>
                        <div>
                            @if($division->active)
                                <span class="badge bg-success">نشطة</span>
                            @else
                                <span class="badge bg-danger">غير نشطة</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">المستخدم المسؤول:</label>
                        <div>{{ $division->user->name ?? 'غير محدد' }}</div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('divisions.index') }}" class="btn btn-secondary">رجوع</a>
                        <a href="{{ route('divisions.edit', $division->id) }}" class="btn btn-primary">تعديل</a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
