<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Master Data Muzakki</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Table Data Muzakki</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jumlah Tanggungan</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jumlah Tanggungan</th>
                        <th>Keterangan</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $i = 1;
                    foreach ($muzakki as $m) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $m['nama_muzakki']; ?></td>
                            <td><?= $m['jumlah_tanggungan']; ?></td>
                            <td><?= $m['keterangan']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>