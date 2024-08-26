<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Page</title>
    <link rel="icon" type="image/jpg" href="images/logoalp.jpg">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>

<body class="hold-transition register-page" style="background-color: white ">
    <div class="register-box">
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                <?= session()->getFlashdata('success'); ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('errors')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5><i class="icon fas fa-exclamation-triangle"></i> Gagal!</h5>
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <p><?= $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="card card-outline card-warning">
            <div class="card-header text-center">
                <img src="<?= base_url('images/logoalp.jpg'); ?>" alt="Logo ALP" height="110">
                <br>
                <br>
                <span class="h3"><b>ALP Inventory</b></span>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Halaman Registrasi</p>
                <form action="/register/save" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="employee_name" placeholder="Masukkan Nama Lengkap" required>
                        <div class="input-group-append">
                            <div class="input-group-text bg-white">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="employee_email" placeholder="Masukkan Email" required>
                        <div class="input-group-append">
                            <div class="input-group-text bg-white">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text bg-white">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="confirm_password" placeholder="Masukkan Password Kembali" required>
                        <div class="input-group-append">
                            <div class="input-group-text bg-white">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-block" style="padding: 10px; background-color: #151C62; color: white;border-radius:20px">Buat Akun</button>
                        </div>
                    </div>
                </form>
                <p class="mb-0 mt-3 text-center">
                    <a href="<?= base_url() ?>login" class="text-center">Sudah punya akun? Login sekarang</a>
                </p>

            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->
    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
</body>

</html>