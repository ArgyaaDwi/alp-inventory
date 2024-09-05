<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Form Tambah Area</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>"><i class="fa-solid fa-house"></i></a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/area') ?>" style="text-color: black">Area</a></li>
                    <li class="breadcrumb-item"><span>Tambah Area</span></li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="card mx-2">
        <div class="card-header">
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form action="<?= base_url('admin/area/save') ?>" method="POST">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="area_name" class="col-sm-2 col-form-label">Nama Area</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="area_name" name="area_name" autofocus placeholder="Masukkan Nama Area">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="area_description" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="area_description" name="area_description" placeholder="Masukkan Deskripsi Terkait Area"></textarea>
                    </div>
                </div>
                <a href="<?= base_url('admin/area') ?>" class="btn btn-outline-secondary"><i class="fa-solid fa-chevron-left"></i> Kembali</a>
                <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Simpan</button>
            </form>
        </div>
        <div class="card-footer">
            PT. ALP Petro Industry
        </div>
    </div>
</section>
<?= $this->endSection() ?>