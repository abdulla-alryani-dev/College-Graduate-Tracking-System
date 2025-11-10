@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">الملف الشخصي</h4>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Profile Image -->
                        <div class="text-center mb-4">
                            <div class="position-relative d-inline-block">
                                @if(auth()->user()->img)
                                    <img src="{{ asset('storage/' . auth()->user()->img) }}"
                                         class="rounded-circle shadow"
                                         style="width: 150px; height: 150px; object-fit: cover;"
                                         id="profileImagePreview">
                                @else
                                    <img src="{{ asset('assets/img/profile-image.png') }}"
                                         class="rounded-circle shadow"
                                         style="width: 150px; height: 150px; object-fit: cover;"
                                         id="profileImagePreview">
                                @endif
                                <label for="profileImage" class="btn btn-sm btn-primary position-absolute bottom-0 end-0 rounded-circle">
                                    <i class="fas fa-camera"></i>
                                </label>
                                <input type="file"
                                       id="profileImage"
                                       name="img"
                                       class="d-none"
                                       accept="image/*">
                            </div>
                        </div>

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">الاسم</label>
                            <input id="name"
                                   type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   name="name"
                                   value="{{ old('name', auth()->user()->name) }}"
                                   required
                                   autocomplete="name">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">البريد الإلكتروني</label>
                            <input id="email"
                                   type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email"
                                   value="{{ old('email', auth()->user()->email) }}"
                                   required
                                   autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">رقم الهاتف</label>
                            <input id="phone"
                                   type="tel"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   name="phone"
                                   value="{{ old('phone', auth()->user()->phone) }}">

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">كلمة المرور الجديدة (اختياري)</label>
                            <input id="password"
                                   type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password"
                                   autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password-confirm" class="form-label">تأكيد كلمة المرور</label>
                            <input id="password-confirm"
                                   type="password"
                                   class="form-control"
                                   name="password_confirmation"
                                   autocomplete="new-password">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                حفظ التغييرات
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Preview profile image before upload
    document.getElementById('profileImage').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('profileImagePreview').src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
