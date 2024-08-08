<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">
                            <i class="fa-solid fa-house"></i>
                        </a></li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->

    <!-- /.card -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?= $categoryCount; ?></h3>

                    <p>Kategori</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fas fa-list"></i>
                </div>
                <a href="<?= base_url() ?>category" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?= $productCount; ?><sup style="font-size: 20px"></sup></h3>

                    <p>Produk</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fas fa-ellipsis-h"></i>

                </div>
                <a href="<?= base_url() ?>product" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>44</h3>

                    <p>Barang Masuk</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fas">
                        <svg xmlns="http://www.w3.org/2000/svg" width="45.6" height="41" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                        </svg>
                    </i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>65</h3>

                    <p>Barang Keluar</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fas">
                        <svg xmlns="http://www.w3.org/2000/svg" width="45.6" height="41" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                            <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                        </svg>
                    </i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->

    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Barang terbaru</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Brand</th>
                        <th>Nama Barang</th>
                        <th>Kode Barang</th>
                        <th>Stock</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>Samsung</td>
                        <td>Monitor 19 inch</td>
                        <td>SM-M12
                        </td>
                        <td>3</td>
                        <td> Barang Elektronik</td>
                        <td><button type="button" class="btn btn-block btn-outline-info btn-sm">Info</button> </td>
                    </tr>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>Epson</td>
                        <td>Epson e-c890</td>
                        <td>EP-F89
                        </td>
                        <td>11</td>
                        <td> Barang Elektronik</td>
                        <td><button type="button" class="btn btn-block btn-outline-info btn-sm">Info</button> </td>
                    </tr>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>Mikrotik</td>
                        <td>CAT 5-E</td>
                        <td>CA-9
                        </td>
                        <td>11</td>
                        <td>Utilities</td>
                        <td><button type="button" class="btn btn-block btn-outline-info btn-sm">Info</button> </td>
                    </tr>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>Panasonic</td>
                        <td>Epson e-c890</td>
                        <td>EP-F89
                        </td>
                        <td>11</td>
                        <td> Barang Elektronik</td>
                        <td><button type="button" class="btn btn-block btn-outline-info btn-sm">Info</button> </td>
                    </tr>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>Xiaomi</td>
                        <td>Mi Taspen</td>
                        <td>TAS-98
                        </td>
                        <td>6</td>
                        <td> Alat</td>
                        <td><button type="button" class="btn btn-block btn-outline-info btn-sm">Info</button> </td>
                    </tr>


                    </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>

<?= $this->endSection() ?>