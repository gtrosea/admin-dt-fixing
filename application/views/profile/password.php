<!-- START_CONTENT -->
<div class="content-wrapper">

  <div class="page-header">
    <h3 class="page-title"> Change Password </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $judul ?></li>
      </ol>
    </nav>
  </div>


  <div class="row">
   
    <div class="col-md-9">
      <div class="card">
        <div class="card-body">
          

          <form action="<?= base_url('profile/updatePass') ?>" method="post">

            <div class="form-group row">
              <label for="pass" class="col-sm-3 col-form-label">Password Lama</label>
              <div class="col-sm-9">
                <input type="password" name="pass" id="pass" class="form-control" required placeholder="Input Password Lama">
              </div>
            </div>

            <div class="form-group row">
              <label for="pass1" class="col-sm-3 col-form-label">Password Baru</label>
              <div class="col-sm-9">
                <input type="password" name="pass1" id="pass1" class="form-control" required placeholder="Input Password Baru">
              </div>
            </div>

            <div class="form-group row">
              <label for="pass2" class="col-sm-3 col-form-label">Ulangi Password Baru</label>
              <div class="col-sm-9">
                <input type="password" name="pass2" id="pass2" class="form-control" required placeholder="Konfirmasi Password Baru">
              </div>
            </div>

            <input type="text" style="display: none" name="id" value="<?= $user['id'] ?>">

            <div class="form-group mt-4 float-right">
              <button type="submit" class="btn btn-primary">Update Password</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- content-wrapper ends -->







<?php $this->load->view('temp/footer') ?>




</body>

</html>