@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>طلب تسجيل صاحب العمل</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $employer->name }}</h5>
                <p class="card-text">البريد الإلكتروني: {{ $employer->email }}</p>
                <p class="card-text">الحالة: {{ $employer->status === 'pending' ? 'قيد الانتظار' : ($employer->status === 'approved' ? 'تم الموافقة' : 'تم الرفض') }}</p>
                <form action="{{ route('admin.notifications.approve', $notification->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success">موافقة</button>
                </form>
                <form action="{{ route('admin.notifications.reject', $notification->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger">رفض</button>
                </form>
            </div>
        </div>
    </div>
@endsection


