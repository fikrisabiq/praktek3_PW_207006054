<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Laporan Pengumpulan Zakat Fitrah</h1>
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
                        <th>Total</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Total</th>
                    </tr>
                </tfoot>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Total Muzakki</td>
                        <td><?= $muzakki['id_muzakki']; ?></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Total Jiwa</td>
                        <td><?= $muzakki['jumlah_tanggungan']; ?></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Total Beras</td>
                        <td><?= $beras; ?> KG</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Total Uang</td>
                        <td><?= "Rp " . number_format($uang, 0, ',', '.'); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>