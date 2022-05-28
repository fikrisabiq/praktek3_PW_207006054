<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Forum Ubah Admin</h1>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="/admin/edit/<?= $admin['id']; ?>" method="POST">
            <?= csrf_field(); ?>
            <input type="hidden" name="usernameLama" value="<?= $admin['username']; ?>">
            <div class="row mb-3">
                <label for="judul" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" value="<?= old('username') ? old('username') : $admin['username']; ?>" name="username">
                    <?php if ($validation->hasError('username')) : ?>
                        <div id="validationServer04Feedback" class="invalid-feedback ">
                            <?= $validation->getError('username'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row mb-3">
                <label for="judul" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" value="<?= old('password'); ?>" name="password">
                    <?php if ($validation->hasError('password')) : ?>
                        <div id="validationServer04Feedback" class="invalid-feedback ">
                            <?= $validation->getError('password'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" id="tambah">Tambah Data</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>