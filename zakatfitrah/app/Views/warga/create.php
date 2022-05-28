<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Forum Tambah Mustahik Warga</h1>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="/warga/tambah" method="POST">
            <?= csrf_field(); ?>
            <input type="hidden" name="id_muzakki" id="id_muzakki">
            <div class="row mb-3">
                <label for="judul" class="col-sm-2 col-form-label">Muzakki</label>
                <div class="col-sm-10">
                    <select class="js-example-basic-single <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" name="nama" id="nama">
                        <option value="" <?= (old('nama')) ? '' : 'selected'; ?>>Pilihan Muzakki</option>
                        <?php foreach ($muzakki as $m) : ?>
                            <option <?= (old('nama') == $m['nama_muzakki']) ? 'selected' : ''; ?> value="<?= $m['nama_muzakki']; ?>" data-id="<?= $m['id_muzakki']; ?>"><?= $m['nama_muzakki']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if ($validation->hasError('nama')) : ?>
                        <div id="validationServer04Feedback" class="invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row mb-3">
                <label for="judul" class="col-sm-2 col-form-label">Kategori</label>
                <div class="col-sm-10">
                    <select class="form-select form-select-sm <?= ($validation->hasError('kategori')) ? 'is-invalid' : ''; ?>" id="kategori" name="kategori" aria-label=".form-select-sm example">
                        <option value="" selected>Pilihan Kategori</option>
                        <?php foreach ($kategori as $k) : ?>
                            <option <?= (old('kategori') == $k['id_kategori']) ? 'selected' : ''; ?> value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if ($validation->hasError('kategori')) : ?>
                        <div id="validationServer04Feedback" class="invalid-feedback">
                            <?= $validation->getError('kategori'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row mb-3">
                <label for="judul" class="col-sm-2 col-form-label">Total</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="hak" name="hak" value="<?= old('hak'); ?>" readonly>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" id="tambah">Tambah Data</button>
            <div class="invalid-feedback salah">Beras Tidak Mencukupi</div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>