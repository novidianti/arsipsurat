<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<a href="<?= base_url('admin/disposisi/create')?>" class="btn btn-primary">
<i class="lni lni-circle-plus"></i>Tambah Data</a>

<table class="table table-striped" id="datatables">
    <thead>
        <tr>
            <th>No</th>
            <th>Jabatan</th>
            <th>Aksi</th>
        </tr>
    </thead>
        <tbody>
            <?php $no=1;
            foreach($jabatan as $dis) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $dis['jabatan'] ?></td>
                <td>
                    <a href="<?= base_url('admin/disposisi/edit/'. $dis['id'])?>" class="badge bg-primary"><i class="lni lni-pencil"></i></a>
                    <a href="<?= base_url('admin/disposisi/delete/'. $dis['id'])?>" class="badge bg-danger tombol-hapus"><i class="lni lni-trash-can"></i></a>
                </td>
            </tr>    
             <?php endforeach; ?>
        </tbody>
</table>

<?= $this->endSection() ?>