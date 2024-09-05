<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Dashboard</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">
                            <i class="fa-solid fa-house"></i>
                        </a></li>
                </ol>
            </div>
            <?php if (session()->getFlashdata('success')) : ?>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                        title: 'Berhasil!',
                        text: '<?= session()->getFlashdata('success'); ?>',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#00008B'
                    });
                </script>
            <?php endif; ?>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <!-- /.card -->
    <div class="row mx-1">
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
                <a href="<?= base_url('admin/category') ?>" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3><?= $productCount; ?></h3>
                    <p>Produk</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-computer"></i>
                </div>
                <a href="<?= base_url('admin/product') ?>" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box" style="background-color: #4169E1;">
                <div class="inner">
                    <h3 class="text-white"><?= $areaCount; ?></h3>
                    <p class="text-white">Area</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fa-solid fa-map-location-dot"></i>
                </div>
                <a href="<?= base_url('admin/area') ?>" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box" style="background-color: #4682B4;">
                <div class="inner">
                    <h3 class="text-white"><?= $employeeCount; ?></h3>
                    <p class="text-white">Karyawan</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fa-regular fa-user"></i>
                </div>
                <a href="<?= base_url('admin/employees') ?>" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="card mx-2">
        <div class="card-header">
            <h3 class="card-title">Barang terbaru</h3>
        </div>
        <div class="card-body table-responsive">
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
    </div>
</section>

<?= $this->endSection() ?>