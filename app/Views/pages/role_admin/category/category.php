    <?= $this->extend('layouts/template'); ?>
    <?= $this->section('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><b>Halaman Kategori</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>"><i class="fa-solid fa-house"></i></a></li>
                        <li class="breadcrumb-item"><span>Kategori</span></li>
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
        <div class="card">
            <div class="card-header">
                <a href="<?= base_url('admin/category/create') ?>" class="btn" style="background-color: #00008B; color: white"><i class="fa-solid fa-plus"></i> Tambah Kategori</a>
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
                            <th>ID Kategori</th>
                            <th><span style="margin:0 15px">Nama Kategori</span></th>
                            <th><span style="margin:0 15px">Aksi</span> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php if (!empty($category)) : ?>
                            <?php foreach ($category as $c) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><span style="margin:0 15px"><?= $c['id']; ?></span></td>
                                    <td><span style="margin:0 15px"><?= $c['category_name']; ?></span></td>

                                    <td>
                                        <div class="d-flex gap-1" style="margin: 10px 15px">
                                            <a href="<?= base_url('admin/category/detail/' . $c['id']); ?>" class="btn btn-outline-info">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                                </svg>
                                            </a>
                                            <a href="<?= base_url('admin/category/edit/' . $c['id']); ?>" class="btn btn-outline-warning">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>

                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?= $c['id']; ?>">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                            <div class="modal fade" id="deleteModal<?= $c['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?= $c['id']; ?>" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel<?= $c['id']; ?>">Konfirmasi Hapus</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus <span style="color: red; font-weight: bold;"><?= $c['category_name']; ?></span> dari data kategori?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                                                            <form action="<?= base_url('admin/category/delete/' . $c['id']); ?>" method="post" style="display:inline;">
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