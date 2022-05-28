<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Forum Ubah Mustahik Lainnya</h1>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="/lainnya/edit/<?= $data['id_mustahiklainnya']; ?>" method="POST">
            <?= csrf_field(); ?>
            <div class="row mb-3">
                <label for="judul" class="col-sm-2 col-form-label">Mustahik</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" value="<?= $data['nama']; ?>" name="nama" value="<?= old('nama') ? old('nama') : $data['nama']; ?>">
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
                        <option value="" <?= (old('kategori')) ? '' : 'selected'; ?>>Pilihan Kategori</option>
                        <?php foreach ($kategori as $k) : ?>
                            <option value="<?= $k['id_kategori']; ?>" <?php if (!old('kategori') & $k['id_kategori'] == $data['id_kategori']) {
                                                                            echo 'selected';
                                                                        } else {
                                                                            if ($k['id_kategori'] == old('kategori')) {
                                                                                echo 'selected';
                                                                            } else {
                                                                                echo '';
                                                                            }
                                                                        } ?> data-hak="<?= $k['jumlah_hak']; ?>"><?= $k['nama_kategori']; ?></option>
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
                    <input type="text" class="form-control" id="haks" name="hak" value="<?= old('hak'); ?>" readonly>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" id="tambah">Tambah Data</button>
            <div class="invalid-feedback salah">Beras Tidak Mencukupi</div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>