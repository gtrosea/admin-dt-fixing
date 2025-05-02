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
  <link rel="shortcut icon" href="<?= base_url('guestbook/') ?>assets/images/auth/scann2.png" />
</head>

<body>

  <div class="bodyKonten">
    <!-- LOAD -->
  </div>




  <script src="<?= base_url('guestbook/') ?>assets/vendors/js/vendor.bundle.base.js"></script>

  <script>
  $(function() {
    var auto_refresh = setInterval(
      function() {
        var url = "<?= base_url('welcomee/autoLoadPage') ?>";
        $('.bodyKonten').load(url).fadeIn("slow");
      }, 1000); // refresh setiap 1 detik
  });
  </script>

</body>

</html>