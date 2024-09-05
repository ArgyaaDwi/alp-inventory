<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Halaman Produk</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>"><i class="fa-solid fa-house"></i></a></li>
                    <li class="breadcrumb-item"><span>Produk</span></li>
                </ol>
            </div>
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                    <?= session()->getFlashdata('success'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<section class="content">
    <div class="card mx-2">
        <div class="card-header">
            <a href="<?= base_url('admin/product/create') ?>" class="btn" style="background-color: #00008B; color: white"><i class="fa-solid fa-plus"></i> Tambah Produk</a>
            <a href="<?= base_url('admin/product/create/stock') ?>" class="btn" style="background-color: indigo; color: white"><i class="fa-solid fa-plus"></i> Tambah Stok</a>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <table id="myTable" class="stripe responsive">
                <thead>
                    <tr>
                        <th>No.</th>
                        <!-- <th>ID.</th> -->
                        <th><span style="margin:0 15px">Nama Barang</span></th>
                        <th><span style="margin:0 15px">Brand</span> </th>
                        <!-- <th>Harga</th> -->
                        <!-- <th><span style="margin:0 15px">Gambar</span> </th> -->
                        <th><span style="margin:0 15px">Kategori</span> </th>
                        <th><span style="margin:0 15px">Stok</span> </th>
                        <th><span style="margin:0 15px">Available</span> </th>


                        <th><span style="margin:0 15px">Aksi</span> </th>
                    </tr>
                </thead>
                <tbody id="productTableBody">
                    <?php $no = 1; ?>
                    <?php if (!empty($products)) : ?>
                        <?php foreach ($products as $p) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <!-- <td><?= $p['id']; ?></td> -->
                                <td><span style="margin:0 15px"><?= $p['product_name']; ?></span></td>
                                <td><span style="margin:0 15px"><?= $p['brand_name']; ?></span> </td>
                                <!-- <td><span style="margin:0 15px"></span><?= $p['product_price']; ?></td> -->
                                <!-- <td style="padding-left: 17px; display: flex; justify-content: center; align-items: center; height: 100px;">
                                    <img src="<?=
                                                base_url('uploads/product/' . esc($p['product_image'])); ?>" width="120" style="margin: 10px auto;" alt="Product Image">
                                </td> -->
                                <td><span style="margin:0 15px"><?= $p['category_name']; ?></span></td>
                                <td><?= array_sum(array_column($p['stock_details'], 'status_stock')); ?></td>
                                <td>
                                    <?php
                                    $found = false;
                                    foreach ($p['stock_details'] as $stockDetail) :
                                        if ($stockDetail['status_name'] == 'Bagus') :
                                            $found = true;
                                    ?>
                                            <span class="badge badge-pill badge-success" style="margin:0 15px; padding:4px 13px">
                                                <?= $stockDetail['status_stock']; ?>
                                            </span>
                                    <?php
                                            break;
                                        endif;
                                    endforeach;
                                    ?>
                                    <?php if (!$found) : ?>
                                        <span>0</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="d-flex gap-1" style="margin: 10px 15px">
                                        <a href="<?= base_url('/admin/product/detail/' . $p['id']); ?>" class="btn btn-outline-info">
                                            <i class="fa-regular fa-eye"></i> </a>
                                        </a>
                                        <a href="<?= base_url('admin/product/edit/' . $p['id']); ?>" class="btn btn-outline-warning"><i class="fa-regular fa-pen-to-square"></i> </a>
                                        <a href="<?= base_url('admin/product/edit/stock/' . $p['id']); ?>" class="btn btn-primary"><i class="fa-solid fa-arrows-rotate"></i> Update Stok</i> </a>

                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?= $p['id']; ?>"><i class="fa-solid fa-trash-can"></i></button>
                                        <div class="modal fade" id="deleteModal<?= $p['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?= $p['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel<?= $p['id']; ?>">Konfirmasi Hapus</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus <span style="color: red; font-weight: bold;"><?= $p['product_name']; ?></span> dari data produk?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                                                        <form action="<?= base_url('admin/product/delete/' . $p['id']); ?>" method="post" style="display:inline;">
                                                            <?= csrf_field() ?>
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i>
                                                                Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            PT. ALP Petro Industry
        </div>
    </div>
</section>
<?= $this->endSection() ?>