<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>نظام متابعة التخرج</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Arabic Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            text-align: right;
        }
        .card {
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body class="bg-light">
<div class="container py-5">
    <header class="text-center mb-5">
        <div class="d-flex justify-content-center mb-4">
            <i class="bi bi-mortarboard-fill text-primary" style="font-size: 4rem;"></i>
        </div>

        @if (Route::has('login'))
            <nav class="d-flex justify-content-start gap-3">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-outline-primary">
                        لوحة التحكم
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        تسجيل الدخول
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-primary">
                            تسجيل جديد
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <main>
        <div class="row g-4">
            <!-- إدارة الطلاب -->
            <div class="col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-people-fill fs-1 text-primary ms-3"></i>
                            <h2 class="card-title mb-0">إدارة الطلاب</h2>
                        </div>
                        <p class="card-text">
                            إدارة سجلات الطلاب بكفاءة، متابعة التقدم الأكاديمي، ومراقبة متطلبات التخرج
                        </p>
                        <div class="text-start">
                            <i class="bi bi-arrow-left-circle-fill text-primary fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- متابعة التقدم -->
            <div class="col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-clipboard-data-fill fs-1 text-primary ms-3"></i>
                            <h2 class="card-title mb-0">متابعة التقدم</h2>
                        </div>
                        <p class="card-text">
                            مراقبة المراحل الأكاديمية، إكمال المواد، وأهلية التخرج في الوقت الفعلي
                        </p>
                        <div class="text-start">
                            <i class="bi bi-arrow-left-circle-fill text-primary fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- التقارير والتحليلات -->
            <div class="col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-file-earmark-bar-graph-fill fs-1 text-primary ms-3"></i>
                            <h2 class="card-title mb-0">التقارير والتحليلات</h2>
                        </div>
                        <p class="card-text">
                            توليد تقارير شاملة ولوحات تحليلية لأداء الطلاب ومؤشرات التخرج
                        </p>
                        <div class="text-start">
                            <i class="bi bi-arrow-left-circle-fill text-primary fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- الدعم الأكاديمي -->
            <div class="col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-question-circle-fill fs-1 text-primary ms-3"></i>
                            <h2 class="card-title mb-0">الدعم الأكاديمي</h2>
                        </div>
                        <p class="card-text">
                            الوصول إلى الوثائق الإرشادية، الأدلة الأكاديمية، وموارد الدعم للطلاب وأعضاء هيئة التدريس
                        </p>
                        <div class="text-start">
                            <i class="bi bi-arrow-left-circle-fill text-primary fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="mt-5 pt-4 text-muted text-center">
        <div class="container">
            <p class="mb-1">© {{ date('Y') }} نظام متابعة التخرج</p>
            <p class="mb-0">الإصدار 1.0.0 · Laravel v{{ Illuminate\Foundation\Application::VERSION }}</p>
        </div>
    </footer>
</div>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
