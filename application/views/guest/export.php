<!DOCTYPE html>
<html>

<head>

</head>

<body>

  <?php
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=DataTamu_" . $namaFile . ".xls");
  header("pragma: no-cache");
  header("expires: 0");
  ?>


  <div>
    <div style="text-align: center;">
      <h3>Data Guestbook <br><span style="display: block;">Event :
          <?= $event['nama']; ?></span><br><span>Tanggal: <?= date('d/m/Y', strtotime($event['tgl'])); ?></span></h3>
    </div>
    <table style="margin: 20px auto;border-collapse: collapse;border: 1px;">
      <tr style="border: 1px solid #000;padding: 5px 15px;height: 30px;margin: 20px auto;">
        <th style="border: 1px solid #000;">No</th>
        <th style="border: 1px solid #000;">Nama</th>
        <th style="border: 1px solid #000;">Alamat</th>
        <th style="border: 1px solid #000;">Check-in</th>
        <th style="border: 1px solid #000;">VIP</th>
        <th style="border: 1px solid #000;">Keterangan</th>
        <th style="border: 1px solid #000;">Jml Tamu</th>
      </tr>
      <?php $i = 1;
      $jml = 0;
      ?>
      <?php foreach ($tamu as $data) : ?>
      <?php
        if ($data['vip'] == 'vip') {
          $vip = 'Yes';
        } else {
          $vip = '';
        }

        $jml += $data['kehadiran'];
        ?>
      <tr style="border: 1px solid #000;padding: 5px 15px;height: 30px;margin: 20px auto;">
        <td style="border: 1px solid #000;padding: 5px 15px;"><?= $i++; ?></td>
        <td style="border: 1px solid #000;padding: 5px 15px;"><?= $data['nama']; ?></td>
        <td style="border: 1px solid #000;padding: 5px 15px;"><?= $data['alamat']; ?></td>
        <?php if ($data['hadir'] == 0) : ?>
        <td style="border: 1px solid #000;padding: 5px 15px;">Tidak Hadir</td>
        <?php else : ?>
        <td style="border: 1px solid #000;padding: 5px 15px;"><?= date('d/m/Y H:i:s', $data['hadir']); ?></td>
        <?php endif; ?>
        <td style="border: 1px solid #000;padding: 5px 15px;"><?= $vip; ?></td>
        <td style="border: 1px solid #000;padding: 5px 15px;"><?= $data['keterangan']; ?></td>
        <td style="border: 1px solid #000;padding: 5px 15px;"><?= $data['kehadiran'] . ' tamu'; ?></td>
      </tr>
      <?php endforeach; ?>
      <tr style="border: 1px solid #000;padding: 5px 15px;height: 30px;margin: 20px auto;">
        <th colspan="6" style="border: 1px solid #000;padding: 5px 15px;text-align: right;">JUMLAH</th>
        <th style="border: 1px solid #000;padding: 5px 15px;text-align: right;">
          <?= $jml; ?> Tamu</th>
      </tr>
    </table>
  </div>
</body>

</html>