<div class="berhasil" data-flashdata="<?= $this->session->flashdata('berhasil'); ?>"></div>
<div class="gagal" data-flashdata="<?= $this->session->flashdata('gagal'); ?>"></div>
<!-- START_CONTENT -->
<div class="content-wrapper">

  <div class="page-header">
    <h3 class="page-title"> Import Data </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $judul ?></li>
      </ol>
    </nav>
  </div>


  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <!-- <a href="#" class="btn btn-info btnQrAll float-right"><i class="mdi mdi-qrcode"></i> Print</a> -->
          <div class="row">
            <div class="col-sm-6">
              <a href="<?= base_url('master/dwlTemplate') ?>" class="btn btn-primary">Download Template</a>
            </div>
            <div class="col-sm-6">
              <?php if ($jmltamuImpor <= 0) : ?>
              <form action="<?= base_url('master/importExcel') ?>" method="post" enctype="multipart/form-data">
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" accept=".xls,.xlsx" class="custom-file-input" name="file" required
                      id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
                    <label class="custom-file-label" for="inputGroupFile04">Select file excel</label>
                  </div>
                  <div class="input-group-append">
                    <button class="btn btn-info" type="submit" id="inputGroupFileAddon04">Upload</button>
                  </div>
                </div>
              </form>
              <?php else : ?>
              <a href="<?= base_url('master/addDataImport') ?>" class="btn btn-primary px-4">Kirim Import</a>
              <a href="<?= base_url('master/cancelImport') ?>" class="btn btn-danger">Cancel Import</a>
              <?php endif; ?>

            </div>
          </div>
        </div>
        <div class="card-body">



          <div class="table-responsive">
            <table class="table table-hover" id="datatable">
              <thead>
                <tr>
                  <th>NO</th>
                  <th>NAMA</th>
                  <th>ALAMAT</th>
                  <th>VIP</th>
                  <th>KETERANGAN</th>
                  <th>SESI</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                foreach ($tamuImpor as $row) : ?>
                <?php if ($row['vip'] == '1') {
                    $vip = '<span class="badge badge-pill badge-primary px-3">VIP</span>';
                  } else {
                    $vip = '';
                  }
                  ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><?= $row['nama'] ?></td>
                  <td><?= $row['alamat'] ?></td>
                  <td><?= $vip ?></td>
                  <td><?= $row['keterangan'] ?></td>
                  <td>Sesi <?= $row['sesi'] ?></td>
                  <td><a href="<?= base_url('master/delImport/' . $row['id']) ?>" class="text-danger">Delete</a></td>
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






<?php $this->load->view('temp/footer') ?>




<script type="text/javascript">
$('.custom-file-input').on('change', function() {
  let fileName = $(this).val().split('\\').pop();
  $(this).next('.custom-file-label').addClass("selected").html(fileName);
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