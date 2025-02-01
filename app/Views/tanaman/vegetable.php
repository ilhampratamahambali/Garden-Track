<?php echo $this->extend('_partials/template')?>
<?php echo $this->section('isi')?>
<div class="container mt-5">
    <h1 class="text-center mb-3">Data Sayuran</h1>
    <!-- Search bar -->
    <div class="container my-4">
        <form action="<?= base_url('plants/search') ?>" method="get" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari tanaman..." aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Cari</button>
        </form>
    </div>
    <br><br>
    <!-- Plants Data -->
    <div class="container mt-5">
    <div class="row g-4" id="plantContainer">
        <?php foreach ($plants as $plant) : ?>
            <div class="col-md-4 plant-item">
                <div class="card mb-4">
                    <img 
                        src="<?= $plant['image_url'] ?? base_url('assets/images/default-image.jpg') ?>" 
                        class="card-img-top" 
                        alt="<?= $plant['common_name'] ?>" 
                        style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title"><?= $plant['common_name'] ?? 'Nama Tidak Tersedia' ?></h5>
                        <p class="card-text">
                            <strong>Nama Ilmiah:</strong> <?= $plant['scientific_name'] ?? 'Tidak Tersedia' ?><br>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Loader -->
    <div id="loading" class="text-center my-3" style="display: none;">
        <p>Loading...</p>
    </div>
</div>
</div>
<script>
    let currentPage = 4; // Mulai dari halaman 4 karena 30 data awal sudah ditampilkan
    let loading = false; // Status loading
    let hasMoreData = true; // Status apakah masih ada data

    // Fungsi untuk mengambil data dengan AJAX
    async function fetchVegetables() {
    if (loading || !hasMoreData) return;
    loading = true;
    document.getElementById('loading').style.display = 'block';

    try {
        let response = await fetch("<?= base_url('/vegetable') ?>?page=" + currentPage);
        let data = await response.json();

        console.log("Data fetched:", data); // **Cek apakah data benar-benar masuk**

        if (data.plants.length > 0) {
            let container = document.getElementById('vegetableContainer');
            data.plants.forEach(plant => {
                console.log("Adding plant:", plant); // **Pastikan data ditambahkan ke halaman**
                let plantHtml = `
                    <div class="col-md-4 plant-item">
                        <div class="card mb-4">
                            <img src="${plant.image_url ?? '<?= base_url('assets/images/default-image.jpg') ?>'}" class="card-img-top" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">${plant.common_name ?? 'Nama Tidak Tersedia'}</h5>
                                <p class="card-text">
                                    <strong>Nama Ilmiah:</strong> ${plant.scientific_name ?? 'Tidak Tersedia'}<br>
                                </p>
                            </div>
                        </div>
                    </div>`;
                container.insertAdjacentHTML('beforeend', plantHtml);
            });
        }

        hasMoreData = data.hasMore;
        currentPage++;
        } catch (error) {
            console.error("Error loading data:", error);
        }

        document.getElementById('loading').style.display = 'none';
        loading = false;
    }
    // Event listener untuk mendeteksi scroll
    window.addEventListener('scroll', () => {
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 50) {
            fetchVegetables();
        }
    });
</script>
<?php echo $this->endSection()?>