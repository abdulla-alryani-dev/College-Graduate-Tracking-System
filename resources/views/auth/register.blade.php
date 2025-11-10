<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل</title>
    <!-- Bootstrap 4.6 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <!-- CoreUI Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@coreui/icons/css/all.min.css">
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
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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

        .btn:focus,
        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(90, 103, 216, 0.5);
            outline: none;
        }

        .input-group-text {
            background-color: #e9ecef;
            /* Darker background for icons */
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
                    <!-- Join Us Card -->
                    <div class="card text-white bg-primary py-5 d-md-flex flex-column align-items-center text-center">
                        <div class="card-body">
                            <div class="d-flex justify-content-center mb-4">
                                <i class="bi bi-mortarboard-fill text-blue-300" style="font-size: 4rem;"></i>
                            </div>
                            <h2>انضم إلينا</h2>
                            <p>أنشئ حسابًا للوصول إلى الميزات الحصرية والمحتوى. إنها سريعة وسهلة!</p>
                            <a class="btn btn-lg btn-outline-light mt-3" href="{{ route('login') }}">! سجل الدخول
                                الآن</a>
                        </div>
                    </div>

                    <!-- Register Card -->
                    <div class="card p-4">
                        <div class="card-body">

                            <h2 class="text-center">تسجيل</h2>
                            <p class="text-muted text-center">أنشئ حسابك</p>

                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4" :status="session('status')" />

                            <!-- Register Form -->
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <!-- Role Selection -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-user-shield"></i>
                                        </span>
                                    </div>
                                    <select name="role" id="roleSelect" class="form-control" required>
                                        <option value="graduate" selected style="text-align:end">خريج</option>
                                        <option value="employer" style="text-align:end">جهة توظيف</option>
                                    </select>
                                </div>

                                <!-- Graduate Email Input -->
                                <div class="input-group mb-3" id="emailGroup">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">@</span>
                                    </div>
                                    <input type="email" name="mailCheck" class="form-control"
                                        placeholder="أدخل البريد الإلكتروني" required>
                                </div>
                                <x-input-error :messages="$errors->get('mailCheck')" class="mt-2" />

                                <!-- Employer Name -->
                                <div class="input-group mb-3 d-none" id="employerNameGroup">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-building"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="employer_name" class="form-control"
                                        placeholder="اسم الجهة">
                                </div>
                                <x-input-error :messages="$errors->get('employer_name')" class="mt-2 text-danger" />

                                <!-- Employer Location -->
                                <div class="input-group mb-3 d-none" id="employerLocationGroup">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="employer_location" class="form-control"
                                        placeholder="الموقع">
                                </div>
                                <x-input-error :messages="$errors->get('employer_location')" class="mt-2 text-danger" />
                                <!-- Employer Industry -->
                                <div class="input-group mb-3" id='employerIndustryGroup'>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-industry"></i>
                                        </span>
                                    </div>

                                    <select name="employer_industry" class="form-control" >
                                        <option value="" disabled selected>اختر القطاع</option>
                                        <option value="التعليم">التعليم</option>
                                        <option value="الصحة">الصحة</option>
                                        <option value="التكنولوجيا">التكنولوجيا</option>
                                        <option value="الإنشاءات">الإنشاءات</option>
                                        <option value="الخدمات المالية">الخدمات المالية</option>
                                    </select>
                                </div>

                                <!-- Show validation error -->
                                <x-input-error :messages="$errors->get('employer_industry')" class="mt-2 text-danger" />


                                <!-- Name -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="cil-user"></i>
                                        </span>
                                    </div>
                                    <x-text-input id="name" class="form-control" type="text" name="name"
                                        placeholder="الاسم" :value="old('name')" required autofocus autocomplete="name" />
                                </div>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />

                                <!-- Email Address -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="cil-envelope-open"></i>
                                        </span>
                                    </div>
                                    <x-text-input id="email" class="form-control" type="email" name="email"
                                        placeholder="البريد الإلكتروني" :value="old('email')" required
                                        autocomplete="username" />
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />

                                <!-- Password -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="cil-lock-locked"></i>
                                        </span>
                                    </div>
                                    <x-text-input id="password" class="form-control" type="password"
                                        name="password" placeholder="كلمة المرور" required
                                        autocomplete="new-password" />
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />

                                <!-- Confirm Password -->
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="cil-lock-locked"></i>
                                        </span>
                                    </div>
                                    <x-text-input id="password_confirmation" class="form-control" type="password"
                                        name="password_confirmation" placeholder="تأكيد كلمة المرور" required
                                        autocomplete="new-password" />
                                </div>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />


                                <x-input-error :messages="$errors->get('role')" class="mt-2" />

                                <!-- Register Button and Login Link -->
                                <div class="row mt-4">
                                    <div class="col-6">
                                        <button class="btn btn-success" type="submit">
                                            {{ __('تسجيل') }}
                                        </button>
                                    </div>
                                    <div class="col-6 text-right">
                                        <a class="btn btn-link p-0" href="{{ route('login') }}">
                                            {{ __('لديك حساب بالفعل؟') }}
                                        </a>
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
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui/dist/js/coreui.bundle.min.js"></script>
    <script>
        // Password Toggle (if needed)
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        if (togglePassword && password) {
            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });
        }
    </script>

    <!-- JavaScript -->
    <script>
        const roleSelect = document.getElementById('roleSelect');
        const emailGroup = document.getElementById('emailGroup');
        const employerNameGroup = document.getElementById('employerNameGroup');
        const employerLocationGroup = document.getElementById('employerLocationGroup');
        const employerIndustryGroup = document.getElementById('employerIndustryGroup');
        const mailCheckInput = document.querySelector('input[name="mailCheck"]');

        function toggleFields() {
            const isGraduate = roleSelect.value === 'graduate';


            // Show email field if the role is "graduate" and make it required
            if (isGraduate) {
                emailGroup.style.display = 'flex'; // Make sure the email field is visible
                mailCheckInput.setAttribute('required', 'true'); // Make the email input required
            } else {
                emailGroup.style.display = 'none'; // Hide the email field if the role is "employer"
                mailCheckInput.removeAttribute('required'); // Remove the required attribute for employer
            }

            employerNameGroup.classList.toggle('d-none', isGraduate);
            employerLocationGroup.classList.toggle('d-none', isGraduate);
            employerIndustryGroup.classList.toggle('d-none', isGraduate);
        }

        // Run on load
        window.addEventListener('DOMContentLoaded', toggleFields);

        // Run on change
        roleSelect.addEventListener('change', toggleFields);
    </script>

</body>

</html>
