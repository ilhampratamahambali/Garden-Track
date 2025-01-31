<?php echo $this->extend('_partials/template_user2') ?>
<?php echo $this->section('isi') ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Kebun</title>
    <style>
        body {
            background-color: #ffffff;
        }
        .card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 20px auto;
            max-width: 600px;
            text-align: center;
        }
        .card img {
            width: 100%;
            height: auto;
        }
        .card h5 {
            margin: 15px 0;
            font-size: 20px;
            color: #333;
        }
        .alert {
            margin-top: 20px;
        }
        .btn {
            margin: 10px;
        }
        .container {
            padding: 15px;
        }
    </style>
</head>
<body>

<section class="container mt-4">
    <!-- Tombol Tambah Tanaman -->
    <a href="/tanaman/tambah/<?= $kebun['id_kebun'] ?>" class="btn btn-success">Tambah Tanaman</a>

    <!-- Kartu Detail Kebun -->
    <div class="card">
        <img src="/uploads/<?= $kebun['poto_kebun'] ?>" alt="<?= htmlspecialchars($kebun['nama_kebun']) ?>">
        <div class="card-body">
            <h5>Nama Kebun: <?= htmlspecialchars($kebun['nama_kebun']) ?></h5>
        </div>
    </div>

    <!-- Daftar Tanaman -->
    <?php if (empty($tanaman)): ?>
        <div class="alert alert-info text-center">
            Anda belum memiliki tanaman di kebun ini.
            <br>
            <a href="/tanaman/tambah/<?= $kebun['id_kebun'] ?>" class="btn btn-success">Buat Tanaman</a>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center">
            Berikut adalah daftar tanaman Anda:
        </div>
        <div class="list-group">
            <?php foreach ($tanaman as $item): ?>
                <a href="/tanaman/detail/<?= $item['id_tanaman'] ?>" class="list-group-item list-group-item-action">
                    <?= htmlspecialchars($item['common_name']) ?> - <?= htmlspecialchars($item['scientific_name']) ?>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
<?php echo $this->endSection() ?>
