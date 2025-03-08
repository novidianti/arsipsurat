<?= $this->extend('kepala/layout.php') ?>

<?= $this->section('content') ?>

<style>
  .parent-clock {
    display: grid;
    grid-template-columns: auto auto auto;
  }
</style>

<div class="row">
            <div class="col-xl-3 col-lg-4 col-sm-6">
              <div class="icon-card mb-30">
                <div class="icon success">
                    <i class="lni lni-files"></i>
                </div>
                <div class="content">
                  <h6 class="mb-10">Belum Disposisi</h6>
                  <h3 class="text-bold mb-10">0</h3>
                </div>
              </div>
              <!-- End Icon Cart -->
            </div>
            <!-- End Col -->
            <div class="col-xl-3 col-lg-4 col-sm-6">
              <div class="icon-card mb-30">
                <div class="icon primary">
                  <i class="lni lni-inbox"></i>
                </div>
                <div class="content">
                  <h6 class="mb-10">Surat Masuk</h6>
                  <h3 class="text-bold mb-10">0</h3>
                </div>
              </div>
              <!-- End Icon Cart -->
            </div>
            <!-- End Col -->
            <div class="col-xl-3 col-lg-4 col-sm-6">
              <div class="icon-card mb-30">
                <div class="icon orange">
                  <i class="lni lni-upload"></i>
                </div>
                <div class="content">
                  <h6 class="mb-10">Surat Keluar</h6>
                  <h3 class="text-bold mb-10">0</h3>
                </div>
              </div>
              <!-- End Icon Cart -->
            </div>
            <!-- End Col -->
</div>
<!-- End Row -->

<?= $this->endSection() ?>