<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Halaman Departemen</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>"><i class="fa-solid fa-house"></i></a></li>
                    <li class="breadcrumb-item"><span>Departemen</span></li>
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
    </div>
</section>
<section class="content">
    <div class="card mx-2">
        <div class="card-header">
            <a href="<?= base_url('admin/department/create') ?>" class="btn" style="background-color: #00008B; color: white"><i class="fa-solid fa-plus"></i> Tambah Departemen</a>
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
                        <th>ID Departemen</th>
                        <th><span style="margin:0 15px">Nama Departemen</span></th>
                        <th><span style="margin:0 15px">Aksi</span> </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php if (!empty($department)) : ?>
                        <?php foreach ($department as $d) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><span style="margin:0 15px"><?= $d['id']; ?></span></td>
                                <td><span style="margin:0 15px"><?= $d['department_name']; ?></span></td>
                                <td>
                                    <div class="d-flex gap-1" style="margin: 10px 15px">
                                        <a href="<?= base_url('admin/department/detail/' . $d['id']); ?>" class="btn btn-outline-info">
                                            <i class="fa-regular fa-eye"></i> </a>
                                        </a>
                                        <a href="<?= base_url('admin/department/edit/' . $d['id']); ?>" class="btn btn-outline-warning">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>

                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?= $d['id']; ?>">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                        <div class="modal fade" id="deleteModal<?= $d['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?= $d['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel<?= $d['id']; ?>">Konfirmasi Hapus</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus <span style="color: red; font-weight: bold;"><?= $d['department_name']; ?></span> dari data departemen?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                                                        <form action="
                                                        <?= base_url('admin/department/delete/' . $d['id']); ?>
                                                      " method="post" style="display:inline;">
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
    </div   >
</section>
<?= $this->endSection() ?>