<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<div class="card col-md-6">
    <div class="card-body">
        <form method="POST" action="<?= base_url('admin/dokumen/update/' . $dokumen['id']) ?>" enctype="multipart/form-data">
          <?= csrf_field() ?>
            <div class="input-style-1">
                <label>Nama Surat</label>
                <input type="text" class="form-control <?= ($validation->hasError('nama_dokumen')) ? 'is-invalid' : '' ?>" name="nama_dokumen" value="<?= old('nama_dokumen', $dokumen['nama_dokumen']) ?>" placeholder="Nama Dokumen" />
                <div class="invalid-feedback"><?= $validation->getError('nama_dokumen') ?></div>
            </div>
            <div class="input-style-1">
                <label>Nomor Kop Surat</label>
                <input type="text" class="form-control <?= ($validation->hasError('no_kop')) ? 'is-invalid' : '' ?>" name="no_kop" value="<?= old('no_kop', $dokumen['no_kop']) ?>" placeholder="Nomor Kop Surat" />
                <div class="invalid-feedback"><?= $validation->getError('no_kop') ?></div>
            </div>
            <div class="input-style-1">
                <label>File</label>
                <input type="file" class="form-control <?= ($validation->hasError('file')) ? 'is-invalid' : '' ?>" name="file" />
                <div class="invalid-feedback"><?= $validation->getError('file') ?></div>

                <!-- Menampilkan file yang sudah diunggah sebelumnya -->
                <?php if ($dokumen['file']): ?>
                    <small>File saat ini: <a href="<?= base_url('uploads/' . $dokumen['file']) ?>" target="_blank"><?= $dokumen['file'] ?></a></small>
                <?php endif; ?>
            </div>
            <div class="input-style-1">
                <label>Disposisi</label>
                <select name="disposisi" class="form-control <?= ($validation->hasError('disposisi')) ? 'is-invalid' : '' ?>">
                    <option value="">-- Pilih Jabatan --</option>
                    <?php foreach ($disposisi as $dsp): ?>
                        <option value="<?= $dsp['id'] ?>" <?= (old('disposisi', $dokumen['disposisi']) == $dsp['id']) ? 'selected' : '' ?>><?= $dsp['jabatan'] ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback"><?= $validation->getError('disposisi') ?></div>
            </div>
            <div class="input-style-1">
                <label>Kategori Surat</label>
                <select name="keluar_masuk" class="form-control <?= ($validation->hasError('keluar_masuk')) ? 'is-invalid' : '' ?>">
                    <option value="">-- Pilih Kategori Surat --</option>
                    <option value="keluar" <?= (old('keluar_masuk', $dokumen['keluar_masuk']) == 'keluar') ? 'selected' : '' ?>>Keluar</option>
                    <option value="masuk" <?= (old('keluar_masuk', $dokumen['keluar_masuk']) == 'masuk') ? 'selected' : '' ?>>Masuk</option>
                </select>
                <div class="invalid-feedback"><?= $validation->getError('keluar_masuk') ?></div>
            </div>
            <div class="input-style-1">
                <label>Status</label>
                <select name="belum_selesai" class="form-control <?= ($validation->hasError('belum_selesai')) ? 'is-invalid' : '' ?>">
                    <option value="">-- Pilih Status Surat --</option>
                    <option value="belum" <?= (old('belum_selesai', $dokumen['belum_selesai']) == 'belum') ? 'selected' : '' ?>>Belum</option>
                    <option value="selesai" <?= (old('belum_selesai', $dokumen['belum_selesai']) == 'selesai') ? 'selected' : '' ?>>Selesai</option>
                </select>
                <div class="invalid-feedback"><?= $validation->getError('belum_selesai') ?></div>
            </div>
            <div class="input-style-1">
                <label>Jenis Surat</label>
                <select name="jenis" class="form-control <?= ($validation->hasError('jenis')) ? 'is-invalid' : '' ?>">
                    <option value="">-- Pilih Jenis Surat --</option>
                    <?php foreach ($jenis as $jns): ?>
                        <option value="<?= $jns['id'] ?>" <?= (old('jenis', $dokumen['jenis']) == $jns['id']) ? 'selected' : '' ?>><?= $jns['jenis'] ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback"><?= $validation->getError('jenis') ?></div>
            </div>
            <div class="input-style-1">
                <label>Tanggal Surat</label>
                <input type="date" class="form-control <?= ($validation->hasError('tanggal_dokumen')) ? 'is-invalid' : '' ?>" name="tanggal_dokumen" value="<?= old('tanggal_dokumen', $dokumen['tanggal_dokumen']) ?>" />
                <div class="invalid-feedback"><?= $validation->getError('tanggal_dokumen') ?></div>
            </div>
            <div class="input-style-1">
                <label>Tentang</label>
                <textarea name="tentang" rows="4" cols="50" class="form-control <?= ($validation->hasError('tentang')) ? 'is-invalid' : '' ?>" placeholder="Masukkan keterangan di sini"><?= old('tentang', $dokumen['tentang']) ?></textarea>
                <div class="invalid-feedback"><?= $validation->getError('tentang') ?></div>
            </div>
            <div class="input-style-1">
                <label>Halaman</label>
                <input type="number" class="form-control <?= ($validation->hasError('halaman')) ? 'is-invalid' : '' ?>" name="halaman" value="<?= old('halaman', $dokumen['halaman']) ?>" />
                <div class="invalid-feedback"><?= $validation->getError('halaman') ?></div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
