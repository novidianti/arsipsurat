<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<a href="<?= base_url('admin/users/create')?>" class="btn btn-primary">
<i class="lni lni-circle-plus"></i>Tambah Data</a>

<table class="table table-striped" id="datatables">
    <thead>
        <tr>
            <th>No</th>
            <th>Jabatan</th>
            <th>Username</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
        <tbody>
            <?php $no=1;
            foreach($users as $usr) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= isset($usr['jabatan']) ? $usr['jabatan'] : 'Tidak ada jabatan' ?></td> <!-- Menampilkan jabatan atau pesan jika null -->                <td><?= $usr['username'] ?></td>
                <td><?= $usr['status'] ?></td>
                <td>
                    <a href="<?= base_url('admin/users/edit/'. $usr['id'])?>" class="badge bg-primary"><i class="lni lni-pencil"></i></a>
                    <a href="<?= base_url('admin/users/delete/'. $usr['id'])?>" class="badge bg-danger tombol-hapus"><i class="lni lni-trash-can"></i></a>
                </td>
            </tr>    
             <?php endforeach; ?>
        </tbody>
</table>

<?= $this->endSection() ?>