<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Form Edit Karyawan</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="fa-solid fa-house"></i></a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>employees" style="text-color: black">Karyawan</a></li>
                    <li class="breadcrumb-item"><span>Edit Karyawan <?= $employee['employee_name']; ?></span></li>
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
            <form action="/employees/update/<?= $employee['id']; ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="employee_badge" class="form-label">Nomor Badge</label>
                        <input type="number" class="form-control" id="employee_badge" name="employee_badge" required placeholder="Masukkan Nomor Badge" value="<?= $employee['employee_badge']; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="id_department" class="form-label">Departemen</label>
                        <select class="form-control" id="id_department" name="id_department" required>
                            <?php if (!empty($departments)) : ?>
                                <?php foreach ($departments as $d) : ?>
                                    <option value="<?= $d['id']; ?>" <?= $employee['id_department'] == $d['id'] ? 'selected' : ''; ?>>
                                        <?= esc($d['department_name']); ?>
                                    </option>
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
                        <input type="text" class="form-control" id="employee_name" name="employee_name" required value="<?= $employee['employee_name']; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="employee_address" class="col-sm-2 col-form-label">Alamat Karyawan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="employee_address" name="employee_address" required value="<?= $employee['employee_address']; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="employee_position" class="col-sm-2 col-form-label">Jabatan Karyawan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="employee_position" name="employee_position" required value="<?= $employee['employee_position']; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="employee_email" class="col-sm-2 col-form-label">Email Karyawan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="employee_email" name="employee_email" required value="<?= $employee['employee_email']; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="employee_phone" class="col-sm-2 col-form-label">No. Telephone</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="employee_phone" name="employee_phone" value="<?= $employee['employee_phone']; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="employee_image" class="col-sm-2 col-form-label">Foto</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="employee_image" name="employee_image" placeholder>
                        <img src="/uploads/<?= esc($employee['employee_image']); ?>" width="100" class="mt-2">
                        <small class="form-text text-muted mt-2">
                            <i class="fas fa-info-circle"></i> Gunakan gambar rasio 1:1 untuk hasil yang maksimal.
                        </small>

                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="status_active" name="is_active" value="1" <?= $employee['is_active'] == 1 ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="status_active">
                                Active
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="status_non_active" name="is_active" value="0" <?= $employee['is_active'] == 0 ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="status_non_active">
                                Non-Active
                            </label>
                        </div>
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