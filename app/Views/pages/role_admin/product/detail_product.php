<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Detail Produk</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="fa-solid fa-house"></i></a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>product" style="text-color: black">Produk</a></li>
                    <li class="breadcrumb-item"><span><?= esc($product['product_name']); ?></span></li>
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
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body" style="display: flex; align-items: flex-start;">

                        <div style="flex-shrink: 0; margin-right: 20px;">
                            <h3>
                                <strong><?= esc($product['product_name']); ?></strong>
                            </h3>
                            <img src="<?=
                                        base_url('uploads/product/' . esc($product['product_image'])); ?>" width="400" style="margin: 10px auto;" alt="Product Image">
                            <p><strong>Sejak:</strong> <?= esc($product['created_at']); ?><?= ' | '; ?><?= esc($sinceCreate); ?> </p>
                            <p><strong>Update:</strong> <?= esc($product['updated_at']); ?><?= ' | '; ?><?= esc($sinceUpdate); ?> </p>
                        </div>
                        <div>
                            <h4><strong><?= esc($product['brand_name']); ?> / <?= esc($product['category_name']); ?></strong></h4>
                            <p><strong>Harga: </strong>Rp.<?= esc($product['product_price']); ?></p>
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label for="product_description" class="col-form-label">Deskripsi Produk:</label>
                                </div>
                                <div class="col-sm-20">
                                    <textarea class="form-control" id="product_description" disabled><?= esc($product['product_description']); ?></textarea>
                                </div>
                            </div>
                            <p><strong>Penempatan Barang:</strong> <?= esc($product['product_placement']); ?></p>
                            <p><strong>Total Stok:</strong> <?= esc($product['total_stock']); ?></p>
                            <p><strong>Bagus:</strong> <?= esc($product['good_stock']); ?></p>
                            <p><strong>Rusak Sebagian:</strong> <?= esc($product['partial_damage_stock']); ?></p>
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label for="partial_damage_descriptions" class="col-form-label">Deskripsi Kerusakan:</label>
                                </div>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="partial_damage_descriptions" disabled><?= esc($partialDamageDescriptions); ?></textarea>
                                </div>
                            </div>
                            <p><strong>Rusak:</strong> <?= esc($product['damaged_stock']); ?></p>

                        </div>
                    </div>
                </div>
                <a href="<?= base_url('admin/product') ?>" class="btn btn-outline-secondary"><i class="fa-solid fa-chevron-left"></i> Kembali</a>
                <a href="<?= base_url('admin/product/edit/' . $product['id']); ?>" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i> Perbarui Data</a>
            </div>
        </div>
        <div class="card-footer">
            PT. ALP Petro Industry
        </div>
    </div>
</section>
<?= $this->endSection() ?>