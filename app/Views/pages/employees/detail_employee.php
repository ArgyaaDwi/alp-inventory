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
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>product/create" style="text-color: black">Tambah Produk</a></li>
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
                                    <h4> <?= esc($employee['id_department']); ?></h4>
                                </div>
                                <div class="card-body d-flex flex-column pt-3">
                                    <div class="row flex-grow-1">
                                        <div class="col-7">
                                            <h2 class="lead mt-8"><b><?= esc($employee['employee_name']); ?></b></h2>
                                            <p class="text-muted text-sm"><b>Position: </b> <?= esc($employee['employee_position']); ?></p>
                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: <?= esc($employee['employee_badge']); ?></li>
                                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: <?= esc($employee['employee_address']); ?></li>
                                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: <?= esc($employee['employee_email']); ?></li>
                                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone: <?= esc($employee['employee_phone']); ?></li>
                                            </ul>
                                        </div>
                                        <div class="col-5 text-center">
                                            <img src="<?= base_url() ?>/images/user.jpg" alt="user-avatar" class="img-circle img-fluid">
                                        </div>
                                    </div>
                                </div>
                             
                            </div>
                        </div>
                    </div>
                </div>
            
                <a href="<?= base_url() ?>product" class="btn btn-outline-secondary"><i class="fa-solid fa-chevron-left"></i></a>
            </div>
        </div>
        <div class="card-footer">
            PT. ALP Petro Industry
        </div>
    </div>
</section>
<?= $this->endSection() ?>