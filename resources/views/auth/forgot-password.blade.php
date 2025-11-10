{{--<x-guest-layout>--}}
{{--    <div class="mb-4 text-sm text-gray-600">--}}
{{--        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}--}}
{{--    </div>--}}

{{--    <!-- Session Status -->--}}
{{--    <x-auth-session-status class="mb-4" :status="session('status')" />--}}

{{--    <form method="POST" action="{{ route('password.email') }}">--}}
{{--        @csrf--}}

{{--        <!-- Email Address -->--}}
{{--        <div>--}}
{{--            <x-input-label for="email" :value="__('Email')" />--}}
{{--            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />--}}
{{--            <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            <x-primary-button>--}}
{{--                {{ __('Email Password Reset Link') }}--}}
{{--            </x-primary-button>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--</x-guest-layout>--}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap 4.6 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .bg-primary {
            background-color: #5a67d8 !important;
        }
        .btn-outline-light {
            border-color: #fff;
            color: #fff;
            transition: all 0.3s ease;
        }
        .btn-outline-light:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }
        .btn-primary {
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #434190;
            border-color: #434190;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn:focus, .form-control:focus {
            box-shadow: 0 0 0 3px rgba(90, 103, 216, 0.5);
            outline: none;
        }
        @media (max-width: 768px) {
            .card-group {
                flex-direction: column;
            }
            .card {
                margin-bottom: 20px;
            }
        }
        @media (max-width: 576px) {
            h2 {
                font-size: 1.5rem;
            }
            p {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body class="bg-light">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group">
                 <!-- Login Card -->
                <div class="card p-4">
                    <div class="card-body">
                        <h2 class="text-center">تسجيل الدخول</h2>
                        <p class="text-muted text-center">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one</p>

                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <!-- Login Form -->
                        <form method="POST" action="{{ route('login') }}" id="loginForm">
                            @csrf

                            <!-- Email Address -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                </div>
                                <x-text-input id="email" class="form-control" placeholder="البريد الإلكتروني" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />

                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />


                            <div class="row mt-4 ">


                                <x-primary-button class="btn btn-primary px-4 ml-auto mr-auto " id="loginButton">
                                    <span id="loginText">{{ __('Email Password Reset Link') }}</span>
                                    <span id="loginSpinner" class="spinner-border spinner-border-sm d-none"></span>

                                </x-primary-button>




                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Password Toggle
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });

    // Login Button Loading State
    document.getElementById('loginForm').addEventListener('submit', function (e) {
        // Show loading state
        const loginButton = document.getElementById('loginButton');
        loginButton.disabled = true;
        document.getElementById('loginText').classList.add('d-none');
        document.getElementById('loginSpinner').classList.remove('d-none');

        // Allow the form to submit naturally
        // No need to prevent default or manually submit the form
    });
</script>
</body>
</html>
