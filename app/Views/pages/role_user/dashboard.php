<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Ini adalah halaman user</h1>
    <form action="<?= base_url('logout'); ?>" method="post" style="display: inline;">
        <button type="submit" class="btn btn-danger rounded btn-flat float-right">
            <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
        </button>
    </form>
    <!-- <a href="<?= base_url('logout'); ?>" class="btn btn-danger rounded btn-flat float-right">
        <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
    </a> -->

</body>

</html>