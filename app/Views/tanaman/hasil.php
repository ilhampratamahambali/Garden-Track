<?php echo $this->extend('_partials/template') ?>
<?php echo $this->section('isi') ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm p-4">
                <h2 class="text-center mb-4">Hasil Prediksi</h2>
                <?php if ($gambar) : ?>
                    <div class="text-center mb-3">
                        <img src="<?= esc($gambar) ?>" alt="Gambar Tanaman" class="img-fluid rounded shadow" style="max-width: 300px;" />
                    </div>
                <?php else: ?>
                    <p class="text-center text-muted"><em>Gambar tidak tersedia</em></p>
                <?php endif; ?>

                <p><strong>Label:</strong> <?= esc($label) ?></p>

                <p><strong>Deskripsi:</strong></p>
                <div class="bg-light p-3 rounded deskripsi">
                    <?= nl2br(esc($deskripsi)) ?>
                </div>

                <div class="text-center mt-4">
                    <a href="/upload_gambar" class="btn btn-primary">
                        &#8592; Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $this->endSection() ?>
