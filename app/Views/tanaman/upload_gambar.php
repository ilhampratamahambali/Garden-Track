<?php echo $this->extend('_partials/template') ?>
<?php echo $this->section('isi') ?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Upload Gambar Tanaman</h1>
    
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm p-4">
                <h4 class="text-center mb-3">Deteksi Tanaman</h4>
                <p class="text-center mb-4">Unggah gambar tanaman, dan sistem akan mengidentifikasi jenis tanamannya.</p>
                
                <form action="/tanaman/hasil" method="post" enctype="multipart/form-data">
                    <div class="mb-3 text-center">
                        <input class="form-control" type="file" name="gambar" required>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-leaf"></i> Prediksi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php echo $this->endSection() ?>
