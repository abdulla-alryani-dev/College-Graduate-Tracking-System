
@extends('layouts.app')

@section('content')

<style>
    /**
* Template Name: iLanding
* Template URL: https://bootstrapmade.com/ilanding-bootstrap-landing-page-template/
* Updated: Nov 12 2024 with Bootstrap v5.3.3
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/

/*--------------------------------------------------------------
# Font & Color Variables
# Help: https://bootstrapmade.com/color-system/
--------------------------------------------------------------*/
/* Fonts */
:root {
  --default-font: "Roboto",  system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
  --heading-font: "Nunito",  sans-serif;
  --nav-font: "Inter",  sans-serif;
}

/* Global Colors - The following color variables are used throughout the website. Updating them here will change the color scheme of the entire website */
:root {
  --background-color: #ffffff; /* Background color for the entire website, including individual sections */
  --default-color: #212529; /* Default color used for the majority of the text content across the entire website */
  --heading-color: #2d465e; /* Color for headings, subheadings and title throughout the website */
  --accent-color: #0d83fd; /* Accent color that represents your brand on the website. It's used for buttons, links, and other elements that need to stand out */
  --surface-color: #ffffff; /* The surface color is used as a background of boxed elements within sections, such as cards, icon boxes, or other elements that require a visual separation from the global background. */
  --contrast-color: #ffffff; /* Contrast color for text, ensuring readability against backgrounds of accent, heading, or default colors. */
}

/* Color Presets - These classes override global colors when applied to any section or element, providing reuse of the sam color scheme. */



/* Smooth scroll */
:root {
  scroll-behavior: smooth;
}

/*--------------------------------------------------------------
# General Styling & Shared Classes
--------------------------------------------------------------*/
body {
  color: var(--default-color);
  background-color: var(--background-color);
  font-family: var(--default-font);
}

a {
  color: var(--accent-color);
  text-decoration: none;
  transition: 0.3s;
}

a:hover {
  color: color-mix(in srgb, var(--accent-color), transparent 25%);
  text-decoration: none;
}

h1,
h2,
h3,
h4,
h5,
h6 {
  color: var(--heading-color);
  font-family: var(--heading-font);
}

/*--------------------------------------------------------------
# Global Section Titles
--------------------------------------------------------------*/
.section-title {
  text-align: center;
  padding-bottom: 60px;
  position: relative;
}

.section-title h2 {
  font-size: 32px;
  font-weight: 700;
  margin-bottom: 20px;
  padding-bottom: 20px;
  position: relative;
}

.section-title h2:after {
  content: "";
  position: absolute;
  display: block;
  width: 50px;
  height: 3px;
  background: var(--accent-color);
  left: 0;
  right: 0;
  bottom: 0;
  margin: auto;
}

.section-title p {
  margin-bottom: 0;
}

/*--------------------------------------------------------------
# Hero Section
--------------------------------------------------------------*/
.hero {
  position: relative;
  padding-top: 140px;
  margin-top: -23px;
  height: 100vh;
  background: linear-gradient(135deg, color-mix(in srgb, var(--accent-color), transparent 95%) 50%, color-mix(in srgb, var(--accent-color), transparent 98%) 25%, transparent 50%);
}

.hero::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: radial-gradient(circle at 90% 10%, color-mix(in srgb, var(--accent-color), transparent 92%), transparent 40%);
  pointer-events: none;
}

.hero .hero-content {
  position: relative;
  z-index: 1;
}

.hero .hero-content h1 {
  font-size: 3.5rem;
  font-weight: 700;
  line-height: 1.2;
  margin-bottom: 1.5rem;
}

.hero .hero-content h1 .accent-text {
  color: var(--accent-color);
}

@media (max-width: 992px) {
  .hero .hero-content {
    text-align: center;
    margin-bottom: 3rem;
  }

  .hero .hero-content h1 {
    font-size: 2.5rem;
  }

  .hero .hero-content .hero-buttons {
    justify-content: center;
  }
}

@media (max-width: 575px) {
  .hero .hero-content h1 {
    font-size: 2rem;
  }
}

.hero .company-badge {
  display: inline-flex;
  align-items: center;
  padding: 0.5rem 1rem;
  background-color: color-mix(in srgb, var(--accent-color), transparent 92%);
  border-radius: 50px;
  color: var(--accent-color);
  font-weight: 500;
}

.hero .company-badge i {
  font-size: 1.25rem;
}

.hero .btn-primary {
  background-color: var(--accent-color);
  border-color: var(--accent-color);
  color: var(--contrast-color);
  padding: 0.75rem 2.5rem;
  border-radius: 50px;
  font-weight: 500;
  transition: all 0.3s ease;
}

.hero .btn-primary:hover {
  background-color: color-mix(in srgb, var(--accent-color), black 20%);
  border-color: color-mix(in srgb, var(--accent-color), black 20%);
}

.hero .btn-link {
  color: var(--heading-color);
  text-decoration: none;
  font-weight: 500;
  transition: all 0.3s ease;
}

.hero .btn-link:hover {
  color: var(--accent-color);
}

.hero .btn-link i {
  font-size: 1.5rem;
  vertical-align: middle;
}

.hero .hero-image {
  position: relative;
  text-align: center;
  z-index: 1;
}

.hero .hero-image img {
  max-width: 100%;
  height: auto;
}

.hero .customers-badge {
  position: absolute;
  bottom: 10px;
  right: 30px;
  background-color: var(--surface-color);
  padding: 1rem;
  border-radius: 10px;
  box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
  max-width: 300px;
  animation: float-badge 3s ease-in-out infinite;
  will-change: transform;
}

.hero .customers-badge .customer-avatars {
  display: flex;
  align-items: center;
  margin-bottom: 0.5rem;
}

.hero .customers-badge .avatar {
  width: 35px;
  height: 35px;
  border-radius: 50%;
  border: 2px solid var(--surface-color);
  margin-left: -8px;
}

.hero .customers-badge .avatar:first-child {
  margin-left: 0;
}

.hero .customers-badge .avatar.more {
  background-color: var(--accent-color);
  color: var(--contrast-color);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.75rem;
  font-weight: 600;
}

.hero .customers-badge p {
  font-size: 0.875rem;
  color: color-mix(in srgb, var(--default-color), transparent 40%);
}

@media (max-width: 992px) {
  .hero .customers-badge {
    position: static;
    margin: 1rem auto;
    max-width: 250px;
  }
}

.hero .stats-row {
  position: relative;
  z-index: 1;
  margin-top: 5rem;
  background-color: var(--surface-color);
  border-radius: 20px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
  padding-bottom: 2rem;
}

.hero .stat-item {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding: 2rem;
}

.hero .stat-item .stat-icon {
  flex-shrink: 0;
  width: 64px;
  height: 64px;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: color-mix(in srgb, var(--accent-color), transparent 92%);
  border-radius: 50px;
  transition: 0.3s;
}

.hero .stat-item .stat-icon i {
  font-size: 1.5rem;
  color: var(--accent-color);
}

.hero .stat-item:hover .stat-icon {
  background-color: var(--accent-color);
}

.hero .stat-item:hover .stat-icon i {
  color: var(--contrast-color);
}

.hero .stat-item .stat-content {
  flex-grow: 1;
}

.hero .stat-item .stat-content h4 {
  font-size: 1.25rem;
  margin-bottom: 0.25rem;
  font-weight: 600;
}

.hero .stat-item .stat-content p {
  font-size: 0.875rem;
  color: color-mix(in srgb, var(--default-color), transparent 40%);
  margin: 0;
}

@media (max-width: 575px) {
  .hero .stat-item {
    padding: 1.5rem;
  }
}

@keyframes float-badge {
  0% {
    transform: translateY(0);
  }

  50% {
    transform: translateY(-10px);
  }

  100% {
    transform: translateY(0);
  }
}


/*
#card
*/
.order-card {
  color: #fff;
}

.bg-c-blue {
  background: linear-gradient(45deg,#4099ff,#73b4ff);
}

.bg-c-green {
  background: linear-gradient(45deg,#2ed8b6,#59e0c5);
}

.bg-c-yellow {
  background: linear-gradient(45deg,#FFB64D,#ffcb80);
}

.bg-c-pink {
  background: linear-gradient(45deg,#FF5370,#ff869a);
}


.card {
  border-radius: 5px;
  -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
  box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
  border: none;
  margin-bottom: 30px;
  -webkit-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}

.card .card-block {
  padding: 25px;
}

.order-card i {
  font-size: 26px;
}

.f-left {
  float: left;
}

.f-right {
  float: right;
}
</style>
<div id="content">

    <!-- Topbar -->

    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid p-0" dir="ltr">

        <!-- Page Heading -->


        <!-- Content Row -->


        <!-- Earnings (Monthly) Card Example -->
        <section id="hero" class="hero section">
            <div class="container">

                <div class="row align-items-center px-5">
                    <div class="col-lg-6">
                        <div class="hero-image">
                            <img src="{{ asset('img/welcome_graduates.png') }}" alt="Hero Image" class="img-fluid">


                        </div>
                    </div>
                    <div class="col-lg-6 " dir="rtl" >
                        <div class="hero-content">


                            <h1 class="mb-4">
                                مرحبا بكم <br>

                                <span class="accent-text">نظام متابعة الخريجين</span>
                            </h1>

                            <p class="mb-3 mb-md-3">
                                يهدف النظام الى جمع معلومات عن الخريجين وانتقالهم إلى سوق العمل ومدى
                                ملاءمتهم لحاجات هذا السوق.
                                ويعتبر هذا النظام مكونًا هامًا في مشروع سوق العمل وربطه ببرامج الجامعات
                                والكليات، يهدف إلى تحسين نوعية التعليم العالي ومحتواه، وجسر الفجوة بين
                                مؤسسات التعليم العالي وسوق العمل.
                            </p>
                            <div class="company-badge mb-6">
                                اخبرنا عن نفسك
                                <i class="bi bi-gear-fill ms-2"></i>
                            </div>

                        </div>
                    </div>


                </div>



            </div>

        </section><!-- /Hero Section -->



        <!-- Content Row -->



        <!-- Content Row -->

    </div>
    <!-- /.container-fluid -->

</div>
@endsection
