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

    /* Specific styling for plant cards */
    .plant-card {
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .plant-card .card-img-top {
        width: 100%;
        height: 200px; /* Fixed height for images */
        object-fit: cover; /* This ensures images cover the area without distortion */
    }
    
    .plant-card .card-body {
        flex: 1; /* This allows the card body to take up remaining space */
        display: flex;
        flex-direction: column;
    }
    
    .plant-card .card-text {
        flex-grow: 1; /* This allows the text to expand */
    }

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

    /* nambah sikit */
    section h2 {
        background-color: #57803c;
        box-shadow: 1px 1px 1px 1px #cac1b3;
        color: #fff;
        font-weight: normal;
        padding: 0.2em;
    }
    .index-cards {
        display: flex;
        flex: none;
        flex-wrap: wrap;
    }
    /* Styling Badge Owner - Warna Lebih Kontras */
    .badge-owner {
        background-color:rgba(233, 215, 206, 0.3) !important; /* Warna oranye kemerahan */
        color: black;
        padding: 5px 10px;
        font-size: 12px;
        font-weight: bold;
        border-radius: 8px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
    }
    .badge-owner-container {
        display: inline-block;
        margin-left: 10px; /* Tambahkan jarak dengan nama pengguna */
    }

</style>
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="px-4 px-lg-5" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/user_page">Home</a></li>
        <li class="breadcrumb-item"><a href="/kebun/semua-kebun">Kebun</a></li>
        <li class="breadcrumb-item active"><?= esc($kebun['nama_kebun']) ?></li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-9">
        <section class="container mt-4">
            <?php if (session()->get('id_user') == $kebun['id_user']): ?>
                <!-- Tombol Tambah Tanaman -->
                <a href="/tanaman/tambah/<?= $kebun['id_kebun'] ?>" class="btn btn-success">Tambah Tanaman</a>
            <?php endif; ?>
            <!-- Daftar Tanaman -->
            <?php if (empty($tanaman)): ?>
                <div class="alert alert-info text-center">
                    Belum memiliki tanaman di kebun ini.
                    <br>
                </div>
            <?php else:?>
                <section>
                    <h2>Tanaman Pada Kebun <?= $kebun['nama_kebun'] ?></h2>
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <?php foreach ($tanaman as $item) : 
                            // Ambil image_url untuk setiap tanaman, atau set ke 'default.png' jika tidak ada
                            $image = $item['image_url'] ?? 'default.png'; 

                            // Mengecek apakah $image adalah URL yang valid
                            if (!empty($image) && filter_var($image, FILTER_VALIDATE_URL)) {
                                // Jika $image adalah URL yang valid, gunakan langsung URL tersebut
                                $poto = $image; 
                            } else {
                                // Jika $image bukan URL atau kosong, cek apakah file tersebut ada di folder uploads
                                $filePath = 'public/uploads/tanaman/' . $image;

                                // Cek apakah file ada di server (upload folder)
                                if (!empty($image) && file_exists($filePath)) {
                                    // Jika file ada di folder uploads, gunakan path ke file tersebut
                                    $poto = base_url('uploads/tanaman/' . $image);
                                } else {
                                    // Jika tidak ada file, gunakan gambar default
                                    $poto = base_url('uploads/tanaman/default.png');
                                }
                            }
                        ?>
                        
                            <div class="col">
                                <div class="card h-100 plant-card">
                                    <a href="/tanaman/detail/<?= $item['id'] ?>" >
                                        <img src="<?= $poto; ?>" class="card-img-top" alt="...">
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title"><?= esc($item['common_name']);?></h5>
                                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-body-secondary">DiTanam Pada <?= esc($item['tanggal_mulai']); ?></small>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>
        </section>
    </div>
    <div class="col-md-3">
        <section class="container mt-4">
            <!-- Kartu Detail Kebun -->
            <div class="card">
                <img src="<?= base_url('uploads/kebun/' . $kebun['poto_kebun']) ?>" alt="<?= htmlspecialchars($kebun['nama_kebun']) ?>">
                <div class="card-body">
                    <h5>Nama Kebun: <?= htmlspecialchars($kebun['nama_kebun']) ?></h5>
                        <!-- Tombol Edit dan Hapus -->
                    <div style="display: flex; justify-content: center; gap: 10px;">
                        <?php if (session()->get('id_user') == $kebun['id_user']): ?>
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
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>


<section class="mt-4">
    <h2>Komentar</h2>
    <!-- Form Komentar (Hanya untuk user selain pemilik kebun) -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="/kebun/komentar" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="id_kebun" value="<?= $kebun['id_kebun'] ?>">
                <div class="form-group">
                    <textarea name="komentar" class="form-control" rows="3" placeholder="Tulis komentar..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim Komentar</button>
            </form>
        </div>
    </div>
    <center><hr width="50%"></center>

    <!-- Menampilkan Komentar -->
    <?php if (empty($komentar)): ?>
    <p class="text-muted">Belum ada komentar.</p>
    <?php else: ?>
        <?php foreach ($komentar as $comment): ?>
            <?php if ($comment['induk_komentar_id'] == NULL): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="font-weight-bold"><?= htmlspecialchars($comment['nama_users']) ?> <span class="badge text-bg-secondary">4</span></span>
                        <span class="text-muted"><?= $comment['created_at'] ?></span>
                        <!-- Menambahkan badge Owner jika komentar dari pemilik kebun -->
                        <?php if ($comment['id_user'] == $kebun['id_user']): ?>
                            <div class="badge-owner-container">
                                <span class="badge badge-owner">Owner</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <p class="card-text"><?= htmlspecialchars($comment['komentar']) ?></p>

                    <!-- Tombol Balas -->
                    <?php if (session()->get('id_user')): ?>
                    <button class="btn btn-sm btn-outline-primary reply-btn" data-parent-id="<?= $comment['id_komentar'] ?>">Balas</button>

                    <!-- Form Balas Tersembunyi -->
                    <form action="/kebun/komentar" method="post" class="mt-3 reply-form" style="display: none;">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id_kebun" value="<?= $kebun['id_kebun'] ?>">
                        <input type="hidden" name="induk_komentar_id" value="<?= $comment['id_komentar'] ?>">
                        <div class="form-group">
                            <textarea name="komentar" class="form-control" rows="2" placeholder="Tulis balasan..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Kirim Balasan</button>
                    </form>
                    <?php endif; ?>

                    <!-- Balasan Komentar -->
                    <?php foreach ($komentar as $reply): ?>
                        <?php if ($reply['induk_komentar_id'] == $comment['id_komentar']): ?>
                        <div class="card mt-3 ml-5" style="border-left: 3px solid #007bff;"> <!-- Card kecil dengan border kiri -->
                            <div class="card-body p-3"> <!-- Padding lebih kecil -->
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="font-weight-bold"><?= htmlspecialchars($reply['nama_users']) ?></span>
                                    <span class="text-muted"><?= $reply['created_at'] ?></span>
                                    <!-- Menambahkan badge Owner jika komentar dari pemilik kebun -->
                                    <?php if ($reply['id_user'] == $kebun['id_user']): ?>
                                        <div class="badge-owner-container">
                                            <span class="badge badge-owner">Owner</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <p class="card-text mb-0"><?= htmlspecialchars($reply['komentar']) ?></p> <!-- Margin bottom 0 -->
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</section>

<script>
// Tampilkan/hilangkan form balasan
const replyButtons = document.querySelectorAll('.reply-btn');
replyButtons.forEach(button => {
    button.addEventListener('click', () => {
        const form = button.nextElementSibling;
        if (form.style.display === 'none' || !form.style.display) {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    });
});
</script>
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
<?php echo $this->endSection() ?>