<?php echo $this->extend('_partials/template') ?>
<?php echo $this->section('isi') ?>
<style>
    .container {
        max-width: 800px;
        margin-top: 50px;
    }
    .select2-container--default .select2-selection--single {
        height: 38px;
        padding: 5px;
    }
</style>
<nav aria-label="breadcrumb" class="px-4 px-lg-5" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/user_page">Home</a></li>
        <li class="breadcrumb-item"><a href="/kebun/detail">Kebun</a></li>
        <li class="breadcrumb-item"><a href="/kebun/detail/<?= esc($tanaman['id_kebun']) ?>">Tanaman</a></li>
        <li class="breadcrumb-item active"><a href="/tanaman/detail/<?= esc($tanaman['id']) ?>"><?= esc($tanaman['common_name']) ?? 'Plants'?></a></li>
        <li class="breadcrumb-item"><span>Update</span></li>
    </ol>
</nav>
<div class="container">
    <h2 class="mb-4">Form Edit Tanaman</h2>
    <form action="<?= base_url('/tanaman/update/'.$tanaman['id_tanaman'])?>" method="post"  enctype="multipart/form-data">
        <!-- Pilih Tanaman -->
        <?= csrf_field() ?>
        <div class="mb-3">
            <label class="form-label">Pilih Tanaman</label>
            <select class="form-select" name="id_tanaman" disabled>
                <option value="<?= $tanaman['id_tanaman'] ?>" selected >
                    <?= isset($tanaman['common_name']) ? $tanaman['common_name'] : 'No Common Name' ?> - 
                    <?= isset($tanaman['scientific_name']) ? $tanaman['scientific_name'] : 'No Scientific Name' ?>
                </option>
            </select>
            <input type="hidden" name="id_tanaman" value="<?= $tanaman['id_tanaman'] ?>">
            <input type="hidden" name="id" value="<?= $tanaman['id'] ?>">
            <input type="hidden" name="id_user" value="<?= session()->get('id_user') ?>">
        </div>
        <!-- Jumlah Benih -->
        <div class="mb-3">
            <label class="form-label">Jumlah Benih</label>
            <input type="number" class="form-control" name="benih" value="<?= esc($tanaman['benih']) ?>" required>
            <input type="hidden" name="id_kebun" value="<?= esc($tanaman['id_kebun']) ?>">
        </div>
        <!-- Cara Menanam -->
        <div class="mb-3">
            <label class="form-label">Cara Menanam</label>
            <select class="form-select" name="cara_menanam" required>
                <option value="">Pilih Metode</option>
                <option value="benih" <?= ($tanaman['cara_menanam'] == 'benih') ? 'selected' : '' ?>>Benih</option>
                <option value="bibit/tunas kecil" <?= ($tanaman['cara_menanam'] == 'bibit/tunas kecil') ? 'selected' : '' ?>>Bibit/Tunas Kecil</option>
                <option value="stek" <?= ($tanaman['cara_menanam'] == 'stek') ? 'selected' : '' ?>>Stek</option>
                <option value="pemisahan akar" <?= ($tanaman['cara_menanam'] == 'pemisahan akar') ? 'selected' : '' ?>>Pemisahan Akar</option>
                <option value="stolon" <?= ($tanaman['cara_menanam'] == 'stolon') ? 'selected' : '' ?>>Stolon</option>
                <option value="umbi lapis" <?= ($tanaman['cara_menanam'] == 'umbi lapis') ? 'selected' : '' ?>>Umbi Lapis</option>
                <option value="umbi akar/umbi batang" <?= ($tanaman['cara_menanam'] == 'umbi akar/umbi batang') ? 'selected' : '' ?>>Umbi Akar/Umbi Batang</option>
                <option value="tanaman berakar telanjang" <?= ($tanaman['cara_menanam'] == 'tanaman berakar telanjang') ? 'selected' : '' ?>>Tanaman Berakar Telanjang</option>
                <option value="tanaman dewasa/siap tanam" <?= ($tanaman['cara_menanam'] == 'tanaman dewasa/siap tanam') ? 'selected' : '' ?>>Tanaman Dewasa/Siap Tanam</option>
                <option value="sambungan/cangkok sambung" <?= ($tanaman['cara_menanam'] == 'sambungan/cangkok sambung') ? 'selected' : '' ?>>Sambungan/Cangkok Sambung</option>
                <option value="cangkok" <?= ($tanaman['cara_menanam'] == 'cangkok') ? 'selected' : '' ?>>Cangkok</option>
            </select>
        </div>
        <!-- Kondisi Matahari -->
        <div class="mb-3">
            <label class="form-label">Kondisi Matahari</label>
            <select class="form-select" name="kondisi_matahari" required>
                <option value="">Pilih Kondisi</option>
                <option value="matahari penuh" <?= ($tanaman['kondisi_matahari'] == 'matahari penuh') ? 'selected' : '' ?>>Matahari Penuh</option>
                <option value="setengah teduh" <?= ($tanaman['kondisi_matahari'] == 'setengah teduh') ? 'selected' : '' ?>>Setengah Teduh</option>
                <option value="teduh" <?= ($tanaman['kondisi_matahari'] == 'teduh') ? 'selected' : '' ?>>Teduh</option>
            </select>
        </div>
        <!-- Tanggal Mulai & Selesai -->
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Tanggal Mulai</label>
                <input type="datetime-local" class="form-control" name="tanggal_mulai" value="<?= date('Y-m-d\TH:i', strtotime($tanaman['tanggal_mulai'])) ?>" required>
            </div>
            <div class="col">
                <label class="form-label">Tanggal Selesai</label>
                <input type="date" class="form-control" name="tanggal_selesai" value="<?= date('Y-m-d', strtotime($tanaman['tanggal_selesai'])) ?>" required>
            </div>
        </div>
        <!-- Deskripsi -->
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea 
                class="form-control" 
                name="deskripsi" 
                rows="3" 
                placeholder="Ceritakan tentang taman ini - di mana lokasinya? Seperti apa tampangnya? Apakah Anda memiliki tautan ke foto? Apakah Anda mengalami irigasi? Apa rencanamu?" 
                required><?= $tanaman['deskripsi'] ?></textarea>
        </div>
        <!-- Tombol Submit -->
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
<!-- Script untuk Select2 dan AJAX Search -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    // Cek apakah ada session flashdata 
    const successMessage = "<?= session()->getFlashdata('success') ?>";
    const errorMessage = "<?= session()->getFlashdata('error') ?>";
    if (successMessage) {
        const Toast = Swal.mixin({
            toast: true,
            position: "top",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            },
            customClass: {
                popup: 'toast-popup'
            }
        });
        Toast.fire({
            icon: "success",
            title: successMessage
        });
    }
    if (errorMessage) {
        const Toast = Swal.mixin({
            toast: true,
            position: "top",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,                                                                                                 
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            },
            customClass: {
                popup: 'toast-popup'
            }
        });
        Toast.fire({
            icon: "error",
            title: errorMessage
        });
    }
</script>
<?php echo $this->endSection() ?>