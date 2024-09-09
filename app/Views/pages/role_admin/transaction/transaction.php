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
                    <li class="breadcrumb-item"><a href="<?= base_url('/admin') ?>"><i class="fa-solid fa-house"></i></a></li>
                    <li class="breadcrumb-item"><span>Transaksi</span></li>
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
<section class="content">
    <div class="card mx-2">
        <div class="card-header">
            <p>Cari berdasarkan</p>
            <form action="<?= base_url('admin/transaction'); ?>" method="get" class="form-inline mb-3">
                <div class="form-group mr-2">
                    <br>
                    <label for="allocator" class="mr-2">Pengalokasi:</label>
                    <select name="allocator_id" id="allocator" class="form-control">
                        <option value="">Semua Pengalokasi</option>
                        <?php
                        $unique_allocators = array_unique(array_column($allocations, 'allocator_name'));
                        foreach ($allocations as $allocator):
                            if (in_array($allocator['allocator_name'], $unique_allocators)):
                        ?>
                                <option value="<?= $allocator['allocator_id']; ?>"><?= $allocator['allocator_name']; ?></option>
                        <?php
                                $unique_allocators = array_diff($unique_allocators, [$allocator['allocator_name']]);
                            endif;
                        endforeach;
                        ?>

                    </select>
                </div>
                <!-- <div class="form-group mr-2">
                    <label for="month" class="mr-2">Bulan:</label>
                    <select name="month" id="month" class="form-control">
                        <option value="">Semua Bulan</option>
                        <?php for ($i = 1; $i <= 12; $i++): ?>
                            <option value="<?= $i; ?>"><?= date('F', mktime(0, 0, 0, $i, 10)); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="form-group mr-2">
                    <label for="year" class="mr-2">Tahun:</label>
                    <select name="year" id="year" class="form-control">
                        <option value="">Semua Tahun</option>
                        <?php for ($year = 2020; $year <= date('Y'); $year++): ?>
                            <option value="<?= $year; ?>"><?= $year; ?></option>
                        <?php endfor; ?>
                    </select>
                </div> -->
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <div class="btn-group btn-group-toggle my-1" data-toggle="buttons">
                <label class="btn">
                    <a href="<?= base_url('admin/transaction/pdf') ?>" target="_blank" class="btn-sm btn-secondary ">
                        <i class="fa-solid fa-file-pdf"></i> Generate PDF
                    </a>
                </label>
            </div>
            <div class="card-tools mr-1">
                <a href="<?= base_url('admin/transaction/create') ?>" class="btn" style="background-color: #00008B; color: white">
                    <i class="fa-solid fa-plus"></i> Tambah Transaksi
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="myTable" class="stripe responsive">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID</th>
                        <th><span style="margin:0 15px">Nama Barang</span></th>
                        <th><span style="margin:0 15px">Tipe Alokasi</span></th>
                        <th><span style="margin:0 15px">Penerima</span></th>
                        <th>Tanggal Alokasi</th>
                        <th>Qty</th>
                        <th><span style="margin:0 15px">Pengalokasi</span></th>
                        <th><span style="margin:0 15px">Aksi</span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php if (!empty($allocations)) : ?>
                        <?php foreach ($allocations as $a) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $a['id'] ?? '-'; ?></td>
                                <td><span style="margin:0 15px"><?= $a['product_name'] ?? '-'; ?></span></td>
                                <td style="text-align: center;">
                                    <?php if ($a['allocation_type'] == 'person') : ?>
                                        <span class="badge badge-pill badge-info">Karyawan</span>
                                    <?php else : ?>
                                        <span class="badge badge-pill badge-warning">Area</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($a['allocation_type'] == 'person') : ?>
                                        <span style="margin:0 15px"> <?= $a['recipient_name'] ?? '-' ?></span>
                                    <?php else : ?>
                                        <span style="margin:0 15px"> <?= $a['area_name'] ?? '-' ?></span>
                                    <?php endif; ?>
                                </td>
                                <td><?= $a['allocation_date'] ?? '-'; ?></td>
                                <td><?= $a['quantity'] ?? '-'; ?></td>
                                <td><span style="margin:0 15px"><?= $a['allocator_name'] ?? '-'; ?></span></td>
                                <td>
                                    <div class="d-flex gap-1" style="margin: 10px 15px">
                                        <a href="<?= base_url('admin/transaction/detail/' . $a['id']) ?>" class="btn btn-outline-info">
                                            <i class="fa-regular fa-eye"></i> </a>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?= $a['id']; ?>">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                    <div class="modal fade" id="deleteModal<?= $a['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?= $a['id']; ?>" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel<?= $a['id']; ?>">Konfirmasi Hapus</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus <span style="color: red; font-weight: bold;"><?= $a['allocation_type']; ?></span> dari data Transaksi?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                                                    <form action="<?= base_url('admin/allocations/delete/' . $a['id']); ?>" method="post" style="display:inline;">
                                                        <?= csrf_field() ?>
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="fa-solid fa-trash-can"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="9" class="text-center">Tidak ada data</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            PT. ALP Petro Industry
        </div>
    </div>
</section>
<?= $this->endSection(); ?>