<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Detail Kategori</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="fa-solid fa-house"></i></a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>category" style="text-color: black">Kategori</a></li>
                    <li class="breadcrumb-item"><span><?= esc($category['category_name']); ?></span></li>
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
                            <h3><?= esc($category['category_name']); ?></h3>
                            <p><strong>Deskripsi Kategori:</strong> <?= esc($category['category_description']); ?></p>
                            <p><strong>Dibuat Pada:</strong> <?= esc($category['created_at']); ?></p>
                            <p><strong>Diupdate Pada:</strong> <?= esc($category['updated_at']); ?></p>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url() ?>category" class="btn btn-outline-secondary"><i class="fa-solid fa-chevron-left"></i> Kembali</a>
                <a href="/category/edit/<?= $category['id']; ?>" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i> Perbarui Data</a>
            </div>
        </div>
        <div class="card-footer">
            PT. ALP Petro Industry
        </div>
    </div>
</section>
<?= $this->endSection() ?>