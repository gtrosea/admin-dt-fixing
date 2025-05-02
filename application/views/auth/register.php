<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= $judul; ?></title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?= base_url('guestbook/') ?>assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?= base_url('guestbook/') ?>assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="<?= base_url('guestbook/') ?>assets/vendors/jquery-toast-plugin/jquery.toast.min.css">
  <link rel="stylesheet" href="<?= base_url('guestbook/') ?>assets/vendors/bootstrap-sweetalert/sweet-alert.css">
  <!-- End Plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="<?= base_url('guestbook/') ?>assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="<?= base_url('guestbook/') ?>assets/images/auth/icon.png" />
</head>

<body>


  <div class="berhasil" data-flashdata="<?= $this->session->flashdata('berhasil'); ?>"></div>
  <div class="gagal" data-flashdata="<?= $this->session->flashdata('gagal'); ?>"></div>

  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="row w-100 m-0">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth lock-full-bg">
          <div class="card col-lg-4 mx-auto">
            <div class="card-body px-5 py-5">
              <h3 class="card-title text-left mb-3">Activasi Kode Program</h3>
              <form id="Formlogin" action="<?= base_url('loadd/registered') ?>" method="POST">
                <div class="form-group">
                  <label for="email">Input email *</label>
                  <input type="email" class="form-control p_input" name="email" id="email" required>
                </div>
                <div class="form-group">
                  <label for="serial">Kode Program *</label>
                  <input type="text" class="form-control p_input" name="serial" id="serial" required>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary btn-block enter-btn">Kirim</button>
                </div>

                <!-- <p class="sign-up">Don't have an Account?<a href="#"> Sign Up</a></p> -->
              </form>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->

      </div>
      <!-- row ends -->

    </div>
    <!-- page-body-wrapper ends -->

  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="<?= base_url('guestbook/') ?>assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?= base_url('guestbook/') ?>assets/vendors/jquery-toast-plugin/jquery.toast.min.js"></script>
  <script src="<?= base_url('guestbook/') ?>assets/vendors/bootstrap-sweetalert/sweet-alert.js"></script>
  <!-- endinject -->

  <!-- inject:js -->
  <script src="<?= base_url('guestbook/') ?>assets/js/off-canvas.js"></script>
  <script src="<?= base_url('guestbook/') ?>assets/js/hoverable-collapse.js"></script>
  <script src="<?= base_url('guestbook/') ?>assets/js/misc.js"></script>
  <script src="<?= base_url('guestbook/') ?>assets/js/settings.js"></script>
  <script src="<?= base_url('guestbook/') ?>assets/js/todolist.js"></script>
  <!-- endinject -->

  <script type="text/javascript">
  $(function() {
    var flash = $('.gagal').data('flashdata');
    if (flash) {
      $.toast({
        heading: 'WARNING',
        text: flash,
        showHideTransition: 'slide',
        icon: 'error',
        loaderBg: '#d4c357',
        position: 'top-center'
      });
    }
  });

  $(function() {
    var flash = $('.berhasil').data('flashdata');
    if (flash) {
      $.toast({
        heading: 'SUCCESS',
        text: flash,
        showHideTransition: 'slide',
        icon: 'success',
        loaderBg: '#d4c357',
        position: 'top-center'
      });
    }
  });
  </script>


</body>

</html>