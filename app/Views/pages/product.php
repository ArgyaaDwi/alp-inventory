<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Product Page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Dashboard</i></a></li>
                    <li class="breadcrumb-item"><a href="/product" style="text-color: black">Product</a></li>
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
            <h3 class="card-title">Title</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Barang</th>
                        <th>Brand</th>
                        <th>Harga</th>
                        <th>Gambar</th>
                        <th>Kategori</th>
                        <th>Stck</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($product as $p) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $p['product_name']; ?></td>
                            <td><?= $p['brand_name']; ?></td>
                            <td><?= $p['price']; ?></td>
                            <td>
                                <img src="/images/<?= $p['product_image']; ?>" width="50">
                            </td>
                            <td><?= $p['id_category']; ?></td>
                            <td><?= $p['stock']; ?></td>
                            <td><button type="button" class="btn btn-block btn-outline-info btn-sm">Info</button> </td>
                        </tr>
                    <?php endforeach; ?>

                    </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            Footer
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->

</section>
<?= $this->endSection() ?>