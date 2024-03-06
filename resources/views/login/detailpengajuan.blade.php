<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Kartoharjo Recycle</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/kare.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

  <!-- <link href="assets/css/style.css" rel="stylesheet"> -->

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jan 29 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/kare.png" alt="">
        <span class="d-none d-lg-block">Kartoharjo Recycle</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <!-- <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form> -->
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">


        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">Rama</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Kevin Anderson</h6>
              <span>Web Designer</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="beranda">
          <i class="bi bi-grid"></i>
          <span>Beranda</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link " href="users-profile.html">
          <i class="bi bi-people-fill"></i>
          <span>Kunjungan</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-faq.html">
          <i class="bi bi-wallet2"></i>
          <span>Tabungan</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->
    </ul>




    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Layanan Kunjungan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Beranda</a></li>
          <li class="breadcrumb-item">Layanan Kunjungan</li>
          <li class="breadcrumb-item active">Data Pengajuan</li>
        </ol>
      </nav>
      <!-- Main Content -->
      <main id="main" class="main">
        <!-- Section Content -->
        <section id="content" class="content">
          <!-- Row and Column -->
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <!-- Card Section -->
                <div class="card">
                  <!-- Page Title Section -->
                  <div class="page-title">
                    <h2>Daftar Formulir Pengajuan Kunjungan</h2>
                  </div><!-- End Page Title -->

                  <!-- Table with stripped rows -->
                  <table class="table datatable">
                    <thead>
                      <tr>
                        <th><b>No.</b></th>
                        <th>Nama</th>
                        <th>Tujuan Kedatangan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- PHP Loop to Populate Data -->

                      @foreach($data as $item)
                      <form method="POST" action="{{ route('formulirkunjungan', ['id' => $item->id]) }}">
                      <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->nama_kunjungan }}</td>
                        <td>{{ $item->tujuan_kunjungan }}</td>
                        <td>
                          <a href="{{ route('formulirkunjungan', ['id' => $item->id]) }}" class="btn btn-success btn-lihat" data-id="{{ $item->id }}" data-toggle="modal" data-target="#modal-lihat"><i class="bi bi-eye-fill"></i> Lihat</a>

                          <a href="{{ url('formulirkunjungan/'.$item->id.'/edit') }}" class="btn btn-warning"><i class="bi bi-pencil-fill"></i> Edit</a>

                          <a href="{{ url('formulirkunjungan/'.$item->id.'/delete') }}" class="btn btn-danger btn-hapus" data-id="{{ $item->id }}" data-toggle="modal" data-target="#modal-hapus"><i class="bi bi-trash-fill"></i> Hapus</a>
                        </td>
                      </tr>
                      @endforeach
                      <!-- End PHP Loop -->
                    </tbody>
                  </table><!-- End Table with stripped rows -->

                </div><!-- End Card -->
              </div>
            </div><!-- End Row and Column -->
          </div><!-- End Container -->
        </section><!-- End Section Content -->

      </main><!-- End Main -->

      <!-- Modal Detail -->
      <div class="modal fade" id="modal-lihat" tabindex="-1" role="dialog" aria-labelledby="modal-lihat-label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <!-- Isi modal detail formulir di sini -->
          </div>
        </div>
      </div>
      <!-- End Modal Detail -->

      <!-- Modal Hapus -->
      <div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="modal-hapus-label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <!-- Isi modal konfirmasi hapus formulir di sini -->
          </div>
        </div>
      </div>
      <!-- End Modal Hapus -->

      <!-- Footer Section -->
      <footer id="footer" class="footer">
        <!-- Footer Content -->
      </footer><!-- End Footer -->

      <!-- Back to Top Button -->
      <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

      <!-- Vendor JS Files -->
      <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- Additional Vendor JS Files -->
      <!-- ... -->

      <!-- Template Main JS File -->
      <script src="assets/js/main.js"></script>

      <!-- Additional Script for Modals -->
     
</body>

</html>