<!-- START_CONTENT -->
<div class="content-wrapper">

  <div class="page-header">
    <h3 class="page-title"> <?= $judul ?> </h3>
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
          <div class="table-responsive">
           <table class="table table-striped">
             <thead>
                <tr>
               <th>#</th>
               <th>USER</th>
               <th>WEDDING</th>
               <th>TANGGAL</th>
               <th>TEMPLATE NAME</th>
               <th>URL WEDDING</th>
               <th>OPTION</th>
             </tr>
             </thead>

             <tbody>
               <?php $i=1; foreach($event as $rows) : ?>
               <?php 
               $member = $this->m_user->byId($rows['admin_id']);
               ?>
               <tr>
                 <td><?= $i++; ?></td>
                 <td><?= $member['nama'] ?></td>
                 <td><?= $rows['nama'] ?></td>
                 <td><?= $rows['tgl'] ?></td>
                 <td><?= $rows['template'] ?></td>
                 <td><a href="<?= $rows['urll'] ?>" target="_blank" rel="noopener noreferrer" class="text-info"><?= $rows['urll'] ?></a></td>
                 <td><a href="" data-url="<?= $rows['urll'] ?>" data-id="<?= $rows['id'] ?>" data-temp="<?= $rows['template'] ?>" class="btn btn-primary btnEdit">Edit</a></td>
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
        <form action="<?= base_url('wordpress/editData') ?>" method="post" enctype="multipart/form-data">
          <div class="row">

            <div class="col-12">
              <div class="form-group">
                <label for="template">Nama Client/Mempelai</label>
                <input type="text" name="template" id="template" class="form-control" required placeholder="nama template"
                  value="" autocomplete="off">
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
                <label for="url">URL Undangan</label>
                <input type="url" name="url" id="url" class="form-control" required placeholder="Link URL undangan"
                  value="" autocomplete="off">
              </div>
            </div>

            <input type="text" name="id" value="" style="display: none;">

            <div class="col-12">
              <div class="form-group">
                <label for=""></label>
                <button type="submit" class="btn btn-primary">submit</button>
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

<script>

$('table tbody').on('click', 'tr .btnEdit', function(e) {
  e.preventDefault();
  var id = $(this).data('id');
  var url = $(this).data('url');
  var temp = $(this).data('temp');
  $('#modalEdit').modal('show');
  $('#modalEdit input[name="id"]').val(id);
  $('#modalEdit input[name="template"]').val(temp);
  $('#modalEdit input[name="url"]').val(url);
});
</script>


</body>

</html>