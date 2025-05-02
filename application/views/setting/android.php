<!-- START_CONTENT -->
<div class="content-wrapper">

  <div class="page-header">
    <h3 class="page-title"> Connect Android </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $judul ?></li>
      </ol>
    </nav>
  </div>


  <div class="row">

    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="text-center">
            <h6>Scan QR Code ini untuk Terkoneksi<br>dengan Aplikasi Andorid</h6>

            <div class="mt-5">
              <img style="max-width: 250px"
                src="<?= base_url('guestbook/assets/images/qr/' . $konek['kode'] . '.png') ?>" alt="qr"
                class="img-fluid">
            </div>
          </div>

        </div>
      </div>
    </div>




  </div>

</div>
<!-- content-wrapper ends -->


<!-- Modal -->
<div class="modal fade" id="modalPoto" tabindex="-1" role="dialog" aria-labelledby="modalPotoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalPotoLabel">Preview Images</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('setting/updatePoto') ?>" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-12 text-center">
              <img class="img-fluid imagepreview" src="" alt="view">
            </div>
            <div class="col-12 text-center my-3">
              <button type="button" class="btn btn-primary btn-pilih-gbr">UPLOAD IMAGE</button>
              <input type="file" name="poto" accept="image/*" oninput="readURL(this)" style="display: none;"
                class="input-upload-image">

              <button type="submit" style="display: none;" class="btn btn-info btnUpdate btn-block mt-3">SAVE</button>
            </div>

            <input type="text" style="display: none;" name="id">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditLabel">Edit Data</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('setting/editData') ?>" method="post" enctype="multipart/form-data">
          <div class="row">

            <div class="col-12">
              <div class="form-group">
                <label for="event">Event</label>
                <input type="text" name="event" id="event" class="form-control" required placeholder="nama event"
                  value="">
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
                <label for="tgl">Tanggal</label>
                <input type="date" name="tgl" id="tgl" class="form-control" required placeholder="tanggal event"
                  value="">
              </div>
            </div>

            <input type="text" name="id" value="" hidden>

            <div class="col-12">
              <div class="form-group">
                <label for=""></label>
                <button type="submit" class="btn btn-primary">UPDATE</button>
              </div>
            </div>

          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>






<?php $this->load->view('temp/footer') ?>

<script src="<?= base_url('guestbook/') ?>assets/js/file-upload.js"></script>




<script type="text/javascript">
$('table tbody').on('click', 'tr a.viewPoto', function(e) {
  e.preventDefault();
  var src = $(this).data('img');
  var id = $(this).data('id');
  $('#modalPoto').modal('show');
  $('#modalPoto .modal-body img').attr('src', src);
  $('#modalPoto input[name="id"]').val(id);
});

$('table tbody').on('click', 'tr .setActive', function(e) {
  e.preventDefault();
  var id = $(this).data('id');
  var btn = $(this);
  var link = '<?= base_url('setting/setActive/') ?>' + id;

  $.ajax({
    url: link,
    cache: false,
    beforeSend: function() {
      btn.html('<i class="mdi mdi-spin mdi-24px mdi-rotate-right"></i>')
    },
    success: function() {
      document.location.reload();
    }
  });
});

$('table tbody').on('click', 'tr .btnDelete', function(e) {
  e.preventDefault();
  var id = $(this).data('id');
  var btn = $(this);
  var link = '<?= base_url('setting/delData/') ?>' + id;

  swal({
    title: '',
    text: "Tindakan ini akan menghapus data Tamu, yg ada pada event ini!",
    type: "info",
    showCancelButton: true,

    confirmButtonText: "Yes Delete",
    cancelButtonText: "No",
  }, function(isConfirm) {
    if (isConfirm) {

      $.ajax({
        url: link,
        cache: false,
        beforeSend: function() {
          btn.html('<i class="mdi mdi-spin mdi-24px mdi-rotate-right"></i>')
        },
        success: function() {
          document.location.reload();
        }
      });
    }
  });
});



$('table tbody').on('click', 'tr .btnEdit', function(e) {
  e.preventDefault();
  var id = $(this).data('id');
  var nama = $(this).data('nama');
  var tgl = $(this).data('tgl');
  $('#modalEdit').modal('show');
  $('#modalEdit input[name="id"]').val(id);
  $('#modalEdit input[name="event"]').val(nama);
  $('#modalEdit input[name="tgl"]').val(tgl);
});


$('table tbody').on('click', 'tr .btnGb', function(e) {
  e.preventDefault();
  var link = '<?= base_url('home') ?>';
  window.location.href = link;
});
</script>





<!-- iUpload Priview -->
<script>
function readURL(input) {
  var url = input.value;
  var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
  if (input.files && input.files[0] && (ext == "png" || ext == "jpeg" || ext == "jpg")) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('.imagepreview').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
    $('#modalPoto .btnUpdate').show();
  } else {
    $('.imagepreview').attr();
    $('#modalPoto .btnUpdate').hide();
  }
}
</script>
<script>
$('.btn-pilih-gbr').click(function() {
  var pilihFile = $('.input-upload-image');
  pilihFile.click();
});
</script>



</body>

</html>