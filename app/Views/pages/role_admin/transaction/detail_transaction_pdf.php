<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="invoice p-3 mb-3">
                <div class="row">
                    <div class="col-12">
                        <h4>
                            Invoice Alokasi <small class="float-right"><?= $allocationDetails['allocation_date']; ?></small>
                        </h4>
                    </div>
                </div>
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        From
                        <address>
                            <strong><?= $allocationDetails['allocator_name']; ?></strong><br>
                            Super Admin<br>
                            <?= $allocationDetails['allocator_address']; ?><br>
                            <?= $allocationDetails['allocator_phone']; ?><br>
                            Email: <?= $allocationDetails['allocator_email']; ?>
                        </address>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        To
                        <address>
                            <?php if ($allocationDetails['allocation_type'] == 'person') : ?>
                                <strong><?= $allocationDetails['recipient_name']; ?></strong><br>
                                <?= $allocationDetails['department_name']; ?><br>
                                <?= $allocationDetails['recipient_address']; ?><br>
                                <?= $allocationDetails['recipient_phone']; ?><br>
                                Email: <?= $allocationDetails['recipient_email']; ?>
                            <?php else : ?>
                                <strong><?= $allocationDetails['area_name']; ?></strong><br>
                            <?php endif; ?>
                        </address>
                    </div>

                    <div class="col-sm-4 invoice-col">
                        <b>Allocation ID:</b> <?= $allocationDetails['allocation_id']; ?><br>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12 table-responsive">
                        <table border="1" cellspacing="0" cellpadding="5" width="100%">
                            <thead>
                                <tr>
                                    <th>Qty</th>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Brand</th>
                                    <th>Deskripsi Produk</th>
                                    <th>Harga Produk</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= $allocationDetails['quantity']; ?></td>
                                    <td><?= $allocationDetails['product_name']; ?></td>
                                    <td><?= $allocationDetails['category_name']; ?></td>
                                    <td><?= $allocationDetails['brand_name']; ?></td>
                                    <td><?= $allocationDetails['product_description']; ?></td>
                                    <td><?= $allocationDetails['product_price']; ?></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>