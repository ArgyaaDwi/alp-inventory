<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Form Edit Produk</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>"><i class="fa-solid fa-house"></i></a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/product') ?>" style="text-color: black">Produk</a></li>
                    <li class="breadcrumb-item"><span>Edit Produk <?= esc($product['product_name']); ?></span></li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card mx-2">
        <div class="card-header">
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form action="<?= base_url('admin/product/update/' . $product['id']); ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="id_brand" class="form-label">Brand</label>
                        <select class="form-control" id="brand_id" name="id_brand" required>
                            <option value="" class="text-center">.:: Pilih Brand ::.</option>
                            <?php if (!empty($brands)) : ?>
                                <?php foreach ($brands as $brand) : ?>
                                    <option value="<?= $brand['id']; ?>" <?= $product['id_brand'] == $brand['id'] ? 'selected' : ''; ?>>
                                        <?= esc($brand['brand_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <option value="">Brand tidak tersedia</option>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="id_department" class="form-label">Kategori</label>
                        <select class="form-control" id="category_id" name="id_category" required>
                            <option value="" class="text-center">.:: Pilih Kategori ::.</option>
                            <?php if (!empty($categories)) : ?>
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?= $category['id']; ?>" <?= $product['id_category'] == $category['id'] ? 'selected' : ''; ?>>
                                        <?= esc($category['category_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <option value="">Kategori tidak tersedia</option>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="judul" class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="product_name" name="product_name" value="<?= $product['product_name']; ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="penulis" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="description" name="product_description"><?= esc($product['product_description']); ?></textarea>
                    </div>

                </div>
                <div class="row mb-3">
                    <label for="product_placement" class="col-sm-2 col-form-label">Penempatan Barang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="product_placement" name="product_placement" value="<?= $product['product_placement']; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="penerbit" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="price" name="product_price" value="<?= esc($product['product_price']); ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="sampul" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="product_image" name="product_image">
                        <img src="<?= base_url('uploads/product/' . esc($product['product_image'])); ?>" width="100" class="mt-2">
                        <i class="fas fa-info-circle"></i> Gunakan gambar rasio 1:1 untuk hasil yang maksimal dengan maks ukuran 1MB [JPG, JPEG, PNG].

                    </div>
                </div>





                <a href="<?= base_url('admin/product') ?>" class="btn btn-outline-secondary"><i class="fa-solid fa-chevron-left"></i> Kembali</a>
                <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Simpan</button>
            </form>
        </div>
        <div class="card-footer">
            PT. ALP Petro Industry
        </div>
    </div>
</section>
<script>
    document.getElementById('status').addEventListener('change', function() {
        var damageDescription = document.getElementById('damage_description');
        if (this.value === '2') {
            document.getElementById('damage-description-container').style.display = 'block';
            damageDescription.setAttribute('required', 'required');
        } else {
            document.getElementById('damage-description-container').style.display = 'none';
            damageDescription.removeAttribute('required');
        }
    });
</script>
<?= $this->endSection() ?>