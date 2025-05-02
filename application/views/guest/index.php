<!-- START_CONTENT -->
<div class="content-wrapper">

  <div class="page-header">
    <h3 class="page-title"> List Tamu </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $judul ?></li>
      </ol>
    </nav>
  </div>



  <style>
  #infoJmlTamu {
    float: right;
    padding: 8px 18px;
    background-color: #1b9cf7;
    color: #ffffff;
    border-radius: 25rem;
    font-size: 0.8rem;
  }
  </style>


  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <span id="infoJmlTamu">0 Tamu</span>
        </div>
        <div class="card-body">

          <div class="row">
            <div class="col-md-6">
              <div class="form-group form-inline">
                <label for="filter" class="mr-4">Status Tamu</label>
                <select name="fiter" id="filter" class="form-control">
                  <option value="">Filter Data Tamu...</option>
                  <option <?php if ($this->session->userdata('filterHadirTamu') == 1) echo 'selected'; ?> value="1">
                    Tamu Hadir</option>
                  <option <?php if ($this->session->userdata('filterHadirTamu') == 2) echo 'selected'; ?> value="2">
                    Tamu Belum Hadir</option>
                </select>
                <div style="display: none" class="loadingg">
                  <div class="spinner-grow text-primary" role="status"></div>
                  <div class="spinner-grow text-danger" role="status"></div>
                  <div class="spinner-grow text-info" role="status"></div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <button class="btn btn-outline-google float-right btnExport">Export Excel</button>
            </div>

          </div>

          <div class="table-responsive">
            <table class="table table-hover table-bordered" id="datatable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Vip</th>
                  <th>Ket</th>
                  <th>Jml Tamu</th>
                  <th>Check-in</th>
                </tr>
              </thead>
              <tbody></tbody>

            </table>
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
        <h5 class="modal-title" id="exampleModalLabel">Prieview Images</h5>
        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="row">
          <div class="col-md-12">
            <div class="text-center">
              <img class="img-fluid" src="" alt="">
            </div>
          </div>

          <div class="col-md-12 text-center">
            <a href="" class="btn px-5 btn-info mt-2"><i class="mdi mdi-download"></i> Download</a>
          </div>
        </div>


      </div>

    </div>
  </div>
</div>



<?php $this->load->view('temp/footer') ?>




<script type="text/javascript">
var table;
$(document).ready(function() {

  jmlAllTamu();

  table = $('#datatable').DataTable({

    "processing": true,
    "serverSide": true,
    "order": [],


    "ajax": {
      "url": '<?= base_url('tamu/datatable') ?>',
      "type": "POST"
    },

    "columnDefs": [{
      "targets": [0],
      "orderable": false,
      "width": "50px"
    }, ],
  });

  $('table tbody').on('click', 'tr .btnViewImg', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    var img = $(this).data('img');
    var link = "<?= base_url('tamu/downloadImg/') ?>" + id;

    $('.modal#exampleModal').modal('show');
    $('.modal#exampleModal img').attr('src', img);
    $('.modal#exampleModal a').attr('href', link);
  })

});



function jmlAllTamu() {
  $.ajax({
    url: '<?= base_url('tamu/jmlAllTamu') ?>',
    cache: false,
    success: function(res) {
      $('#infoJmlTamu').html(res);
    }
  })
}




$(function() {
  $('select#filter').on('change', function() {
    var filter = $(this).val();
    if (filter == "") {
      return false;
    }
    $.ajax({
      url: "<?= base_url('tamu/setFilterTamu/') ?>" + filter,
      type: "post",
      cache: false,
      beforeSend: function() {
        $('.loadingg').show();
      },
      success: function() {
        $('.loadingg').hide();
        table.draw();
        jmlAllTamu();
      }
    });
  });
});


$(function() {
  $('.btnExport').on('click', function() {
    window.location.href = "<?= base_url('tamu/export') ?>";
  });
});
</script>



</body>

</html>