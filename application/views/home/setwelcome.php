<div class="berhasil" data-flashdata="<?= $this->session->flashdata('berhasil'); ?>"></div>
<div class="gagal" data-flashdata="<?= $this->session->flashdata('gagal'); ?>"></div>
<!-- START_CONTENT -->
<div class="content-wrapper">

  <div class="page-header">
    <h3 class="page-title"> Setting Welcome Screen </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $judul ?></li>
      </ol>
    </nav>
  </div>


  <div class="row">



    <div class="col-md-4">
      <div class="card mt-3">

        <div class="card-header">
          <h4>Setting Login</h4>
        </div>

        <div class="card-body">
          <form action="<?= base_url('welcomee/bgLogin') ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <button type="button" class="btn btn-block btn-outline-primary btnBgLogin">Background Login</button>
              <input type="file" class="inpBg" name="bg" accept="image/*" style="display: none;">
            </div>
            <div class="form-group">
              <button type="button" class="btn btn-block btn-outline-primary btnlogoLogin">Logo Login</button>
              <input type="file" class="inpIcon" name="icon" accept="image/*" style="display: none;">
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-block btn-primary">PREVIEW</button>
            </div>
          </form>
        </div>
      </div>

      <div class="content-wrapper mt-3"
        style="background: url('<?= base_url('guestbook/assets/images/auth/' . $seting['bg_login']) ?>');background-repeat: no-repeat;background-position-y: top;background-position-x: center;background-size: cover;">

        <div class="text-center">
          <a href="<?= base_url('welcomee/loginLive') ?>" class="btn btn-danger px-4 mb-n5">PREVIEW
            LIVE</a>
        </div>

        <div style="max-width: 300px;margin-top:60px;margin-bottom:30px" class="card col-md-4 mx-auto">
          <div class="card-body px-2 pt-5 pb-2 rounded">
            <div
              style="width: 5em;height: 5em;background: url('<?= base_url('guestbook/assets/images/auth/' . $seting['logo_login']) ?>');background-position: center;background-repeat: no-repeat;background-size: cover;margin-top: -5em;margin-bottom: 20px;border-radius: 50%;"
              class="mx-auto">
            </div>

            <form>
              <div class="form-group">
                <label class="small">Username or email *</label>
                <input type="text" class="form-control form-control-sm" value="admin">
              </div>
              <div class="form-group">
                <label class="small">Password *</label>
                <input type="password" class="form-control form-control-sm" value="***********">
              </div>

              <div class="text-center">
                <button type="button" class="btn btn-sm btn-primary btn-block mb-5">LOGIN</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>



    <div class="col-md-7">
      <div class="card mt-3">

        <div class="card-header">
          <h4>Setting Video</h4>
        </div>

        <div class="card-body">
          <form action="<?= base_url('welcomee/video') ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <div class="input-group mb-3">
                <input type="text" class="form-control videoUrl" required placeholder="Video.mp4" readonly>
                <div class="input-group-append">
                  <button class="btn btn-primary btnVideo" type="submit">Kirim</button>
                  <input type="file" name="url" class="urlVideo" required accept=".mp4" style="display: none;">
                </div>
              </div>
            </div>
          </form>

          <video controls autoplay class="img-fluid">
            <source src="<?= base_url('guestbook/assets/images/auth/' . $seting['url']) ?>" type="video/mp4" />
            Browsermu tidak mendukung tag ini, upgrade dulu ya!
          </video>

        </div>
      </div>
    </div>

  </div>

</div>
<!-- content-wrapper ends -->





<?php $this->load->view('temp/footer') ?>




<script type="text/javascript">
$('.btnView').click(function() {
  document.location.reload();
});



$('input#wel').blur(function() {
  var isi = $(this).val();
  var id = $(this).data('id');
  $.ajax({
    url: "<?= base_url('welcomee/setingWel') ?>",
    type: "POST",
    data: {
      isi: isi,
      id: id,
      name: 'welcome'
    },
    cache: false,
    success: function() {
      console.log('1');
    }
  });
});

$('input#warna').change(function() {
  var isi = $(this).val();
  var id = $(this).data('id');
  $.ajax({
    url: "<?= base_url('welcomee/setingWel') ?>",
    type: "POST",
    data: {
      isi: isi,
      id: id,
      name: 'warna'
    },
    cache: false,
    success: function() {
      console.log('1');
    }
  });
});

$('input#bg').change(function() {
  var isi = $(this).val();
  var id = $(this).data('id');
  $.ajax({
    url: "<?= base_url('welcomee/setingWel') ?>",
    type: "POST",
    data: {
      isi: isi,
      id: id,
      name: 'warna_bg'
    },
    cache: false,
    success: function() {
      console.log('1');
    }
  });
});



function readURL(input) {
  var url = input.value;
  var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
  if (input.files && input.files[0] && (ext == "png" || ext == "jpeg" || ext == "jpg")) {
    $('.btnView').hide();
    $('.btnSave').show();
  } else {
    $('.btnSave').hide();
    $('.btnView').show();
  }
}

$('.btnUpload').click(function(e) {
  e.preventDefault();
  $('.inputFile').click();
})




$('.videoUrl').click(function(e) {
  e.preventDefault();
  $('.urlVideo').click();
});


$('.urlVideo').on('input', function() {
  let fileName = $(this).val().split('\\').pop();
  $('.videoUrl').val(fileName);
});



$('.btnlogoLogin').click(function(e) {
  e.preventDefault();
  $('.inpIcon').click();
});

$('.inpIcon').on('input', function() {
  let fileName = $(this).val().split('\\').pop();
  $('.btnlogoLogin').html(fileName);
});


$('.btnBgLogin').click(function(e) {
  e.preventDefault();
  $('.inpBg').click();
});

$('.inpBg').on('input', function() {
  let fileName = $(this).val().split('\\').pop();
  $('.btnBgLogin').html(fileName);
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