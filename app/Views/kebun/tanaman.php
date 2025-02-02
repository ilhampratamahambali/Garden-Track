<?php echo $this->extend('_partials/template') ?>
<?php echo $this->section('isi') ?>
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
    /* From Uiverse.io by vinodjangid07 */ 
    .button {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: rgb(20, 20, 20);
        border: none;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.164);
        cursor: pointer;
        transition-duration: .3s;
        overflow: hidden;
        position: relative;
    }
    .svgIcon {
        width: 12px;
        transition-duration: .3s;
    }
    .svgIcon path {
        fill: white;
    }
    .button:hover {
        width: 140px;
        border-radius: 50px;
        transition-duration: .3s;
        background-color: rgb(255, 69, 69);
        align-items: center;
    }
    .button:hover .svgIcon {
        width: 50px;
        transition-duration: .3s;
        transform: translateY(60%);
    }
    .button::before {
        position: absolute;
        top: -20px;
        content: "Delete";
        color: white;
        transition-duration: .3s;
        font-size: 2px;
    }
    .button:hover::before {
        font-size: 13px;
        opacity: 1;
        transform: translateY(30px);
        transition-duration: .3s;
    }
    /* From Uiverse.io by aaronross1 */ 
    .edit-button {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: rgb(20, 20, 20);
        border: none;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.164);
        cursor: pointer;
        transition-duration: 0.3s;
        overflow: hidden;
        position: relative;
        text-decoration: none !important;
    }
    .edit-svgIcon {
        width: 17px;
        transition-duration: 0.3s;
    }
    .edit-svgIcon path {
        fill: white;
    }
    .edit-button:hover {
        width: 120px;
        border-radius: 50px;
        transition-duration: 0.3s;
        background-color: rgb(255, 69, 69);
        align-items: center;
    }
    .edit-button:hover .edit-svgIcon {
        width: 20px;
        transition-duration: 0.3s;
        transform: translateY(60%);
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        transform: rotate(360deg);
    }
    .edit-button::before {
        display: none;
        content: "Edit";
        color: white;
        transition-duration: 0.3s;
        font-size: 2px;
    }
    .edit-button:hover::before {
        display: block;
        padding-right: 10px;
        font-size: 13px;
        opacity: 1;
        transform: translateY(0px);
        transition-duration: 0.3s;
    }
    .breadcrumb {
        padding: 10px 0;
        margin-bottom: 20px;
    }
    .breadcrumb a {
        color: #4a7140;
        text-decoration: none;
    }
    .breadcrumb span {
        color: #666;
        margin: 0 5px;
    }
</style>
</head>
<body>
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="px-4 px-lg-5" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/user_page">Home</a></li>
        <li class="breadcrumb-item"><a href="/kebun/detail">Kebun</a></li>
        <li class="breadcrumb-item active"><?= esc($kebun['nama_kebun']) ?></li>
    </ol>
</nav>
<div class="container mt-4">
    <!-- Kartu Detail Kebun -->
    <div class="card">
        <img src="<?= base_url('uploads/' . $kebun['poto_kebun']) ?>" alt="<?= htmlspecialchars($kebun['nama_kebun']) ?>">
        <div class="card-body">
            <h5>Nama Kebun: <?= htmlspecialchars($kebun['nama_kebun']) ?></h5>
            <!-- Tombol Edit dan Hapus -->
            <div style="display: flex; justify-content: center; gap: 10px;">
                <!-- Tombol Edit -->
                <a href="/kebun/edit/<?= $kebun['id_kebun']; ?>" style="text-decoration: none;">
                    <button class="edit-button">
                        <svg class="edit-svgIcon" viewBox="0 0 512 512">
                            <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path>
                        </svg>
                    </button>
                </a>
                <!-- Tombol Hapus -->
                <a href="/kebun/delete/<?= $kebun['id_kebun']; ?>" id="deleteButton" style="text-decoration: none;">
                    <button class="button">
                        <svg viewBox="0 0 448 512" class="svgIcon">
                            <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path>
                        </svg>
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
<section class="container mt-4">
<!-- Tombol Tambah Tanaman -->
<center><a href="/tanaman/tambah/<?= $kebun['id_kebun'] ?>" class="btn btn-success">Tambah Tanaman</a></center>
<!-- Daftar Tanaman -->
<?php if (empty($tanaman)): ?>
    <div class="alert alert-info text-center">
        Anda belum memiliki tanaman di kebun ini.
        <br>
    </div>
<?php else: ?>
    <div class="alert alert-info text-center">
        Berikut adalah daftar tanaman Anda:
    </div>
    <div class="list-group">
        <?php foreach ($tanaman as $item): ?>
            <a href="/tanaman/detail/<?= $item['id'] ?>" class="list-group-item list-group-item-action">
                <?= htmlspecialchars($item['common_name']) ?> - <?= htmlspecialchars($item['scientific_name']) ?>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
</section>
<script>
    // Cek apakah ada session flashdata 
    const successMessage = "<?= session()->getFlashdata('success') ?>";
    const errorMessage = "<?= session()->getFlashdata('error') ?>";

    if (successMessage) {
        const Toast = Swal.mixin({
            toast: true,
            position: "top",  // Pastikan posisinya top
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
            title: successMessage // Tampilkan pesan dari session flashdata
        });
    }

    if (errorMessage) {
        const Toast = Swal.mixin({
            toast: true,
            position: "top",  // Pastikan posisinya top
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
            title: errorMessage // Tampilkan pesan error
        });
    }
    document.getElementById('deleteButton').addEventListener('click', function(event) {
        event.preventDefault(); // Hentikan tindakan default dari tautan
        confirmDelete(<?= $kebun['id_kebun']; ?>);
    });

    function confirmDelete(idKebun) {
        // Tampilkan dialog SweetAlert2
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini tidak dapat dikembalikan setelah dihapus!",
            icon: 'warning',
            showCancelButton: true, // Tampilkan tombol Batal
            confirmButtonColor: '#d33', // Warna tombol Hapus
            cancelButtonColor: '#3085d6', // Warna tombol Batal
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            // Hanya hapus jika user menekan "Ya, Hapus!"
            if (result.isConfirmed) {
                // Proses penghapusan
                window.location.href = `/kebun/delete/${idKebun}`;
            }
        });
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<?php echo $this->endSection() ?>