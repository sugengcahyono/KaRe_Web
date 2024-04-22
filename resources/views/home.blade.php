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

  <!-- ======= Featured Services Section ======= -->
  <section id="featured-services" class="featured-services">
    <div class="container">

      <div class="row gy-4">

      </div>

    </div>
  </section><!-- End Featured Services Section -->

  <!-- ======= About Us Section ======= -->
  <section id="about" class="about pt-0">
    <div class="container" data-aos="fade-up">

      <div class="row gy-4">
        <div class="col-lg-6 position-relative align-self-start order-lg-last order-first">
          <img src="{{ asset('assets/img/kegiatan1.jpeg') }}" width="400" style="float:right; margin-left: 5px">

          <!-- <img src="assets/img/kegiatan1.jpeg" class="img-fluid" alt=""> -->
          <!-- <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ"></a> -->
        </div>
        <div class="col-lg-6 content order-last  order-lg-first">
          <h3>Apa itu Kartoharjo Recycle?</h3>
          <p class="custom-justify">
            Kartoharjo Recycle hadir sebagai platform digital inovatif untuk memudahkan pengelolaan serta pengaksesan informasi yang dimiliki oleh Tempat Pengelolaan Sampah Terpadu (TPST) Kartoharjo. Terdiri dari aplikasi mobile khusus admin dan website yang mudah diakses umum oleh pengguna.
          </p>
          <p class="custom-justify">
            Aplikasi Mobile Kartoharjo Recycle memungkinkan admin untuk data sampah yang tekumpul, mengelola tabungan sampah milik nasabah, melakukan konfirmasi kunjungan, melakukan update kegiatan serta penjualan pupuk. Di sisi lain, Website Kartoharjo Recycle memberikan informasi mengenai penjualan pupuk serta penjemputan sampaha, kegiatan yang terselenggarakan, melihat data saldo tabungan sampah yang terkumpul dari hasil menabung sampah, melakukan pengajuan kunjungan.
          </p>
          <p class="custom-justify">
            Dengan terintegrasinya kedua platform tersebut, menjadi sebuah solusi terpadu untuk meningkatkan partisipasi masyarakat dalam daur ulang sampah seta mewujudkan lingkungan yang bersih dan berkelanjutan di Kelurahan Kartoharjo
          </p>

        </div>
      </div>

    </div>
  </section><!-- End About Us Section -->

  <!-- ======= Services Section ======= -->
  <section id="service" class="services pt-0">
    <div class="container" data-aos="fade-up">

      <div class="section-header">
        <h2>LAYANAN</h2>
      </div>

      <div class="row gy-4">

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
          <div class="card">
            <div class="card-img">
              <img src="assets/img/kegiatan3.jpeg" alt="" class="img-fluid">
            </div>
            <h3><a href="{{ route('layanansampah') }}" class="stretched-link ">Layanan Pengelolaan Sampah</a></h3>
            <p class="custom-justify">Layanan pengelolaan sampah memiliki 2 sub layanan yaitu layanan penjemputan sampah serta layanan pembelian pupuk.</p>

          </div>
        </div><!-- End Card Item -->

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
          <div class="card">
            <div class="card-img">
              <img src="assets/img/kegiatan3.jpeg" alt="" class="img-fluid">
            </div>
            <h3><a href="{{ route('layanankunjungan') }}" class="stretched-link">Layanan Kunjungan</a></h3>
            <p class="custom-justify">Layanan kunjungan merupakan program yang dapat digunakan oleh pengguna untuk melakukan pengajuan kunjungan sebelum datang ke TPST Kartoharjo.</p>
          </div>
        </div><!-- End Card Item -->

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
          <div class="card">
            <div class="card-img">
              <img src="assets/img/kegiatan3.jpeg" alt="" class="img-fluid">
            </div>
            <h3><a href="{{ route('layanantabungan') }}" class="stretched-link">Layanan Tabungan</a></h3>
            <p class="custom-justify">
              Layanan tabungan sampah merupakan kegiatan menabung sampah yang sudah dipilah sesuai jenisnya, sampah yang ditabung akan ditimbang, dan hasil penimbangan akan dikonversikan ke dalam rupiah.
            </p>

          </div>
        </div><!-- End Card Item -->

      </div>

    </div>
  </section><!-- End Services Section -->

  
  <!-- ======= Features Section ======= -->

  <div class="section-header">
    <h2>KEGIATAN</h2>

  </div>

  <section id="features" class="features">
    <div class="container">

      <div class="row gy-4 align-items-center features-item" data-aos="fade-up">

        <div class="col-md-5">
          <img src="assets/img/kegiatan2.jpeg" class="img-fluid" alt="">
        </div>
        <div class="col-md-7">
          <h3>Pengumpulan Sampah</h3>
          <p class="fst-serif custom-justify">
            Pengumpulan sampah adalah proses pengambilan limbah dari rumah tangga, area komersial, dan industri oleh layanan pengelola sampah. Sampah diangkut menggunakan kendaraan khusus ke tempat pemrosesan seperti Tempat Pemrosesan Sampah Terpadu (TPST) atau fasilitas daur ulang. Penduduk mungkin diminta untuk memilah sampah. Di tempat pemrosesan, sampah diolah untuk mengurangi volume, menghasilkan energi, atau didaur ulang. Pematuhan terhadap prosedur pengumpulan yang ditetapkan oleh otoritas setempat penting untuk manajemen limbah yang efektif dan berkelanjutan.
          </p>

        </div>
      </div><!-- Features Item -->

      <div class="row gy-4 align-items-center features-item" data-aos="fade-up">
        <div class="col-md-5 order-1 order-md-2">
          <img src="assets/img/kegiatan2.jpeg" class="img-fluid" alt="">
        </div>
        <div class="col-md-7 order-2 order-md-1">
          <h3>Daur Ulang</h3>
          <p class="fst-serif custom-justify">
            Daur ulang sampah adalah proses konversi limbah menjadi produk baru untuk mengurangi limbah yang masuk ke tempat pembuangan sampah. Ini melibatkan pengumpulan, pemilahan, dan pembersihan limbah, diikuti oleh pemrosesan untuk menghasilkan bahan baku. Bahan tersebut kemudian digunakan untuk membuat produk daur ulang seperti kertas, plastik, atau logam. Daur ulang membantu mengurangi penggunaan sumber daya alam, energi, dan volume limbah, serta berkontribusi pada keberlanjutan lingkungan. Kesadaran masyarakat terhadap daur ulang adalah kunci dalam menciptakan lingkungan yang lebih berkelanjutan.
          </p>
        </div>
      </div><!-- Features Item -->

      <div class="row gy-4 align-items-center features-item" data-aos="fade-up">
        <div class="col-md-5">
          <img src="assets/img/kegiatan2.jpeg" class="img-fluid" alt="">
        </div>
        <div class="col-md-7">
          <h3>Pengelolaan Pupuk</h3>
          <p class="fst-serif custom-justify">
            Pengelolaan sampah menjadi pupuk melibatkan pengomposan atau fermentasi bahan organik dari sampah untuk menghasilkan pupuk kompos. Melalui proses ini, sisa-sisa makanan, daun kering, atau limbah pertanian diurai oleh mikroorganisme menjadi humus yang kaya nutrisi. Pupuk kompos yang dihasilkan dapat digunakan sebagai pembenah tanah, mengurangi volume sampah di tempat pembuangan, serta mendukung konsep daur ulang dan pertanian berkelanjutan.</p>
          <p>
        </div>

      </div><!-- Features Item -->
</main><!-- End #main -->

@endsection