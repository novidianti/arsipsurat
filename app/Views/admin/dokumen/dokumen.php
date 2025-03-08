<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<a href="<?= base_url('admin/dokumen/create')?>" class="btn btn-primary">
<i class="lni lni-circle-plus"></i>Tambah Data</a>

<table class="table table-striped" id="datatables">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Surat</th>
            <th>No Kop</th>
            <th>Status</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>
        <tbody>
            <?php $no=1;
            foreach($dokumen as $dok) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= isset($dok['nama_dokumen']) ? $dok['nama_dokumen'] : '' ?></td> <!-- Menampilkan jabatan atau pesan jika null -->                
                <td><?= $dok['no_kop'] ?></td>
                <td><?= $dok['belum_selesai'] ?></td>
                <td><?= $dok['tanggal_dokumen'] ?></td>
                <td>
                    <a href="<?= base_url('admin/dokumen/detail/'. $dok['id'])?>" class="badge bg-warning"><i class="lni lni-eye"></i></a>
                    <a href="<?= base_url('admin/dokumen/edit/'. $dok['id'])?>" class="badge bg-primary"><i class="lni lni-pencil"></i></a>
                    <a href="<?= base_url('admin/dokumen/delete/'. $dok['id'])?>" class="badge bg-danger tombol-hapus"><i class="lni lni-trash-can"></i></a>
                </td>
            </tr>    
             <?php endforeach; ?>
        </tbody>
</table>

<?= $this->endSection() ?>