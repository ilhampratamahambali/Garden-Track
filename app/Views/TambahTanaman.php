<?php echo $this->extend('_partials/template_user2') ?>
<?php echo $this->section('isi') ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Tanaman</title>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Tambah Tanaman</h2>
    <form action="/tanaman/tambah" method="post">
        <input type="hidden" name="id_kebun" value="<?= $id_kebun ?>">
        <div class="mb-3">
            <label for="id_tanaman" class="form-label">Pilih Tanaman</label>
            <select name="id_tanaman" id="id_tanaman" class="form-select" required>
                <option value="" disabled selected>-- Pilih Tanaman --</option>
                <?php foreach ($dataTanaman as $tanaman): ?>
                    <option value="<?= $tanaman['id_tanaman'] ?>">
                        <?= htmlspecialchars($tanaman['common_name']) ?> (<?= htmlspecialchars($tanaman['scientific_name']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
</body>
</html>
<?php echo $this->endSection() ?>
