<!-- START_CONTENT -->
<div class="content-wrapper">

  <div class="page-header">
    <h3 class="page-title"> Master Data </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $judul ?></li>
      </ol>
    </nav>
  </div>

  <style>
  .boxmaster .item-box.select {
    background-color: #f6f6f6;
  }

  .butpdf {
    display: inline-block;
    vertical-align: middle;
    background-color: #4d4d4d;
    padding-top: 6px;
    padding-bottom: 1px;
    padding-left: 10px;
    padding-right: 10px;
    border-radius: 3px;
  }

  .butpdf input#selectAll {
    margin-right: 10px;
  }

  .butpdf button:hover {
    background-color: whitesmoke;
  }

  .butpdf button.btnPdf {
    color: #fca103;
  }

  .butpdf button.btnDel {
    color: red;
  }

  .butpdf button {
    padding: 2px 4px;
    text-align: center;
  }

  .butpdf button i {
    font-size: 19px;
  }

  .boxmaster .item-box {
    position: relative;
    background-color: #fff;
    padding: 10px;
    border: 1px solid #bfbfbf;
    border-radius: 6px;
    margin-bottom: 10px;
  }

  .boxmaster .item-box .nama {
    font-size: 16px;
    display: block;
  }

  .boxmaster .item-box .alamat {
    font-size: 10px;
    margin-left: 5px;
    color: #7b7b7b;
  }

  .boxmaster .item-box .boxbutton {
    position: absolute;
    right: 10px;
    top: 10px;
  }

  .boxmaster .boxbutton .dropdown {
    display: none;
  }

  .boxbutton .dropdown .dropdown-item {
    font-size: 14px;
  }


  @media (max-width: 767.98px) {

    .boxmaster {
      margin-left: -15px;
      margin-right: -15px;
    }

    .boxmaster .boxbutton .dropdown {
      display: unset;
    }

    .boxmaster .boxbutton .group-btn {
      display: none;
    }

    .boxmaster .item-box .nama {
      font-size: 14px;
    }

    .boxmaster .item-box .alamat {
      font-size: 9px;
      margin-left: 3px;
    }
  }

  .boxmaster .item-box .urutan {
    font-size: 12px;
    position: absolute;
    left: 2px;
    top: -7px;
    background-color: #ededed;
    color: #191a19;
    padding: 3px;
    border-radius: 25rem;
    min-width: 16px;
    height: 16px;
    line-height: 11px;
    text-align: center;
  }

  .dropdown-item:hover,
  .dropdown-item:focus {
    color: #16181b;
    text-decoration: none;
    background-color: #fff;
  }

  .btn.btn-xs {
    font-size: 0.8rem;
  }

  #infoJmlTamu {
    float: right;
    padding: 8px 18px;
    background-color: #1b9cf7;
    color: #ffffff;
    border-radius: 25rem;
    font-size: 0.8rem;
  }

  #infoJmlTamu2 {
    float: right;
    padding: 8px 18px;
    background-color: #1b9cf7;
    color: #ffffff;
    border-radius: 25rem;
    font-size: 0.8rem;
    margin-right: 5px;
  }
  </style>


  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">

          <span id="infoJmlTamu">0 Undangan</span>

          <div class="dropdown">
            <button class="btn btn-info dropdown-toggle" type="button" id="adddata" data-toggle="dropdown"
              aria-expanded="false">Add Data</button>
            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="adddata">
              <a class="dropdown-item" href="<?= base_url('master/import') ?>">Import</a>
              <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal" href="#">Manual</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="text-center">
            <h4 class="mb-4"><?= $event['nama']; ?></h4>
          </div>

          <div class="row">
            <div class="col-12">

              <div class="row mb-4">
                <div class="col-sm-6">
                  <div class="form-group">
                    <select style="width: unset;" name="page" id="page" class="form-control d-inline">
                      <option value="10">10 data</option>
                      <option value="20">20 data</option>
                      <option value="50">50 data</option>
                      <option selected value="10000000">All data</option>
                    </select>
                    <?php if ($event['sesi'] > 1) : ?>
                    <select style="width: unset;" name="sesi" id="sesi" class="form-control d-inline">
                      <option value="">All Sesi</option>
                      <?php for ($i = 0; $i < $event['sesi']; $i++) : ?>
                      <option value="<?= $i + 1 ?>"><?= $i + 1 ?></option>
                      <?php endfor; ?>
                    </select>
                    <?php endif; ?>
                    <div class="butpdf">
                      <input type="checkbox" id="selectAll">
                      <button class="btnPdf btn"><i class="mdi mdi-file-pdf"></i></button>
                      <button class="btnDel btn"><i class="mdi mdi-delete"></i></button>
                    </div>
                  </div>
                </div>

                <div class="col-sm-6">
                  <input type="search" autocomplete="off" name="cari" id="cari" class="form-control"
                    placeholder="Search name or address">
                </div>
              </div>

              <div class="boxmaster"></div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

</div>
<!-- content-wrapper ends -->

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Data</h5>
        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('master/newData') ?>" id="formTamu" method="post">

          <!-- <div class="form-group">
            <label for="ev">Event Name</label>
            <input type="text" class="form-control" id="ev" name="ev" readonly value="<?= $event ?>">
          </div> -->

          <div class="form-group">
            <label for="nama">Nama Tamu</label>
            <input type="text" class="form-control" id="nama" name="nama" required placeholder="Input Nama Tamu">
          </div>

          <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Input Alamat Tamu">
          </div>

          <div class="form-group">
            <label for="vip">VIP</label>
            <select name="vip" id="vip" class="form-control">
              <option value="">NO</option>
              <option value="vip">YES</option>
            </select>
          </div>

          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" id="keterangan" rows="5" class="form-control"></textarea>
          </div>

          <div class="form-group">
            <label for="sesi">Sesi</label>
            <input type="number" class="form-control" id="sesi" name="sesi" required placeholder="Sesi">
          </div>

          <input type="text" hidden name="event" value="<?= $this->session->userdata('sessionEventCek') ?>">

          <div class="form-group">
            <label for=""></label>
            <button type="submit" class="btn btn-primary btnSubmit">ENTER</button>
          </div>

        </form>
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
        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('master/editData') ?>" id="formTamuEdit" method="post">


          <div class="form-group">
            <label for="nama1">Nama Tamu</label>
            <input type="text" class="form-control" id="nama1" name="nama1" required placeholder="Input Nama Tamu">
          </div>

          <div class="form-group">
            <label for="alamat1">Alamat</label>
            <input type="text" class="form-control" id="alamat1" name="alamat1" placeholder="Input Alamat Tamu">
          </div>

          <div class="form-group">
            <label for="vip1">VIP</label>
            <select name="vip1" id="vip1" class="form-control">
              <option value="">Set VIP</option>
              <option value="vip">Yes</option>
            </select>
          </div>

          <div class="form-group">
            <label for="keterangan1">Keterangan</label>
            <textarea name="keterangan1" id="keterangan1" rows="5" class="form-control"></textarea>
          </div>

          <div class="form-group">
            <label for="sesi1">Sesi</label>
            <input type="number" class="form-control" id="sesi1" name="sesi1" required placeholder="Sesi">
          </div>

          <input type="text" hidden name="id" value="">

          <div class="form-group">
            <label for=""></label>
            <button type="submit" class="btn btn-primary btnSubmit1">UPDATE</button>
          </div>

        </form>
      </div>

    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalCOPY" tabindex="-1" role="dialog" aria-labelledby="modalCOPYLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body">

        <div class="row">
          <div class="col-12 text-center">
            <div class="form-group">
              <textarea name="tek" rows="5" class="form-control" readonly></textarea>
            </div>


            <div class="form-group">
              <label for=""></label>
              <button type="button" onclick="copyTeks()" class="btn btn-primary">COPi</button>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>



<?php $this->load->view('temp/footer') ?>




<script type="text/javascript">
var tampilPage = $('select#page').val();
var pencarian = $('input#cari').val();
var sesinya = $('select#sesi').val();
$(document).ready(function() {
  loadDataTamu(tampilPage, pencarian, sesinya);
  jmlTamu();
  jmlAllTamu();

  $('input#cari').keyup(function() {
    var isi = $(this).val();
    var sesinya = $('select#sesi').val();
    if (isi == "") {
      loadDataTamu(tampilPage, pencarian, sesinya);
    } else {
      loadDataTamu(tampilPage, isi, sesinya);
    }
  })

  $('input#cari').on('search', function() {
    var isi = $(this).val();
    var sesinya = $('select#sesi').val();
    if (isi == "") {
      loadDataTamu(tampilPage, pencarian, sesinya);
    } else {
      loadDataTamu(tampilPage, isi, sesinya);
    }
  })

  $('select#page').on('change', function() {
    var isi = $(this).val();
    var sesinya = $('select#sesi').val();
    loadDataTamu(isi, pencarian, sesinya);
    $('input#cari').val("");
  })

  $('select#sesi').on('change', function() {
    var sesi = $(this).val();
    loadDataTamu(tampilPage, pencarian, sesi);
    $('input#cari').val("");
  })


});



$('.boxmaster').on('click', '.item-box .btnDelet', function(e) {
  e.preventDefault();
  var btn = $(this);
  var txt = btn.html();
  var id = $(this).data('id');

  swal({
    title: "Are you sure?",
    text: "Tindakan ini akan menghapus data!",
    type: "info",
    showCancelButton: true,

    confirmButtonText: "Yes",
    cancelButtonText: "No",
  }, function(isConfirm) {
    if (isConfirm) {

      $.ajax({
        url: '<?= base_url('master/deleteData/') ?>' + id,
        type: "POST",
        cache: false,
        beforeSend: function() {
          btn.html('<i class="mdi mdi-spin mdi-18px mdi-rotate-right"></i>');
        },
        success: function() {
          btn.html(txt);
          loadDataTamu(tampilPage, pencarian, sesinya);
          jmlTamu();
          jmlAllTamu();
        }
      });
    }
  });


});

$('.boxmaster').on('click', '.item-box .btnEdit', function(e) {
  e.preventDefault();
  var id = $(this).data('id');
  var nama = $(this).data('nama');
  var alamat = $(this).data('alamat');
  var keterangan = $(this).data('keterangan');
  var vip = $(this).data('vip');
  var sesii = $(this).data('sesi');

  $('#modalEdit').modal('show');

  $('#modalEdit input[name="nama1"]').val(nama);
  $('#modalEdit input[name="alamat1"]').val(alamat);
  $('#modalEdit select[name="vip1"]').val(vip);
  $('#modalEdit textarea[name="keterangan1"]').val(keterangan);
  $('#modalEdit input[name="sesi1"]').val(sesii);
  $('#modalEdit input[name="id"]').val(id);
});


$('.boxmaster').on('click', '.item-box .btnCopy', function(e) {
  e.preventDefault();
  var id = $(this).data('id');

  $.ajax({
    url: '<?= base_url('master/copyWa/') ?>' + id,
    cache: false,
    success: function(respon) {
      if (respon == 1) {
        $.toast({
          heading: 'Danger',
          text: 'Silahkan Setting URL Undangannya',
          showHideTransition: 'slide',
          icon: 'error',
          loaderBg: '#d4c357',
          position: 'top-right'
        });
        return false;
      }
      $('#modalCOPY').modal('show');
      $('#modalCOPY textarea[name="tek"]').val(respon);
    }
  });

});







$('.boxmaster').on('click', '.item-box .btnLink', function(e) {
  e.preventDefault();
  var btn = $(this);
  var txt = btn.html();
  var id = $(this).data('id');

  $.ajax({
    url: '<?= base_url('master/cekData/') ?>' + id,
    cache: false,
    beforeSend: function() {
      btn.html('<i class="mdi mdi-spin mdi-18px mdi-rotate-right"></i>');
    },
    success: function(respon) {
      btn.html(txt);
      window.open(respon, 'blank');
    }
  });
});

$('.boxmaster').on('click', '.item-box .btnLinkWp', function(e) {
  e.preventDefault();
  var btn = $(this);
  var txt = btn.html();
  var id = $(this).data('id');

  $.ajax({
    url: '<?= base_url('master/cekDataWp/') ?>' + id,
    cache: false,
    beforeSend: function() {
      btn.html('<i class="mdi mdi-spin mdi-18px mdi-rotate-right"></i>');
    },
    success: function(respon) {
      if (respon == 1) {
        $.toast({
          heading: 'Danger',
          text: 'Silahkan Setting URL Undangannya',
          showHideTransition: 'slide',
          icon: 'error',
          loaderBg: '#d4c357',
          position: 'top-right'
        });
        btn.html(txt);
        return false;
      }
      btn.html(txt);
      window.open(respon, 'blank');
    }
  });
});

$('.boxmaster').on('click', '.item-box .btnWA', function(e) {
  e.preventDefault();
  var btn = $(this);
  var txt = btn.html();
  var id = $(this).data('id');

  $.ajax({
    url: '<?= base_url('master/shareWp/') ?>' + id,
    cache: false,
    beforeSend: function() {
      btn.html('<i class="mdi mdi-spin mdi-18px mdi-rotate-right"></i>');
    },
    success: function(respon) {
      if (respon == 1) {
        $.toast({
          heading: 'Danger',
          text: 'Silahkan Setting URL Undangannya',
          showHideTransition: 'slide',
          icon: 'error',
          loaderBg: '#d4c357',
          position: 'top-right'
        });
        btn.html(txt);
        return false;
      }
      btn.html(txt);
      window.open(respon, 'blank');
    }
  });
});

$('.boxmaster').on('click', '.item-box .btnQr', function(e) {
  e.preventDefault();
  var btn = $(this);
  var txt = btn.html();
  var id = $(this).data('id');
  var link = '<?= base_url('master/printQr/') ?>' + id;

  $.ajax({
    url: link,
    cache: false,
    beforeSend: function() {
      btn.html('<i class="mdi mdi-spin mdi-18px mdi-rotate-right"></i>');
    },
    success: function() {
      btn.html(txt);
      window.open(link, 'blank');
    }
  });
});




function copyTeks() {
  var text = $('#modalCOPY textarea[name="tek"]').select().val();
  document.execCommand("copy");
  $.toast({
    heading: 'Success',
    text: 'Copy Link Success',
    showHideTransition: 'slide',
    icon: 'success',
    loaderBg: '#e834eb',
    position: 'top-center'
  });
  $('#modalCOPY').modal('hide');
}




$(function() {
  $('#formTamu').submit(function(e) {
    e.preventDefault();
    $.ajax({
      url: $(this).attr('action'),
      type: "POST",
      cache: false,
      data: $(this).serialize(),
      dataType: 'json',
      beforeSend: function() {
        $('.btnSubmit').html('<i class="mdi mdi-spin mdi-24px mdi-rotate-right"></i>');
        $('.btnSubmit').attr('type', 'button');
      },
      success: function(json) {
        //response dari json_encode di controller

        if (json.kode == 3) {
          $.toast({
            heading: 'Danger',
            text: json.text,
            showHideTransition: 'slide',
            icon: 'error',
            loaderBg: '#d4c357',
            position: 'top-right'
          });
          $('.btnSubmit').html('ENTER');
          $('.btnSubmit').attr('type', 'submit');
        }

        if (json.kode == 1) {
          $.toast({
            heading: 'Success',
            text: json.text,
            showHideTransition: 'slide',
            icon: 'success',
            loaderBg: '#e834eb',
            position: 'top-right'
          });
          $('#nama').focus();
          $('#nama').val('');
          $('#alamat').val('');
          $('#vip').val('');
          $('#keterangan').val('');
          $('.btnSubmit').html('ENTER');
          $('.btnSubmit').attr('type', 'submit');
          loadDataTamu(tampilPage, pencarian, sesinya);
          jmlTamu();
          jmlAllTamu();
        }
        if (json.kode == 2) {
          $.toast({
            heading: 'Danger',
            text: json.text,
            showHideTransition: 'slide',
            icon: 'error',
            loaderBg: '#d4c357',
            position: 'top-right'
          });
          $('.btnSubmit').html('ENTER');
          $('.btnSubmit').attr('type', 'submit');
        }

      }
    });
  });
});


$(function() {
  $('#formTamuEdit').submit(function(e) {
    e.preventDefault();
    $.ajax({
      url: $(this).attr('action'),
      type: "POST",
      cache: false,
      data: $(this).serialize(),
      dataType: 'json',
      beforeSend: function() {
        $('.btnSubmit1').html('<i class="mdi mdi-spin mdi-24px mdi-rotate-right"></i>');
        $('.btnSubmit1').attr('type', 'button');
      },
      success: function(json) {
        //response dari json_encode di controller

        if (json.kode == 1) {
          $.toast({
            heading: 'Success',
            text: json.text,
            showHideTransition: 'slide',
            icon: 'success',
            loaderBg: '#e834eb',
            position: 'top-right'
          });
          $('#nama1').val('');
          $('#alamat1').val('');
          $('#vip1').val('');
          $('#keterangan1').val('');
          $('.btnSubmit1').html('UPDATE');
          $('.btnSubmit1').attr('type', 'submit');
          $('#modalEdit').modal('hide');
          loadDataTamu(tampilPage, pencarian, sesinya);
          jmlTamu();
          jmlAllTamu();
        }
        if (json.kode == 2) {
          $.toast({
            heading: 'Danger',
            text: json.text,
            showHideTransition: 'slide',
            icon: 'error',
            loaderBg: '#d4c357',
            position: 'top-right'
          });
          $('#nama1').val('');
          $('#alamat1').val('');
          $('#telp1').val('');
          $('.btnSubmit1').html('UPDATE');
          $('.btnSubmit1').attr('type', 'submit');
          $('#modalEdit').modal('hide');
        }
      }
    });
  });
});

$('#exampleModal').on('shown.bs.modal', function() {
  $('#exampleModal input#nama').trigger('focus')
});

$('#modalEdit').on('shown.bs.modal', function() {
  $('#modalEdit input#nama1').trigger('focus')
});




function loadDataTamu(page, cari, sesii) {
  $.ajax({
    url: '<?= base_url('master/loadData') ?>',
    type: "POST",
    data: {
      page: page,
      cari: cari,
      sesi: sesii
    },
    cache: false,
    success: function(res) {
      $('.boxmaster').html(res);
    }
  })
}


function jmlTamu() {
  $.ajax({
    url: '<?= base_url('master/jmlTamu') ?>',
    cache: false,
    success: function(res) {
      $('#infoJmlTamu').html(res);
    }
  })
}

function jmlAllTamu() {
  $.ajax({
    url: '<?= base_url('master/jmlAllTamu') ?>',
    cache: false,
    success: function(res) {
      $('#infoJmlTamu2').html(res);
    }
  })
}



$('.boxmaster').on('click', '.item-box', function() {
  $(this).toggleClass('select');
});

$('.butpdf input#selectAll').click(function() {
  if ($(this).prop('checked')) {
    $('.boxmaster .item-box').addClass('select')
  } else {
    $('.boxmaster .item-box').removeClass('select')
  }
})

$('.butpdf button.btnPdf').click(function() {
  var idnya = [];
  $('.boxmaster .item-box.select input#idT').each(function() {
    idnya.push(this.value);
  });
  if (idnya == "" || idnya == null) {
    $.toast({
      heading: 'Danger',
      text: 'Select data',
      showHideTransition: 'slide',
      icon: 'error',
      loaderBg: '#d4c357',
      position: 'top-center'
    });
    $('.butpdf input#selectAll').removeAttr('checked', 'checked')
    return false;
  } else {
    $('.butpdf input#selectAll').attr('checked', 'checked')
    window.open('<?= base_url('master/pdf?data=') ?>' + idnya, '_blank');
  }
})

$('.butpdf button.btnDel').click(function() {
  var btn = $(this);
  var idnya = [];
  $('.boxmaster .item-box.select input#idT').each(function() {
    idnya.push(this.value);
  });
  if (idnya == "" || idnya == null) {
    $.toast({
      heading: 'Danger',
      text: 'Select data',
      showHideTransition: 'slide',
      icon: 'error',
      loaderBg: '#d4c357',
      position: 'top-center'
    });
    $('.butpdf input#selectAll').removeAttr('checked', 'checked')
    return false;
  } else {
    $('.butpdf input#selectAll').attr('checked', 'checked')

    swal({
      title: "Are you sure?",
      text: "Tindakan ini akan menghapus semua data, Yang dipilih!",
      type: "info",
      showCancelButton: true,

      confirmButtonText: "Yes",
      cancelButtonText: "No",
    }, function(isConfirm) {
      if (isConfirm) {

        $.ajax({
          url: '<?= base_url('master/deleteAll') ?>',
          type: "POST",
          data: {
            id: idnya
          },
          cache: false,
          beforeSend: function() {
            btn.html('<i class="mdi mdi-spin mdi-rotate-right"></i>')
          },
          success: function() {
            btn.html('<i class="mdi mdi-delete"></i>');
            loadDataTamu(tampilPage, pencarian, sesinya);
            jmlTamu();
            jmlAllTamu();
            $('.butpdf input#selectAll').removeAttr('checked')
          }
        })
      }
    });
  }
})
</script>



</body>

</html>