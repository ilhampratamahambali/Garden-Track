<?php echo $this->extend('_partials/template')?>
<?php echo $this->section('isi')?>

<style>
    html {
        scroll-behavior: smooth;
    }
    .carousel-bg {
        height: 100vh; /* Menyesuaikan tinggi layar perangkat */
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
    script#services {
        scroll-margin-top: 100px; /* Menambahkan jarak agar tidak terlalu dekat dengan navbar */
    }
    .service-section {
        background-color: #ffffff; /* Latar belakang putih */
    }
</style>
<script>
    document.querySelectorAll('.scroll-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault(); // Mencegah aksi default

            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start' // Menyelaraskan bagian atas elemen ke bagian atas viewport
                });

                // Setelah scroll, sedikit geser untuk memberikan jarak
                window.scrollBy(0, -80); // Geser sedikit ke atas
            }
        });
    });
</script>
<!-- Carousel Start -->
<div class="container-fluid p-0 wow fadeIn" data-wow-delay="0.1s">
    <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100 carousel-bg" src="<?php echo base_url('tanaman/'); ?>img/carousel-1.jpg" alt="Image"><section id="services">
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

<br><br>
<!-- Service Start-->
<section id="services">
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
<!-- Script untuk menampilkan SweetAlert dari session flashdata -->
 <!-- <php
     dd(session()->getFlashdata('success'), session()->getFlashdata('error'));
     ?> -->
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
