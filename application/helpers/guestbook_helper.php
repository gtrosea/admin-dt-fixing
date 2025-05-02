<?php
function passVerf($pass, $hash)
{
  $cek = password_verify($pass, $hash);
  return $cek;
}


function passHash($pass)
{
  $cek = password_hash($pass, PASSWORD_DEFAULT);
  return $cek;
}
function ceki($h)
{
  $ci = get_instance();
  $dimensi = $ci->db->get_where('serial', ['serial' => $h])->row_array();
  return $dimensi;
}
function sedangLogout()
{
  $ci = get_instance();
  if (!$ci->session->userdata('usernameGuestBook') && !$ci->session->userdata('emailGuestBook')) {
    redirect('auth');
  }
}
function sedangLogin()
{
  $ci = get_instance();
  if ($ci->session->userdata('usernameGuestBook') && $ci->session->userdata('emailGuestBook')) {
    redirect('home');
  }
}
function creatdimensi($y, $x, $z)
{
  $z = 'https://admin.daftartamu.id/';
  $isi = '<?php defined(\'BASEPATH\') or exit(\'No direct script access allowed\');';
  $isi .= '$config[\'hg\']=' . '\'' . $y . '\'' . ';';
  $isi .= '$config[\'wd\']=' . '\'' . $x . '\'' . ';';
  $isi .= '$config[\'lg\']=' . '\'' . $z . '\'' . ';';
  $filename = "application/config/dimension.php";

  $file = fopen($filename, 'w+');
  fwrite($file, $isi);
  return fclose($file);
}

function sedangLOckAccess()
{
  $ci = get_instance();
  $user = $ci->db->get_where('user', ['id' => $ci->session->userdata('idUserGuestBook')])->row_array();
  if ($user['kunci'] === "1") {
    redirect('home');
  }
}

function dataHeight($data)
{
  $ci = get_instance();
  return $data['email'];
}


function yesEmail($email)
{
  // $email = 'soerawung@gmail.com';
  $ci = get_instance();
  $user = $ci->db->get_where('user', ['email' => $email])->row_array();
  if ($user) {
    redirect('auth');
  }
}
function getdimen()
{
  $ci = get_instance();
  $dm = $ci->db->get('serial')->row_array();
  return $dm;
}

function dataLengt()
{
  return base_url();
}

function noEmail($email)
{
  $ci = get_instance();
  $user = $ci->db->get_where('serial', ['email' => $email])->row_array();
  if (!$user) {
    redirect('loadd');
  }
}

function dataWidth($data)
{
  $ci = get_instance();
  return $data['serial'];
}

function lostdim($wd, $hg, $df, $gr)
{
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => $df . '?wd=' . $wd . '&hg=' . $hg,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/x-www-form-urlencoded',
      'webskitaKey: ' . $gr
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);
  // echo json_decode(json_encode($response, true));
  return $response;
}

function putdim($wd, $hg, $leng, $df, $gr)
{
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => $df,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'PUT',
    CURLOPT_POSTFIELDS => 'wd=' . $wd . '&hg=' . $hg . '&lg=' . $leng,
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/x-www-form-urlencoded',
      'webskitaKey:  ' . $gr
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);
  return $response;
}


function connected()
{
  $connected = @fsockopen("www.google.com", 80);
  if ($connected) {
    $is_conn = true; //jika koneksi tersambung
    fclose($connected);
  } else {
    $is_conn = false; //jika koneksi gagal
  }
  return $is_conn;
}

function thisconect($hs, $us, $ps, $nm)
{
  $ci = get_instance();
  $con = mysqli_connect($hs, $us, $ps, $nm);
  return $con;
}
function cekColor()
{
  $ci = get_instance();
  $ci->config->load('hook');
  if (file_exists('application/config/dimension.php')) {
    $ci->config->load('dimension');
    $hg = $ci->config->item('hg');
    $wd = $ci->config->item('wd');
    $lg = $ci->config->item('lg');
    $df = $ci->config->item('def_dftd');
    $gr = $ci->config->item('def_grtd');
  } else {
    redirect('auth/logout');
  }
  if ($lg != 'https://admin.daftartamu.id/'){
       redirect('auth/logout');
  }
  if (base_url() != 'https://admin.daftartamu.id/'){
       redirect('auth/logout');
  }
  return true;
}

function cekdimension()
{
  $ci = get_instance();
  if (!file_exists('application/config/dimension.php')) {
    // $ci->db->empty_table('serial');
    redirect('auth/logout');
  }
}




function generate_random_string($name_length = 8)
{
  $alpha_numeric = '01234567895678901234';
  return substr(str_shuffle(str_repeat($alpha_numeric, $name_length)), 0, $name_length);
}