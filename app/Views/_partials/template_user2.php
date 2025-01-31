<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Garden Track</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">  

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="user_page" class="nav-item nav-link active">Home</a>
                <!-- <a href="#" class="nav-item nav-link">About</a> -->
                <a href="/services" class="nav-item nav-link">Layanan</a>
                <!-- <a href="#" class="nav-item nav-link">Projects</a> -->
            </div>
            <a href="/logout" class="btn btn-primary py-4 px-lg-4 rounded-0 d-none d-lg-block">Logout<i class="fa fa-arrow-right ms-3"></i></a>
        </div>
    </nav>
    <!-- Navbar End -->


    <?php echo $this->renderSection('isi')?>


  

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
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