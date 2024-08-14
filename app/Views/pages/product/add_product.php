<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Form Tambah Produk</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="fa-solid fa-house"></i></a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>product" style="text-color: black">Produk</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>product/create" style="text-color: black">Tambah Produk</a></li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form action="/product/save" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="product_name" class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="product_name" name="product_name" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <div>
                        <input type="radio" id="good" name="status" value="good" checked>
                        <label for="good">Bagus</label>
                    </div>
                    <div>
                        <input type="radio" id="partially_damaged" name="status" value="partially_damaged">
                        <label for="partially_damaged">Rusak Sebagian</label>
                    </div>
                    <div>
                        <input type="radio" id="damaged" name="status" value="damaged">
                        <label for="damaged">Rusak</label>
                    </div>
                </div>
                <div class="form-group" id="damage-description-container" style="display: none;">
                    <label for="damage_description">Deskripsi Kerusakan:</label>
                    <textarea id="damage_description" name="damage_description" class="form-control"></textarea>
                </div>

                <div class="row mb-3">
                    <label for="brand_name" class="col-sm-2 col-form-label">Brand</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="brand_name" name="brand_name" autofocus>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="description" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="price" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="price" name="price">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="product_image" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="product_image" name="product_image">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="kategori" name="id_category">
                            <?php if (!empty($categories)) : ?>
                                <?php foreach ($categories as $c) : ?>
                                    <option value="<?= $c['id']; ?>">
                                        <?= esc($c['category_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <option value="">Kategori tidak tersedia</option>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="sampul" class="col-sm-2 col-form-label">Stok</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="stock" name="stock">
                    </div>
                </div>
                <a href="<?= base_url() ?>product" class="btn btn-outline-secondary"><i class="fa-solid fa-chevron-left"></i></a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            Footer
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
    <script>
        document.querySelectorAll('input[name="status"]').forEach((elem) => {
            elem.addEventListener('change', (event) => {
                if (event.target.value === 'partially_damaged') {
                    document.getElementById('damage-description-container').style.display = 'block';
                } else {
                    document.getElementById('damage-description-container').style.display = 'none';
                }
            });
        });
    </script>
</section>
<?= $this->endSection() ?>