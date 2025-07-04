<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?= esc($title ?? 'Garden Track') ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="<?php echo base_url(''); ?>logo.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">  

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    
    <!-- Libraries Stylesheet -->
    <link href="<?php echo base_url('tanaman/'); ?>lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url('tanaman/'); ?>lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?php echo base_url('tanaman/'); ?>lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo base_url('tanaman/'); ?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?php echo base_url('tanaman/'); ?>css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
        <a href="/" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h1 class="m-0">Garden Track</h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php 
            $uri = service('uri');
        ?>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <?php if (session()->get('logged_in')) : ?>
                    <a href="/user_page" class="nav-item nav-link <?= ($uri->getSegment(1) == 'user_page') ? 'active' : '' ?>">Home</a>
                    <a href="/services" class="nav-item nav-link <?= ($uri->getSegment(1) == 'services') ? 'active' : '' ?>">Layanan</a>
                    <a href="/kebun/semua-kebun" class="nav-item nav-link <?= ($uri->getSegment(1) == 'kebun/semua-kebun') ? 'active' : '' ?>">Kebun</a>
                    <a href="/plants" class="nav-item nav-link <?= ($uri->getSegment(1) == 'plants') ? 'active' : '' ?>">Tanaman</a>
                <?php else: ?>
                    <a href="/" class="nav-item nav-link">Home</a>
                    <a href="/services" class="nav-item nav-link">Layanan</a>
                <?php endif; ?>
                <?php if (session()->has('logged_in') && session('logged_in') === true) : ?>    
                    <?php
                        $profile = session()->get('profile') ?? 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png';
                        if (!filter_var($profile, FILTER_VALIDATE_URL)) {
                            $profile = base_url('uploads/profile/' . $profile);
                        }
                        $user = session()->get('id_user');
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img alt="" height="30" width="30" aria-hidden="true" src="<?= esc($profile) ?>">
                            <?php
                                if (session()->has('nama_users')) {
                                    echo session('nama_users'); 
                                } elseif (session()->has('email')) {
                                    echo session('email'); 
                                } else {
                                    echo "Profile"; 
                                }
                            ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/Pengguna/editProfile/<?php echo $user; ?>">Edit Profile</a></li>
                            <li><a class="dropdown-item" href="/kebun">Kebun Saya</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <!-- <li><a class="dropdown-item" href="#">Something else here</a></li> -->
                        </ul>
                    </li>
                <?php endif; ?>
            </div>
            <?php if (session()->get('logged_in')): ?>
                <a href="/logout" class="btn btn-primary py-4 px-lg-4 rounded-0 d-none d-lg-block">
                    Logout
                    <i class="fa fa-arrow-right ms-3"></i>
                </a>
            <?php else: ?>
                <a href="/login" class="btn btn-primary py-4 px-lg-4 rounded-0 d-none d-lg-block">
                    Login
                    <i class="fa fa-arrow-right ms-3"></i>
                </a>
            <?php endif; ?>
        </div>
    </nav>
    <!-- Navbar End -->

    <?php echo $this->renderSection('isi')?>

    <!-- Footer Start -->
    <?php if (!isset($noFooter) || !$noFooter): ?>
        <div class="container-fluid bg-dark text-light footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h4 class="text-white mb-4">Layanan</h4>
                        <a class="btn btn-link" href="/plants">Cari Tanaman</a>
                        <a class="btn btn-link" href="/kebun/semua-kebun">Lihat Kebun</a>
                        <a class="btn btn-link" href="/buat_kebun">Buat Taman Anda</a>
                        <a class="btn btn-link" href="/kebun">Kelola Taman Anda</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->
        <!-- Copyright Start -->
        <div class="container-fluid copyright py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Garden Track</a>, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a class="border-bottom" href="#">ZHINK</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- Copyright End -->
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url('tanaman/'); ?>lib/wow/wow.min.js"></script>
    <script src="<?php echo base_url('tanaman/'); ?>lib/easing/easing.min.js"></script>
    <script src="<?php echo base_url('tanaman/'); ?>lib/waypoints/waypoints.min.js"></script>
    <script src="<?php echo base_url('tanaman/'); ?>lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="<?php echo base_url('tanaman/'); ?>lib/counterup/counterup.min.js"></script>
    <script src="<?php echo base_url('tanaman/'); ?>lib/parallax/parallax.min.js"></script>
    <script src="<?php echo base_url('tanaman/'); ?>lib/isotope/isotope.pkgd.min.js"></script>
    <script src="<?php echo base_url('tanaman/'); ?>lib/lightbox/js/lightbox.min.js"></script>
    <!-- Template Javascript -->
    <script src="<?php echo base_url('tanaman/'); ?>js/main.js"></script>
</body>
</html>