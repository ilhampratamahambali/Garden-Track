<?php echo $this->extend('_partials/template_user2')?>
<?php echo $this->section('isi')?>

<style>
@media (max-width: 1200px) {
    .carousel-bg {
        height: 80vh; /* Untuk layar lebih kecil dari 1200px */
    }
}
@media (max-width: 992px) {
    .service-item {
        margin-bottom: 20px; /* Penyesuaian jarak pada layar lebih kecil */
    }
}
body {
    background-color: #f9f9f9; 
}
.form-container {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    max-width: 550px;
    margin: 50px auto;
}
.form-control {
    max-width: 700px;
}
.form-title {
    font-size: 28px;
    font-weight: bold;
    color: #333;
    margin-bottom: 30px;
    text-align: center;
}
#preview {
    display: none;
    width: 100%;
    max-height: 300px;
    margin-top: 15px;
    border-radius: 12px;
    object-fit: contain;
}
.btn-primary, .btn-secondary {
    padding: 10px 20px;
    border-radius: 6px;
    transition: all 0.3s ease;
        }
.btn-primary:hover {
    background-color: #0056b3;
}
.btn-secondary:hover {
    background-color: #6c757d;
}
</style>
<script>
    // Sesuaikan tinggi navbar di bawah ini
    const navbarHeight = 100; // Misal tinggi navbar Anda adalah 70px

    // Ambil semua tautan yang memiliki kelas "scroll-link"
    document.querySelectorAll('.scroll-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault(); // Mencegah aksi default

            // Ambil target dari atribut href
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
            // Hitung posisi scroll dengan mengurangi tinggi navbar
            const offsetTop = targetElement.offsetTop - navbarHeight;

            // Scroll ke posisi tersebut
            window.scrollTo({
                top: offsetTop,
                behavior: 'smooth'
            });
            }
        });
    });
</script>

<div class="container">
        <div class="form-container">
            <h1 class="form-title">Buat Kebun Anda</h1>
            <form id="catalogForm" action="/buat" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nama_kebun" class="form-label">Nama Kebun</label>
                    <input type="text" id="nama_kebun" name="nama_kebun" class="form-control" required>
                </div>
                <div class="mb-4">
                    <label for="poto_kebun" class="form-label">Image</label>
                    <input type="file" id="poto_kebun" name="poto_kebun" class="form-control" accept="image/*" required onchange="previewImage(event)">
                    <img id="preview" class="img-thumbnail">
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" onclick="resetForm()">Reset</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

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
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        }

        function resetForm() {
            const form = document.getElementById('catalogForm');
            const preview = document.getElementById('preview');
            const fileInput = document.getElementById('poto_kebun');
            form.reset();
            fileInput.value = '';
            preview.src = '';
            preview.style.display = 'none';
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php echo $this->endSection()?>