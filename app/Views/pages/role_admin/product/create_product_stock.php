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
                    <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>"><i class="fa-solid fa-house"></i></a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/product') ?>" style="text-color: black">Produk</a></li>
                    <li class="breadcrumb-item"><span>Tambah Stok</span></li>
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
                    <div class="col-md-2">
                        <label for="id_product" class="form-label">Nama Barang</label>
                    </div>
                    <div class="col-md-10">
                        <select class="form-control" id="id_product" name="id_product" required>
                            <option value="" class="text-center">.:: Pilih Barang ::.</option>
                            <?php foreach ($products as $p) : ?>
                                <option value="<?= $p['id']; ?>"><?= esc($p['product_name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <?php foreach ($status as $s) : ?>
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label for="quantity_<?= $s['id'] ?>" class="form-label"><?= esc($s['status_name']); ?>:</label>
                        </div>
                        <div class="col-md-10">
                            <input type="number" class="form-control" id="quantity_<?= $s['id'] ?>" name="quantity[<?= $s['id'] ?>]" value="0" required placeholder="Masukkan Stok untuk <?= esc($s['status_name']); ?>">
                        </div>
                    </div>
                    <?php if ($s['status_name'] == 'Rusak Sebagian') : ?>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="damage_description_<?= $s['id'] ?>" class="form-label">Deskripsi Kerusakan:</label>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control" id="damage_description_<?= $s['id'] ?>" name="damage_description[<?= $s['id'] ?>]" placeholder="Masukkan Deskripsi Kerusakan"></textarea>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                <a href="<?= base_url('admin/product') ?>" class="btn btn-outline-secondary"><i class="fa-solid fa-chevron-left"></i> Kembali</a>
                <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Simpan</button>
            </form>
        </div>
        <div class="card-footer">
            PT. ALP Petro Industry
        </div>
    </div>
</section>
<?= $this->endSection() ?>