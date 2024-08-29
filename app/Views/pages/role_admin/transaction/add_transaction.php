<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><b>Form Transaksi</b></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>"><i class="fa-solid fa-house"></i></a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/product') ?>" style="text-color: black">Produk</a></li>
                    <li class="breadcrumb-item"><span>Transaksi</span></li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">

        </div>
        <form action="<?= base_url('loan/loanProduct'); ?>" method="post">
            <div class="row mb-2" style="display:flex; justify-content:center">
                <div class="col-md-12" style="display:flex; flex-direction: column; align-items: center; text-align: center;">
                    <label>.:: Alokasi ::.</label>
                    <div>
                        <input type="radio" id="alokasi_orang" name="alokasi" value="orang" checked onclick="toggleDropdown()"> Orang
                        <input type="radio" id="alokasi_area" name="alokasi" value="area" onclick="toggleDropdown()"> Area
                    </div>
                </div>
            </div>

            <div class="row mb-1">
                <div class="col-md-6">
                    <label for="id_product" class="form-label" style="text-align: center; display:flex; justify-content:center">Barang</label>
                    <select class="form-control" id="id_product" name="id_product" required onchange="getProductStock()">
                        <option value="" class="text-center">.:: Pilih Barang ::.</option>
                        <?php if (!empty($products)) : ?>
                            <?php foreach ($products as $p) : ?>
                                <option value="<?= $p['id']; ?>"><?= esc($p['product_name']); ?></option>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <option value="">Barang tidak tersedia</option>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="id_employee" id="label_alokasi" class="form-label" style="text-align: center; display:flex; justify-content:center"><b>Karyawan</b></label>
                    <select class="form-control" id="id_employee" name="id_employee" style="display: block;">
                        <option value="" class="text-center">.:: Pilih Karyawan ::.</option>
                        <?php if (!empty($employees)) : ?>
                            <?php foreach ($employees as $e) : ?>
                                <option value="<?= $e['id']; ?>"><?= esc($e['employee_name']); ?></option>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <option value="">Karyawan tidak tersedia</option>
                        <?php endif; ?>
                    </select>
                    <select class="form-control" id="id_area" name="id_area" style="display: none;">
                        <option value="" class="text-center">.:: Pilih Area ::.</option>
                        <?php if (!empty($area)) : ?>
                            <?php foreach ($area as $a) : ?>
                                <option value="<?= $a['id']; ?>"><?= esc($a['area_name']); ?></option>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <option value="">Area tidak tersedia</option>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <div class="row mb-1">
                <div class="col-md-12">
                    <label for="product_stock" class="form-label">Rincian Stok</label>
                    <div id="product_stock" class="alert alert-info">
                        Pilih produk untuk melihat rincian stok.
                    </div>
                </div>
            </div>

            <div id="allocation_items">
                <div class="row mb-1">
                    <div class="col-md-6">
                        <label for="loan_stock_1" class="form-label">Total Dipinjam (Status 1)</label>
                        <input type="number" class="form-control" id="loan_stock_1" name="loan_stock[]" placeholder="Masukkan Kuantitas">
                    </div>
                    <div class="col-md-6">
                        <label for="status_1" class="form-label">Status Produk Sebelum Alokasi</label>
                        <select class="form-control" id="status_1" name="status[]" required>
                            <option value="" class="text-center">.:: Pilih Status ::.</option>
                            <?php if (!empty($statuses)) : ?>
                                <?php foreach ($statuses as $s) : ?>
                                    <option value="<?= $s['id']; ?>"><?= esc($s['status_name']); ?></option>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <option value="">Status tidak tersedia</option>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
            </div>

            <button type="button" onclick="addAllocationItem()">Tambah Status</button>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="loan_date" class="form-label">Tanggal Alokasi</label>
                    <input type="date" class="form-control" id="loan_date" name="loan_date" placeholder="Masukkan Kuantitas">
                </div>
            </div>

            <a href="<?= base_url('admin/product') ?>" class="btn btn-outline-secondary"><i class="fa-solid fa-chevron-left"></i> Kembali</a>
            <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Simpan</button>
        </form>

        <div class="card-footer">
            PT. ALP Petro Industry
        </div>
    </div>

    <script>
        let statusCounter = 1;

        function addAllocationItem() {
            statusCounter++;
            const allocationItems = document.getElementById('allocation_items');
            const newItem = document.createElement('div');
            newItem.classList.add('row', 'mb-1');

            newItem.innerHTML = `
            <div class="col-md-6">
                <label for="loan_stock_${statusCounter}" class="form-label">Total Dipinjam (Status ${statusCounter})</label>
                <input type="number" class="form-control" id="loan_stock_${statusCounter}" name="loan_stock[]" placeholder="Masukkan Kuantitas">
            </div>
            <div class="col-md-6">
                <label for="status_${statusCounter}" class="form-label">Status Produk Sebelum Alokasi</label>
                <select class="form-control" id="status_${statusCounter}" name="status[]" required>
                    <option value="" class="text-center">.:: Pilih Status ::.</option>
                    <?php if (!empty($statuses)) : ?>
                        <?php foreach ($statuses as $s) : ?>
                            <option value="<?= $s['id']; ?>"><?= esc($s['status_name']); ?></option>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <option value="">Status tidak tersedia</option>
                    <?php endif; ?>
                </select>
            </div>
        `;

            allocationItems.appendChild(newItem);
        }

        function toggleDropdown() {
            const alokasiOrang = document.getElementById('alokasi_orang').checked;
            const labelAlokasi = document.getElementById('label_alokasi');
            const dropdownEmployee = document.getElementById('id_employee');
            const dropdownArea = document.getElementById('id_area');

            if (alokasiOrang) {
                labelAlokasi.innerText = 'Karyawan';
                dropdownEmployee.style.display = 'block';
                dropdownArea.style.display = 'none';
            } else {
                labelAlokasi.innerText = 'Area';
                dropdownEmployee.style.display = 'none';
                dropdownArea.style.display = 'block';
            }
        }

        function getProductStock() {
            var productId = document.getElementById('id_product').value;
            if (productId) {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '<?= base_url('product/getStockDetails'); ?>/' + productId, true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        document.getElementById('product_stock').innerHTML = xhr.responseText;
                    }
                };
                xhr.send();
            } else {
                document.getElementById('product_stock').innerHTML = 'Pilih produk untuk melihat rincian stok.';
            }
        }

        // Panggil fungsi toggleDropdown saat halaman dimuat
        window.onload = function() {
            toggleDropdown(); // Set initial state of dropdowns
            document.getElementById('alokasi_orang').addEventListener('change', toggleDropdown);
            document.getElementById('alokasi_area').addEventListener('change', toggleDropdown);
        };
    </script>

</section>
<?= $this->endSection() ?>