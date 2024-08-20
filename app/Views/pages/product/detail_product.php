<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<?php

use CodeIgniter\I18n\Time; ?>



<?php
// Asumsi $product adalah array yang berisi data produk
$statusLabels = [
    1 => 'Baik',
    2 => 'Rusak Sebagian',
    3 => 'Rusak'
];

$statusLabel = isset($statusLabels[$product['id_status']]) ? $statusLabels[$product['id_status']] : 'Tidak Diketahui';
?>

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
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>product/create" style="text-color: black">Tambah Produk</a></li>
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
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body" style="display: flex; align-items: flex-start;">
                        <!-- Gambar Produk -->
                        <div style="flex-shrink: 0; margin-right: 20px;">
                            <img src="/uploads/<?= esc($product['product_image']); ?>" width="200">
                        </div>
                        <!-- Detail Produk -->
                        <div>
                            <h3><?= esc($product['product_name']); ?></h3>
                            <p><strong>Brand:</strong> <?= esc($product['brand_name']); ?></p>
                            <p><strong>Harga:</strong> <?= esc($product['price']); ?></p>
                            <p><strong>Stok:</strong> <?= esc($product['stock']); ?></p>
                            <p><strong>Deskripsi:</strong> <?= esc($product['description']); ?></p>
                            <p><strong>Kondisi:</strong> <?= esc($statusLabel); ?></p>
                            <?php if ($product['id_status'] == 2): ?>
                                <p><strong>Deskripsi Kerusakan:</strong> <?= esc($product['damage_description']); ?></p>
                            <?php endif; ?> <p><strong>Sejak:</strong> <?= esc($product['created_at']); ?><?= ' | '; ?><?= esc($since); ?> </p>

                        </div>
                    </div>
                </div>
                <a href="<?= base_url() ?>product" class="btn btn-outline-secondary"><i class="fa-solid fa-chevron-left"></i></a>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            Footer
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->

</section>
<?= $this->endSection() ?>