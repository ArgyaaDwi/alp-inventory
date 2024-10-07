<table  border="1" cellspacing="0" cellpadding="5" width="100%" class="stripe responsive">
    <thead>
        <tr>
            <th>No.</th>
            <th>ID</th>
            <th><span style="margin:0 15px">Nama Barang</span></th>
            <th><span style="margin:0 15px">Tipe Alokasi</span></th>
            <th><span style="margin:0 15px">Penerima</span></th>
            <th>Tanggal Alokasi</th>
            <th>Qty</th>
            <th><span style="margin:0 15px">Pengalokasi</span></th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php if (!empty($allocations)) : ?>
            <?php foreach ($allocations as $a) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $a['id'] ?? '-'; ?></td>
                    <td><span style="margin:0 15px"><?= $a['product_name'] ?? '-'; ?></span></td>
                    <td style="text-align: center;">
                        <?php if ($a['allocation_type'] == 'person') : ?>
                            <span class="badge badge-pill badge-info">Karyawan</span>
                        <?php else : ?>
                            <span class="badge badge-pill badge-warning">Area</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($a['allocation_type'] == 'person') : ?>
                            <span style="margin:0 15px"> <?= $a['recipient_name'] ?? '-' ?></span>
                        <?php else : ?>
                            <span style="margin:0 15px"> <?= $a['area_name'] ?? '-' ?></span>
                        <?php endif; ?>
                    </td>
                    <td><?= $a['allocation_date'] ?? '-'; ?></td>
                    <td><?= $a['quantity'] ?? '-'; ?></td>
                    <td><span style="margin:0 15px"><?= $a['allocator_name'] ?? '-'; ?></span></td>

                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="9" class="text-center">Tidak ada data</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>