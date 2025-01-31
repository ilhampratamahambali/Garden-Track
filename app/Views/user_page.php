<?php echo $this->extend('_partials/template')?>
<?php echo $this->section('isi')?>
    <!-- Carousel Start -->
    <div class="container-fluid p-0 wow fadeIn" data-wow-delay="0.1s">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="<?php echo base_url('tanaman/'); ?>img/carousel-1.jpg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <h1 class="display-1 text-white mb-4 animated slideInDown">Tamanmu Dimulai dari Rumah</h1>
                                    <form action="/search" method="get" class="d-flex animated fadeInUp" style="max-width: 600px; margin: auto;">
                                        <input type="text" name="query" class="form-control form-control-lg" placeholder="Cari tanaman..." style="border-radius: 30px 0 0 30px;">
                                        <button type="submit" class="btn btn-primary btn-lg" style="border-radius: 0 30px 30px 0;">Cari</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="<?php echo base_url('tanaman/'); ?>img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7">
                                    <h1 class="display-1 text-white mb-4 animated slideInDown">Taman Kecil, Kebahagiaan Besar</h1>
                                    <form action="/search" method="get" class="d-flex animated fadeInUp" style="max-width: 600px; margin: auto;">
                                        <input type="text" name="query" class="form-control form-control-lg" placeholder="Cari tanaman..." style="border-radius: 30px 0 0 30px;">
                                        <button type="submit" class="btn btn-primary btn-lg" style="border-radius: 0 30px 30px 0;">Cari</button>
                                    </form>
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

    <!-- Service Start-->
<div class="container-fluid py-5 service-section">
    <div class="container">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="fs-5 fw-bold text-primary">Layanan Kami</p>
            <h1 class="display-5 mb-5">Layanan yang kami tawarkan untuk Anda</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item d-flex h-100">
                    <div class="service-img rounded">
                        <img class="img-fluid" src="<?php echo base_url('tanaman/'); ?>img/service-1.jpg" alt="">
                    </div>
                    <div class="service-text rounded p-5">
                        <div class="btn-square rounded-circle mx-auto mb-3">
                            <img class="img-fluid" src="<?php echo base_url('tanaman/'); ?>img/icon/icon-5.png" alt="Icon">
                        </div>
                        <h4 class="mb-3">Buat Taman Anda</h4>
                        <p class="mb-4">Erat ipsum justo amet duo et elitr dolor, est duo duo eos lorem sed diam stet diam sed stet.</p>
                        <a class="btn btn-sm" href=""><i class="fa fa-plus text-primary me-2"></i>Buat Taman</a>
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
                                <img class="img-fluid" src="<?php echo base_url('tanaman/'); ?>img/icon/icon-6.png" alt="Icon">
                            </div>
                            <h4 class="mb-3">Pruning plants</h4>
                            <p class="mb-4">Erat ipsum justo amet duo et elitr dolor, est duo duo eos lorem sed diam stet diam sed stet.</p>
                            <a class="btn btn-sm" href=""><i class="fa fa-plus text-primary me-2"></i>Read More</a>
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
                                <img class="img-fluid" src="<?php echo base_url('tanaman/'); ?>img/icon/icon-3.png" alt="Icon">
                            </div>
                            <h4 class="mb-3">Irrigation & Drainage</h4>
                            <p class="mb-4">Erat ipsum justo amet duo et elitr dolor, est duo duo eos lorem sed diam stet diam sed stet.</p>
                            <a class="btn btn-sm" href=""><i class="fa fa-plus text-primary me-2"></i>Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection()?>