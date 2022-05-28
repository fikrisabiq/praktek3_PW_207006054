<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">View Bayar Zakat</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Table Data Kategori Mustahik</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jumlah Tanggungan</th>
                        <th>Tanggungan yang Dibayar</th>
                        <th>Jenis Pembayaran</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jumlah Tanggungan</th>
                        <th>Tanggungan Yang Dibayar</th>
                        <th>Jenis Pembayaran</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $i = 1;
                    foreach ($data as $d) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $d['nama_KK']; ?></td>
                            <td><?= $d['jumlah_tanggungan']; ?></td>
                            <td><?= $d['jumlah_tanggunganyangdibayar']; ?></td>
                            <td><?= $d['nama_jenis']; ?></td>
                            <?php if ($d['nama_jenis'] == 'beras') : ?>
                                <td><?= $d['beras']; ?></td>
                            <?php else : ?>
                                <td><?= $d['uang']; ?></td>
                            <?php endif; ?>
                            <td>
                                <a href="/bayarzakat/ubah/<?= $d['id_zakat']; ?>" class="btn-sm btn-warning">Edit</a>
                                <form action="/bayarzakat/<?= $d['id_zakat']; ?>" method="POST" class="d-inline">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn-sm btn-danger" onclick="return confirm('apakah anda yakin?');">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>