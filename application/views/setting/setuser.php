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


  <style>
  table tbody#myTable td img {
    border-radius: 5px;
    width: 70px;
    height: auto;
  }

  @media (max-width: 576px) {
    table tbody#myTable td img {
      border-radius: 3px;
      width: 30px;
      height: auto;
    }
  }

  hr {
    border-top: 1px solid #fff;
  }

  .boxlist {
    position: relative;
    padding: 10px 15px;
    /* margin: 8px 0px; */
    border-top: 1px solid #a0a0a0;
  }

  .boxlist:hover {
    background-color: #f6f6f6;
  }

  ul#myList {
    padding: 0px;
    list-style: none;
  }

  ul#myList li img {
    border-radius: 5px;
    width: 70px;
    height: auto;
    position: absolute;
    left: 15px;
    top: 15px;
  }

  ul#myList li img:hover {
    cursor: pointer;
    opacity: 0.5;
  }

  ul#myList li #detail {
    margin-left: 90px;
  }

  ul#myList li #detail #nama {
    font-size: 0.9rem;
  }

  ul#myList li #detail #tgl {
    font-size: 0.8rem;
  }

  ul#myList li #detail #hadir {
    font-size: 0.75rem;
  }

  ul#myList li .btnDelete {
    color: red;
  }

  ul#myList li #detail #user {
    font-size: 0.75rem;
    color: #aeaeae;
  }

  ul#myList li #detail #user .sesi {
    font-size: 0.7rem;
    color: #ffffff;
    background-color: #bc40ff;
    margin-left: 10px;
    padding: 2px 8px;
    border-radius: 1rem;
  }



  @media (max-width: 576px) {
    ul#myList li #detail {
      margin-left: 50px;
    }

    ul#myList li img {
      border-radius: 5px;
      width: 40px;
      height: auto;
    }
  }

  .boxbutton {
    position: absolute;
    right: 10px;
    top: 15px;
  }

  .boxbutton .dropdown .dropdown-item {
    font-size: 13px;
  }

  .dropdown-item:hover,
  .dropdown-item:focus {
    color: #16181b;
    text-decoration: none;
    background-color: #fff;
  }
  </style>


  <div class="row">


    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <div class="row mb-4">
            <div class="col-sm-6">
              <h4 class="card-title">List Event</h4>
            </div>

            <div class="col-sm-6">
              <input type="text" id="cari" autocomplete="off" class="form-control" placeholder="Search...">
            </div>


          </div>



          <?php foreach ($event as $row) : ?>
          <?php
            $jmlTamu = $this->m_event->jmlTamuByEvent($row['id']);
            $member = $this->m_user->byId($row['admin_id']);
            ?>
          <div class="boxlist">
            <ul id="myList">
              <li>
                <img class="viewPoto" data-id="<?= $row['id'] ?>"
                  data-img="<?= base_url('guestbook/assets/images/event/' . $row['poto']) ?>"
                  src="<?= base_url('guestbook/assets/images/event/' . $row['poto']) ?>" alt="image">
                <div id="detail">
                  <div id="nama"><?= $row['nama'] ?></div>
                  <div id="tgl"><?= date('d/m/Y', strtotime($row['tgl'])) ?></div>
                  <div id="hadir">Jumlah Tamu: <?= $jmlTamu ?></div>
                  <div id="user">User: <?= $member['nama'] ?> <span class="sesi"><?= $row['sesi'] ?> Sesi</span></div>
                </div>

                <div class="boxbutton">
                  <div class="dropdown">
                    <button class="btn <?php if ($eventActive['id'] == $row['id']) echo 'btn-danger';
                                          else echo 'btn-primary'; ?> dropdown-toggle" type="button"
                      id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false"><i
                        class="mdi mdi-settings"></i></button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item btnWelcome" data-id="<?= $row['id'] ?>" data-warna="<?= $row['warna'] ?>"
                        data-wel="<?= $row['welcome'] ?>" href="#">Welcome</a>
                      <a class="dropdown-item btnEditWa" data-id="<?= $row['id'] ?>" data-wa="<?= $row['wa'] ?>"
                        href="#">WhatsApp Message</a>
                      <a class="dropdown-item btnEdit" data-id="<?= $row['id'] ?>" data-nama="<?= $row['nama'] ?>"
                        data-tgl="<?= $row['tgl'] ?>" data-sesi="<?= $row['sesi'] ?>" href="#">Edit</a>
                      <?php if ($eventActive['id'] == $row['id']) : ?>
                      <a class="dropdown-item btnGb" href="#">View Event</a>
                      <a class="dropdown-item"
                        onclick="window.open('<?= base_url('welcomee/live') ?>', '_blank', config='height=500,width=800')"
                        href="javascript:void(0)">Welcome view</a>
                      <?php else : ?>
                      <a class="dropdown-item setActive" data-id="<?= $row['id'] ?>" href="#">Set Event</a>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>

              </li>
            </ul>
          </div>

          <?php endforeach; ?>
          <hr>

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

            <div class="col-12">
              <div class="form-group">
                <label for="sesi">Jumlah Sesi</label>
                <input type="number" name="sesi" id="sesi" class="form-control" required placeholder="tanggal event"
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
                Nama Tamu disipkan, Pastikan menulis dengan benar,
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
$('.boxlist').on('click', 'ul li .btnWelcome', function(e) {
  e.preventDefault();
  var warna = $(this).data('warna');
  var wel = $(this).data('wel');
  var id = $(this).data('id');
  $('#modalBge').modal('show');
  $('#modalBge input[name="id"]').val(id);
  $('#modalBge input[name="warna"]').val(warna);
  $('#modalBge input[name="wel"]').val(wel);
});


$('.boxlist').on('click', 'ul li img.viewPoto', function(e) {
  e.preventDefault();
  var src = $(this).data('img');
  var id = $(this).data('id');
  $('#modalPoto').modal('show');
  $('#modalPoto .modal-body img').attr('src', src);
  $('#modalPoto input[name="id"]').val(id);
});

$('.boxlist').on('click', 'ul li .setActive', function(e) {
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





$('.boxlist').on('click', 'ul li .btnEdit', function(e) {
  e.preventDefault();
  var id = $(this).data('id');
  var nama = $(this).data('nama');
  var tgl = $(this).data('tgl');
  var sesi = $(this).data('sesi');
  $('#modalEdit').modal('show');
  $('#modalEdit input[name="id"]').val(id);
  $('#modalEdit input[name="event"]').val(nama);
  $('#modalEdit input[name="tgl"]').val(tgl);
  $('#modalEdit input[name="sesi"]').val(sesi);
});


$('.boxlist').on('click', 'ul li .btnGb', function(e) {
  e.preventDefault();
  var link = '<?= base_url('home') ?>';
  window.location.href = link;
});


$('.boxlist').on('click', 'ul li .btnEditWa', function(e) {
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



<script>
$(document).ready(function() {

  $('#cari').on('keyup', function() {

    var value = $(this).val().toLowerCase();

    // $('#myTable tr').filter(function() {

    //   $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)

    // });

    $('.boxlist').filter(function() {

      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)

    });

  });

});
</script>


</body>

</html>