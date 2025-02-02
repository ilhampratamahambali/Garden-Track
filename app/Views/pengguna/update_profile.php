
<?php echo $this->extend('_partials/template') ?>
<?php echo $this->section('isi') ?>

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
    </style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <!-- Style definitions remain the same -->
    </head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="profile-card text-center">
                    <!-- Foto Profil -->
                    <img src="<?= base_url($user->profile) ?>" alt="Profile Picture" class="img-fluid rounded-circle mb-3" id="preview" style="width: 150px; height: 150px; object-fit: cover;">
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
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
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
    </script>
</body>
</html>
<?php echo $this->endSection()?>