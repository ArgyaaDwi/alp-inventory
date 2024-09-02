<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Halaman Karyawan</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('/admin') ?>"><i class="fa-solid fa-house"></i></a></li>
                    <li class="breadcrumb-item"><span>Karyawan</span></li>
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
    <div class="card">
        <div class="card-header">
            <a href="<?= base_url('admin/employees/create') ?>" class="btn" style="background-color: #00008B; color: white"><i class="fa-solid fa-plus"></i> Tambah Karyawan</a>
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
                        <th>ID</th>
                        <th>NIP</th>
                        <th><span style="margin:0 15px">Nama Karyawan</span></th>
                        <th><span style="margin:0 15px">Email Karyawan</span></th>
                        <th><span style="margin:0 15px">Departemen</span></th>
                        <th><span style="margin:0 15px">Status</span></th>
                        <th><span style="margin:0 15px">Aksi</span> </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php if (!empty($employee)) : ?>
                        <?php foreach ($employee as $e) : ?>
                            <tr>
                                <td><span style="margin:0 15px"><?= $no++; ?></span></td>
                                <td><span style="margin:0 15px"><?= $e['id'] ?? '-'; ?></span></td>
                                <td><span style="margin:0 15px"><?= $e['employee_badge'] ?? '-'; ?></span></td>
                                <td><span style="margin:0 15px"><?= $e['employee_name'] ?? '-'; ?></span></td>
                                <td><span style="margin:0 15px"><?= $e['employee_email'] ?? '-'; ?></span></td>
                                <td><span style="margin:0 15px"><?= $e['department_name'] ?? '-'; ?></span></td>
                                <td><span style="display: flex; justify-content: center">
                                        <?php if ($e['is_active'] == 1) : ?>
                                            <span class="badge badge-pill badge-success">Aktif</span>
                                        <?php else : ?>
                                            <span class="badge badge-pill badge-danger">Nonaktif</span>
                                        <?php endif; ?></span></td>
                                <td>
                                    <div class="d-flex gap-1" style="margin: 10px 15px">
                                        <a href="<?= base_url('admin/employees/detail/' . $e['id']); ?>" class="btn btn-outline-info">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                            </svg>
                                        </a>
                                        <a href="<?= base_url('admin/employees/edit/' . $e['id']); ?>" class="btn btn-outline-warning">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <?php if ($e['is_active'] == 1) : ?>
                                            <a href="<?= base_url('admin/employees/toggle_status/' . $e['id']); ?>" class="btn btn-success">
                                                <i class="fa-solid fa-toggle-on"></i> </a>
                                        <?php else : ?>
                                            <a href="<?= base_url('admin/employees/toggle_status/' . $e['id']); ?>" class="btn btn-secondary">
                                                <i class="fa-solid fa-toggle-off"></i> </a>
                                        <?php endif; ?>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?= $e['id']; ?>">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                </td>
                                <div class="modal fade" id="deleteModal<?= $e['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?= $e['id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel<?= $e['id']; ?>">Konfirmasi Hapus</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus <span style="color: red; font-weight: bold;"><?= $e['employee_name']; ?></span> dari data karyawan?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                                                <form action="
                                                <?= base_url('admin/employees/delete/' . $e['id']); ?>" method="post" style="display:inline;">
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
    </div>
    </td>
    </tr>

<?php endforeach; ?>
<?php else : ?>
    <tr>
        <td colspan="8" class="text-center">Tidak ada data</td>
    </tr>
<?php endif; ?>

</tfoot>
</table>
</div>
<div class="card-footer">
    PT. ALP Petro Industry
</div>
</div>
</section>


<?= $this->endSection() ?>