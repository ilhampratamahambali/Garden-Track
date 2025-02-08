<?php echo $this->extend('_partials/template') ?>
<?php echo $this->section('isi') ?>
<style>
    body {
        background: #fff;
        color: #333;
        font-family: 'Poppins', sans-serif;
    }
    .profile-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1);
        padding: 2rem;
        margin-top: 5rem;
        border: 1px solid rgba(0, 0, 0, 0.1);
    }
    .profile-card img {
        width: 150px;
        height: 150px;
        border: 4px solid #28a745;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .profile-card h3 {
        font-weight: 600;
        margin-top: 1rem;
        color: #333;
    }
    .profile-card .form-control {
        background: #f8f9fa;
        border: none;
        color: #333;
        border-radius: 10px;
        padding: 0.75rem 1rem;
    }
    .profile-card .btn-success {
        background: #28a745;
        border: none;
        border-radius: 10px;
        padding: 0.75rem 2rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    .profile-card .btn-success:hover {
        background: #218838;
        transform: translateY(-2px);
    }
    .svgIcon {
        width: 12px;
        transition-duration: .3s;
    }
    .svgIcon path {
        fill: white;
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
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="profile-card text-center">
                <!-- Foto Profil -->
                <?php
                    $profilePath = $user->profile;
                    if (filter_var($profilePath, FILTER_VALIDATE_URL)) {
                        $profileSrc = $profilePath;
                    } else {
                        $profileSrc = base_url('uploads/profile/' . $profilePath);
                    }
                    // dd($profilePath,$profileSrc);
                    // die;
                ?>
                <img src="<?= esc($profileSrc) ?>" alt="Profile Picture" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                <!-- Form Edit Profil -->
                <h3>Edit Profil</h3>
                <form action="/Pengguna/updateProfile/<?= esc($user->id_user) ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="profile" class="form-label">Foto Profil</label>
                        <input type="file" class="form-control" id="profile" name="profile" accept="image/*" onchange="previewImage()">
                    </div>
                    <div class="mb-3">
                        <label for="nama_users" class="form-label">Nama</label>
                        <input type="text" class="form-control text-center" id="nama_users" name="nama_users" value="<?= esc($user->nama_users) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control text-center" id="email" name="email" value="<?= esc($user->email) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control text-center" id="password" name="password" value="">
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control text-center" id="confirm_password" name="confirm_password" value="">
                    </div>
                    <?php if (session()->getFlashdata('error')): ?>
                        <div style="color: red;">
                            <?php 
                            $errors = session()->getFlashdata('error'); 
                            if (is_array($errors)) {
                                foreach ($errors as $error) {
                                    echo "<p>$error</p>"; 
                                }
                            } else {
                                echo "<p>$errors</p>";
                            }
                            ?>
                        </div>
                    <?php endif; ?>
                    <div style="display: flex; justify-content: center; gap: 10px;">
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    </div>
                </form>
                <a href="#" id="deleteButton" style="text-decoration: none;">
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
<!-- Preview Image Script -->
<script>
    function previewImage() {
        const preview = document.getElementById('preview');
        const file = document.querySelector('input[type=file]').files[0];
        const reader = new FileReader();
        reader.onloadend = function () {
            preview.src = reader.result;
        }
        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "<?= esc($user->profile) ?>";
        }
    }

    // Cek apakah ada session flashdata 
    const successMessage = "<?= session()->getFlashdata('success') ?>";
    const errorMessages = <?= json_encode(session()->getFlashdata('error')) ?>;

    document.getElementById('deleteButton').addEventListener('click', function(event) {
        event.preventDefault(); // Cegah pindah halaman sebelum konfirmasi
        confirmDelete("<?= $user->id_user; ?>");
    });

    function confirmDelete(id_user) {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data ini tidak dapat dikembalikan setelah dihapus!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke URL penghapusan setelah konfirmasi
                window.location.href = `/Pengguna/deleteProfile/${id_user}`;
            }
        });
    }
    
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

    if (errorMessages) {
        let errorText = "";

        if (Array.isArray(errorMessages)) {
            errorText = errorMessages.join("\n");
        } else {
            errorText = er
        }

        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: errorText
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

    function confirmDelete(id_user) {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data ini tidak dapat dikembalikan setelah dihapus!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Deleted!",
                    text: "Akun Anda akan dihapus dalam 5 detik...",
                    icon: "success",
                    timer: 5000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                setTimeout(() => {
                    window.location.href = `/Pengguna/deleteProfile/${id_user}`;
                }, 5000);
            }
        });
    }
</script>
<?php echo $this->endSection()?>