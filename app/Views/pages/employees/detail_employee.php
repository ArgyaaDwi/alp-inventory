<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>


<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Detail Karyawan</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="fa-solid fa-house"></i></a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>employees" style="text-color: black">Karyawan</a></li>
                    <li class="breadcrumb-item"><span><?= esc($employee['employee_name']); ?></span></li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
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
                <div class="card-body d-flex flex-column">
                    <div class="row flex-grow-1">
                        <div class="col-12">
                            <div class="card bg-light d-flex flex-fill">
                                <div class="card-header text-muted border-bottom-0">
                                    <h4><?= esc($employee['department_name']); ?></h4>
                                </div>
                                <div class="card-body d-flex flex-column pt-3">
                                    <div class="row flex-grow-1">
                                        <div class="col-7">
                                            <h2 class="lead mt-8"><b><?= esc($employee['employee_name']); ?> / <?= esc($employee['id']); ?></b></h2>
                                            <?php if ($employee['is_active'] == 1) : ?>
                                                <span class="badge badge-pill badge-success">Aktif</span>
                                            <?php else : ?>
                                                <span class="badge badge-pill badge-danger">Nonaktif</span>
                                            <?php endif; ?>
                                            <p class="text-muted text-sm"><b>Posisi: </b> <?= esc($employee['employee_position']); ?></p>
                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                <li class="small"><span class="fa-li"><i class="fa-regular fa-id-badge"></i></span>Badge: <?= esc($employee['employee_badge']); ?></li>
                                                <li class="small"><span class="fa-li"><i class="fa-solid fa-location-dot"></i></i></span> Alamat: <?= esc($employee['employee_address']); ?></li>
                                                <li class="small"><span class="fa-li"><i class="fa-regular fa-envelope"></i></span> Email: <?= esc($employee['employee_email']); ?></li>
                                                <li class="small"><span class="fa-li"><i class="fa-solid fa-square-phone"></i></i></span> No. Telepon: <?= esc($employee['employee_phone']); ?></li>
                                            </ul>
                                            <br>
                                            <p class="text-muted text-sm"><b>Bergabung Sejak: </b> <?= esc($employee['created_at']); ?> | <?= esc($sinceCreate); ?> </p>
                                            <p class="text-muted text-sm"><b>Terakhir Diperbarui: </b> <?php if ($employee['updated_at'] == NULL) : ?> - <?php else : ?> <?= esc($employee['updated_at']); ?> | <?= esc($sinceUpdate); ?> <?php endif; ?></p>
                                            <a href="<?= base_url() ?>product" class="btn btn-warning"><i class="fa-regular fa-rectangle-list"></i> List Barang Yang Dipinjam</a>
                                            <br>
                                        </div>
                                        <div class="col-5 text-center">
                                            <img src="/uploads/<?= esc($employee['employee_image']); ?>" alt="user-avatar" class="img-circle img-fluid">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <a href="<?= base_url() ?>employees" class="btn btn-outline-secondary"><i class="fa-solid fa-chevron-left"></i> Kembali</a>
                <a href="<?= base_url() ?>employees/edit/<?= $employee['id']; ?>" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i> Perbarui Data</a>
            </div>
        </div>
        <div class="card-footer">
            PT. ALP Petro Industry
        </div>
    </div>
</section>
<?= $this->endSection() ?>