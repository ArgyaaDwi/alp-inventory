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
    <div class="card mx-2">
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
                                            <i class="fa-regular fa-eye"></i> </a>
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
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data</td>
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
<?= $this->endSection() ?>