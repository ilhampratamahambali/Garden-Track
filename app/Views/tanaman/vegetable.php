<?php echo $this->extend('_partials/template')?>
<?php echo $this->section('isi')?>
<div class="container mt-5">
    <h1 class="text-center mb-3">Data Sayuran</h1>

    <!-- Search bar -->
    <div class="container my-4">
        <form action="<?= base_url('plants/search') ?>" method="get" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari tanaman..." aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Cari</button>
        </form>
    </div>

    <!-- Plants Data -->
    <div class="container mt-5">
        <div class="row g-4" id="plantContainer">
            <?php foreach ($plants as $plant) : ?>
                <?php if (!empty($plant['common_name']) && !empty($plant['image_url'])) : // Hanya tampilkan jika tidak null ?>
                    <div class="col-md-4 plant-item">
                        <div class="card mb-4">
                            <img 
                                src="<?= $plant['image_url'] ?>" 
                                class="card-img-top" 
                                alt="<?= $plant['common_name'] ?>" 
                                style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title"><?= $plant['common_name'] ?></h5>
                                <p class="card-text">
                                    <strong>Nama Ilmiah:</strong> <?= $plant['scientific_name'] ?? 'Tidak Tersedia' ?><br>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <!-- Loader -->
        <div id="loading" class="text-center my-3" style="display: none;">
            <p>Loading...</p>
        </div>
    </div>
</div>
<script>
    let currentPage = 4;
    let loading = false;
    let hasMoreData = true;

    function fetchVegetables() {
        if (loading || !hasMoreData) return;
        loading = true;
        $('#loading').show();

        $.ajax({
            url: "<?= base_url('/vegetable') ?>",
            type: "GET",
            data: { page: currentPage },
            dataType: "json",
            success: function(data) {
                console.log("Fetched data:", data); // Debugging

                if (data.plants.length > 0) {
                    let container = $('#plantContainer');

                    $.each(data.plants, function(index, plant) {
                        console.log("Adding plant:", plant); // Debugging
                        let plantHtml = `
                            <div class="col-md-4 plant-item">
                                <div class="card mb-4">
                                    <img src="${plant.image_url}" class="card-img-top" style="height: 200px; object-fit: cover;">
                                    <div class="card-body">
                                        <h5 class="card-title">${plant.common_name}</h5>
                                        <p class="card-text">
                                            <strong>Nama Ilmiah:</strong> ${plant.scientific_name ?? 'Tidak Tersedia'}<br>
                                        </p>
                                    </div>
                                </div>
                            </div>`;
                        container.append(plantHtml);
                    });
                }

                hasMoreData = data.hasMore;
                currentPage++;
            },
            error: function(xhr, status, error) {
                console.error("Error loading data:", error);
            },
            complete: function() {
                $('#loading').hide();
                loading = false;
            }
        });
    }

    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 50) {
            fetchVegetables();
        }
    });
</script>

<?php echo $this->endSection()?>