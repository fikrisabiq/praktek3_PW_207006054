<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">View Mustahik Lainnya</h1>
<div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title"><?= $data['nama']; ?></h5>
        <h6 class="card-subtitle mb-2 text-muted"><?= $data['nama_kategori']; ?></h6>
        <p class="card-text"> Jumlah Hak: <?= $data['hak']; ?></p>
        <a href="/lainnya" class="card-link">Kembali</a>
    </div>
</div>

<?= $this->endSection(); ?>