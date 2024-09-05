<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Halaman Area</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>"><i class="fa-solid fa-house"></i></a></li>
                    <li class="breadcrumb-item"><span>Area</span></li>
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
            <a href="<?= base_url('admin/area/create') ?>" class="btn" style="background-color: #00008B; color: white"><i class="fa-solid fa-plus"></i> Tambah Area</a>
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
                        <th>ID Area</th>
                        <th><span style="margin:0 15px">Nama Area</span></th>
                        <th><span style="margin:0 15px">Aksi</span> </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php if (!empty($area)) : ?>
                        <?php foreach ($area as $a) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><span style="margin:0 15px"><?= $a['id']; ?></span></td>
                                <td><span style="margin:0 15px"><?= $a['area_name']; ?></span></td>
                                <td>
                                    <div class="d-flex gap-1" style="margin: 10px 15px">
                                        <a href="<?= base_url('admin/area/detail/' . $a['id']); ?>" class="btn btn-outline-info">
                                            <i class="fa-regular fa-eye"></i> </a>
                                        </a>
                                        <a href="<?= base_url('admin/area/edit/' . $a['id']); ?>" class="btn btn-outline-warning">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>

                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?= $a['id']; ?>">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
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
                                                        Apakah Anda yakin ingin menghapus <span style="color: red; font-weight: bold;"><?= $a['area_name']; ?></span> dari data area?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                                                        <form action="<?= base_url('admin/area/delete/' . $a['id']); ?>" method="post" style="display:inline;">
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
<?= $this->endSection() ?>