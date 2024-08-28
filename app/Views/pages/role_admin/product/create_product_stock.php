add_product

<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Form Tambah Stok</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="fa-solid fa-house"></i></a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('product') ?>" style="text-color: black">Produk</a></li>
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
            <form action="<?= base_url('admin/product/save/stock') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="id_brand" class="form-label">Nama Barang</label>
                        <select class="form-control" id="id_product" name="id_product" required>
                            <option value="" class="text-center">.:: Pilih Barang ::.</option>
                            <?php if (!empty($products)) : ?>
                                <?php foreach ($products as $p) : ?>
                                    <option value="<?= $p['id']; ?>"><?= esc($p['product_name']); ?></option>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <option value="">Barang tidak tersedia</option>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="id_department" class="form-label">Status</label>
                        <select class="form-control" id="id_status" name="id_status" required>
                            <option value="" class="text-center">.:: Pilih Status ::.</option>
                            <?php if (!empty($status)) : ?>
                                <?php foreach ($status as $s) : ?>
                                    <option value="<?= $s['id']; ?>"><?= esc($s['status_name']); ?></option>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <option value="">Kategori tidak tersedia</option>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="product_name" class="col-sm-2 col-form-label">Kode Item</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="item_code" name="item_code" autofocus required placeholder="Masukkan Kode Item">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="description" class="col-sm-2 col-form-label">Deskripsi Kerusakan</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="damage_description" name="damage_description" placeholder="Masukkan Deskripsi Kerusakan Terkait"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="price" class="col-sm-2 col-form-label">Stok</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="quantity" name="quantity" required placeholder="Masukkan Stok">
                    </div>
                </div>
                <!-- <div class="row mb-3" id="damage-description-container" style="display: none;">
                    <label for="damage_description" class="col-sm-2 col-form-label">Deskripsi Kerusakan:</label>
                    <div class="col-sm-12">
                        <textarea id="damage_description" name="damage_description" class="form-control" placeholder="Masukkan Deskripsi Kerusakan"></textarea>
                    </div>
                </div> -->
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