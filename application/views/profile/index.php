<!-- START_CONTENT -->
<div class="content-wrapper">

  <div class="page-header">
    <h3 class="page-title"> Account Settings </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $judul ?></li>
      </ol>
    </nav>
  </div>


  <div class="row">
    <div class="col-md-3">
      <div class="card">
        <div class="card-body text-center">
         
        <img src="<?= base_url('guestbook/assets/images/faces/'. $user['poto']) ?>" alt="pp" class="img-fluid rounded imagepreview" style="width: 200px">

        <div class="mt-3 mb-3">
          <button class="btn btn-success btnUpload">Upload</button>

          <form action="<?= base_url('profile/updatePoto') ?>" method="POST" enctype="multipart/form-data">
          <input type="file" name="poto" class="inputFile" oninput="readURL(this)" style="display: none">
          <input type="text" style="display: none" name="id" value="<?= $user['id'] ?>">

          <button class="btn btn-primary btn-block mt-3 btnSav" style="display: none">SAVE</button>
        </form>
        </div>

        </div>
      </div>
    </div>

    <div class="col-md-9">
      <div class="card">
        <div class="card-body">
          <div class="card-title">
            <h3>My Profile</h3>
          </div>

          <form action="<?= base_url('profile/update') ?>" method="post">

            <div class="form-group row">
              <label for="nama" class="col-sm-3 col-form-label">Name</label>
              <div class="col-sm-9">
                <input type="text" name="nama" id="nama" class="form-control" readonly required value="<?= $user['nama'] ?>">
              </div>
            </div>

            <div class="form-group row">
              <label for="username" class="col-sm-3 col-form-label">Username</label>
              <div class="col-sm-9">
                <input type="text" name="username" id="username" class="form-control" readonly required value="<?= $user['username'] ?>">
              </div>
            </div>

            <div class="form-group row">
              <label for="email" class="col-sm-3 col-form-label">Email</label>
              <div class="col-sm-9">
                <input type="text" name="email" id="email" class="form-control" readonly required value="<?= $user['email'] ?>">
              </div>
            </div>

            <input type="text" style="display: none" name="id" value="<?= $user['id'] ?>">

            <div class="form-group mt-4 float-right">
              <button type="button" class="btn btn-inverse-danger btnEdi">Edit Profile</button>
              <button type="submit" class="btn btn-primary btnSave" style="display: none">Save Update</button>
            </div>

          </form>
        </div>
      </div>
    </div>

  </div>

</div>
<!-- content-wrapper ends -->





<?php $this->load->view('temp/footer') ?>




<script type="text/javascript">
$(function(){
$('#datatable').DataTable();
});



$('#btnMember').click(function(){
  $('.modal#modalAddMember').modal('show');
})

$('.btnUpgradeM').click(function(e){
  e.preventDefault();
  var id = $(this).data('id');
  var nama = $(this).data('nama');
  $('.modal#modalUpgrade').modal('show');
  $('.modal#modalUpgrade input[name="nama"]').val(nama);
  $('.modal#modalUpgrade input[name="id"]').val(id);
})





$(function() {
  $('.btnEdi').on('click', function(e) {
    e.preventDefault();
    $(this).hide();
    $('.btnSave').show();
    $('input[name="nama"]').focus()
    $('input[name="nama"]').removeAttr('readonly');
  });


  $('.btnUpload').click(function(e){
    e.preventDefault();
    $('.inputFile').click();
  })
});


function readURL(input) {
  var url = input.value;
  var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
  if (input.files && input.files[0] && (ext == "png" || ext == "jpeg" || ext == "jpg")) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('.imagepreview').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
    $('.btnSav').show();
  } else {
    $('.imagepreview').attr();
    $('.btnSav').hide();
  }
}

</script>


<script>
$('.custom-file-input').on('change', function() {
  let fileName = $(this).val().split('\\').pop();
  $(this).next('.custom-file-label').addClass("selected").html(fileName);
});
</script>



</body>

</html>