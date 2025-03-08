<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<div class="row">
            <div class="col-xl-3 col-lg-4 col-sm-6">
              <div class="icon-card mb-30">
                <div class="icon purple">
                    <i class="lni lni-check-box"></i>
                </div>
                <div class="content">
                  <h6 class="mb-10">Disposisi</h6>
                  <h3 class="text-bold mb-10"><?= $disposisiCount; ?></h3>
                </div>
              </div>
              <!-- End Icon Cart -->
            </div>
            <!-- End Col -->
            <div class="col-xl-3 col-lg-4 col-sm-6">
              <div class="icon-card mb-30">
                <div class="icon success">
                    <i class="lni lni-files"></i>
                </div>
                <div class="content">
                  <h6 class="mb-10">Jenis Surat</h6>
                  <h3 class="text-bold mb-10"><?= $jenisCount; ?></h3>
                </div>
              </div>
              <!-- End Icon Cart -->
            </div>
            <!-- End Col -->
            <div class="col-xl-3 col-lg-4 col-sm-6">
              <div class="icon-card mb-30">
                <div class="icon primary">
                    <i class="lni lni-folder"></i>
                </div>
                <div class="content">
                  <h6 class="mb-10">Dokumen</h6>
                  <h3 class="text-bold mb-10"><?= $dokumenCount; ?></h3>
                </div>
              </div>
              <!-- End Icon Cart -->
            </div>
            <!-- End Col -->
            <div class="col-xl-3 col-lg-4 col-sm-6">
              <div class="icon-card mb-30">
                <div class="icon orange">
                  <i class="lni lni-users"></i>
                </div>
                <div class="content">
                  <h6 class="mb-10">Pengguna</h6>
                  <h3 class="text-bold mb-10"><?= $userCount; ?></h3>
                </div>
              </div>
              <!-- End Icon Cart -->
            </div>
            <!-- End Col -->
          </div>
          <!-- End Row -->
 
<?= $this->endSection() ?>