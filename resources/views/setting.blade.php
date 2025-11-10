@extends('layouts.app')
@section('content')

    <div class="main-content">
        <div class="demo-card">
            <h4>لوحة التحكم الرئيسية</h4>
            <p>مرحبًا بك في نظام متابعة الخريجين المتقدم</p>
            <div class="alert alert-primary">
                يمكنك استخدام الشريط الجانبي للتنقل بين أقسام النظام المختلفة
            </div>
            <button class="btn btn-primary" id="toggleSidebar">تبديل الشريط الجانبي</button>
        </div>
    </div>

@endsection
