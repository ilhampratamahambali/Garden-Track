<?php echo $this->extend('_partials/template')?>
<?php echo $this->section('isi')?>

<div class="container mt-5">
    <h1 class="text-center mb-4 font-weight-bold" style="font-size: 2.5rem; color: #333;"><?= $title ?></h1>
    <?php if (count($kebun) > 0): ?>
        <div class="row">
            <?php foreach ($kebun as $k): ?>
                <div class="col-md-4 d-flex align-items-stretch">
                    <div class="card mb-4 shadow-lg" style="border-radius: 15px; overflow: hidden;">
                        <img src="<?= base_url('uploads/' . $k['poto_kebun']) ?>" class="card-img-top" alt="<?= $k['nama_kebun'] ?>" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title font-weight-bold" style="color: #4CAF50;">Nama Kebun : <?= $k['nama_kebun'] ?></h5>
                            <div class="mt-auto">
                                <a href="/kebun/detail/<?= $k['id_kebun']; ?>" class="btn btn-success w-100" style="border-radius: 25px; transition: all 0.3s ease;">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center text-muted" style="font-size: 1.2rem;">Belum ada kebun dari pengguna lain.</p>
    <?php endif; ?>
</div>

<style>
    .card:hover {
        transform: translateY(-10px);
        transition: all 0.3s ease;
    }
    .btn:hover {
        background-color: #45A049;
        color: #fff;
    }
</style>

<?php echo $this->endSection() ?>