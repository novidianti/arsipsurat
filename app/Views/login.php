<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="<?= base_url('assets/images/logo/logo.png') ?>" type="image/x-icon" />
    <title>SIPEDE | Arsip Surat</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>" />
  </head>
  <body>
    <!-- ======== Preloader =========== -->
    <div id="preloader">
      <div class="spinner"></div>
    </div>
    <!-- ======== Preloader =========== -->

      <!-- ========== signin-section start ========== -->
      <section class="signin-section">
        <div class="container-fluid">
          <div class="row g-0 auth-row">
            <div class="col-lg-6">
              <div class="auth-cover-wrapper bg-primary-100">
                <div class="auth-cover">
                  <div class="title text-center">
                    <h1 class="text-default mb-10">Efisien, Terstruktur dan Fleksibel</h1>
                    <p class="text-medium">
                    Aplikasi SIPEDE (Sistem Persuratan Disposisi Elektronik) meningkatkan efisiensi
                    dalam pengelolaan surat dan disposisi secara elektronik. Dengan sistem yang
                    terstruktur, aplikasi ini memungkinkan pengaturan dan
                    pelacakan alur disposisi surat secara digital.
                    </p>
                  </div>
                  <div class="cover-image" style="display: flex; justify-content: center;">
                    <img src="<?=base_url('assets/images/auth/login.png')?>" alt="" style="width: 340px;"/>
                  </div>
                  <div class="shape-image">
                    <img src="<?= base_url('assets/images/auth/shape.svg')?>" alt="" style="width: 340px;" />
                  </div>
                </div>
              </div>
            </div>
            <!-- end col -->
            <div class="col-lg-6">
              <div class="signin-wrapper">
                <div class="form-wrapper">
                  <h6 class="mb-15">Login</h6>
                  <p class="text-sm mb-25">
                  Silakan masukkan detail Anda untuk melanjutkan.
                  </p>
                    <?php if(!empty(session()->getFlashdata('pesan'))) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata(('pesan')) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif ?>
                  <form method="POST" action="<?=base_url('login') ?>">
                    <div class="row">
                      <div class="col-12">
                        <div class="input-style-1">
                          <label>Username</label>
                          <input type="text" class="<?= ($validation->hasError
                          ('username')) ? 'is-invalid' : '' ?> form-control" 
                          placeholder="Username" name="username" />
                            <div class="invalid-feedback">
                                <?= $validation->getError('username')?>
                            </div>
                        </div>
                      </div>
                      <!-- end col -->
                      <div class="col-12">
                        <div class="input-style-1">
                          <label>Password</label>
                          <input type="password" class="<?= ($validation->hasError
                          ('password')) ? 'is-invalid' : '' ?> form-control" 
                          placeholder="Password" name="password"/>
                            <div class="invalid-feedback">  
                                <?= $validation->getError('password')?>
                            </div>  
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="button-group d-flex justify-content-center flex-wrap">
                          <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                            Login
                          </button>
                        </div>
                      </div>
                    </div>
                    <!-- end row -->
                  </form>
                </div>
              </div>
            </div>
            <!-- end col -->
          </div>
          <!-- end row -->
        </div>
      </section>
      <!-- ========== signin-section end ========== -->

    <!-- ========= All Javascript files linkup ======== -->
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
  </body>
</html>
