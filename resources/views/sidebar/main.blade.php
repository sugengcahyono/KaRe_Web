{{-- @extends('sidebar.main')   --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Kartoharjo Recycle</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="../assets/img/kare.png">

    <!-- <link href="assets/img/kare.png" rel="icon"> -->
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Logis
  * Updated: Jan 29 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/logis-bootstrap-logistics-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <a href="{{ route('home') }}" class="logo d-flex align-items-center">


                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1>Kartoharjo Recycle</h1>
            </a>

            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="{{ route('home') }}" class="active">Beranda</a></li>
                    <li><a href="about.html" class="active">Tentang Kami</a></li>
                    <!-- <li><a href="services.html"></a></li> -->

                    <li class="dropdown"><a href="#" class="active"><span>Layanan</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                        <ul>
                            <li><a href="{{ route('layanankunjungan') }}" class="active">Layanan Kunjungan</a></li>
                            <li class="dropdown"><a href="{{ route('layanansampah') }}" class="active"><span>Layanan Sampah</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                                <ul>

                                    <li><a href="{{ route('layanansampah') }}">Penjemputan Sampah</a></li>
                                    <li><a href="{{ route('layanansampah') }}">Pembelian Pupuk</a></li>

                                </ul>

                            </li>
                            <li><a href="{{ route('layanantabungan') }}" class="active">Layanan Tabungan</a></li>
                            <!-- <li><a href="#">Drop Down 3</a></li>
                            <li><a href="#">Drop Down 4</a></li> -->
                        </ul>
                    <li><a href="{{ route('galeri') }}" class="active">Galeri</a></li>
                    </li>
                    <li><a href="{{ route('lokasi') }}" class="active">Lokasi</a></li>

                    <a class="login-blade" href="{{ route('login') }}">
                        <button type="submit" class="btn btn-success mb-2">
                            Login <span class="badge bg-white text-success"></span>
                        </button>
                        <!-- <button type="submit" class="btn btn-primary">Login</button> -->
                        <!-- Login -->
                        <!-- <div class="login-box"></div> -->
                    </a>
                    </li>


            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->
    <!-- End Header -->




    @yield('content')


    </div>




    </div>

    </div>
    </div>



    </div>


    <head>
        <!-- Add your head content here -->
    </head>



    <footer id="footer" class="footer">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-info">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span>TPST Kartoharjo</span>
                    </a>
                    <p>Jl. Mayjen Sutoyo No.59, Strenan, Kartoharjo, Kec. Nganjuk, Kabupaten Nganjuk, Jawa Timur 64416</p>
                </div>

                <div class="col-lg-7 col-md-12 d-flex justify-content-end">
                    <div class="copyright ms-auto">
                        &copy; Copyright <strong><span>Nama Kelompok</span></strong>. All Rights Reserved
                        <p>Designed by Nama Kelompok</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <!-- Add your scripts and other body content here -->
</body>

</html>


</footer><!-- End Footer -->
<!-- End Footer -->

<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- <div id="preloader"></div> -->

<!-- Vendor JS Files -->
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>