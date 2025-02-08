<?php echo $this->extend('_partials/template')?>
<?php echo $this->section('isi')?>
<div class="container mt-5">
    <h1 class="text-center mb-3">Data Tanaman</h1>
    <!-- Search bar -->
    <div class="container my-4">
    <form action="<?= base_url('/plants/search') ?>" method="get" class="d-flex">
        <input type="text" name="search" class="form-control me-2" placeholder="Cari tanaman..." aria-label="Search" value="<?= isset($searchQuery) ? esc($searchQuery) : '' ?>">
        <button class="btn btn-outline-success" type="submit">Cari</button>
    </form>
</div>

<br><br>

<!-- Plants Data -->
<div class="container my-4">
    <div class="row g-4">
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
                                <strong>Kategori:</strong> <?= $plant['family'] ?? 'Tidak Tersedia' ?><br>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-danger">Tidak ada data tanaman yang sesuai dengan pencarian.</p>
        <?php endif; ?>
    </div>

    <!-- Pagination Controls -->
    <?php if (isset($totalPages) && $totalPages > 1): ?>
        <nav aria-label="Page navigation">
          <ul class="pagination justify-content-center mt-4">
            <?php 
              // Previous button
              $prevPage = ($currentPage > 1) ? $currentPage - 1 : 1;
            ?>
            <li class="page-item <?= ($currentPage == 1) ? 'disabled' : '' ?>">
              <a class="page-link" href="<?= base_url('plants?search=' . urlencode($searchQuery) . '&page=' . $prevPage) ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
              <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                <a class="page-link" href="<?= base_url('plants?search=' . urlencode($searchQuery) . '&page=' . $i) ?>">
                  <?= $i ?>
                </a>
              </li>
            <?php endfor; ?>
            
            <?php 
              // Next button
              $nextPage = ($currentPage < $totalPages) ? $currentPage + 1 : $totalPages;
            ?>
            <li class="page-item <?= ($currentPage == $totalPages) ? 'disabled' : '' ?>">
              <a class="page-link" href="<?= base_url('plants?search=' . urlencode($searchQuery) . '&page=' . $nextPage) ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          </ul>
        </nav>
    <?php endif; ?>
</div>
</div>

<?php echo $this->endSection()?>