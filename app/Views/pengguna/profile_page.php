<?php echo $this->extend('_partials/template')?>
<?php echo $this->section('isi')?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <!-- Bootstrap 5 CSS -->
    <!-- Custom CSS -->
    <style>
        body {
            background: #fff; /* Background putih */
            color: #333; /* Warna teks gelap */
            font-family: 'Poppins', sans-serif;
        }
        .profile-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1); /* Shadow halus */
            padding: 2rem;
            margin-top: 5rem;
            border: 1px solid rgba(0, 0, 0, 0.1); /* Border tipis */
        }
        .profile-card img {
            width: 150px;
            height: 150px;
            border: 4px solid #28a745; /* Border hijau */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .profile-card h3 {
            font-weight: 600;
            margin-top: 1rem;
            color: #333; /* Warna teks gelap */
        }
        .profile-card .form-control {
            background: #f8f9fa; /* Warna input field abu-abu muda */
            border: none;
            color: #333;
            border-radius: 10px;
            padding: 0.75rem 1rem;
        }
        .profile-card .form-control:read-only {
            background: #f8f9fa; /* Tetap abu-abu muda untuk input readonly */
        }
        .profile-card .btn-success {
            background: #28a745; /* Warna hijau */
            border: none;
            border-radius: 10px;
            padding: 0.75rem 2rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .profile-card .btn-success:hover {
            background: #218838; /* Warna hijau lebih gelap saat hover */
            transform: translateY(-2px);
        }
        .profile-card .btn-success:active {
            transform: translateY(0);
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
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="profile-card text-center">
                    <!-- Foto Profil -->
                    <img src="<?= base_url($user->profile) ?>" alt="Profile Picture" class="img-fluid rounded-circle mb-3"  style="width: 150px; height: 150px; object-fit: cover;">
                    <!-- Nama Pengguna -->
                    <h3><?= esc($user->nama_users) ?></h3>
                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control text-center" id="email" value="<?= esc($user->email) ?>" readonly>
                    </div>
                    <div style="display: flex; justify-content: center; gap: 10px;">
                        <!-- Tombol Edit -->
                        <a href="/Pengguna/editProfile/<?= $user->id_user ?>" style="text-decoration: none;">
                            <button class="edit-button">
                                <svg class="edit-svgIcon" viewBox="0 0 512 512">
                                    <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path>
                                </svg>
                            </button>
                        </a>
                        <!-- Tombol Hapus -->
                        <a href="/Pengguna/deleteProfile/<?= $user->id_user ?>" id="deleteButton" style="text-decoration: none;">
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
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php echo $this->endSection()?>