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
    <div class="container">
        <h2 class="mb-4">Form Tambah Tanaman</h2>
        <form action="<?= base_url('/tanaman/tambah') ?>" method="post" enctype="multipart/form-data">
            <!-- Pilih Tanaman -->
            <div class="mb-3">
                <label class="form-label">Pilih Tanaman</label>
                <select class="form-select" name="id_tanaman" required>
                    <option value="">-- Pilih Tanaman --</option>
                    <?php foreach ($dataTanaman as $tanaman) : ?>
                        <option value="<?= $tanaman['id_tanaman'] ?>">
                            <?= $tanaman['common_name'] ?> (<?= $tanaman['scientific_name'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- Jumlah Benih -->
            <div class="mb-3">
                <label class="form-label">Jumlah Benih</label>
                <input type="number" class="form-control" name="benih" required>
                <input type="hidden" name="id_kebun" value="<?= $id_kebun ?>">
            </div>

            <!-- Cara Menanam -->
            <div class="mb-3">
                <label class="form-label">Cara Menanam</label>
                <select class="form-select" name="cara_menanam" required>
                    <option value="">Pilih Metode</option>
                    <option value="benih">Benih</option>
                    <option value="bibit/tunas kecil">Bibit/Tunas Kecil</option>
                    <option value="stek">Stek</option>
                    <option value="pemisahan akar">Pemisahan Akar</option>
                    <option value="stolon">Stolon</option>
                    <option value="umbi lapis">Umbi Lapis</option>
                    <option value="umbi akar/umbi batang">Umbi Akar/Umbi Batang</option>
                    <option value="tanaman berakar telanjang">Tanaman Berakar Telanjang</option>
                    <option value="tanaman dewasa/siap tanam">Tanaman Dewasa/Siap Tanam</option>
                    <option value="sambungan/cangkok sambung">Sambungan/Cangkok Sambung</option>
                    <option value="cangkok">Cangkok</option>
                </select>
            </div>

            <!-- Kondisi Matahari -->
            <div class="mb-3">
                <label class="form-label">Kondisi Matahari</label>
                <select class="form-select" name="kondisi_matahari" required>
                    <option value="">Pilih Kondisi</option>
                    <option value="matahari penuh">Matahari Penuh</option>
                    <option value="setengah teduh">Setengah Teduh</option>
                    <option value="teduh">Teduh</option>
                </select>
            </div>

            <!-- Tanggal Mulai & Selesai -->
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="datetime-local" class="form-control" name="tanggal_mulai" required>
                </div>
                <div class="col">
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="date" class="form-control" name="tanggal_selesai" required>
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
                    required></textarea>
            </div>
            <!-- Tombol Submit -->
                <div class="mb-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
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
    $(document).ready(function() {
        $('#search').select2({
            placeholder: 'Cari tanaman...',
            templateResult: formatTanaman,
            templateSelection: formatTanamanSelection,
            ajax: {
                url: '<?= site_url('/tanaman/search') ?>',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        term: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 1
        });

        // Format hasil pencarian di Select2
        function formatTanaman(tanaman) {
            if (!tanaman.id) {
                return tanaman.text;
            }
            var image = tanaman.image ? 
                `<img src="${tanaman.image}" class="select2-result-repository__image">` : 
                '<img src="<?= base_url('assets/default-plant.jpg') ?>" class="select2-result-repository__image">';
            return $(`<span>${image} ${tanaman.text}</span>`);
        }

        // Format pilihan yang dipilih
        function formatTanamanSelection(tanaman) {
            // Simpan ID tanaman yang dipilih ke hidden input
            $('#selected_plant_id').val(tanaman.id);
            return tanaman.text;
        }
    });
    </script>
<?php echo $this->endSection() ?>
