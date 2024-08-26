<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link rel="icon" type="image/jpg" href="images/logoalp.jpg">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
</head>

<body class="hold-transition login-page" style="background-color: white ">
    <div class="login-box">
        <?php if (session()->getFlashdata('success')) : ?>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                console.log('SweetAlert script loaded');
                Swal.fire({
                    title: 'Berhasil!',
                    text: '<?= session()->getFlashdata('success'); ?>',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(function() {
                    console.log('SweetAlert executed');
                });
            </script>
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
                <p class="login-box-msg">Halaman Login</p>
                <form action="<?= base_url() ?>/login/save" method="post">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Masukkan Email" name="employee_email" required>
                        <div class="input-group-append">
                            <div class="input-group-text bg-white">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="employee_password" required>
                        <div class="input-group-append">
                            <div class="input-group-text bg-white">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-block" style="padding: 10px; background-color: #151C62; color: white; border-radius:20px">Masuk</button>
                        </div>
                    </div>
                </form>
                <p class="mb-0 mt-3 text-center">
                    <a href="<?= base_url() ?>register">Belum punya akun? Buat sekarang</a>
                </p>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
</body>

</html>