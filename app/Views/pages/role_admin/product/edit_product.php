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
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="fa-solid fa-house"></i></a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>product" style="text-color: black">Produk</a></li>
                    <li class="breadcrumb-item"><span>Edit Produk <?= esc($product['product_name']); ?></span></li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form action="/product/update/<?= $product['id']; ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="judul" class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="product_name" name="product_name" value="<?= $product['product_name']; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="penulis" class="col-sm-2 col-form-label">Brand</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="brand_name" name="brand_name" value="<?= esc($product['brand_name']); ?>" autofocus>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="penulis" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="description" name="description"><?= esc($product['description']); ?></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="penerbit" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="price" name="price" value="<?= esc($product['price']); ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="sampul" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="product_image" name="product_image">
                        <img src="/uploads/<?= esc($product['product_image']); ?>" width="100" class="mt-2">
                      
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="id_category" name="id_category">
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
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select class="form-control" id="status" name="id_status" required>
                        <?php if (!empty($status)) : ?>
                            <?php foreach ($status as $s) : ?>
                                <option value="<?= $s['id']; ?>" <?= $product['id_status'] == $s['id'] ? 'selected' : ''; ?>>
                                    <?= esc($s['status_name']); ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <option value="">Status tidak tersedia</option>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="form-group" id="damage-description-container" style="<?= $product['id_status'] == 2 ? 'display: block;' : 'display: none;'; ?>">
                    <label for="damage_description">Deskripsi Kerusakan:</label>
                    <textarea id="damage_description" name="damage_description" class="form-control"><?= esc($product['damage_description']); ?></textarea>
                </div>

                <div class="row mb-3">
                    <label for="stock" class="col-sm-2 col-form-label">Stok</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="stock" name="stock" value="<?= esc($product['stock']); ?>">
                    </div>
                </div>
                <a href="<?= base_url() ?>product" class="btn btn-outline-secondary"><i class="fa-solid fa-chevron-left"></i> Kembali</a>
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