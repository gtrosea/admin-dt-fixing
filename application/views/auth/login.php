<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title><?= $judul ?></title>
  <link rel="shortcut icon" href="<?= base_url('guestbook/assets/images/auth/' . $seting['logo_login']) ?>">

  <meta content="" name="descriptison">
  <meta content="" name="keywords">
  <meta property="og:title" content="<?= $judul ?>">
  <meta property="og:description" content="<?= base_url() ?>">
  <meta property="og:image" content="<?= base_url('guestbook/assets/images/auth/' . $seting['logo_login']) ?>">

  <meta property="twitter:title" content="<?= $judul ?>">
  <meta property="twitter:description" content="<?= base_url() ?>">
  <meta property="twitter:image" content="<?= base_url('guestbook/assets/images/auth/' . $seting['logo_login']) ?>">
  <meta name="twitter:card" content="summary_large_image">
  <meta data-rh="true" name="description" content="<?= base_url() ?>">


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
  <link rel="stylesheet"
    href="<?= base_url('guestbook/assets/css/style.css?v=' . filemtime('guestbook/assets/css/style.css')) ?>">

  <!-- End layout styles -->
  <link rel="shortcut icon" href="<?= base_url('guestbook/assets/images/auth/' . $seting['logo_login']) ?>">
</head>

<body>


  <div class="berhasil" data-flashdata="<?= $this->session->flashdata('berhasil'); ?>"></div>
  <div class="gagal" data-flashdata="<?= $this->session->flashdata('gagal'); ?>"></div>

  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="row w-100 m-0">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth lock-full-bg"
          style="background: url('<?= base_url('guestbook/assets/images/auth/' . $seting['bg_login']) ?>');background-repeat: no-repeat;background-position-y: top;background-position-x: center;background-size: cover;">

          <div style="max-width: 350px;" class="card-login col-md-4 mx-auto mt-5">
            <div class="card-body px-2 pt-5 pb-2 rounded">
              <div
                style="width: 9em;height: 9em;background: url('<?= base_url('guestbook/assets/images/auth/' . $seting['logo_login']) ?>');background-position: center;background-repeat: no-repeat;background-size: cover;margin-top: -7em;"
                class="mx-auto">
              </div>

              <!-- <h3 class="card-title text-left mb-3">Login</h3> -->
              <form id="Formlogin" action="<?= base_url('auth/login') ?>">
                <div class="form-group">
                  <label>Username or email *</label>
                  <input type="text" class="form-control p_input" name="username" id="InputUsername" required>
                </div>
                <div class="form-group">
                  <label>Password *</label>
                  <input type="password" class="form-control p_input" name="password" id="InputPassword" required>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary btn-block enter-btn">LOGIN</button>
                </div>

                <p class="sign-up">Don't have an Account?<a href="https://pesan.link/chatminti"> Sign Up</a></p>
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

  <!-- <script src="<?= base_url('guestbook/') ?>assets/js/toastDemo.js"></script> -->
  <!-- <script src="<?= base_url('guestbook/') ?>assets/js/desktop-notification.js"></script> -->

  <script>
  $(function() {
    $('#Formlogin').submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: $(this).attr('action'),
        type: "POST",
        cache: false,
        data: $(this).serialize(),
        dataType: 'json',
        success: function(json) {
          //response dari json_encode di controller

          if (json.kode == 1) {
            window.location.href = json.url_home;
          }
          if (json.kode == 2) {
            $.toast({
              heading: 'ERROR',
              text: json.text,
              showHideTransition: 'slide',
              icon: 'error',
              loaderBg: '#57c7d4',
              position: 'top-right'
            });
            $('#InputPassword').val('');
          }
          if (json.kode == 3) {
            $.toast({
              heading: 'ERROR',
              text: json.text,
              showHideTransition: 'slide',
              icon: 'warning',
              loaderBg: '#57c7d4',
              position: 'top-right'
            });
          }
        }
      });
    });
  });
  </script>

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