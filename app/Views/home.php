<?php echo $this->extend('_partials/template')?>
<?php echo $this->section('isi')?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>
<style>
    html {
        scroll-behavior: smooth;
    }
    .carousel-bg {
        height: 92vh; /* Menyesuaikan tinggi layar perangkat */
        object-fit: cover; /* Memastikan gambar tidak terdistorsi */
    }

    .service-section {
        background-color: #e8f5e9; /* Warna hijau muda */
        width: 100%;
        padding: 150px 0;
        margin: 0;
    }

    .service-item {
        margin-bottom: 30px;
        background-color: #ffffff;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        overflow: hidden;
    }

    .service-item:hover {
        transform: scale(1.05);
        transition: transform 0.3s ease;
    }
    .text-justify {
        text-align: justify;
        display: block;
    }
    @media (max-width: 1200px) {
        .carousel-bg {
            height: 80vh; /* Untuk layar lebih kecil dari 1200px */
        }
    }
    @media (max-width: 992px) {
        .service-item {
            margin-bottom: 20px; /* Penyesuaian jarak pada layar lebih kecil */
        }
    }
</style>
<script>
    // // Sesuaikan tinggi navbar di bawah ini
    const navbarHeight = 100; // Misal tinggi navbar Anda adalah 70px

    // Ambil semua tautan yang memiliki kelas "scroll-link"
    document.querySelectorAll('.scroll-link').forEach(link => {
        link.addEventListener('click', function(e) {
        e.preventDefault(); // Mencegah aksi default

        // Ambil target dari atribut href
        const targetId = this.getAttribute('href').substring(1);
        const targetElement = document.getElementById(targetId);

            if (targetElement) {
                // Hitung posisi scroll dengan mengurangi tinggi navbar
                const offsetTop = targetElement.offsetTop - navbarHeight;

                // Scroll ke posisi tersebut
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });
</script>
    <!-- Carousel Start -->
    <div class="container-fluid p-0 wow fadeIn" data-wow-delay="0.1s">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100 carousel-bg" src="<?php echo base_url('tanaman/'); ?>img/carousel-1.jpg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <h1 class="display-1 text-white mb-4 animated slideInDown">Tamanmu Dimulai dari Rumah</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100 carousel-bg" src="<?php echo base_url('tanaman/'); ?>img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7">
                                    <h1 class="display-1 text-white mb-4 animated slideInDown">Taman Kecil, Kebahagiaan Besar</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    <!-- Carousel End -->

<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-end">
            <div class="col-lg-3 col-md-5 wow fadeInUp" data-wow-delay="0.1s">
                <img class="img-fluid rounded" data-wow-delay="0.1s" src="<?php echo base_url('tanaman/'); ?>img/about.jpg">
            </div>
            <div class="col-lg-6 col-md-7 wow fadeInUp" data-wow-delay="0.3s">
                <h1 class="display-1 text-primary mb-0">Garden Track</h1>
                <p class="text-primary mb-4"></p>
                <h1 class="display-5 mb-4">Hidup Hijau, Dimulai dari Rumah.</h1>
                <p class="mb-4">Buat dan kelola kebun digital Anda sendiri! Tambahkan tanaman, catat perkembangan mereka, dan atur jadwal perawatan semua dalam satu aplikasi yang mudah digunakan. Bawa kebun Anda ke level berikutnya, tanpa kesulitan!</p>
                <a class="btn btn-primary py-3 px-4" href="#services">Jelajahi</a>
                <section id="services">
            </div>
            <div class="col-lg-3 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                <div class="row g-5">
                    <div class="col-12 col-sm-6 col-lg-12">
                        <div class="border-start ps-4">
                            <i class="fa fa-award fa-3x text-primary mb-3"></i>
                            <h4 class="mb-3">Kualitas Terjamin</h4>
                            <span style="text-align: justify; display: block;">Kami memberikan layanan berkualitas yang dirancang untuk memenuhi kebutuhan kebun Anda, memastikan pertumbuhan tanaman yang sehat dan optimal</span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-12">
                        <div class="border-start ps-4">
                            <i class="fa fa-users fa-3x text-primary mb-3"></i>
                            <h4 class="mb-3">Dukungan Penuh</h4>
                            <span style="text-align: justify; display: block;">Tim kami selalu siap membantu Anda dengan panduan yang mudah dan praktis untuk mengelola kebun Anda secara efektif</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service Start-->

<div class="container-fluid py-5 service-section">
    <div class="container">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-7 mb-7">Layanan Garden Track</h1>
            <p class="fs-5 fw-bold text-primary">Cari Tanaman Dan Buat Kebun Disini</p><br>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item d-flex h-100">
                    <div class="service-img rounded">
                        <img class="img-fluid" src="<?php echo base_url('tanaman/'); ?>img/service-6.jpg" alt="">
                    </div>
                    <div class="service-text rounded p-5">
                        <div class="btn-square rounded-circle mx-auto mb-3">
                            <img class="img-fluid" src="<?php echo base_url('tanaman/'); ?>img/icon/icon-7.png" alt="Icon">
                        </div>
                        <h4 class="mb-3">Deteksi Tanaman</h4>
                        <p class="mb-4">Unggah Gambar Tanaman, dan sistem akan mengidentifikasi jenis tanamannya </p>
                        <a class="btn btn-sm" href="upload_gambar"><i class="fa fa-plus text-primary me-2"></i>Deteksi Tanaman</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item d-flex h-100">
                    <div class="service-img rounded">
                        <img class="img-fluid" src="<?php echo base_url('tanaman/'); ?>img/service-1.jpg" alt="">
                    </div>
                    <div class="service-text rounded p-5">
                        <div class="btn-square rounded-circle mx-auto mb-3">
                            <img class="img-fluid" src="<?php echo base_url('tanaman/'); ?>img/icon/icon-2.png" alt="Icon">
                        </div>
                        <h4 class="mb-3">Cari Tanaman</h4>
                        <p class="mb-4">Lihat Berbagai Jenis Tanaman Disini, Dan cari Informasinya</p>
                        <a class="btn btn-sm" href="plants"><i class="fa fa-plus text-primary me-2"></i>Cari Tanaman</a>
                    </div>
                </div>
            </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-img rounded">
                            <img class="img-fluid" src="<?php echo base_url('tanaman/'); ?>img/service-2.jpg" alt="">
                        </div>
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid" src="<?php echo base_url('tanaman/'); ?>img/icon/icon-4.png" alt="Icon">
                            </div>
                            <h4 class="mb-3">Buat Kebun Anda</h4>
                            <p class="mb-4">Buat kebun digital anda disini, dan tambahkan tanaman</p>
                            <a class="btn btn-sm" href="buat_kebun"><i class="fa fa-plus text-primary me-2"></i>Buat Kebun</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-img rounded">
                            <img class="img-fluid" src="<?php echo base_url('tanaman/'); ?>img/service-3.jpg" alt="">
                        </div>
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid" src="<?php echo base_url('tanaman/'); ?>img/icon/icon-8.png" alt="Icon">
                            </div>
                            <h4 class="mb-3">Kelola Kebun Anda</h4>
                            <p class="mb-4">Kelola kebun digital anda disini, lihat perkembangan tanaman anda</p>
                            <a class="btn btn-sm" href="kebun"><i class="fa fa-plus text-primary me-2"></i>Kelola Kebun</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Features Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <p class="fs-5 fw-bold text-primary">Mengapa Memilih Kami!</p>
                <h1 class="display-5 mb-4">Beberapa Alasan Mengapa Banyak Orang Memilih Kami!</h1>
                <p class="mb-4">Garden Track memberikan akses mudah ke berbagai informasi tentang tanaman, mulai dari cara perawatan, hingga manfaat kesehatan yang bisa Anda dapatkan. Temukan semua yang perlu Anda ketahui untuk merawat tanaman kesayangan dengan lebih baik!</p>
            </div>
            <div class="col-lg-6">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6">
                        <div class="row g-4">
                            <div class="col-12 wow fadeIn" data-wow-delay="0.3s">
                                <div class="text-center rounded py-5 px-4" style="box-shadow: 0 0 45px rgba(0,0,0,.08);">
                                    <div class="btn-square bg-light rounded-circle mx-auto mb-4" style="width: 90px; height: 90px;">
                                        <i class="fa fa-check fa-3x text-primary"></i>
                                    </div>
                                    <h4 class="mb-0">100% Satisfaction</h4>
                                </div>
                            </div>
                            <div class="col-12 wow fadeIn" data-wow-delay="0.5s">
                                <div class="text-center rounded py-5 px-4" style="box-shadow: 0 0 45px rgba(0,0,0,.08);">
                                    <div class="btn-square bg-light rounded-circle mx-auto mb-4" style="width: 90px; height: 90px;">
                                        <i class="fa fa-users fa-3x text-primary"></i>
                                    </div>
                                    <h4 class="mb-0">Dedicated Team</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 wow fadeIn" data-wow-delay="0.7s">
                        <div class="text-center rounded py-5 px-4" style="box-shadow: 0 0 45px rgba(0,0,0,.08);">
                            <div class="btn-square bg-light rounded-circle mx-auto mb-4" style="width: 90px; height: 90px;">
                                <i class="fa fa-tools fa-3x text-primary"></i>
                            </div>
                            <h4 class="mb-0">Modern Equipment</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Features End -->
<script>
    // Cek apakah ada session flashdata 
    const successMessage = "<?= session()->getFlashdata('success') ?>";
    const errorMessage = "<?= session()->getFlashdata('error') ?>";

    if (successMessage) {
        const Toast = Swal.mixin({
            toast: true,
            position: "top",  
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            },
            customClass: {
                popup: 'toast-popup'
            }
        });

        Toast.fire({
            icon: "success",
            title: successMessage // Tampilkan pesan dari session flashdata
        });
    }

    if (errorMessage) {
        const Toast = Swal.mixin({
            toast: true,
            position: "top", 
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            },
            customClass: {
                popup: 'toast-popup'
            }
        });

        Toast.fire({
            icon: "error",
            title: errorMessage // Tampilkan pesan error
        });
    }
</script>
<?php echo $this->endSection()?>