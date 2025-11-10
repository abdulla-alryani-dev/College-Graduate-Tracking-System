<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Laravel Roles')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <style>
        .navbar-brand {
            margin-right: auto !important;
        }
        .nav-item {
            margin-left: 15px;
        }
        /* Add padding to body to prevent content hiding */
        body {
            padding-top: 80px;
        }
        /* Fixed navbar styling */
        .fixed-nav {
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1030;
        }
    </style>
</head>

<body>


<!-- Fixed Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container-fluid">
        <!-- Logo Section -->
        <a class="navbar-brand" href="#">
                <svg width="30" height="30" viewBox="0 0 40 40" style="margin-left: 10px;">
                    <path d="M20 2L3 8v14c0 6.4 4.346 12.866 17 18 12.654-5.134 17-11.6 17-18V8L20 2z" fill="#2c3e50"/>
                    <path d="M20 25.5a6.5 6.5 0 1 1 0-13 6.5 6.5 0 0 1 0 13z" fill="#3498db"/>
                    <path d="M20 19.5l2.5 2.5-5 5-2.5-2.5 5-5z" fill="#fff"/>
                </svg>
                 إدارة الصلاحيات والأدوار

        </a>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Items -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">

                <!-- Dashboard Link -->
                <li class="nav-item">
                    <a class="nav-link" href="{{route('dashboard')}}">لوحة التحكم</a>
                </li>

                <!-- Logout Button -->
                <li class="nav-item">
                    <button class="btn btn-outline-danger">تسجيل الخروج</button>
                </li>


            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid">
    @yield('content')
</div>



</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</html>
