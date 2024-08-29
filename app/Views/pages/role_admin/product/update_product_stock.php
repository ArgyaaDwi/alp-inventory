<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Form Edit Stok</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>"><i class="fa-solid fa-house"></i></a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/product') ?>" style="text-color: black">Produk</a></li>
                    <li class="breadcrumb-item"><span>Edit Stok <?= esc($product['product_name']); ?></span></li>
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
            <form action="<?= site_url('admin/product/update/stock/' . $product['id']); ?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="product_id" value="<?= esc($product['id']); ?>">
                <div class="row mb-3">
                    <label for="product_name" class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="product_name" name="product_name" value="<?= $product['product_name']; ?>" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="id_brand" class="col-sm-2 col-form-label">Brand</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="id_brand" name="id_brand" value="<?= $product['brand_name']; ?>" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="id_category" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="id_category" name="id_category" value="<?= $product['category_name']; ?>" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="product_description<?= esc($product['product_description']); ?>" class="col-sm-2 col-form-label">Deskripsi Produk:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="product_description" id="product_description" disabled><?= esc($product['product_description']); ?></textarea>
                    </div>
                </div>
                <?php foreach ($productStocks as $stock): ?>
                    <div class="row mb-3">
                        <label for="quantity_<?= esc($stock['id_status']); ?>" class="col-sm-2 col-form-label">
                            <?= esc($stock['status_name']); ?>:
                        </label>
                        <div class="col-sm-10">
                            <input type="hidden" name="stocks[<?= esc($stock['id_status']); ?>][id]" value="<?= esc($stock['id']); ?>">
                            <input type="hidden" name="stocks[<?= esc($stock['id_status']); ?>][status]" value="<?= esc($stock['id_status']); ?>">
                            <input type="number" class="form-control" name="stocks[<?= esc($stock['id_status']); ?>][quantity]" id="quantity_<?= esc($stock['id_status']); ?>" value="<?= esc($stock['quantity']); ?>" required>
                        </div>
                    </div>
                    <?php if ($stock['status_name'] == 'Rusak Sebagian') : ?>
                        <div class="row mb-3">
                            <label for="damage_description_<?= esc($stock['id_status']); ?>" class="col-sm-2 col-form-label">Deskripsi Kerusakan:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="stocks[<?= esc($stock['id_status']); ?>][damage_description]" id="damage_description_<?= esc($stock['id_status']); ?>"><?= esc($stock['damage_description']); ?></textarea>
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