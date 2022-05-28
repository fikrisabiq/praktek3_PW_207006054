<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Forum Ubah Pembayaran Zakat</h1>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="/bayarzakat/edit/<?= $data['id_zakat']; ?>" method="POST">
            <?= csrf_field(); ?>
            <input type="hidden" name="jenis_lama" value="<?= $data['id_jenis']; ?>">
            <?php if ($data['id_jenis'] == 1) : ?>
                <input type="hidden" name="id_lama" value="<?= $data['id_bayar_beras']; ?>">
                <input type="hidden" name="total_lama" value="<?= $data['beras']; ?>">
            <?php else : ?>
                <input type="hidden" name="id_lama" value="<?= $data['id_bayar_uang']; ?>">
                <input type="hidden" name="total_lama" value="<?= $data['uang']; ?>">
            <?php endif; ?>
            <div class="row mb-3">
                <label for="nama_KK" class="col-sm-2 col-form-label">Muzakki</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama_Keluarga" name="nama_KK" readonly value="<?= $data['nama_KK']; ?>">
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
                            <option value="<?= $j['id_jenis']; ?>" <?php if (!old('jenis_pembayaran') & $j['id_jenis'] == $data['id_bayar']) {
                                                                        echo 'selected';
                                                                    } else {
                                                                        if ($j['id_jenis'] == old('jenis_pembayaran')) {
                                                                            echo 'selected';
                                                                        } else {
                                                                            echo '';
                                                                        }
                                                                    } ?>><?= $j['nama_jenis']; ?></option>
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
                    <select class="form-select form-select-sm <?= ($validation->hasError('jumlah')) ? 'is-invalid' : ''; ?>" id="jumlahs" name="jumlah" aria-label=".form-select-sm example">
                        <option selected value="">Tanggungan yang Dibayar</option>
                        <?php for ($t = 1; $t <= $data['jumlah_tanggungan']; $t++) : ?>
                            <option value="<?= $t; ?>" <?php if (!old('jumlah') & $t == $data['jumlah_tanggunganyangdibayar']) {
                                                            echo 'selected';
                                                        } else {
                                                            if ($t == old('jumlah')) {
                                                                echo 'selected';
                                                            } else {
                                                                echo '';
                                                            }
                                                        } ?>><?= $t; ?></option>
                        <?php endfor; ?>
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
                    <?php if ($data['id_jenis'] == 1) : ?>
                        <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="total" name="total" value="<?= old('total') ? old('total') : $data['beras']; ?>" readonly>
                    <?php else : ?>
                        <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="total" name="total" value="<?= old('total') ? old('total') : $data['uang']; ?>" readonly>
                    <?php endif; ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Data</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>