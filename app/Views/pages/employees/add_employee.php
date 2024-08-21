<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Form Tambah Karyawan</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="fa-solid fa-house"></i></a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>employees" style="text-color: black">Karyawan</a></li>
                    <li class="breadcrumb-item"><span>Tambah Karyawan</span></li>
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
            <form action="/employees/save" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="employee_badge" class="form-label">Nomor Badge</label>
                        <input type="number" class="form-control" id="employee_badge" name="employee_badge" required placeholder="Masukkan Nomor Badge">
                    </div>
                    <div class="col-md-6">
                        <label for="id_department" class="form-label">Departemen</label>
                        <select class="form-control" id="id_department" name="id_department" required>
                            <option value="" class="text-center">.:: Pilih Departemen ::.</option>
                            <?php if (!empty($departments)) : ?>
                                <?php foreach ($departments as $d) : ?>
                                    <option value="<?= $d['id']; ?>"><?= esc($d['department_name']); ?></option>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <option value="">Departemen tidak tersedia</option>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="employee_name" class="col-sm-2 col-form-label">Nama Karyawan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="employee_name" name="employee_name" autofocus required autofocus placeholder="Masukkan Nama Karyawan">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="employee_address" class="col-sm-2 col-form-label">Alamat Karyawan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="employee_address" name="employee_address" autofocus required placeholder="Masukkan Alamat Karyawan">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="employee_position" class="col-sm-2 col-form-label">Jabatan Karyawan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="employee_position" name="employee_position" autofocus required placeholder="Masukkan Jabatan Karyawan">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="employee_email" class="col-sm-2 col-form-label">Email Karyawan</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="employee_email" name="employee_email" autofocus required placeholder="Masukkan Email Karyawan">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="employee_phone" class="col-sm-2 col-form-label">No. Telephone</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="employee_phone" name="employee_phone" placeholder="Masukkan Nomor Telephone Karyawan">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="employee_image" class="col-sm-2 col-form-label">Foto</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="employee_image" name="employee_image" placeholder>
                        <small class="form-text text-muted mt-2">
                            <i class="fas fa-info-circle"></i> Gunakan gambar rasio 1:1 untuk hasil yang maksimal.
                        </small>
                    </div>
                </div>
                <br>
                <a href="<?= base_url() ?>employees" class="btn btn-outline-secondary"><i class="fa-solid fa-chevron-left"></i> Kembali</a>
                <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Simpan</button>
            </form>
        </div>
        <div class="card-footer">
            PT. ALP Petro Industry
        </div>
    </div>
</section>
<?= $this->endSection() ?>