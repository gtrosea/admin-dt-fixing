<!DOCTYPE html>
<html lang="en">

<head>

  <title><?= $judul ?></title>
</head>

<style>
.page {
  width: 21.9cm;
  height: inherit;
  font-family: 'Times New Roman', Times, serif;
}

.text-center {
  text-align: center;
}


@media print {
  #print {
    display: none;
  }

  .page {
    margin             : 0;
    border             : 0;
    /* border-radius      : initial; */
    /* width              : initial; */
    /* min-height         : initial; */
    /* box-shadow         : none; */
    /* background         : none; */
    /* page-break-after: always; */
  }
}


@page {
  width : inherit;
  height: initial;
  margin: 0;
}




img.imgBingkai {
  width: 250px;
  height: 310px;
  top: -6px;
  left: -4px;
  /* display: inline-block; */
  position: absolute;
  z-index: 1;
}

img.imgQr {
  width: 110px;
  margin-top: -2px;
}

.kotak {
  position: relative;
  width: 6.5cm;
  height: 8cm;
  border: 1px solid #eaea;
  text-align: center;
  display: inline-table;
  border-collapse: collapse;
}

.kotak span {
  display: block;
  font-size: 12px;
  z-index: 5;
}

.kotak span.tamu, .kotak span.alamat {
  text-transform: uppercase;
  font-weight: bolder;
  font-size: 12px;
}

.kotak span.mempelai {
  margin-top: 38px;
  font-weight: bolder;
}

.kotak span.to {
  margin-top: 10px;
}

.kotak span.alamat {
  margin-top: -10px;
}

.kotak span.ket {
  color: red;
  font-size: 9px;
  margin-top: 3px;
}

</style>

<body>

  <div class="page">

  <?php foreach($tamu as $rows) : ?>

  <?php 
  $qrNya = $rows['qr'] .'.png';
  ?>
  
  <div class="kotak">
    <img class="imgBingkai" src="<?= base_url('guestbook/assets/images/auth/frame.png') ?>" alt="frame">
    <span class="mempelai"><?= $event['nama'] ?></span>
    <span class="tgl"><?= date('d F Y', strtotime($event['tgl'])) ?></span>
    <span class="to">Kepada :</span>
    <span class="tamu"><?= $rows['nama'] ?></span>
    <img class="imgQr" src="<?= base_url('guestbook/assets/images/qr/' . $qrNya) ?>" alt="qr">
    <span class="alamat"><?= $rows['alamat'] ?></span>
    <span class="ket">Gunakan QR-Code Untuk Check-in</span>
  </div>
  
  <?php endforeach; ?>

  </div>


  <script src="<?= base_url('guestbook/') ?>assets/js/jquery.min.js"></script>

  <script>
  $(document).ready(function() {

    $('.btnPrint').click(function() {
      window.print();
      window.close();
    });

    window.onload = function() {
      window.print();
    }

    window.onmousemove = function() {
      window.close();
    }
  })
  </script>
</body>

</html>