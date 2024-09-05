<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<?php

use CodeIgniter\I18n\Time; ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Detail Departemen</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="fa-solid fa-house"></i></a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/department') ?>" style="text-color: black">Departemen</a></li>
                    <li class="breadcrumb-item"><span><?= esc($department['department_name']); ?></span></li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
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
                    <div class="card-body" style="">
                        <div>
                            <h3><?= esc($department['department_name']); ?></h3>
                            <p><strong>Deskripsi Departemen:</strong> <?= esc($department['department_description']); ?></p>
                            <!-- <p><strong>Dibuat Pada:</strong> <?= esc($department['created_at']); ?></p>
                            <p><strong>Diupdate Pada:</strong> <?= esc($department['updated_at']); ?></p> -->
                            <a href="<?= base_url() ?>product" class="btn btn-warning disabled"><i class="fa-regular fa-rectangle-list"></i> List Karyawan Departemen <?= esc($department['department_name']); ?></a>
                            <div class="mt-2 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">ID Karyawan</th>
                                            <th scope="col">Badge</th>
                                            <th scope="col">Nama Karyawan</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Telephone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($employeesByDepartment)): ?>
                                            <?php $no = 1; ?>
                                            <?php foreach ($employeesByDepartment as $item): ?>
                                                <tr>
                                                    <th scope="row"><?= $no++; ?></th>
                                                    <td><?= esc($item['id']); ?></td>
                                                    <td><?= esc($item['employee_badge']); ?></td>
                                                    <td><?= esc($item['employee_name']); ?></td>
                                                    <td><?= esc($item['employee_email']); ?></td>
                                                    <td><?= esc($item['employee_phone']); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6" class="text-center">Tidak ada karyawan di departemen ini.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url('admin/department') ?>" class="btn btn-outline-secondary"><i class="fa-solid fa-chevron-left"></i> Kembali</a>
                <a href="
                <?= base_url('admin/department/edit/'  . $department['id']) ?>"
                    class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i> Perbarui Data</a>

            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            PT. ALP Petro Industry
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->

</section>
<?= $this->endSection() ?>