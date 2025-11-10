<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تأكيد البريد الإلكتروني</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            /*font-family: 'Tahoma', 'Arial', sans-serif;*/
            line-height: 1.8;
        }
        .card-body {
            font-size: 1.1rem;
        }
    </style>
</head>
<body class="bg-light">
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body p-5">
                    <!-- رسالة التأكيد -->
                    <div class="mb-4 text-muted">
                        شكرًا لتسجيلك! قبل البدء، يُرجى تأكيد عنوان بريدك الإلكتروني عن طريق النقر على الرابط الذي أرسلناه إليك. إذا لم تستلم البريد، سنرسل لك بريدًا آخر بكل سرور.
                    </div>

                    <!-- تنبيه إرسال رابط التأكيد -->
                    @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-success mb-4">
                            تم إرسال رابط تأكيد جديد إلى عنوان البريد الإلكتروني الذي قدمته أثناء التسجيل.
                        </div>
                    @endif

                    <!-- أزرار الإجراءات -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link text-decoration-none text-muted">
                                تسجيل الخروج
                            </button>
                        </form>

                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                إعادة إرسال بريد التأكيد
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
