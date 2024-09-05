<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Halaman Transaksi</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url('/admin') ?>"><i class="fa-solid fa-house"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/transaction') ?>" style="text-color: black">Transaksi</a></li>

                    <li class="breadcrumb-item"><span>Detail Invoice</span></li>
                </ol>
            </div>
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

        <?php if (session()->getFlashdata('errors')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5><i class="icon fas fa-exclamation-triangle"></i> Kesalahan!</h5>
                <?= implode('<br>', session()->getFlashdata('errors')) ?>
            </div>
        <?php endif; ?>

    </div>
</section>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="invoice p-3 mb-3">
                <div class="row">
                    <div class="col-12">
                        <h4>
                            Invoice Alokasi <small class="float-right"><?= $allocationDetails['allocation_date']; ?></small>
                        </h4>
                    </div>
                </div>
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        From
                        <address>
                            <strong><?= $allocationDetails['allocator_name']; ?></strong><br>
                            Super Admin<br>
                            <?= $allocationDetails['allocator_address']; ?><br>
                            <?= $allocationDetails['allocator_phone']; ?><br>
                            Email: <?= $allocationDetails['allocator_email']; ?>
                        </address>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        To
                        <address>
                            <?php if ($allocationDetails['allocation_type'] == 'person') : ?>
                                <strong><?= $allocationDetails['recipient_name']; ?></strong><br>
                                <?= $allocationDetails['department_name']; ?><br>
                                <?= $allocationDetails['recipient_address']; ?><br>
                                <?= $allocationDetails['recipient_phone']; ?><br>
                                Email: <?= $allocationDetails['recipient_email']; ?>
                            <?php else : ?>
                                <strong><?= $allocationDetails['area_name']; ?></strong><br>
                            <?php endif; ?>
                        </address>
                    </div>

                    <div class="col-sm-4 invoice-col">
                        <b>Allocation ID:</b> <?= $allocationDetails['allocation_id']; ?><br>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Qty</th>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Brand</th>
                                    <th>Deskripsi Produk</th>
                                    <th>Harga Produk</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= $allocationDetails['quantity']; ?></td>
                                    <td><?= $allocationDetails['product_name']; ?></td>
                                    <td><?= $allocationDetails['category_name']; ?></td>
                                    <td><?= $allocationDetails['brand_name']; ?></td>
                                    <td><?= $allocationDetails['product_description']; ?></td>
                                    <td><?= $allocationDetails['product_price']; ?></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row no-print">
                    <div class="col-12">
                        <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                        <a href="<?= base_url('admin/transaction/pdf/detail/' . $allocationDetails['allocation_id']); ?>" class="btn btn-primary float-right" style="margin-right: 5px;">
                            <i class="fas fa-download"></i> Generate PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>