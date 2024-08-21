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
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="fa-solid fa-house"></i></a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>product" style="text-color: black">Produk</a></li>
                    <li class="breadcrumb-item"><span>Tambah Produk</span></li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form action="/product/save" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="product_name" class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="product_name" name="product_name" autofocus required placeholder="Masukkan Nama Barang">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="brand_name" class="col-sm-2 col-form-label">Brand</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="brand_name" name="brand_name" autofocus required placeholder="Masukkan Nama Brand">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="description" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="description" name="description" placeholder="Masukkan Deskripsi Terkait Barang"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="price" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="price" name="price" required placeholder="Masukkan Harga Barang">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="product_image" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="product_image" name="product_image" placeholder>

                    </div>
                </div>
                <div class="row mb-3">
                    <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="kategori" name="id_category" required>
                            <option value="" class="text-center">.:: Pilih Kategori ::.</option>
                            <?php if (!empty($categories)) : ?>
                                <?php foreach ($categories as $c) : ?>
                                    <option value="<?= $c['id']; ?>"><?= esc($c['category_name']); ?></option>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <option value="">Kategori tidak tersedia</option>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="status" name="id_status" required>
                            <option value="" class="text-center">.:: Pilih Status ::.</option>
                            <?php if (!empty($status)) : ?>
                                <?php foreach ($status as $s) : ?>
                                    <option value="<?= $s['id']; ?>"><?= esc($s['status_name']); ?></option>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <option value="">Status tidak tersedia</option>
                            <?php endif; ?>
                        </select>

                    </div>
                </div>
                <div class="row mb-3" id="damage-description-container" style="display: none;">
                    <label for="damage_description" class="col-sm-2 col-form-label">Deskripsi Kerusakan:</label>
                    <div class="col-sm-12">
                        <textarea id="damage_description" name="damage_description" class="form-control" required placeholder="Masukkan Deskripsi Kerusakan"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="stock" class="col-sm-2 col-form-label">Stok</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="stock" name="stock" placeholder="Masukkan Stok">
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