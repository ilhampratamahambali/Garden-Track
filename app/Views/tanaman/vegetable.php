<?php echo $this->extend('_partials/template')?>
<?php echo $this->section('isi')?>
<div class="container mt-5">
    <h1 class="text-center mb-3">Data Sayuran</h1>
    <!-- Search bar -->
    <div class="container my-4">
        <form action="<?= base_url('vegetable/search') ?>" method="get" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari tanaman..." aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Cari</button>
        </form>
    </div>
    <!-- Plants Data -->
    <div class="container mt-5">
        <div class="row g-4" id="plantContainer">
            <?php foreach ($plants as $plant) : ?>
                <?php if (!empty($plant['common_name']) && !empty($plant['image_url'])) : // Hanya tampilkan jika tidak null ?>
                    <div class="col-md-4 plant-item">
                        <div class="card mb-4">
                            <img 
                                src="<?= $plant['image_url'] ?>" 
                                class="card-img-top" 
                                alt="<?= $plant['common_name'] ?>" 
                                style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title"><?= $plant['common_name'] ?></h5>
                                <p class="card-text">
                                    <strong>Nama Ilmiah:</strong> <?= $plant['scientific_name'] ?? 'Tidak Tersedia' ?><br>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div id="loading" class="text-center my-3">
            <p>Loading...</p>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let currentPage = 2; // Mulai dari halaman 2 karena halaman 1 sudah dimuat
    let loading = false;
    let hasMoreData = true;

    function fetchVegetables() {
        if (loading || !hasMoreData) return;

        loading = true;
        $('#loading').show(); // Tampilkan loading

        $.ajax({
            url: "<?= base_url('/vegetable/load') ?>",
            type: "GET",
            data: { page: currentPage },
            dataType: "json",
            success: function(response) {
                console.log("Fetched data:", response);

                if (response.plants.length > 0) {
                    let container = $('#plantContainer');

                    $.each(response.plants, function(index, plant) {
                        let plantHtml = `
                            <div class="col-md-4 plant-item">
                                <div class="card mb-4">
                                    <img src="${plant.image_url}" class="card-img-top" alt="${plant.common_name}" style="height: 200px; object-fit: cover;">
                                    <div class="card-body">
                                        <h5 class="card-title">${plant.common_name}</h5>
                                        <p class="card-text">
                                            <strong>Nama Ilmiah:</strong> ${plant.scientific_name ?? 'Tidak Tersedia'}<br>
                                        </p>
                                    </div>
                                </div>
                            </div>`;
                        container.append(plantHtml);
                    });

                    currentPage++; // Naikkan halaman untuk request selanjutnya
                }

                hasMoreData = response.hasMore; // Cek apakah masih ada data
            },
            error: function(xhr, status, error) {
                console.error("Error loading data:", error);
            },
            complete: function() {
                $('#loading').hide(); // Sembunyikan loading setelah selesai
                loading = false;
            }
        });
    }

    $(window).on('scroll', function() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 50) {
            fetchVegetables();
        }
    });

    $(document).ready(function() {
        $('#loading').hide(); // Pastikan loading disembunyikan di awal
    });
</script>
<?php echo $this->endSection()?>