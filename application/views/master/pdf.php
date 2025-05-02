<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $judul ?></title>
</head>

<style>
#box {
  width: 33%;
  /* border: 1px solid whitesmoke; */
  display: inline;
}

.median {
  margin: 10px auto;
  border: 1px solid #fff;
  padding: 2px;
  width: auto;
  height: auto;
  position: relative;
  text-align: center;
  display: block;
}

#box img#hero {
  width: auto;
  height: 315px;
  /* position: absolute; */
  display: inline-block;
}

img#qr {
  width: 125px;
  height: 125px;
  position: absolute;
  top: 66px;
  left: 42px;
  /* display: inline-block; */
}


.des {
  width: 200px;
  height: auto;
  position: absolute;
  top: 20px;
  left: 4px;
  text-align: center;
}

.des2 {
  width: 200px;
  height: auto;
  position: absolute;
  top: 200px;
  left: 4px;
  text-align: center;
}

.des p {
  margin: 0px;
  text-align: center;
  font-size: 12px;
}


.des p#wed {
  font-size: 10px;
  margin-bottom: 5px;
  font-weight: 100;
  color: #595959;
  text-transform: uppercase;
}

.des p#manten {
  font-size: 15px;
  margin-bottom: 10px;
  font-weight: bolder;
  color: #000;
}

.des2 p#nama {
  font-size: 15px;
  margin-bottom: 0px;
  font-weight: bolder;
  color: #000;
}

.des2 p#sesi {
  font-size: 13px;
  margin-top: 8px;
  font-weight: bolder;
  color: #000;
}
</style>

<body>

  <?php foreach ($tamu as $row) : ?>
  <div id="box">

    <div class="median" style="text-align: center;">
      <img id="hero" src="<?= base_url('guestbook/assets/images/event/card.png') ?>">
      <img id="qr" src="<?= base_url('guestbook/assets/images/qr/' . $row['qr'] . '.png') ?>">
      <div class="des">
        <p id="wed">The Wedding of</p>
        <p id="manten"><?= $event ?></p>
      </div>

      <div class="des2">
        <p id="nama"><?= $row['tamu'] ?></p>
        <?php if ($active['sesi'] > 1) : ?>
        <p id="sesi">Sesi <?= $row['sesi'] ?></p>
        <?php endif; ?>
      </div>

    </div>


  </div>

  <?php endforeach; ?>


</body>

</html>