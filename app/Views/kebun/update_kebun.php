<?php echo $this->extend('_partials/template')?>
<?php echo $this->section('isi')?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Kebun</title>
    <style>
        body {
            background-color: #f9f9f9;
        }
        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            max-width: 550px;
            margin: 50px auto;
        }
        .form-title {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }
        .form-control {
            max-width: 700px;
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
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1 class="form-title">Update Kebun</h1>
            <form id="updateForm" action="/kebun/update/<?= $kebun['id_kebun']; ?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nama_kebun" class="form-label">Nama Kebun</label>
                    <input type="text" id="nama_kebun" name="nama_kebun" class="form-control" value="<?= htmlspecialchars($kebun['nama_kebun']); ?>" required>
                </div>
                <div class="mb-4">
                    <label for="poto_kebun" class="form-label">Gambar Kebun</label>
                    <input type="file" id="poto_kebun" name="poto_kebun" class="form-control" accept="image/*" onchange="previewImage(event)">
                    <img id="preview" src="/uploads/<?= $kebun['poto_kebun']; ?>" class="img-thumbnail" style="display: block;">
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" onclick="resetForm()">Reset</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
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
            const form = document.getElementById('updateForm');
            const preview = document.getElementById('preview');
            const fileInput = document.getElementById('poto_kebun');
            form.reset();
            fileInput.value = '';
            preview.src = '/uploads/<?= $kebun['poto_kebun']; ?>';
            preview.style.display = 'block';
        }
    </script>
</body>
</html>
<?php echo $this->endSection()?>