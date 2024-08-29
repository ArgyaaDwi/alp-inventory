<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Detail Area</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>"><i class="fa-solid fa-house"></i></a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/area') ?>" style="text-color: black">Area</a></li>
                    <li class="breadcrumb-item"><span><?= esc($area['area_name']); ?></span></li>
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
                <div class="card">
                    <div class="card-body" style="display: flex; align-items: flex-start;">
                        <div>
                            <h3><?= esc($area['area_name']); ?></h3>
                            <p><strong>Deskripsi area:</strong> <?= esc($area['area_description']); ?></p>
                            <p><strong>Dibuat Pada:</strong> <?= esc($area['created_at']); ?></p>
                            <p><strong>Diupdate Pada:</strong> <?= esc($area['updated_at']); ?></p>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url('admin/area') ?>" class="btn btn-outline-secondary"><i class="fa-solid fa-chevron-left"></i> Kembali</a>
                <a href="<?= base_url('admin/area/edit/' . $area['id']) ?>" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i> Perbarui Data</a>
            </div>
        </div>
        <div class="card-footer">
            PT. ALP Petro Industry
        </div>
    </div>
</section>
<?= $this->endSection() ?>