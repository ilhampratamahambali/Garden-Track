<?php echo $this->extend('_partials/template')?>
<?php echo $this->section('isi')?>
<div class="container mt-5">
    <h1 class="text-center mb-3">Data Tanaman</h1>
    <!-- Search bar -->
    <div class="container my-4">
        <form action="<?= base_url('plants/search') ?>" method="get" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari tanaman..." aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Cari</button>
        </form>
    </div>
    <br><br>
    <!-- Plants Data -->
    <div class="row g-4" id="plants-container">
        <?php if (!empty($plants)): ?>
            <?php foreach ($plants as $plant): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img 
                            src="<?= $plant['image_url'] ?: base_url('assets/images/default-image.jpg') ?>" 
                            class="card-img-top" 
                            alt="<?= $plant['common_name'] ?>" 
                            style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $plant['common_name'] ?? 'Nama Tidak Tersedia' ?></h5>
                            <p class="card-text">
                                <strong>Nama Ilmiah:</strong> <?= $plant['scientific_name'] ?? 'Tidak Tersedia' ?><br>
                                <strong>Keluarga:</strong> <?= $plant['family'] ?? 'Tidak Tersedia' ?><br>
                                <strong>Genus:</strong> <?= $plant['genus'] ?? 'Tidak Tersedia' ?><br>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-danger">Tidak ada data tanaman yang sesuai dengan pencarian.</p>
        <?php endif; ?>
    </div>
    <!-- Loading Spinner -->
    <div id="loading" class="text-center my-4" style="display: none;">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>

<script>
    let offset = 30; // Offset awal (30 data pertama sudah dimuat)
    let isLoading = false; // Flag untuk menghindari multiple request

    // Fungsi untuk memuat data tambahan
    function loadMorePlants() {
        if (isLoading) return; // Hindari multiple request
        isLoading = true;

        // Tampilkan loading spinner
        document.getElementById('loading').style.display = 'block';

        // Kirim request AJAX ke server
        fetch(`<?= base_url('plants/loadMore') ?>/${offset}`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    // Tambahkan data baru ke container
                    const plantsContainer = document.getElementById('plants-container');
                    data.forEach(plant => {
                        plantsContainer.innerHTML += `
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <img 
                                        src="${plant.image_url || '<?= base_url('assets/images/default-image.jpg') ?>'}" 
                                        class="card-img-top" 
                                        alt="${plant.common_name}" 
                                        style="height: 200px; object-fit: cover;">
                                    <div class="card-body">
                                        <h5 class="card-title">${plant.common_name || 'Nama Tidak Tersedia'}</h5>
                                        <p class="card-text">
                                            <strong>Nama Ilmiah:</strong> ${plant.scientific_name || 'Tidak Tersedia'}<br>
                                            <strong>Keluarga:</strong> ${plant.family || 'Tidak Tersedia'}<br>
                                            <strong>Genus:</strong> ${plant.genus || 'Tidak Tersedia'}<br>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        `;
                    });

                    offset += 30; // Update offset untuk request berikutnya
                } else {
                    // Tidak ada data lagi, hentikan infinite scroll
                    window.removeEventListener('scroll', onScroll);
                }
            })
            .catch(error => console.error('Error:', error))
            .finally(() => {
                isLoading = false;
                document.getElementById('loading').style.display = 'none'; // Sembunyikan loading spinner
            });
    }

    // Fungsi untuk menangani event scroll
    function onScroll() {
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 100) {
            loadMorePlants();
        }
    }

    // Tambahkan event listener untuk scroll
    window.addEventListener('scroll', onScroll);
</script>
<?php echo $this->endSection()?>