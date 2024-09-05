<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Form Tambah Produk</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>"><i class="fa-solid fa-house"></i></a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/product') ?>" style="text-color: black">Produk</a></li>
                    <li class="breadcrumb-item"><span>Tambah Produk</span></li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="card mx-2">
        <div class="card-header">
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form action="<?= base_url('admin/product/save') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="id_brand" class="form-label">Brand</label>
                        <select class="form-control" id="brand_id" name="id_brand" required>
                            <option value="" class="text-center">.:: Pilih Brand ::.</option>
                            <?php if (!empty($brands)) : ?>
                                <?php foreach ($brands as $brand) : ?>
                                    <option value="<?= $brand['id']; ?>"><?= esc($brand['brand_name']); ?></option>
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
                                    <option value="<?= $category['id']; ?>"><?= esc($category['category_name']); ?></option>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <option value="">Kategori tidak tersedia</option>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="product_name" class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="product_name" name="product_name" autofocus required placeholder="Masukkan Nama Barang">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="description" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="description" name="product_description" placeholder="Masukkan Deskripsi Terkait Barang"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="product_placement" class="col-sm-2 col-form-label">Penempatan Barang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="product_placement" name="product_placement" placeholder="Dimana Barang Ditempatkan">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="price" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="price" name="product_price" required placeholder="Masukkan Harga Barang">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="product_image" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="product_image" name="product_image">
                        <i class="fas fa-info-circle"></i> Gunakan gambar rasio 1:1 untuk hasil yang maksimal dengan maks ukuran 1MB [JPG, JPEG, PNG].
                    </div>
                </div>
                <div class="row mb-3" id="damage-description-container" style="display: none;">
                    <label for="damage_description" class="col-sm-2 col-form-label">Deskripsi Kerusakan:</label>
                    <div class="col-sm-12">
                        <textarea id="damage_description" name="damage_description" class="form-control" placeholder="Masukkan Deskripsi Kerusakan"></textarea>
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
    document.getElementById('status_id').addEventListener('change', function() {
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