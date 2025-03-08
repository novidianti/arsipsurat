<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<div class="card col-md-6">
    <div class="card-body">
        <form method="POST" action="<?= base_url('admin/jenis/update/'.$jenis['id'])?>">
    <div class="input-style-1">
        <label>Nama Jenis Surat</label>
            <input type="text" class="form-control <?= ($validation->hasError
            ('jenis')) ? 'is-invalid' : '' ?>" name="jenis" 
            placeholder="Nama Jenis Surat" value="<?= $jenis['jenis']?>"/>
         <div class="invalid-feedback"><?= $validation->getError
         ('jenis')?></div>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>

</form>
    </div>
</div>



<?= $this->endSection() ?>