<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Form Edit Departemen</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="fa-solid fa-house"></i></a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>department" style="text-color: black">Departemen</a></li>
                    <li class="breadcrumb-item"><span>Edit Departemen <?= esc($department['department_name']); ?></span></li>
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
            <form action="<?= base_url('department/update/' . $department['id']); ?>" method="POST">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="department_name" class="col-sm-2 col-form-label">Nama Departemen</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="department_name" name="department_name" autofocus placeholder="Masukkan Nama Departemen" value="<?= $department['department_name']; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="department_description" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="department_description" name="department_description" placeholder="Masukkan Deskripsi Terkait Departemen"><?= $department['department_description']; ?></textarea>
                    </div>
                </div>
                <a href="javascript:history.back()" class="btn btn-outline-secondary"><i class="fa-solid fa-chevron-left"></i> Kembali</a>
                <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Simpan</button>
            </form>
        </div>
        <div class="card-footer">
            PT. ALP Petro Industry
        </div>
    </div>
</section>
<?= $this->endSection() ?>