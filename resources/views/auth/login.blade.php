{{--<x-guest-layout>--}}
{{--    <!-- Session Status -->--}}
{{--    <x-auth-session-status class="mb-4" :status="session('status')" />--}}

{{--    <form method="POST" action="{{ route('login') }}">--}}
{{--        @csrf--}}

{{--        <!-- Email Address -->--}}
{{--        <div>--}}
{{--            <x-input-label for="email" :value="__('Email')" />--}}
{{--            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />--}}
{{--            <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password" :value="__('Password')" />--}}

{{--            <x-text-input id="password" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password"--}}
{{--                            required autocomplete="current-password" />--}}

{{--            <x-input-error :messages="$errors->get('password')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Remember Me -->--}}
{{--        <div class="block mt-4">--}}
{{--            <label for="remember_me" class="inline-flex items-center">--}}
{{--                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">--}}
{{--                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>--}}
{{--            </label>--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            @if (Route::has('password.request'))--}}
{{--                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">--}}
{{--                    {{ __('Forgot your password?') }}--}}
{{--                </a>--}}
{{--            @endif--}}

{{--            <x-primary-button class="ms-3">--}}
{{--                {{ __('Log in') }}--}}
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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

        .input-group-text {
            background-color: #e9ecef; /* Darker background for icons */
            border-right: none;
        }
        .form-control {
            border-left: none;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #ced4da;
        }
        .btn-success {
            width: 100%;
            padding: 0.75rem;
            border-radius: 4px;
            background-color: #28a745;
            border: none;
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
        }
        .btn-success:hover {
            background-color: #218838;
        }
        .activate-windows {
            margin-top: 1.5rem;
            color: #6c757d;
            font-size: 0.875rem;
        }
        @media (max-width: 1000px) {
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

                <!-- Sign Up Card -->
                <div class="card text-white bg-primary py-5 d-md-flex flex-column align-items-center text-center">

                    <div class="card-body">
                            <i class="bi bi-mortarboard-fill text-blue-300" style="font-size: 4rem;"></i>
                        <h2>انضم إلينا</h2>
                        <p>أنشئ حسابًا</p>
                        <a class="btn btn-lg btn-outline-light mt-3" href="{{ route('register') }}">! سجل الآن</a>
                    </div>
                </div>
                <!-- Login Card -->
                <div class="card p-4">
                    <div class="card-body">
                        <h2 class="text-center">تسجيل الدخول</h2>
                        <p class="text-muted text-center">سجل للدخول الى حسابك</p>

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

                            <!-- Password -->
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                </div>
                                <x-text-input id="password" class="form-control"
                                              type="password"
                                              name="password"
                                              placeholder="كلمة المرور"
                                              required autocomplete="current-password" />

                                 <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />

                            <!-- Remember Me -->
                            <div class="block mt-4">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                    <span class="ml-2 text-sm text-gray-600">{{ __('تذكرني') }}</span>
                                </label>
                            </div>

                            <!-- Login Button and Forgot Password -->
                            <div class="row mt-4">
                                <div class="col-6 text-left">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link p-0" href="{{ route('password.request') }}">
                                            {{ __('نسيت كلمة السر؟') }}
                                        </a>
                                    @endif
                                </div>
                                <div class="col-6" >
                                    <button class="btn btn-primary px-4" type="submit" id="loginButton">
                                        <span id="loginText">{{ __('تسجيل دخول') }}</span>
                                        <span id="loginSpinner" class="spinner-border spinner-border-sm d-none"></span>
                                    </button>
                                </div>

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


