<!-- START_CONTENT -->
<div class="content-wrapper">

  <div class="page-header">
    <h3 class="page-title"> Settings </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $judul ?></li>
      </ol>
    </nav>
  </div>


  <div class="row">

    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-sm-6">
              <h4>Add New Event</h4>
            </div>
            <div class="col-sm-6">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="chekAdmin" data-nama="<?= $user['nama'] ?>"
                  data-email="<?= $user['email'] ?>" data-username="<?= $user['username'] ?>">
                <label class="form-check-label" for="chekAdmin">Add Event Administrator</label>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <h4 class="card-title">Add New Event</h4>
          <form class="forms-sample" action="<?= base_url('setting/addData') ?>" id="formInput"
            enctype="multipart/form-data" method="POST">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="event">Event</label>
                  <input type="text" class="form-control" id="event" name="event" required
                    placeholder="exp: Rendi & Dina">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="tgl">Tanggal Event</label>
                  <input type="date" class="form-control" id="tgl" name="tgl" required placeholder="Tanggal Event">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>File upload</label>
                  <input type="file" name="img" accept="image/*" class="file-upload-default" required>
                  <div class="input-group col-xs-12">
                    <input type="text" class="form-control file-upload-info" required disabled
                      placeholder="Upload Image">
                    <span class="input-group-append">
                      <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                    </span>
                  </div>
                </div>

                <textarea style="display: none" name="wa" rows="10">Bissmillahirrahmanirrahim 
Assalamualaikum Warahmatullahi Wabarakatuh.

Kepada Yth:
*[NAMA-TAMU]*



Dengan memohon rahmat dan ridho ﷲ 
kami bermaksud mengundang Bapak/Ibu/Saudara/i untuk hadir dalam acara pernikahan kami :


*Nama Mempelai 1*
 & 
*Nama Mempelai 2*


Untuk Info Detail Acara, Lokasi, dan Waktu Lebih Lengkap bisa akses link undangan online berikut : 


[LINK-UNDANGAN]



Merupakan Suatu Kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Rekan-rekan berkenan hadir dan memberikan doa restu di acara pernikahan kami.  

Karena keterbatasan jarak dan waktu tidak dapat mengirimkan undangan ini secara langsung, maka melalui e-invitation ini dapat menjadi pengganti undangan resmi sehingga tujuan kami tersampaikan.



Hormat Kami yang berbahagia
*Mempelai 1 & Mempelai 2*

Wassallamualaikum Warahmatullahi Wabarakatuh.</textarea>
              </div>


              <div class="col-md-4">
                <div class="form-group">
                  <label for="nama">User Member</label>
                  <input type="text" class="form-control" id="nama" name="nama" required
                    placeholder="exp: Rangga Marlius">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="username">Username Member</label>
                  <input type="text" class="form-control" id="username" name="username" required
                    placeholder="exp: rangga">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="email">Email Member</label>
                  <input type="email" class="form-control" id="email" name="email" required
                    placeholder="example@gmail.com">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="pass">Password Member</label>
                  <input type="text" class="form-control" id="pass" name="pass" required>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <button type="submit" class="btn btn-primary mt-4 btn-block">Tambahkan</button>
                </div>
              </div>

            </div>


          </form>
        </div>
      </div>
    </div>


    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <div class="row">
            <div class="col-sm-7">
              <h4 class="card-title">List Event</h4>
            </div>




          </div>



          <div class="table-responsive">
            <table class="table table-striped" id="dataTable">
              <thead>
                <tr>
                  <th>Images</th>
                  <th>Event</th>
                  <th>Tanggal</th>
                  <th>Jml Undangan</th>
                  <th>Member</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($event as $row) : ?>
                <?php
                  $jmlTamu = $this->m_event->jmlTamuByEvent($row['id']);
                  $member = $this->m_user->byId($row['admin_id']);
                  ?>
                <tr>
                  <td><a href="" class="viewPoto" data-id="<?= $row['id'] ?>"
                      data-img="<?= base_url('guestbook/assets/images/event/' . $row['poto']) ?>"><img
                        src="<?= base_url('guestbook/assets/images/event/' . $row['poto']) ?>" alt="image"></a></td>
                  <td><?= $row['nama'] ?></td>
                  <td><?= date('d/m/Y', strtotime($row['tgl'])) ?></td>
                  <td><?= $jmlTamu ?></td>
                  <td><?= $member['nama'] . ' / ' . $member['email'] ?></td>
                  <td style="width: 100px;">
                    <div class="btn-group btn-group-sm">
                      <button class="btn btn-sm btn-info btnWelcome" data-id="<?= $row['id'] ?>"
                        data-warna="<?= $row['warna'] ?>" data-wel="<?= $row['welcome'] ?>"><i
                          class="mdi mdi-image"></i></button>
                      <button class="btn btn-sm btn-success btnEditWa" data-id="<?= $row['id'] ?>"
                        data-wa="<?= $row['wa'] ?>"><i class="mdi mdi-whatsapp"></i></button>
                      <button class="btn btn-sm btn-primary btnEdit" data-id="<?= $row['id'] ?>"
                        data-nama="<?= $row['nama'] ?>" data-tgl="<?= $row['tgl'] ?>">Edit</button>
                      <?php if ($eventActive['id'] == $row['id']) : ?>
                      <button class="btn btn-sm btn-success btnGb">Guestbook</button>
                      <!-- <button class="btn btn-sm btn-success">Active</button> -->
                      <?php else : ?>
                      <button class="btn btn-sm btn-danger btnDelete" data-id="<?= $row['id'] ?>">Delete</button>
                      <button data-id="<?= $row['id'] ?>" class="btn btn-sm btn-info setActive">Set Active</button>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
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


<!-- Modal -->
<div class="modal fade" id="modalWa" tabindex="-1" role="dialog" aria-labelledby="modalWaLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalWaLabel">Edit Data</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('setting/editDataWa') ?>" method="post" enctype="multipart/form-data">
          <div class="row">



            <div class="col-12">
              <div class="form-group">
                <label for="wa">Text WhatsApp</label>
                <textarea name="wa" id="wa" rows="13" class="form-control" required></textarea>
              </div>
              <small class="text-muted">Kode [LINK-UNDANGAN] untuk posisi link undangan di sisipkan | Kode [NAMA-TAMU]
                untuk posisi
                Nama Tamu disipkan | Kode [CARD] Untuk posisi QRCODE tamu sisipkan, Pastikan menulis dengan benar,
                ya!</small>
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



<!-- Modal -->
<div class="modal fade" id="modalBge" tabindex="-1" role="dialog" aria-labelledby="modalBgeLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalBgeLabel">Background Welcome</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('setting/editBgWelcome') ?>" method="post" enctype="multipart/form-data">
          <div class="row">

            <div class="col-sm-12">
              <div class="form-group">
                <label for="wel">Text Welcome</label>
                <input type="text" name="wel" id="wel" data-id="<?= $event['id'] ?>" class="form-control" required
                  value="<?= $event['welcome'] ?>">
              </div>
            </div>

            <div class="col-sm-12">
              <div class="form-group">
                <label for="warna">Text Color</label>
                <input type="color" name="warna" id="warna" data-id="<?= $event['id'] ?>" class="form-control" required
                  value="<?= $event['warna'] ?>">
              </div>
            </div>

            <div class="col-sm-12">
              <div class="form-group">
                <input type="file" name="poto" accept="image/*" style="display: none;" class="file-upload-default">
                <div class="input-group">
                  <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                  <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                  </span>
                </div>
              </div>
            </div>

            <div class="col-sm-12">
              <div class="form-group">
                <button type="submit" class="btn btn-block btn-primary">UPDATE</button>
              </div>
            </div>

            <input type="text" name="id" style="display: none;">

          </div>
        </form>
      </div>

    </div>
  </div>
</div>



<?php $this->load->view('temp/footer') ?>

<script src="<?= base_url('guestbook/') ?>assets/js/file-upload.js"></script>

<script>
$(document).ready(function() {
  $('#dataTable').dataTable()
})
</script>



<script type="text/javascript">
$('table tbody').on('click', 'tr .btnWelcome', function(e) {
  e.preventDefault();
  var warna = $(this).data('warna');
  var wel = $(this).data('wel');
  var id = $(this).data('id');
  $('#modalBge').modal('show');
  $('#modalBge input[name="id"]').val(id);
  $('#modalBge input[name="warna"]').val(warna);
  $('#modalBge input[name="wel"]').val(wel);
});


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
    success: function(respon) {
      if (respon == 1) {
        document.location.reload();
      } else {
        $.toast({
          heading: 'Danger',
          text: 'Silahkan LOGIN Sebagai Member Pada Event INI',
          showHideTransition: 'slide',
          icon: 'error',
          loaderBg: '#d4c357',
          position: 'top-right'
        });
        btn.html('Set Active');
      }
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


$('table tbody').on('click', 'tr .btnEditWa', function(e) {
  e.preventDefault();
  var id = $(this).data('id');
  var wa = $(this).data('wa');
  $('#modalWa').modal('show');
  $('#modalWa input[name="id"]').val(id);
  $('#modalWa textarea[name="wa"]').val(wa);
});



$('#chekAdmin').on('click', function() {
  var name = $(this).data('nama');
  var username = $(this).data('username');
  var mail = $(this).data('email');

  if ($(this).prop('checked')) {
    $('#formInput input[name="nama"]').attr('readonly', 'readonly');
    $('#formInput input[name="nama"]').val(name);
    $('#formInput input[name="username"]').attr('readonly', 'readonly');
    $('#formInput input[name="username"]').val(username);
    $('#formInput input[name="email"]').attr('readonly', 'readonly');
    $('#formInput input[name="email"]').val(mail);
    $('#formInput input[name="pass"]').attr('readonly', 'readonly');
    $('#formInput input[name="pass"]').attr('type', 'password');
    $('#formInput input[name="pass"]').val('kendalikan');
  } else {
    $('#formInput input[name="nama"]').removeAttr('readonly', 'readonly');
    $('#formInput input[name="nama"]').val('');
    $('#formInput input[name="username"]').removeAttr('readonly', 'readonly');
    $('#formInput input[name="username"]').val('');
    $('#formInput input[name="email"]').removeAttr('readonly', 'readonly');
    $('#formInput input[name="email"]').val('');
    $('#formInput input[name="pass"]').removeAttr('readonly', 'readonly');
    $('#formInput input[name="pass"]').val('');
    $('#formInput input[name="pass"]').removeAttr('type');
    $('#formInput input[name="pass"]').atrr('type', 'text');
  }
});


$('#formInput .file-upload-info').on('click', function() {
  $('#formInput .file-upload-browse').click();
})
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


<script>
$('.custom-file-input').on('change', function() {
  let fileName = $(this).val().split('\\').pop();
  $(this).next('.custom-file-label').addClass("selected").html(fileName);
});
</script>




</body>

</html>