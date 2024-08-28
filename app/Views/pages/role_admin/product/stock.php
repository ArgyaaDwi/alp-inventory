<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Form Edit Produk</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>"><i class="fa-solid fa-house"></i></a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/product') ?>" style="text-color: black">Produk</a></li>
                    <li class="breadcrumb-item"><span>Edit Produk <?= esc($product['product_name']); ?></span></li>
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
            <form action="<?= site_url('product/updateStock/' . $product['id']); ?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="product_id" value="<?= esc($product['id']); ?>">

                <?php foreach ($productStocks as $stock): ?>
                    <div>
                        <label for="quantity_<?= esc($stock['id_status']); ?>">
                            <?= esc($stock['status_name']); ?>:
                        </label>
                        <input type="hidden" name="stocks[<?= esc($stock['id_status']); ?>][id]" value="<?= esc($stock['id']); ?>">
                        <input type="hidden" name="stocks[<?= esc($stock['id_status']); ?>][status]" value="<?= esc($stock['id_status']); ?>">
                        <input type="number" name="stocks[<?= esc($stock['id_status']); ?>][quantity]" id="quantity_<?= esc($stock['id_status']); ?>" value="<?= esc($stock['quantity']); ?>" required>

                        <?php if ($stock['status_name'] == 'Rusak Sebagian' || $stock['status_name'] == 'Rusak'): ?>
                            <div>
                                <label for="damage_description_<?= esc($stock['id_status']); ?>">Deskripsi Kerusakan:</label>
                                <textarea name="stocks[<?= esc($stock['id_status']); ?>][damage_description]" id="damage_description_<?= esc($stock['id_status']); ?>"><?= esc($stock['damage_description']); ?></textarea>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>

                <button type="submit">Update Stok</button>
            </form>

        </div>
        <div class="card-footer">
            PT. ALP Petro Industry
        </div>
    </div>
</section>
<script>
    document.getElementById('status').addEventListener('change', function() {
        var damageDescription = document.getElementById('damage_description');
        if (this.value === '2') {
            document.getElementById('damage-description-container').style.display = 'block';
            damageDescription.setAttribute('required', 'required');
        } else {
            document.getElementById('damage-description-container').style.display = 'none';
            damageDescription.removeAttribute('required');
        }
    });
</script>
<?= $this->endSection() ?>