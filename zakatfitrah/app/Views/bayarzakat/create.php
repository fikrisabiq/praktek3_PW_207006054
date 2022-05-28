<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Forum Pembayaran Zakat</h1>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="/bayarzakat/tambah" method="POST">
            <?= csrf_field(); ?>
            <input type="hidden" name="jumlah_tanggungan" id="jumlah_tanggungan" value="<?= old('jumlah_tanggungan'); ?>">
            <input type="hidden" name="id_muzakki" id="id_muzakki" value="<?= old('id_muzakki'); ?>">
            <div class="row mb-3">
                <label for="nama_KK" class="col-sm-2 col-form-label">Muzakki</label>
                <div class="col-sm-10">
                    <select class="js-example-basic-single <?= ($validation->hasError('nama_KK')) ? 'is-invalid' : ''; ?>" name="nama_KK" id="nama_KK">
                        <option value="" <?= (old('nama_KK')) ? '' : 'selected'; ?>>Pilihan Muzakki</option>
                        <?php foreach ($muzakki as $m) : ?>
                            <option <?= (old('nama_KK') == $m['nama_muzakki']) ? 'selected' : ''; ?> value="<?= $m['nama_muzakki']; ?>" data-id="<?= $m['id_muzakki']; ?>" <?= ($m['nama_muzakki'] == old('nama_muzakki')) ? 'selected' : ''; ?>><?= $m['nama_muzakki']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if ($validation->hasError('nama_KK')) : ?>
                        <div id="validationServer04Feedback" class="invalid-feedback">
                            <?= $validation->getError('nama_KK'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row mb-3">
                <label for="jenis" class="col-sm-2 col-form-label">Jenis Pembayaran</label>
                <div class="col-sm-10">
                    <select class="form-select form-select-sm <?= ($validation->hasError('jenis_pembayaran')) ? 'is-invalid' : ''; ?>" id="jenis" name="jenis_pembayaran" aria-label=".form-select-sm example">
                        <option value="" <?= (old('jenis_pembayaran')) ? '' : 'selected'; ?>>Pilihan Jenis Pembayaran</option>
                        <?php foreach ($jenis_bayar as $j) : ?>
                            <option value="<?= $j['id_jenis']; ?>" <?= ($j['id_jenis'] == old('jenis_pembayaran')) ? 'selected' : ''; ?>><?= $j['nama_jenis']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if ($validation->hasError('jenis_pembayaran')) : ?>
                        <div id="validationServer04Feedback" class="invalid-feedback">
                            <?= $validation->getError('jenis_pembayaran'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row mb-3">
                <label for="jumlah" class="col-sm-2 col-form-label">Tanggungan</label>
                <div class="col-sm-10">
                    <select class="form-select form-select-sm <?= ($validation->hasError('jumlah')) ? 'is-invalid' : ''; ?>" id="jumlah" name="jumlah" aria-label=".form-select-sm example">
                        <option selected value="">Tanggungan yang Dibayar</option>
                    </select>
                    <?php if ($validation->hasError('jumlah')) : ?>
                        <div id="validationServer04Feedback" class="invalid-feedback">
                            <?= $validation->getError('jumlah'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row mb-3">
                <label for="total" class="col-sm-2 col-form-label">Total</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="total" name="total" readonly>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Data</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>