<!-- START_CONTENT -->
<div class="content-wrapper">

  <div class="page-header">
    <h3 class="page-title"> <?= $judul ?> </h3>
  </div>


  <style>
  .card.aktif {
    border-top: 4px solid red;
  }

  .card .btaktif {
    position: absolute;
    left: 10px;
    top: -10px;
    background-color: red;
    padding: 1px 10px;
    border-radius: 5rem;
    font-size: 12px;
  }

  .card .btaktif.no {
    background-color: grey;
    cursor: pointer;
  }

  .card .btaktif.no:hover {
    background-color: #000;
    cursor: pointer;
  }

  #jam {
    float: right;
    font-size: 0.85rem;
    color: #dc40ff;
    cursor: text;
  }

  #jam:hover {
    color: #fefefe;
  }

  #jam i {
    font-size: 1rem;
  }

  #jam span:focus-visible {
    padding: 2px 5px;
    color: #fefefe;
  }

  .boxcari {
    position: relative;
  }


  .boxcari .menu {
    position: absolute;
    top: 43px;
    padding: 10px 15px;
    background-color: #000;
    border-radius: 5px;
    width: 100%;
    max-height: 300px;
    overflow-x: hidden;
    z-index: 900;
    overflow-y: auto;
    display: none;
  }

  .boxcari .menu ul {
    padding: 0px;
    list-style: none;
  }

  .boxcari .menu ul li {
    width: 100%;
    font-size: 0.9rem;
    cursor: pointer;
  }

  .boxcari .menu ul li:hover {
    color: salmon;
  }

  .boxdata ul {
    padding: 10px 0px;
    list-style: none;
  }

  .boxdata ul li {
    font-size: 1rem;
  }

  .boxdata ul li a {
    color: red;
    float: right;
  }

  .boxdata ul li a:hover i {
    color: #fff;
  }

  .boxdata ul li a i {
    color: red;
  }
  </style>

  <div class="row">



    <?php if ($eventSesi) : ?>
    <?php foreach ($eventSesi as $row) : ?>
    <div class="col-md-4 mb-4">
      <div class="card <?php if ($event['sesi_active'] == $row['id']) echo 'aktif' ?>">
        <div class="card-body">
          <?php if ($event['sesi_active'] == $row['id']) : ?>
          <span class="btaktif">active</span>
          <?php else : ?>
          <span data-id="<?= $row['id'] ?>" class="btaktif no">Non-active</span>
          <?php endif; ?>

          <h5 class="mt-n1">Sesi <?= $row['sesi'] ?> <span id="jam"><i class="mdi mdi-clock-outline"></i>
              <span contenteditable data-id="<?= $row['id'] ?>"><?= $row['jam'] ?></span></span>
          </h5>

          <div data-sesi="<?= $row['sesi'] ?>" class="boxcari">
            <input type="text" name="cari" id="cari" class="form-control" placeholder="Cari Tamu" autocomplete="off">
            <div class="menu">
              <ul>
                <li></li>
              </ul>
            </div>
          </div>


          <div id="sesi<?= $row['sesi'] ?>" class="boxdata" data-sesi="<?= $row['sesi'] ?>">
            <!-- LOAD -->
          </div>

        </div>
      </div>
    </div>
    <?php endforeach; ?>

    <?php else : ?>
    <div class="col-md-12">
      <h2 class="text-danger">Tidak Ada Setting Jumlah Sesi</h2>
    </div>
    <?php endif; ?>


  </div>

</div>
<!-- content-wrapper ends -->




<?php $this->load->view('temp/footer') ?>

<script>
$('.custom-file-input').on('change', function() {
  let fileName = $(this).val().split('\\').pop();
  $(this).next('.custom-file-label').addClass("selected").html(fileName);
});

$(document).ready(function() {

  var jml = '<?= $event['sesi'] ?>';
  for (let i = 0; i < jml; i++) {
    loaddt(i + 1);
  }

  $('.boxcari').on('keyup', 'input#cari', function() {
    var dt = $(this).val();
    var paren = $(this).parent('.boxcari');
    if (dt == '' || dt == null) {
      paren.children('.menu').hide();
      return false;
    }

    $.ajax({
      url: '<?= base_url('sesi/cariTamu') ?>',
      type: 'POST',
      data: {
        cari: dt
      },
      cache: false,
      success: function(res) {
        paren.children('.menu').html(res);
        paren.children('.menu').show();
      }
    })
  })

  $('.boxcari').on('click', '.menu li', function(e) {
    e.preventDefault();
    var paren = $(this).parent().parent().parent();
    var sesi = paren.data('sesi');
    var id = $(this).data('id');
    if (id == null) {
      paren.children('input#cari').val('');
      paren.children('input#cari').focus();
      $('.menu').hide();
      return false;
    }

    $.ajax({
      url: '<?= base_url('sesi/setSesi') ?>',
      type: 'POST',
      data: {
        sesi: sesi,
        id: id
      },
      cache: false,
      success: function(res) {
        paren.children('input#cari').val('');
        paren.children('input#cari').focus();
        $('.menu').hide();
        loaddt(sesi);
      }
    })

  })

  $('.boxdata').on('click', 'ul li a', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
      url: '<?= base_url('sesi/removeSesi') ?>',
      type: 'POST',
      data: {
        id: id
      },
      cache: false,
      success: function(res) {
        document.location.reload();
      }
    })
  })


  $('.row').on('click', '.btaktif.no', function() {
    var id = $(this).data('id');
    $.ajax({
      url: '<?= base_url('sesi/activeSesi') ?>',
      type: 'POST',
      data: {
        id: id
      },
      cache: false,
      success: function() {
        document.location.reload();
      }
    })
  })

  $('#jam span').focusout(function() {
    var dt = $(this).html();
    var id = $(this).data('id');
    $.ajax({
      url: '<?= base_url('sesi/sesiJam') ?>',
      type: 'POST',
      data: {
        wkt: dt,
        id: id
      },
      cache: false,
      success: function() {
        console.log('1');
      }
    })
  })

})


function loaddt(sesi) {
  $.ajax({
    url: '<?= base_url('sesi/loadSesi') ?>',
    type: 'POST',
    data: {
      sesi: sesi
    },
    cache: false,
    success: function(res) {
      $('.boxdata#sesi' + sesi).html(res);
    }
  })
}
</script>

</body>

</html>