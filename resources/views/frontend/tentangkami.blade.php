@extends('sidebar.main')
@section('content')


<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">
    <div class="container">
        <div class="row gy-4 d-flex justify-content-between">
            <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            </div>
        </div>
        <div class="col-lg-5 order-1 order-lg-2" data-aos="zoom-out">
        </div>
    </div>
    </div>
</section><!-- End Hero Section -->

<main id="main">

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about pt-0">
        <div class="container" data-aos="fade-up">
            <div class="container">
                <div class="section-header">
                    <h2>TENTANG KAMI</h2>
                </div>

                <div class="row">
                    <div class="col-lg-6 order-last order-lg-first">
                        <h3>Struktur Organisasi</h3>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <img src="{{ asset('assets/img/struktur-organisasi.jpeg') }}" width="400" class="img-below-text">
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-lg-6 order-last order-lg-first">
                        <h3>Visi dan Misi</h3>

                        <h3>Visi</h3>
                        <p class="custom-justify">
                            "Kebersihan Kunci Keindahan Bersama"
                        </p>

                        <h3>Misi</h3>
                        <ol class="misi-list">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End About Us Section -->
    @endsection