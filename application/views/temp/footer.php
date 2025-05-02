<?php
$responTamu = $this->db->get_where('tamu', ['event_id' => $this->session->userdata('sessionEventCek'), 'status_pesan' => '1'])->result_array();
?>

<!-- Modal MESSAGES-->
<div class="modal fade" id="messages" tabindex="-1" role="dialog" aria-labelledby="messagesLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="messagesLabel">Respons Undangan</h5>
        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Konfirmasi Undangan</th>
                <th>Ucapan / Do'a</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($responTamu) : ?>
              <?php foreach ($responTamu as $rst) : ?>
              <tr>
                <td><?= $rst['nama'] ?></td>
                <td>
                  <?php if ($rst['kehadiran'] == '1') : ?>
                  <span>Bersedia Hadir</span>
                  <?php elseif ($rst['kehadiran'] == '2') : ?>
                  <span>Tidak Bisa Hadir</span>
                  <?php endif; ?>
                </td>
                <td><?= nl2br($rst['pesan']) ?></td>
              </tr>
              <?php endforeach; ?>
              <?php else : ?>
              <tr>
                <td>
                  <h4>Tidak ada Data</h4>
                </td>
              </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- Modal KONFIRM-->
<div class="modal fade" id="modalKonfirmLock" tabindex="-1" role="dialog" aria-labelledby="modalKonfirmLockLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalKonfirmLockLabel">Konfirmasi Password</h5>
        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('home/openAccess') ?>" method="post">
          <div class="form-group">
            <label for="pass">Konfirmasi Password</label>
            <input type="password" name="pass" id="pass" class="form-control" autocomplete="off" required
              placeholder="Konfirmasi Password Untuk membuka access">
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-inverse-danger btn-block">KONFIRM</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>





<!-- partial:partials/_footer.html -->
<footer class="footer bg-gradient-light">
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">www.daftartamu.id - <?= date('Y') ?></span>
  </div>
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->


<script src="<?= base_url('guestbook/') ?>assets/vendors/js/vendor.bundle.base.js"></script>

<script src="<?= base_url('guestbook/') ?>assets/vendors/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('guestbook/') ?>assets/vendors/datatables/dataTables.bootstrap4.min.js"></script>

<script src="<?= base_url('guestbook/') ?>assets/vendors/jquery-toast-plugin/jquery.toast.min.js"></script>
<script src="<?= base_url('guestbook/') ?>assets/vendors/bootstrap-sweetalert/sweet-alert.js"></script>

<!-- endinject -->

<!-- inject:js -->
<script src="<?= base_url('guestbook/') ?>assets/js/off-canvas.js"></script>
<script src="<?= base_url('guestbook/') ?>assets/js/hoverable-collapse.js"></script>
<script src="<?= base_url('guestbook/') ?>assets/js/misc.js"></script>
<script src="<?= base_url('guestbook/') ?>assets/js/settings.js"></script>
<script src="<?= base_url('guestbook/') ?>assets/js/todolist.js"></script>
<script src="<?= base_url('guestbook/') ?>assets/js/tooltips.js"></script>
<!-- endinject -->



<script>
var message = $('.successAlert').data('flashdata');
if (message) {
  $.toast({
    heading: 'Success',
    text: message,
    showHideTransition: 'slide',
    icon: 'success',
    loaderBg: '#e834eb',
    position: 'top-right'
  });
}

var messageE = $('.errorAlert').data('flashdata');
if (messageE) {
  $.toast({
    heading: 'Danger',
    text: messageE,
    showHideTransition: 'slide',
    icon: 'error',
    loaderBg: '#d4c357',
    position: 'top-right'
  });
}


$(function() {
  $('.profile .profile-desc a.profileLockAces').on('click', function(e) {
    e.preventDefault();
    var link = $(this).attr('href');
    $.ajax({
      url: link,
      type: "post",
      cache: false,
      success: function(respon) {
        if (respon == "1") {
          $('.modal#modalKonfirmLock').modal('show');
          return false;
        }

        if (respon == "2") {
          document.location.reload();
        }
      }
    });
  });
});




$('table tbody').on('mouseenter', 'tr button[data-toggle="tooltip"]', function() {
  $(this).tooltip();
});


$('table tbody').on('mouseenter', 'tr a[data-toggle="tooltip"]', function() {
  $(this).tooltip();
});
</script>