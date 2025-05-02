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
  <link rel="stylesheet"
    href="<?= base_url('guestbook/assets/css/style.css?v=' . filemtime('guestbook/assets/css/style.css')) ?>">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="<?= base_url('guestbook/') ?>assets/images/auth/icon.png" />
</head>

<body>
    
    <style>
        .sidebar .nav .nav-item.active.noactive>.nav-link {
    background: none;
    box-shadow: none;
}

.sidebar .nav .nav-item.active.noactive>.nav-link:before {
    content: "";
    width: 3px;
    height: 100%;
    background: none;
    display: inline-block;
    position: absolute;
    left: 0;
    top: 0;
}
    </style>

  <div class="successAlert" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
  <div class="errorAlert" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>

  <div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->

    <!-- SIDEBAR -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="<?= base_url() ?>"><i class="mdi mdi-qrcode-scan"></i> BUKUTAMU</a>
        <a class="sidebar-brand brand-logo-mini" href="<?= base_url() ?>"><i class="mdi mdi-qrcode-scan"></i></a>
      </div>
      <ul class="nav">


        <!-- PROFILE -->
        <li class="nav-item profile">
          <div class="profile-desc">

            <a href="#" id="profile-dropdown" data-toggle="dropdown" style="text-decoration: none;color: unset">
              <div class="profile-pic">
                <div class="count-indicator">
                  <img class="img-xs rounded-circle "
                    src="<?= base_url('guestbook/') ?>assets/images/faces/<?= $user['poto'] ?>" alt="">
                  <span class="count bg-success"></span>
                </div>
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal"><?= $user['nama'] ?></h5>
                  <?php if ($user['role'] == '2' || $user['role'] == '1') : ?>
                  <span>Akun Admin</span>
                  <?php else : ?>
                  <span>Akun User</span>
                  <?php endif; ?>
                </div>
              </div>

            </a>

            <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list"
              aria-labelledby="profile-dropdown">
              <a href="<?= base_url('profile') ?>" class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-dark rounded-circle">
                    <i class="mdi mdi-settings text-primary"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                </div>
              </a>

              <div class="dropdown-divider"></div>
              <a href="<?= base_url('profile/password') ?>" class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-dark rounded-circle">
                    <i class="mdi mdi-onepassword  text-info"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                </div>
              </a>


              </a>

            </div>
          </div>
        </li>
        <!-- END-PROFILE -->






        <!-- MAIN-MENU -->
        <li class="nav-item nav-category">
          <span class="nav-link">Main Menu</span>
        </li>

        <li class="nav-item menu-items">
          <a class="nav-link" href="<?= base_url('home') ?>">
            <span class="menu-icon">
              <i class="mdi mdi-speedometer"></i>
            </span>
            <span class="menu-title">Buku Tamu</span>
          </a>
        </li>

        <li class="nav-item menu-items">
          <a class="nav-link" href="<?= base_url('tamu/tamulist') ?>">
            <span class="menu-icon">
              <i class="mdi mdi-account-multiple"></i>
            </span>
            <span class="menu-title">Rekap Data Tamu</span>
          </a>
        </li>



        <li class="nav-item menu-items">
          <a class="nav-link" href="<?= base_url('master') ?>">
            <span class="menu-icon">
              <i class="mdi mdi-database"></i>
            </span>
            <span class="menu-title">Master Data Tamu</span>
          </a>
        </li>




        <?php if ($user['role'] !== "3") : ?>

        <li class="nav-item menu-items">
          <a class="nav-link" href="<?= base_url('setting') ?>">
            <span class="menu-icon">
              <i class="mdi mdi-settings"></i>
            </span>
            <span class="menu-title">Settings</span>
          </a>
        </li>



        <li class="nav-item menu-items">
          <a class="nav-link" href="<?= base_url('wordpress') ?>">
            <span class="menu-icon">
              <i class="mdi mdi-wordpress"></i>
            </span>
            <span class="menu-title">Wordpress Connect</span>
          </a>
        </li>



        <li class="nav-item menu-items">
          <a class="nav-link" href="<?= base_url('welcomee') ?>">
            <span class="menu-icon">
              <i class="mdi mdi-desktop-mac"></i>
            </span>
            <span class="menu-title">Screen Welcome</span>
          </a>
        </li>

        <?php endif; ?>

        <?php if ($user['role'] == "3") : ?>

        <li class="nav-item menu-items">
          <a class="nav-link" href="<?= base_url('setingunser') ?>">
            <span class="menu-icon">
              <i class="mdi mdi-settings"></i>
            </span>
            <span class="menu-title">Settings</span>
          </a>
        </li>

        <?php endif; ?>

        <li class="nav-item menu-items <?php if($judul!='UserGuide') echo 'noactive' ?>">
          <a class="nav-link" href="<?= base_url('home/tutor') ?>">
            <span class="menu-icon">
              <i class="mdi mdi-video"></i>
            </span>
            <span class="menu-title">Userguide</span>
          </a>
        </li>

        <li class="nav-item menu-items">
          <a class="nav-link" href="<?= base_url('auth/logout') ?>">
            <span class="menu-icon">
              <i class="mdi mdi-logout"></i>
            </span>
            <span class="menu-title">Log-out</span>
          </a>
        </li>


        <!-- END-MAIN-MENU -->

      </ul>
    </nav>






    <!-- partial -->
    <div class="container-fluid page-body-wrapper">

      <!-- partial:partials/_navbar.html -->
      <!-- NAVBAR -->
      <nav class="navbar p-0 fixed-top d-flex flex-row bg-gradient-secondary">
        <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
          <a class="navbar-brand brand-logo-mini btnScanWebcamcode" data-toggle="modal" data-target="#modalWebcamHome"
            href="#"><i class="mdi mdi-qrcode-scan"></i></a>
        </div>
        <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center text-black" type="button"
            data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>

          <!-- <ul class="navbar-nav w-100">
            <li class="nav-item w-100">
              <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                <input type="text" class="form-control" placeholder="Search Event">
              </form>
            </li>
          </ul> -->

          <ul class="navbar-nav navbar-nav-right text-black">



            <li class="nav-item border-left">
              <a class="nav-link" target="_blank" href="<?= base_url('home/welcome') ?>">
                <i class="mdi mdi-desktop-mac"></i>
              </a>
            </li>


          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-format-line-spacing"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->



      <!-- footer -->
      <div class="main-panel">