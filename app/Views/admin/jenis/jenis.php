<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<a href="<?= base_url('admin/jenis/create')?>" class="btn btn-primary">
<i class="lni lni-circle-plus"></i>Tambah Data</a>

<table class="table table-striped" id="datatables">
    <thead>
        <tr>
            <th>No</th>
            <th>Jenis Surat</th>
            <th>Aksi</th>
        </tr>
    </thead>
        <tbody>
            <?php $no=1;
            foreach($jenis as $jen) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $jen['jenis'] ?></td>
                <td>
                    <a href="<?= base_url('admin/jenis/edit/'. $jen['id'])?>" class="badge bg-primary"><i class="lni lni-pencil"></i></a>
                    <a href="<?= base_url('admin/jenis/delete/'. $jen['id'])?>" class="badge bg-danger tombol-hapus"><i class="lni lni-trash-can"></i></a>
                </td>
            </tr>    
             <?php endforeach; ?>
        </tbody>
</table>

<?= $this->endSection() ?>