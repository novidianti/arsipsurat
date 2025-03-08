<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>


<div class="card col-md-8">
    <div class="card-body">
        <table class="table">
            <tr>
                <td>Nama Surat</td>
                <td>:</td>
                <td><?= $dokumen['nama_dokumen'] ?></td>
            </tr>
            <tr>
                <td>Nomor Kop</td>
                <td>:</td>
                <td><?= $dokumen['no_kop'] ?></td>
            </tr>
            <tr>
                <td>File</td>
                <td>:</td>
                <td>
                <?php if ($dokumen['file']): ?>
                    <a href="/uploads/<?= $dokumen['file'] ?>" class="btn btn-primary" target="_blank">
    Lihat File
</a>
        <?php else: ?>
            Tidak ada file
        <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>Disposisi</td>
                <td>:</td>
                <td><?= $dokumen['jabatan'] ?></td>
            </tr>
            <tr>
                <td>Kategori Surat</td>
                <td>:</td>
                <td><?= $dokumen['keluar_masuk'] ?></td>
            </tr>
            <tr>
                <td>Status Surat</td>
                <td>:</td>
                <td><?= $dokumen['belum_selesai'] ?></td>
            </tr>
            <tr>
                <td>Jenis Surat</td>
                <td>:</td>
                <td><?= $dokumen['jenis'] ?></td>
            </tr>
            <tr>
                <td>Tanggal Surat</td>
                <td>:</td>
                <td><?= $dokumen['tanggal_dokumen'] ?></td>
            </tr>
            <tr>
                <td>Tentang</td>
                <td>:</td>
                <td><?= $dokumen['tentang'] ?></td>
            </tr>
            <tr>
                <td>Halaman</td>
                <td>:</td>
                <td><?= $dokumen['halaman'] ?></td>
            </tr>
        </table>
    </div>
</div>

<?= $this->endSection() ?>