<!-- START_CONTENT -->
<div class="content-wrapper">

  <!-- <div class="page-header">
    <h3 class="page-title"> Daftar Tamu </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $judul ?></li>
      </ol>
    </nav>
  </div> -->

  <?php if (!$this->session->userdata('sessionEventCek')) : ?>

  <div class="row">
    <div class="col-12">
      <div class="container" style="max-width: 500px;">
        <div class="form-group">
          <div class="input-group">
            <select name="eventId" class="form-control">
              <option value="">Select Event</option>
              <?php foreach ($listEvent as $ls) : ?>
              <option value="<?= $ls['id'] ?>"><?= $ls['nama'] ?></option>
              <?php endforeach; ?>
            </select>
            <div class="input-group-append">
              <button class="input-group-btn btn btn-outline-info btnSetactive">Set Active</button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <?php else : ?>


  <div class="row">
    <div class="col-12">
      <div class="text-center bg-gradient-dark py-2 mb-2 rounded">
        <?php if ($event['sesi'] > 1) : ?>
        <h4><?= $event['nama'] ?></h4>
        <?php else : ?>
        <h4><?= $event['nama'] ?></h4>
        <?php endif; ?>
      </div>
    </div>


    <div class="col-md-6">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">

            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text iconScan" data-toggle="modal" data-target="#modalWebcamHome"><i
                    class="mdi mdi-qrcode-scan"></i></span>
              </div>
              <input type="text" class="form-control" autofocus name="barcode" placeholder="Scan Barcode"
                autocomplete="off">
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <button class="btn btn-outline-primary btn-block" data-target="#modalAndroidApk" data-toggle="modal"><i
                class="mdi mdi-android btn-icon-text mdi-18px"></i> KODE AKSES </button>
          </div>
        </div>


      </div>



      <div class="text-center mb-3">
        <img class="img-thumbnail img-fluid" src="<?= base_url('guestbook/assets/images/event/' . $event['poto']) ?>"
          alt="img">
      </div>



    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-md-6 text-center">
              <div class="btn-group">
                <button class="btn btn-outline-linkedin" data-toggle="modal" data-target="#inputManualMOdal"><i
                    class="mdi mdi-account"></i>INPUT TAMU HADIR</button>
                <button class="btn btn-linkedin" data-toggle="modal" data-target="#cariTamu"><i
                    class="mdi mdi-magnify"></i></button>
              </div>
            </div>
            <div class="col-md-6 text-center">
              <h1 style="font-size: 30px;color:#dadada;padding-top:10px;" id="jam"><?= date('H:i:s') ?></h1>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div style="max-height: 350px;overflow-y: auto;" id="bodyCardListTamu">
            <div>
              <table class="table table-striped table-hover">
                <tbody class="pageTamu">
                  <!-- LOAD -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <?php endif; ?>


</div>
<!-- content-wrapper ends -->


<!-- Modal MANUAL-->
<div class="modal fade" id="inputManualMOdal" tabindex="-1" role="dialog" aria-labelledby="inputManualMOdalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="inputManualMOdalLabel">Check-in Manual</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('home/manual') ?>" method="post" id="formTamu">

          <div class="form-group">
            <input type="text" name="nama" id="nama" class="form-control" required autocomplete="off"
              placeholder="Nama Tamu">
          </div>

          <div class="form-group">
            <input type="text" name="alamat" class="form-control" autocomplete="off" required
              placeholder="Alamat / Asal Tamu">
          </div>

          <div class="form-group">
            <input type="number" name="jml" class="form-control" required autocomplete="off" placeholder="Jumlah Tamu">
          </div>


          <button type="submit" class="btn btn-primary btnSubmit">Tambahkan</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal APK-->
<div class="modal fade" id="modalAndroidApk" tabindex="-1" role="dialog" aria-labelledby="modalAndroidApkLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAndroidApkLabel">Kode untuk mengakses Aplikasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="text-center">
          <span style="font-size: 12px;color:#000;">Kode Akses</span>
          <h4 style="letter-spacing:3px;color:#000;"><?= $koneksi['kode'] ?></h4>

          <span style="font-size: 12px;color:#000;">Download Aplikasi (Android)</span>
          <br>
          <a href="DAFTARTAMU.apk" download="DAFTARTAMU.apk" class="btn btn-dark">Download</a></br>

          <!-- <a href="#" id="palystore"><img src="<?= base_url('guestbook/assets/fonts/gp.jpg') ?>" class="img-fluid mt-3"
              style="max-width: 130px;"></a> -->
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>


<style>
.menuSearch {
  max-height: 400px;
  overflow-y: auto;
  padding: 15px;
  background-color: #515151;
  text-align: left;
  display: none;
}

.menuSearch ul {
  display: table-cell;
  list-style: none;
  padding-left: 0px;
}

.menuSearch ul li {
  font-size: 16px;
  /* margin-left: 10px; */
  margin: 15px;
}

.menuSearch ul li a {
  color: #ffffff;
}

.menuSearch ul li a:hover {
  color: #ffffff;
}
</style>

<div class="modal fade" id="cariTamu" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false"
  aria-labelledby="cariTamuLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cariTamuLabel">Cari Tamu</h5>
        <button type="button" style="margin-right: -15px;" class="close text-light" data-dismiss="modal"
          aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="text-center">
          <div class="form-group">
            <input type="text" autocomplete="off" class="form-control" id="cari" placeholder="Search tamu belum hadir">
          </div>

          <div class="menuSearch">
            <!-- load -->
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="hadirTamu" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false"
  aria-labelledby="hadirTamuLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">

      <div class="modal-body">

        <div class="text-center kehadiran">
          <div class="form-group">
            <input type="number" autocomplete="off" class="form-control" id="jml" placeholder="Jumlah Tamu">
          </div>
          <input type="text" autocomplete="off" style="display: none;" id="id">

          <div class="form-group">
            <button class="btn btn-primary  btnsubmitjml">Submit</button>
          </div>

        </div>

      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="hadirTamu3" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false"
  aria-labelledby="hadirTamu2Label" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">

      <div class="modal-body">

        <div class="text-center kehadiran">
          <div class="form-group">
            <input type="number" autocomplete="off" class="form-control" id="jml" placeholder="Jumlah Tamu">
          </div>
          <input type="text" autocomplete="off" style="display: none;" id="nama">

          <div class="form-group">
            <button class="btn btn-primary  btnsubmitjml">Submit</button>
          </div>

        </div>

      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="hadirTamu2" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false"
  aria-labelledby="hadirTamu2Label" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">

      <div class="modal-body">

        <div class="text-center kehadiran">
          <div class="form-group">
            <input type="number" autocomplete="off" class="form-control" id="jml" placeholder="Jumlah Tamu">
          </div>
          <input type="text" autocomplete="off" style="display: none;" id="nama">

          <div class="form-group">
            <button class="btn btn-primary  btnsubmitjml">Submit</button>
          </div>

        </div>

      </div>
    </div>
  </div>
</div>

<style>
.webcamQr {
  text-align: center;
  padding: 5px;
  width: 100%;
  height: 100%;
}

.webcamQr .well {
  position: relative;
  display: inline-block;
}

.webcamQr #webcodecam-canvas {
  background-color: #272727d2;
  width: 100%;
  height: 300px;
}

.webcamQr .lbl {
  position: absolute;
  opacity: 0.5;
  top: 0px;
  left: 0;
  right: 0;
  margin-top: 120px;
  font-size: 20px;
  color: #00ff7b;
}


.webcamQr .warning {
  position: absolute;
  opacity: 0.8;
  top: 0;
  left: 0;
  right: 0;
  margin-top: 160px;
  font-size: 20px;
  color: #ff0000;
  font-weight: bolder;
}

.webcamQr .scanner-laser {
  position: absolute;
  margin: 35px;
  height: 30px;
  width: 30px;
  opacity: 0.5;
}

.webcamQr .laser-leftTop {
  top: 0;
  left: 0;
  border-top: solid #00ff7b 5px;
  border-left: solid #00ff7b 5px;
}

.webcamQr .laser-leftBottom {
  bottom: 0;
  left: 0;
  border-bottom: solid #00ff7b 5px;
  border-left: solid #00ff7b 5px;
}

.webcamQr .laser-rightTop {
  top: 0;
  right: 0;
  border-top: solid #00ff7b 5px;
  border-right: solid #00ff7b 5px;
}

.webcamQr .laser-rightBottom {
  bottom: 0;
  right: 0;
  border-bottom: solid #00ff7b 5px;
  border-right: solid #00ff7b 5px;
}
</style>

<!-- Modal APK-->
<div class="modal fade" id="modalWebcamHome" tabindex="-1" role="dialog" aria-labelledby="modalWebcamHomeLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">

            <div class="form-group">
              <select class="form-control" id="camera-select"></select>
            </div>

            <div class="webcamQr">
              <div class="well" style="position: relative;display: inline-block;">
                <canvas id="webcodecam-canvas"></canvas>
                <div class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>
                <div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>
                <div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>
                <div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div>

                <span class="lbl">Scan Qrcode</span>
                <span class="warning"></span>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>





<?php $this->load->view('temp/footer') ?>

<script type="text/javascript" src="<?= base_url('guestbook/') ?>assets/js/qrcodelib.js"></script>
<script type="text/javascript" src="<?= base_url('guestbook/') ?>assets/js/webcodecamjs.js"></script>
<!-- <script type="text/javascript" src="<?= base_url('guestbook/') ?>assets/js/mainjqueryQr.js"></script> -->



<script>
$('select[name="eventId"]').on('change', function() {
  var id = $(this).val();
  if (id == "") {
    $('.btnSetactive').addClass('btn-outline-info');
    $('.btnSetactive').removeClass('btn-info');

    $(this).focus();
    $.toast({
      heading: 'Warning',
      text: 'Pilih event atau set active di menu Settings',
      showHideTransition: 'slide',
      icon: 'error',
      loaderBg: '#cccc10',
      position: 'top-right'
    });
    return false;
  }
  $('.btnSetactive').removeClass('btn-outline-info');
  $('.btnSetactive').addClass('btn-info');
});


$('.btnSetactive').on('click', function() {
  var btn = $(this);
  var event = $('select[name="eventId"]').val();
  if (event == "") {
    $('select[name="eventId"]').focus();
    $.toast({
      heading: 'Warning',
      text: 'Pilih event atau set active di menu Settings',
      showHideTransition: 'slide',
      icon: 'error',
      loaderBg: '#cccc10',
      position: 'top-right'
    });
    return false;
  }

  $.ajax({
    url: "<?= base_url('home/setActive/') ?>" + event,
    cache: false,
    beforeSend: function() {
      btn.html('<i class="mdi mdi-spin mdi-18px mdi-rotate-right"></i> Load...');
    },
    success: function() {
      document.location.reload();
    }
  });
});


$('input[name="barcode"]').change(function() {
  var inp = $(this);
  var kode = $(this).val();
  var icn = $('span.iconScan');
  if (kode == "") {
    inp.focus();
    return false;
  }
  $(this).val("");
  $.ajax({
    url: "<?= base_url('home/chekIn') ?>",
    type: "POST",
    data: {
      barcode: kode
    },
    dataType: "JSON",
    beforeSend: function() {
      icn.html('<i class="mdi mdi-spin mdi-rotate-right"></i>');
    },
    cache: false,
    success: function(respon) {
      icn.html('<i class="mdi mdi-barcode-scan"></i>');
      inp.focus();

      if (respon.kode == 1) {
        $('.modal#hadirTamu2').modal('show');
        $('.modal#hadirTamu2 input#nama').val(kode);
        return false;
      } else if (respon.kode == 2) {
        $.toast({
          heading: 'Thank You',
          text: respon.pesan,
          showHideTransition: 'slide',
          icon: 'success',
          loaderBg: '#cccc10',
          position: 'top-right'
        });
      } else {
        $.toast({
          heading: 'TIDAK DIKENAL',
          text: respon.pesan,
          showHideTransition: 'slide',
          icon: 'error',
          loaderBg: '#cccc10',
          position: 'top-right'
        });
      }


    }
  });
});
</script>



<script type="text/javascript">
$(function() {
  var auto_refresh = setInterval(
    function() {
      var url = "<?= base_url('home/listTamu') ?>";
      $('.pageTamu').load(url).fadeIn("slow");

      $('#bodyCardListTamu').animate({
        scrollTop: $("#bodyCardListTamu")[0].scrollHeight
      }, "slow");

    }, 2000); // refresh setiap 2 detik
});

$(function() {
  var auto_refresh2 = setInterval(
    function() {
      var url = "<?= base_url('home/jamNya') ?>";
      $('#jam').load(url).fadeIn("slow");
    }, 1000); // refresh setiap 1 detik
});



$('#palystore').on('click', function(e) {
  e.preventDefault();
  $('.modal').modal('hide');
  window.open('', 'blank')
})





$(function() {
  $('#formTamu').submit(function(e) {
    e.preventDefault();
    $.ajax({
      url: $(this).attr('action'),
      type: "POST",
      cache: false,
      dataType: "json",
      data: $(this).serialize(),
      beforeSend: function() {
        $('.btnSubmit').html('<i class="mdi mdi-spin mdi-24px mdi-rotate-right"></i>');
        $('.btnSubmit').attr('type', 'button');
      },
      success: function(respon) {
        if (respon.kode == 3) {
          $.toast({
            heading: 'WARNING',
            text: respon.pesan,
            showHideTransition: 'slide',
            icon: 'error',
            loaderBg: '#cccc10',
            position: 'top-right'
          });
        } else {
          $.toast({
            heading: 'Success',
            text: respon.pesan,
            showHideTransition: 'slide',
            icon: 'success',
            loaderBg: '#e834eb',
            position: 'top-right'
          });
        }

        $('.modal#inputManualMOdal').modal('hide');
        $('.modal#inputManualMOdal input').val('');
        $('.btnSubmit').html('Tambahkan');
        $('.btnSubmit').attr('type', 'submit');
      }
    });
  });
});


$('#inputManualMOdal').on('shown.bs.modal', function() {
  $('#inputManualMOdal input#nama').trigger('focus')
})


$('.btnDwlApk').click(function() {
  $('#modalAndroidApk').modal('hide');
});



$(document).ready(function() {
  $('#bodyCardListTamu').animate({
    scrollTop: $("#bodyCardListTamu")[0].scrollHeight
  }, "slow");
});




$('.modal#cariTamu input#cari').keyup(function() {
  var isi = $(this).val();
  if (isi == "") {
    $('.menuSearch').hide();
    return false;
  }

  $.ajax({
    url: "<?= base_url('home/cariTamu/') ?>",
    type: "POST",
    data: {
      isi: isi
    },
    cache: false,
    beforeSend: function() {
      $('.menuSearch').html('<h5><i class="mdi mdi-spin mdi-18px mdi-rotate-right"></i> Load...</h5>');
    },
    success: function(res) {
      $('.menuSearch').html(res);
      $('.menuSearch').show();
    }
  });

})



$('.modal#cariTamu').on('shown.bs.modal', function() {
  $('.modal#cariTamu input#cari').trigger('focus');
})


$('.modal#hadirTamu').on('shown.bs.modal', function() {
  $('.modal#hadirTamu input#jml').trigger('focus');
})

$('.modal#hadirTamu2').on('shown.bs.modal', function() {
  $('.modal#hadirTamu2 input#jml').trigger('focus');
})

$('.modal#hadirTamu3').on('shown.bs.modal', function() {
  $('.modal#hadirTamu3 input#jml').trigger('focus');
})



$('.menuSearch').on('click', 'li a', function(e) {
  e.preventDefault();
  var id = $(this).attr('href');
  $('.modal#hadirTamu').modal('show');
  $('.modal#hadirTamu input#id').val(id);
  $('.modal#cariTamu').modal('hide');
  $('.modal#cariTamu input#cari').val("");
  $('.menuSearch').html("");
});


$('.modal#hadirTamu .kehadiran .btnsubmitjml').click(function(e) {
  e.preventDefault();
  var id = $('.modal#hadirTamu .kehadiran input#id').val();
  var jml = $('.modal#hadirTamu .kehadiran input#jml').val();
  if (jml == "" || jml <= 0 || jml == null) {
    $('.modal#hadirTamu .kehadiran input#jml').focus();
    return false;
  }
  $.ajax({
    url: "<?= base_url('home/checkin3/') ?>",
    type: "POST",
    dataType: "JSON",
    data: {
      id: id,
      jml: jml,
    },
    cache: false,
    success: function(res) {
        $.toast({
          heading: 'Terimakasih',
          text: 'SELAMAT DATANG',
          showHideTransition: 'slide',
          icon: 'success',
          loaderBg: '#cccc10',
          position: 'top-right'
        });
    //   if (res.kode == 1) {
    //   }
      $('.modal#hadirTamu .kehadiran input').val("");
      $('.modal#hadirTamu').modal('hide');
    }
  });
});


$('.modal#hadirTamu2 .kehadiran .btnsubmitjml').click(function(e) {
  e.preventDefault();
  var id = $('.modal#hadirTamu2 .kehadiran input#nama').val();
  var jml = $('.modal#hadirTamu2 .kehadiran input#jml').val();
  if (jml == "" || jml <= 0 || jml == null) {
    $('.modal#hadirTamu .kehadiran input#jml').focus();
    return false;
  }
  $.ajax({
    url: "<?= base_url('home/checkin4/') ?>",
    type: "POST",
    data: {
      nama: id,
      jml: jml,
    },
    cache: false,
    success: function(res) {
      if (res == 1) {
        $.toast({
          heading: 'Terimakasih',
          text: 'SELAMAT DATANG ',
          showHideTransition: 'slide',
          icon: 'success',
          loaderBg: '#cccc10',
          position: 'top-right'
        });
      }
      $('.modal#hadirTamu2 .kehadiran input').val("");
      $('.modal#hadirTamu2').modal('hide');
      $('input[name="barcode"]').focus();
    }
  });
});
</script>



<script type="text/javascript">
// Tambahkan fungsi untuk meminta izin kamera
async function requestCameraPermission() {
  try {
    const stream = await navigator.mediaDevices.getUserMedia({ 
      video: {
        facingMode: "environment"
      }
    });
    stream.getTracks().forEach(track => track.stop()); // Stop stream setelah mendapatkan izin
    return true;
  } catch (err) {
    console.error('Error accessing camera:', err);
    alert('Tidak dapat mengakses kamera. Pastikan Anda telah memberikan izin akses kamera di browser Anda.');
    return false;
  }
}

// Fungsi untuk menginisialisasi kamera
async function initializeCamera() {
  const hasPermission = await requestCameraPermission();
  if (!hasPermission) return;

  var arg = {
    resultFunction: function(result) {
      var kod = result.code;
      $.ajax({
        url: "<?= base_url('home/chekcode') ?>",
        type: "POST",
        dataType: "JSON",
        data: {
          barcode: result.code
        },
        cache: false,
        success: function(respon) {
          if (respon.kode == 1) {
            $('.modal#modalWebcamHome').modal('hide');
            $('.modal#hadirTamu2').modal('show');
            $('.modal#hadirTamu2 input#nama').val(kod);
            $('.modal#cariTamu2').modal('hide');
            return false;
          }
          if (respon.kode == 3) {
            $('.webcamQr span.warning').fadeIn();
            $('.webcamQr span.warning').html('QrCode Salah, Ulangi.!');
            $('.webcamQr span.warning').css('color', '#ff0000');

            setTimeout(function() {
              $('.webcamQr span.warning').fadeOut("slow");
            }, 800);
            return false;
          }
          if (respon.kode == 0) {
            console.log('ok');
            return false;
          }
          if (respon.kode == 2) {
            $('.webcamQr span.warning').fadeIn();
            $('.webcamQr span.warning').html('Tamu sudah Check-in');
            $('.webcamQr span.warning').css('color', '#ffa52c');

            setTimeout(function() {
              $('.webcamQr span.warning').fadeOut("slow");
            }, 800);

            setTimeout(function() {
              $('.modal#modalWebcamHome').modal('hide');
            }, 3000);
            return false;
          }
        }
      });
    }
  };

  try {
    var decoder = new WebCodeCamJS("#webcodecam-canvas")
      .buildSelectMenu("#camera-select", "environment|back")
      .init(arg)
      .play();

    document.querySelector("#camera-select").addEventListener("change", function() {
      if (decoder.isInitialized()) {
        decoder.stop();
        decoder.play();
      }
    });
  } catch (err) {
    console.error('Error initializing camera:', err);
    alert('Terjadi kesalahan saat menginisialisasi kamera. Silakan refresh halaman dan coba lagi.');
  }
}

// Jalankan inisialisasi kamera saat modal dibuka
$('#modalWebcamHome').on('shown.bs.modal', function () {
  initializeCamera();
});

// Hentikan kamera saat modal ditutup
$('#modalWebcamHome').on('hidden.bs.modal', function () {
  if (typeof decoder !== 'undefined' && decoder.isInitialized()) {
    decoder.stop();
  }
});
</script>



</body>

</html>