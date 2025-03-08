<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<div class="card col-md-6">
    <div class="card-body">
        <form method="POST" action="<?= base_url('admin/users/store') ?>">
          <?= csrf_field() ?>
            <div class="input-style-1">
                <label>Disposisi</label>
                <select name="disposisi" class="form-control <?= ($validation->hasError('disposisi')) ? 'is-invalid' : '' ?>">
                    <option value="">-- Pilih Jabatan --</option>
                <?php foreach($disposisi as $dsp): ?>
                    <option value="<?= $dsp['id']; ?>">
                <?= !empty($dsp['jabatan']) ? $dsp['jabatan'] : 'Tidak ada jabatan'; ?>
                    </option>
                <?php endforeach; ?>
            <!-- Tambahkan opsi untuk disposisi yang tidak ada jabatan -->
                    <option value="null">Tidak ada jabatan</option>
                </select>
                <div class="invalid-feedback"><?= $validation->getError('disposisi') ?></div>
            </div>
            <div class="input-style-1">
                <label>Username</label>
                <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>" name="username" placeholder="Username" />
                <div class="invalid-feedback"><?= $validation->getError('username') ?></div>
            </div>
            <div class="input-style-1">
                <label>Password</label>
                <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" name="password" placeholder="Password" />
                <div class="invalid-feedback"><?= $validation->getError('password') ?></div>
            </div>
            <div class="input-style-1">
                <label>Konfirmasi Password</label>
                <input type="password" class="form-control <?= ($validation->hasError('konfirmasi_password')) ? 'is-invalid' : '' ?>" name="konfirmasi_password" placeholder="Konfirmasi Password" />
                <div class="invalid-feedback"><?= $validation->getError('konfirmasi_password') ?></div>
            </div>
            <div class="input-style-1">
                <label>Status</label>
                <select name="status" class="form-control <?= ($validation->hasError('status')) ? 'is-invalid' : '' ?>">
                    <option value="">-- Pilih Status --</option>
                    <option value="Admin">Admin</option>
                    <option value="Kepala">Kepala</option>
                </select>
                <div class="invalid-feedback"><?= $validation->getError('status') ?></div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
