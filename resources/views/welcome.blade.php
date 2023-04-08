<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8">
    <title>Silicon | Medical Landing</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="Silicon - Multipurpose Technology Bootstrap Template">
    <meta name="keywords"
        content="bootstrap, business, creative agency, mobile app showcase, saas, fintech, finance, online courses, software, medical, conference landing, services, e-commerce, shopping cart, multipurpose, shop, ui kit, marketing, seo, landing, blog, portfolio, html5, css3, javascript, gallery, slider, touch, creative">
    <meta name="author" content="Createx Studio">

    <!-- Viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon and Touch Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/landing/assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/landing/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/landing/assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="/landing/assets/favicon/site.webmanifest">
    <link rel="mask-icon" href="/landing/assets/favicon/safari-pinned-tab.svg" color="#6366f1">
    <link rel="shortcut icon" href="/landing/assets/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#080032">
    <meta name="msapplication-config" content="/landing/assets/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <!-- Vendor Styles -->
    <link rel="stylesheet" media="screen" href="/landing/assets/vendor/boxicons/css/boxicons.min.css" />
    <link rel="stylesheet" media="screen" href="/landing/assets/vendor/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" media="screen" href="/landing/assets/vendor/lightgallery/css/lightgallery-bundle.min.css" />

    <!-- Main Theme Styles + Bootstrap -->
    <link rel="stylesheet" media="screen" href="/landing/assets/css/theme.min.css">

    <!-- Page loading styles -->
    <style>
        .page-loading {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            -webkit-transition: all .4s .2s ease-in-out;
            transition: all .4s .2s ease-in-out;
            background-color: #fff;
            opacity: 0;
            visibility: hidden;
            z-index: 9999;
        }

        .dark-mode .page-loading {
            background-color: #0b0f19;
        }

        .page-loading.active {
            opacity: 1;
            visibility: visible;
        }

        .page-loading-inner {
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            text-align: center;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            -webkit-transition: opacity .2s ease-in-out;
            transition: opacity .2s ease-in-out;
            opacity: 0;
        }

        .page-loading.active>.page-loading-inner {
            opacity: 1;
        }

        .page-loading-inner>span {
            display: block;
            font-size: 1rem;
            font-weight: normal;
            color: #9397ad;
        }

        .dark-mode .page-loading-inner>span {
            color: #fff;
            opacity: .6;
        }

        .page-spinner {
            display: inline-block;
            width: 2.75rem;
            height: 2.75rem;
            margin-bottom: .75rem;
            vertical-align: text-bottom;
            border: .15em solid #b4b7c9;
            border-right-color: transparent;
            border-radius: 50%;
            -webkit-animation: spinner .75s linear infinite;
            animation: spinner .75s linear infinite;
        }

        .dark-mode .page-spinner {
            border-color: rgba(255, 255, 255, .4);
            border-right-color: transparent;
        }

        @-webkit-keyframes spinner {
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes spinner {
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
    </style>

    <!-- Theme mode -->
    <script>
        let mode = window.localStorage.getItem('mode'),
            root = document.getElementsByTagName('html')[0];
        if (mode !== null && mode === 'dark') {
            root.classList.add('dark-mode');
        } else {
            root.classList.remove('dark-mode');
        }
    </script>

    <!-- Page loading scripts -->
    <script>
        (function() {
            window.onload = function() {
                const preloader = document.querySelector('.page-loading');
                preloader.classList.remove('active');
                setTimeout(function() {
                    preloader.remove();
                }, 1000);
            };
        })();
    </script>

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                '../www.googletagmanager.com/gtm5445.html?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-WKV3GT5');
    </script>
</head>


<!-- Body -->

<body>

    <!-- Google Tag Manager (noscript)-->
    <noscript>
        <iframe src="http://www.googletagmanager.com/ns.html?id=GTM-WKV3GT5" height="0" width="0"
            style="display: none; visibility: hidden;"></iframe>
    </noscript>

    <!-- Page loading spinner -->
    <div class="page-loading active">
        <div class="page-loading-inner">
            <div class="page-spinner"></div><span>Loading...</span>
        </div>
    </div>


    <!-- Page wrapper for sticky footer -->
    <!-- Wraps everything except footer to push footer to the bottom of the page if there is little content -->
    <main class="page-wrapper">


        <!-- Navbar -->
        <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page -->
        <header class="header navbar navbar-expand-lg position-absolute navbar-sticky">
            <div class="container px-3">
                <a href="index.html" class="navbar-brand pe-3">
                    <img src="/landing/assets/img/logo.svg" width="47" alt="Silicon">
                    Silicon
                </a>
                <div id="navbarNav" class="offcanvas offcanvas-end">
                    <div class="offcanvas-header border-bottom">
                        <h5 class="offcanvas-title">Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a href="components/typography.html" class="nav-link">UI Kit</a>
                            </li>
                            <li class="nav-item">
                                <a href="docs/getting-started.html" class="nav-link">Docs</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>


        <!-- Hero -->
        <section class="position-relative pt-md-3 pt-lg-5 mb-md-3 mb-lg-5">
            <div class="container position-relative zindex-5 pt-5">
                <div class="row mt-4 pt-5">
                    <div class="col-xl-4 col-lg-5 text-center text-lg-start pb-3 pb-md-4 pb-lg-0">
                        <h1 class="fs-xl text-uppercase">Professional Dental Care</h1>
                        <h3 class="display-4 pb-md-2 pb-lg-4">We Take Care of Your Health</h3>
                    </div>
                    <div class="col-xl-5 col-lg-6 offset-xl-1 position-relative zindex-5 mb-5 mb-lg-0">
                        <div class="rellax card bg-primary border-0 shadow-primary py-2 p-sm-4 p-lg-5"
                            data-rellax-speed="-1" data-disable-parallax-down="lg">
                            <div class="card-body p-lg-3">
                                <h2 class="text-light pb-1 pb-md-3">Manigo Dental Care</h2>
                                <p class="fs-lg text-light pb-2 pb-md-0 mb-4 mb-md-5">Our medical center provides a
                                    wide range of health care services. We use only advanced technologies to keep your
                                    family happy and healthy, without any unexpected surprises. We appreciate your trust
                                    greatly. Our patients choose us and our services because they know we are the best.
                                </p>
                                <a href="#" class="btn btn-light btn-lg">
                                    About Us
                                    <i class="bx bx-right-arrow-alt lh-1 fs-4 ms-2 me-n2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-none d-lg-block" style="margin-top: -165px;"></div>
                <div class="row align-items-end">
                    <div class="col-lg-6 d-none d-lg-block">
                        <img src="/landing/assets/img/landing/medical/hero-img-2.jpg" class="rellax rounded-3"
                            alt="Image" data-rellax-speed="1.35" data-disable-parallax-down="md">
                    </div>
                    <div class="col-lg-6 d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <div class="d-flex align-items-center ps-xl-5 mb-4 mb-md-0">
                            <div class="btn btn-icon btn-secondary btn-lg pe-none rounded d-lg-none d-xl-inline-flex">
                                <i class="bx bx-time text-primary fs-3"></i>
                            </div>
                            <ul class="list-unstyled ps-3 ps-lg-0 ps-xl-3 mb-0">
                                <li><strong class="text-dark">Mon – Fri:</strong> 9:00 am – 22:00 pm</li>
                                <li><strong class="text-dark">Sat – Sun:</strong> 9:00 am – 20:00 pm</li>
                            </ul>
                        </div>
                        <a href="#" class="btn btn-primary btn-lg shadow-primary">Make an appointment</a>
                    </div>
                </div>
            </div>
            <div class="d-none d-lg-block position-absolute top-0 end-0 w-50 d-flex flex-column ps-3"
                style="height: calc(100% - 108px);">
                <div class="w-100 h-100 overflow-hidden bg-position-center bg-repeat-0 bg-size-cover"
                    style="background-image: url(/landing/assets/img/landing/medical/hero-img-1.jpg); border-bottom-left-radius: .5rem;">
                </div>
            </div>
        </section>


        <!-- Icon boxes (Features) -->
        <section class="container py-5 mb-2 mb-md-4 mb-lg-5">
            <div class="row row-cols-1 row-cols-md-3 g-4 pt-2 pt-md-4 pb-lg-2">

                <!-- Item -->
                <div class="col">
                    <div
                        class="card flex-column flex-sm-row flex-md-column flex-xxl-row align-items-center card-hover border-primary h-100">
                        <img src="/landing/assets/img/landing/medical/icons/doctor.svg" width="168"
                            alt="Doctor icon">
                        <div
                            class="card-body text-center text-sm-start text-md-center text-xxl-start pb-3 pb-sm-2 pb-md-3 pb-xxl-2">
                            <h3 class="h5 mb-2 mt-n4 mt-sm-0 mt-md-n4 mt-xxl-0">Find a Doctor</h3>
                            <p class="fs-sm mb-1">Search the right doctor by location and specialty.</p>
                            <a href="#" class="btn btn-link stretched-link px-0">
                                See all doctors
                                <i class="bx bx-right-arrow-alt fs-xl ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Item -->
                <div class="col">
                    <div
                        class="card flex-column flex-sm-row flex-md-column flex-xxl-row align-items-center card-hover border-primary h-100">
                        <img src="/landing/assets/img/landing/medical/icons/ambulance.svg" width="168"
                            alt="Ambulance icon">
                        <div
                            class="card-body text-center text-sm-start text-md-center text-xxl-start pb-3 pb-sm-2 pb-md-3 pb-xxl-2">
                            <h3 class="h5 mb-3 mt-n4 mt-sm-0 mt-md-n4 mt-xxl-0">Emergency Service</h3>
                            <p class="d-flex align-items-center text-nav fs-xl fw-medium mb-2">
                                <i class="bx bx-phone-call fs-4 text-muted me-1"></i>
                                (406) 555-0120
                            </p>
                            <a href="#" class="btn btn-link stretched-link px-0">
                                Contact us
                                <i class="bx bx-right-arrow-alt fs-xl ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Item -->
                <div class="col">
                    <div
                        class="card flex-column flex-sm-row flex-md-column flex-xxl-row align-items-center card-hover border-primary h-100">
                        <img src="/landing/assets/img/landing/medical/icons/virus.svg" width="168"
                            alt="Virus icon">
                        <div
                            class="card-body text-center text-sm-start text-md-center text-xxl-start pb-3 pb-sm-2 pb-md-3 pb-xxl-2">
                            <h3 class="h5 mb-2 mt-n4 mt-sm-0 mt-md-n4 mt-xxl-0">COVID-19 Info</h3>
                            <p class="fs-sm mb-1">We offer quick COVID-19 testing by appointment.</p>
                            <a href="#" class="btn btn-link stretched-link px-0">
                                Learn more
                                <i class="bx bx-right-arrow-alt fs-xl ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Video showreel -->
        <section class="container text-center pb-5 mb-3 mb-md-4 mb-lg-5">
            <h2 class="h1 pt-1 mb-4">See What Makes Us Different</h2>
            <div class="row justify-content-center mb-md-2 mb-lg-5">
                <div class="col-lg-6 col-md-8">
                    <p class="fs-lg text-muted mb-lg-0">Your best care begins here. Hurry up to get top health care
                        quality from leading doctors of the world.</p>
                </div>
            </div>
            <div class="position-relative rounded-3 overflow-hidden mb-lg-3">
                <div
                    class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center zindex-5">
                    <a href="https://www.youtube.com/watch?v=wJC1LFT_GD0"
                        class="btn btn-video btn-icon btn-xl stretched-link bg-white" data-bs-toggle="video">
                        <i class="bx bx-play"></i>
                    </a>
                </div>
                <span class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-35"></span>
                <img src="/landing/assets/img/landing/medical/video-cover.jpg" alt="Cover image">
            </div>
        </section>


        <!-- Services -->
        <section class="container pb-5 mb-md-2 mb-lg-5">
            <div class="row">
                <div class="col-lg-4 text-center text-lg-start pb-3 pb-lg-0 mb-4 mb-lg-0">
                    <h2 class="h1 mb-lg-4">Highly Innovative Technology &amp; Services</h2>
                    <p class="pb-4 mb-0 mb-lg-3">We appreciate your trust greatly. Our patients choose us and our
                        services because they know we are the best. We offer complete health care to individuals with
                        various health concerns.</p>
                    <a href="#" class="btn btn-primary shadow-primary btn-lg">All services</a>
                </div>
                <div class="col-xl-7 col-lg-8 offset-xl-1">
                    <div class="row row-cols-1 row-cols-md-2">
                        <div class="col">
                            <div class="card card-hover bg-secondary border-0 mb-4">
                                <div class="card-body d-flex align-items-start">
                                    <div class="flex-shrink-0 bg-light rounded-3 p-3">
                                        <img src="/landing/assets/img/landing/medical/services/cardiology.svg"
                                            width="28" alt="Icon">
                                    </div>
                                    <div class="ps-4">
                                        <h3 class="h5 pb-2 mb-1">Cardiology</h3>
                                        <p class="pb-2 mb-1">Id mollis consectetur congue egestas egestas suspendisse
                                            blandit justo.</p>
                                        <a href="services-single-v2.html" class="btn btn-link stretched-link px-0">
                                            Learn more
                                            <i class="bx bx-right-arrow-alt fs-xl ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-hover bg-secondary border-0 mb-4">
                                <div class="card-body d-flex align-items-start">
                                    <div class="flex-shrink-0 bg-light rounded-3 p-3">
                                        <img src="/landing/assets/img/landing/medical/services/scalpel.svg"
                                            width="28" alt="Icon">
                                    </div>
                                    <div class="ps-4">
                                        <h3 class="h5 pb-2 mb-1">Surgery</h3>
                                        <p class="pb-2 mb-1">Mattis urna ultricies non amet, purus in auctor non. Odio
                                            vulputate ac nibh.</p>
                                        <a href="services-single-v2.html" class="btn btn-link stretched-link px-0">
                                            Learn more
                                            <i class="bx bx-right-arrow-alt fs-xl ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-hover bg-secondary border-0 mb-4">
                                <div class="card-body d-flex align-items-start">
                                    <div class="flex-shrink-0 bg-light rounded-3 p-3">
                                        <img src="/landing/assets/img/landing/medical/services/x-ray.svg"
                                            width="28" alt="Icon">
                                    </div>
                                    <div class="ps-4">
                                        <h3 class="h5 pb-2 mb-1">Radiology</h3>
                                        <p class="pb-2 mb-1">Faucibus cursus maecenas lorem cursus nibh.</p>
                                        <a href="services-single-v2.html" class="btn btn-link stretched-link px-0">
                                            Learn more
                                            <i class="bx bx-right-arrow-alt fs-xl ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card card-hover bg-secondary border-0 mb-4">
                                <div class="card-body d-flex align-items-start">
                                    <div class="flex-shrink-0 bg-light rounded-3 p-3">
                                        <img src="/landing/assets/img/landing/medical/services/stethoscope.svg"
                                            width="28" alt="Icon">
                                    </div>
                                    <div class="ps-4">
                                        <h3 class="h5 pb-2 mb-1">Family Medicine</h3>
                                        <p class="pb-2 mb-1">Augue pulvinar justo, fermentum fames aliquam.</p>
                                        <a href="services-single-v2.html" class="btn btn-link stretched-link px-0">
                                            Learn more
                                            <i class="bx bx-right-arrow-alt fs-xl ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-hover bg-secondary border-0 mb-4">
                                <div class="card-body d-flex align-items-start">
                                    <div class="flex-shrink-0 bg-light rounded-3 p-3">
                                        <img src="/landing/assets/img/landing/medical/services/lungs.svg"
                                            width="28" alt="Icon">
                                    </div>
                                    <div class="ps-4">
                                        <h3 class="h5 pb-2 mb-1">Pulmonary</h3>
                                        <p class="pb-2 mb-1">Ullamcorper in magna varius quisque enim tempor iaculis
                                            proin sed.</p>
                                        <a href="services-single-v2.html" class="btn btn-link stretched-link px-0">
                                            Learn more
                                            <i class="bx bx-right-arrow-alt fs-xl ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-hover bg-secondary border-0 mb-4">
                                <div class="card-body d-flex align-items-start">
                                    <div class="flex-shrink-0 bg-light rounded-3 p-3">
                                        <img src="/landing/assets/img/landing/medical/services/tooth.svg"
                                            width="28" alt="Icon">
                                    </div>
                                    <div class="ps-4">
                                        <h3 class="h5 pb-2 mb-1">Dental Care</h3>
                                        <p class="pb-2 mb-1">Faucibus cursus maecenas lorem cursus nibh. Sociis sit
                                            facilisis dolor arcu.</p>
                                        <a href="services-single-v2.html" class="btn btn-link stretched-link px-0">
                                            Learn more
                                            <i class="bx bx-right-arrow-alt fs-xl ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Team -->
        <section class="container pt-xl-2 pb-5 mb-md-3 mb-lg-5">
            <div
                class="d-md-flex align-items-center justify-content-between text-center text-md-start pb-1 pb-lg-0 mb-4 mb-lg-5">
                <h2 class="h1 mb-md-0">Qualified Medical Specialists</h2>
            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">

                <!-- Item -->
                <div class="col">
                    <div class="card card-hover border-0 bg-transparent">
                        <div class="position-relative">
                            <img src="/landing/assets/img/team/16.jpg" class="rounded-3" alt="Dr. Ronald Richards">
                            <div
                                class="card-img-overlay d-flex flex-column align-items-center justify-content-center rounded-3">
                                <span
                                    class="position-absolute top-0 start-0 w-100 h-100 bg-primary opacity-35 rounded-3"></span>
                                <div class="position-relative d-flex zindex-2">
                                    <a href="#"
                                        class="btn btn-icon btn-secondary btn-facebook btn-sm bg-white me-2">
                                        <i class="bx bxl-facebook"></i>
                                    </a>
                                    <a href="#"
                                        class="btn btn-icon btn-secondary btn-linkedin btn-sm bg-white me-2">
                                        <i class="bx bxl-linkedin"></i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-secondary btn-twitter btn-sm bg-white">
                                        <i class="bx bxl-twitter"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center p-3">
                            <h3 class="fs-lg fw-semibold pt-1 mb-2">Dr. Ronald Richards</h3>
                            <p class="fs-sm mb-2">Neurosurgeon</p>
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="text-nowrap me-1">
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                </div>
                                <span class="fs-xs text-muted">(19 reviews)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item -->
                <div class="col">
                    <div class="card card-hover border-0 bg-transparent">
                        <div class="position-relative">
                            <img src="/landing/assets/img/team/17.jpg" class="rounded-3" alt="Dr. Esther Howard">
                            <div
                                class="card-img-overlay d-flex flex-column align-items-center justify-content-center rounded-3">
                                <span
                                    class="position-absolute top-0 start-0 w-100 h-100 bg-primary opacity-35 rounded-3"></span>
                                <div class="position-relative d-flex zindex-2">
                                    <a href="#"
                                        class="btn btn-icon btn-secondary btn-facebook btn-sm bg-white me-2">
                                        <i class="bx bxl-facebook"></i>
                                    </a>
                                    <a href="#"
                                        class="btn btn-icon btn-secondary btn-linkedin btn-sm bg-white me-2">
                                        <i class="bx bxl-linkedin"></i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-secondary btn-twitter btn-sm bg-white">
                                        <i class="bx bxl-twitter"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center p-3">
                            <h3 class="fs-lg fw-semibold pt-1 mb-2">Dr. Esther Howard</h3>
                            <p class="fs-sm mb-2">Therapist</p>
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="text-nowrap me-1">
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                </div>
                                <span class="fs-xs text-muted">(4 reviews)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item -->
                <div class="col">
                    <div class="card card-hover border-0 bg-transparent">
                        <div class="position-relative">
                            <img src="/landing/assets/img/team/18.jpg" class="rounded-3" alt="Dr. Jerome Bell">
                            <div
                                class="card-img-overlay d-flex flex-column align-items-center justify-content-center rounded-3">
                                <span
                                    class="position-absolute top-0 start-0 w-100 h-100 bg-primary opacity-35 rounded-3"></span>
                                <div class="position-relative d-flex zindex-2">
                                    <a href="#"
                                        class="btn btn-icon btn-secondary btn-facebook btn-sm bg-white me-2">
                                        <i class="bx bxl-facebook"></i>
                                    </a>
                                    <a href="#"
                                        class="btn btn-icon btn-secondary btn-linkedin btn-sm bg-white me-2">
                                        <i class="bx bxl-linkedin"></i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-secondary btn-twitter btn-sm bg-white">
                                        <i class="bx bxl-twitter"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center p-3">
                            <h3 class="fs-lg fw-semibold pt-1 mb-2">Dr. Jerome Bell</h3>
                            <p class="fs-sm mb-2">Anesthesiologist</p>
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="text-nowrap me-1">
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                    <i class="bx bx-star text-muted fs-sm opacity-75"></i>
                                </div>
                                <span class="fs-xs text-muted">(12 reviews)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item -->
                <div class="col">
                    <div class="card card-hover border-0 bg-transparent">
                        <div class="position-relative">
                            <img src="/landing/assets/img/team/19.jpg" class="rounded-3" alt="Dr. Ralph Edwards">
                            <div
                                class="card-img-overlay d-flex flex-column align-items-center justify-content-center rounded-3">
                                <span
                                    class="position-absolute top-0 start-0 w-100 h-100 bg-primary opacity-35 rounded-3"></span>
                                <div class="position-relative d-flex zindex-2">
                                    <a href="#"
                                        class="btn btn-icon btn-secondary btn-facebook btn-sm bg-white me-2">
                                        <i class="bx bxl-facebook"></i>
                                    </a>
                                    <a href="#"
                                        class="btn btn-icon btn-secondary btn-linkedin btn-sm bg-white me-2">
                                        <i class="bx bxl-linkedin"></i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-secondary btn-twitter btn-sm bg-white">
                                        <i class="bx bxl-twitter"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center p-3">
                            <h3 class="fs-lg fw-semibold pt-1 mb-2">Dr. Ralph Edwards</h3>
                            <p class="fs-sm mb-2">Surgeon</p>
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="text-nowrap me-1">
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                </div>
                                <span class="fs-xs text-muted">(8 reviews)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item -->
                <div class="col">
                    <div class="card card-hover border-0 bg-transparent">
                        <div class="position-relative">
                            <img src="/landing/assets/img/team/20.jpg" class="rounded-3" alt="Dr. Darrell Steward">
                            <div
                                class="card-img-overlay d-flex flex-column align-items-center justify-content-center rounded-3">
                                <span
                                    class="position-absolute top-0 start-0 w-100 h-100 bg-primary opacity-35 rounded-3"></span>
                                <div class="position-relative d-flex zindex-2">
                                    <a href="#"
                                        class="btn btn-icon btn-secondary btn-facebook btn-sm bg-white me-2">
                                        <i class="bx bxl-facebook"></i>
                                    </a>
                                    <a href="#"
                                        class="btn btn-icon btn-secondary btn-linkedin btn-sm bg-white me-2">
                                        <i class="bx bxl-linkedin"></i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-secondary btn-twitter btn-sm bg-white">
                                        <i class="bx bxl-twitter"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center p-3">
                            <h3 class="fs-lg fw-semibold pt-1 mb-2">Dr. Darrell Steward</h3>
                            <p class="fs-sm mb-2">Cardiologist</p>
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="text-nowrap me-1">
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                    <i class="bx bx-star text-muted fs-sm opacity-75"></i>
                                </div>
                                <span class="fs-xs text-muted">(14 reviews)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item -->
                <div class="col">
                    <div class="card card-hover border-0 bg-transparent">
                        <div class="position-relative">
                            <img src="/landing/assets/img/team/21.jpg" class="rounded-3" alt="Dr. Annette Black">
                            <div
                                class="card-img-overlay d-flex flex-column align-items-center justify-content-center rounded-3">
                                <span
                                    class="position-absolute top-0 start-0 w-100 h-100 bg-primary opacity-35 rounded-3"></span>
                                <div class="position-relative d-flex zindex-2">
                                    <a href="#"
                                        class="btn btn-icon btn-secondary btn-facebook btn-sm bg-white me-2">
                                        <i class="bx bxl-facebook"></i>
                                    </a>
                                    <a href="#"
                                        class="btn btn-icon btn-secondary btn-linkedin btn-sm bg-white me-2">
                                        <i class="bx bxl-linkedin"></i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-secondary btn-twitter btn-sm bg-white">
                                        <i class="bx bxl-twitter"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center p-3">
                            <h3 class="fs-lg fw-semibold pt-1 mb-2">Dr. Annette Black</h3>
                            <p class="fs-sm mb-2">Pediatrician</p>
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="text-nowrap me-1">
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                    <i class="bx bx-star text-muted fs-sm opacity-75"></i>
                                </div>
                                <span class="fs-xs text-muted">(10 reviews)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item -->
                <div class="col">
                    <div class="card card-hover border-0 bg-transparent">
                        <div class="position-relative">
                            <img src="/landing/assets/img/team/22.jpg" class="rounded-3" alt="Dr. Dianne Russell">
                            <div
                                class="card-img-overlay d-flex flex-column align-items-center justify-content-center rounded-3">
                                <span
                                    class="position-absolute top-0 start-0 w-100 h-100 bg-primary opacity-35 rounded-3"></span>
                                <div class="position-relative d-flex zindex-2">
                                    <a href="#"
                                        class="btn btn-icon btn-secondary btn-facebook btn-sm bg-white me-2">
                                        <i class="bx bxl-facebook"></i>
                                    </a>
                                    <a href="#"
                                        class="btn btn-icon btn-secondary btn-linkedin btn-sm bg-white me-2">
                                        <i class="bx bxl-linkedin"></i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-secondary btn-twitter btn-sm bg-white">
                                        <i class="bx bxl-twitter"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center p-3">
                            <h3 class="fs-lg fw-semibold pt-1 mb-2">Dr. Dianne Russell</h3>
                            <p class="fs-sm mb-2">Dentist</p>
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="text-nowrap me-1">
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                </div>
                                <span class="fs-xs text-muted">(5 reviews)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item -->
                <div class="col">
                    <div class="card card-hover border-0 bg-transparent">
                        <div class="position-relative">
                            <img src="/landing/assets/img/team/23.jpg" class="rounded-3" alt="Dr. Courtney Henry">
                            <div
                                class="card-img-overlay d-flex flex-column align-items-center justify-content-center rounded-3">
                                <span
                                    class="position-absolute top-0 start-0 w-100 h-100 bg-primary opacity-35 rounded-3"></span>
                                <div class="position-relative d-flex zindex-2">
                                    <a href="#"
                                        class="btn btn-icon btn-secondary btn-facebook btn-sm bg-white me-2">
                                        <i class="bx bxl-facebook"></i>
                                    </a>
                                    <a href="#"
                                        class="btn btn-icon btn-secondary btn-linkedin btn-sm bg-white me-2">
                                        <i class="bx bxl-linkedin"></i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-secondary btn-twitter btn-sm bg-white">
                                        <i class="bx bxl-twitter"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center p-3">
                            <h3 class="fs-lg fw-semibold pt-1 mb-2">Dr. Courtney Henry</h3>
                            <p class="fs-sm mb-2">Gynecologist</p>
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="text-nowrap me-1">
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                    <i class="bx bxs-star text-warning fs-sm"></i>
                                </div>
                                <span class="fs-xs text-muted">(16 reviews)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Contacts -->
        <section class="container pb-5 mb-1 mb-md-4 mb-lg-5">
            <div class="row pb-xl-3">
                <div class="col-md-6 pb-2 pb-md-0 mb-4 mb-md-0">
                    <div class="gallery rounded-3 shadow-sm">
                        <a href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d17239.8060668495!2d-122.43668227971098!3d37.741526659411576!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808f7e1259a3ed73%3A0xaae7371cd8db1e38!2sNoe%20Valley%20Bakery!5e0!3m2!1sen!2sua!4v1637757959377!5m2!1sen!2sua"
                            data-iframe="true" class="gallery-item rounded-3"
                            data-sub-html='<h6 class="fs-sm text-light">Noe Valley Bakery 24th Street, San Francisco, CA, USA</h6>'>
                            <i
                                class="bx bxs-map text-primary display-5 position-absolute top-50 start-50 translate-middle mb-0"></i>
                            <img src="/landing/assets/img/landing/medical/map.jpg" alt="Map cover">
                            <div class="gallery-item-caption fs-sm fw-medium">Expand the map</div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-5 col-md-6 offset-xl-1">
                    <h2 class="h1 pb-4 mb-1 mb-lg-3">Get Free Professional Consultation</h2>
                    <ul class="list-unstyled pb-3 mb-0 mb-lg-3">
                        <li class="d-flex mb-3">
                            <i class="bx bx-map text-muted fs-xl mt-1 me-2"></i>
                            Noe Valley Bakery 24th Street, San Francisco, CA, USA
                        </li>
                        <li class="d-flex mb-3">
                            <i class="bx bx-phone-call text-muted fs-xl mt-1 me-2"></i>
                            (406) 555-0120
                        </li>
                        <li class="d-flex mb-3">
                            <i class="bx bx-time text-muted fs-xl mt-1 me-2"></i>
                            <div>
                                <div><span class="text-dark fw-semibold me-1">Mon – Fri:</span>9:00 am – 22:00 pm
                                </div>
                                <div><span class="text-dark fw-semibold me-1">Sat – Sun:</span>9:00 am – 20:00 pm
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-3">
                            <i class="bx bx-envelope text-muted fs-xl mt-1 me-2"></i>
                            example@email.com
                        </li>
                    </ul>
                    <a href="#" class="btn btn-primary shadow-primary btn-lg">Make an appointment</a>
                </div>
            </div>
        </section>
    </main>


    <!-- Footer -->
    <footer class="footer bg-secondary pt-5 pb-4 pb-lg-5">
        <div class="container pt-lg-4">
            <div class="row pb-5">
                <div class="col-lg-4 col-md-6">
                    <div class="navbar-brand text-dark p-0 me-0 mb-3 mb-lg-4">
                        <img src="/landing/assets/img/logo.svg" width="47" alt="Silicon">
                        Silicon
                    </div>
                    <p class="fs-sm pb-lg-3 mb-4">Proin ipsum pharetra, senectus eget scelerisque varius pretium
                        platea velit. Lacus, eget eu vitae nullam proin turpis etiam mi sit. Non feugiat feugiat egestas
                        nulla nec. Arcu tempus, eget elementum dolor ullamcorper sodales ultrices eros.</p>
                    <form class="needs-validation" novalidate>
                        <label for="subscr-email" class="form-label">Subscribe to our newsletter</label>
                        <div class="input-group">
                            <input type="email" id="subscr-email" class="form-control rounded-start ps-5"
                                placeholder="Your email" required>
                            <i
                                class="bx bx-envelope fs-lg text-muted position-absolute top-50 start-0 translate-middle-y ms-3 zindex-5"></i>
                            <div class="invalid-tooltip position-absolute top-100 start-0">Please provide a valid
                                email address.</div>
                            <button type="submit" class="btn btn-primary">Subscribe</button>
                        </div>
                    </form>
                </div>
                <div class="col-xl-6 col-lg-7 col-md-5 offset-xl-2 offset-md-1 pt-4 pt-md-1 pt-lg-0">
                    <div id="footer-links" class="row">
                        <div class="col-lg-4">
                            <h6 class="mb-2">
                                <a href="#useful-links" class="d-block text-dark dropdown-toggle d-lg-none py-2"
                                    data-bs-toggle="collapse">Useful Links</a>
                            </h6>
                            <div id="useful-links" class="collapse d-lg-block" data-bs-parent="#footer-links">
                                <ul class="nav flex-column pb-lg-1 mb-lg-3">
                                    <li class="nav-item"><a href="#"
                                            class="nav-link d-inline-block px-0 pt-1 pb-2">Home</a></li>
                                    <li class="nav-item"><a href="#"
                                            class="nav-link d-inline-block px-0 pt-1 pb-2">About</a></li>
                                    <li class="nav-item"><a href="#"
                                            class="nav-link d-inline-block px-0 pt-1 pb-2">Services</a></li>
                                    <li class="nav-item"><a href="#"
                                            class="nav-link d-inline-block px-0 pt-1 pb-2">Prices</a></li>
                                    <li class="nav-item"><a href="#"
                                            class="nav-link d-inline-block px-0 pt-1 pb-2">News</a></li>
                                </ul>
                                <ul class="nav flex-column mb-2 mb-lg-0">
                                    <li class="nav-item"><a href="#"
                                            class="nav-link d-inline-block px-0 pt-1 pb-2">Terms &amp; Conditions</a>
                                    </li>
                                    <li class="nav-item"><a href="#"
                                            class="nav-link d-inline-block px-0 pt-1 pb-2">Privacy Policy</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-3">
                            <h6 class="mb-2">
                                <a href="#social-links" class="d-block text-dark dropdown-toggle d-lg-none py-2"
                                    data-bs-toggle="collapse">Socials</a>
                            </h6>
                            <div id="social-links" class="collapse d-lg-block" data-bs-parent="#footer-links">
                                <ul class="nav flex-column mb-2 mb-lg-0">
                                    <li class="nav-item"><a href="#"
                                            class="nav-link d-inline-block px-0 pt-1 pb-2">Facebook</a></li>
                                    <li class="nav-item"><a href="#"
                                            class="nav-link d-inline-block px-0 pt-1 pb-2">LinkedIn</a></li>
                                    <li class="nav-item"><a href="#"
                                            class="nav-link d-inline-block px-0 pt-1 pb-2">Twitter</a></li>
                                    <li class="nav-item"><a href="#"
                                            class="nav-link d-inline-block px-0 pt-1 pb-2">Instagram</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-5 pt-2 pt-lg-0">
                            <h6 class="mb-2">Contact Us</h6>
                            <a href="mailto:email@example.com" class="fw-medium">email@example.com</a>
                        </div>
                    </div>
                </div>
            </div>
            <p class="nav d-block fs-xs text-center text-md-start pb-2 pb-lg-0 mb-0">
                &copy; All rights reserved. Made by
                <a class="nav-link d-inline-block p-0" href="https://createx.studio/" target="_blank"
                    rel="noopener">Createx Studio</a>
            </p>
        </div>
    </footer>


    <!-- Back to top button -->
    <a href="#top" class="btn-scroll-top" data-scroll>
        <span class="btn-scroll-top-tooltip text-muted fs-sm me-2">Top</span>
        <i class="btn-scroll-top-icon bx bx-chevron-up"></i>
    </a>


    <!-- Vendor Scripts -->
    <script src="/landing/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/landing/assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
    <script src="/landing/assets/vendor/rellax/rellax.min.js"></script>
    <script src="/landing/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="/landing/assets/vendor/lightgallery/lightgallery.min.js"></script>
    <script src="/landing/assets/vendor/lightgallery/plugins/fullscreen/lg-fullscreen.min.js"></script>
    <script src="/landing/assets/vendor/lightgallery/plugins/zoom/lg-zoom.min.js"></script>
    <script src="/landing/assets/vendor/lightgallery/plugins/video/lg-video.min.js"></script>

    <!-- Main Theme Script -->
    <script src="/landing/assets/js/theme.min.js"></script>
</body>

</html>
