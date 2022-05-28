<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Laporan Distibusi Zakat Fitrah Warga</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tabel Data Laporan Zakat</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Hak Beras</th>
                        <th>Jumlah KK</th>
                        <th>Total Beras</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Hak Beras</th>
                        <th>Jumlah KK</th>
                        <th>Total Beras</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $i = 1;
                    foreach ($warga as $w) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $w['nama_kategori']; ?></td>
                            <td><?= $w['jumlah_hak']; ?></td>
                            <td><?= $w['id_mustahikwarga']; ?></td>
                            <?php if ($w['hak'] == '') : ?>
                                <td>0</td>
                            <?php else : ?>
                                <td><?= $w['hak']; ?> KG</td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>