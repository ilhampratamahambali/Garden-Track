<?php echo $this->extend('_partials/template')?>
<?php echo $this->section('isi')?>

<div class="container mt-5">
    <h1 class="text-center mb-3">Data Tanaman</h1>
    <div class="container my-4">
        <form action="<?= base_url('plants/search') ?>" method="get" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari tanaman..." aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Cari</button>
        </form>
    </div>
    <br><br>
    <!-- Plants Data -->
    <div class="row g-4">
        <?php if (!empty($plants)): ?>
        <?php 
            // dd($plants);
            // die;
        ?>

        <div class="row">
            <?php foreach ($plants as $plant): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="<?= $plant['image_url'] ?>" class="card-img-top" alt="<?= $plant['common_name'] ?>" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $plant['common_name'] ?? 'Nama Tidak Tersedia' ?></h5>
                            <p class="card-text">
                                <strong>Nama Ilmiah:</strong> <?= $plant['scientific_name'] ?? 'Tidak Tersedia'?><br>
                                <strong>Kategori:</strong> <?= $plant['family'] ?? 'Tidak Tersedia' ?><br>
                                <strong>Deskripsi:</strong> <?= $plant['description'] ?? 'Tidak Tersedia' ?><br>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
            <p class="text-danger">Tidak ada data tanaman yang sesuai dengan pencarian.</p>
        <?php endif; ?>
    </div>
    <!-- Pagination Buttons -->
    <div class="d-flex justify-content-between">
        <a href="<?= base_url('plants?page=' . ($currentPage - 1)) ?>" id="prevButton" class="btn btn-primary" <?= $currentPage < 0 ? 'disabled' : '' ?>>Previous</a>
        <a href="<?= base_url('plants?page=' . ($currentPage + 1)) ?>" id="nextButton" class="btn btn-primary" <?= $currentPage > $totalPages || $currentPage >= 21863 ? 'disabled' : '' ?>>Next</a>
    </div>
</div>
<script>
    // Ambil parameter 'page' dari URL saat ini
    const urlParams = new URLSearchParams(window.location.search);
    let currentPage = parseInt(urlParams.get('page')) || 1; // Default ke halaman 1 jika tidak ada parameter
    const totalPages = <?= $totalPages ?? 1 ?>; // Ambil total halaman dari PHP

    // Fungsi untuk mengarahkan ke halaman berikutnya atau sebelumnya
    function goToPage(page) {
        urlParams.set('page', page); // Set parameter 'page' di URL
        window.location.href = "<?= base_url('plants') ?>?" + urlParams.toString(); // Update URL dan refresh halaman
    }

    // Fungsi untuk update status tombol
    function updatePaginationButtons() {
        document.getElementById('prevButton').disabled = currentPage <= 1;
        document.getElementById('nextButton').disabled = currentPage >= totalPages || currentPage >= 21863;
    }

    // Tambahkan event listener untuk tombol "Previous"
    document.getElementById('prevButton').addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--; // Halaman berkurang
            goToPage(currentPage); // Arahkan ke halaman sebelumnya
        }
    });

    // Tambahkan event listener untuk tombol "Next"
    document.getElementById('nextButton').addEventListener('click', () => {
        if (currentPage < totalPages && currentPage <= 21863) {
            currentPage++; // Halaman bertambah
            goToPage(currentPage); // Arahkan ke halaman berikutnya
        }
    });

    // Update status tombol saat halaman dimuat
    updatePaginationButtons();
</script>

<?php echo $this->endSection()?>
