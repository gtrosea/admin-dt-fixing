<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_user');
    $this->load->model('m_event');
  }



  public function index()
  {
    sedangLogout();
    $myUser = $this->db->get_where('user', ['email' => $this->session->userdata('emailGuestBook')])->row_array();

    if ($myUser['role'] == '3') {
      if (!$this->session->userdata('sessionEventCek')) {
        redirect('home/setEventUser/' . $myUser['event_id']);
      }
    } else {
      if (!$this->session->userdata('sessionEventCek')) {
        $eve = $this->db->get_where('event', ['admin_id' => $myUser['id']])->row_array();
        redirect('home/setEventUser/' . $eve['id']);
      }
    }

    if ($myUser['expired'] < date('Y-m-d')) {
      $this->db->set('active', 0)->where('id', $myUser['id'])->update('user');
    }


    // START EDIT KONEKSI
    $random = generate_random_string(8);
    $cekDuplikat = $this->db->get_where('konek', ['kode' => $random])->row_array();
    if ($cekDuplikat) {
      redirect();
    }
    $cekKode = $this->db->get_where('konek', ['event_id' => $this->session->userdata('sessionEventCek')])->row_array();

    if (!$cekKode) {
      $dataK = [
        'event_id' => $this->session->userdata('sessionEventCek'),
        'kode' => $random,
        'url' => base_url()
      ];
      $this->db->insert('konek', $dataK);
      // $this->creatBarcode('url=' . $url . $random, $random);
    } else {
      $this->db->set('url', base_url())->where('event_id', $this->session->userdata('sessionEventCek'))->update('konek');
    }


    $data['koneksi'] = $this->db->get_where('konek', ['event_id' => $this->session->userdata('sessionEventCek')])->row_array();
    // END EDITED KODE KONEKSI

    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('emailGuestBook')])->row_array();
    $data['event'] = $this->m_event->byId($this->session->userdata('sessionEventCek'));
    $data['listEvent'] = $this->m_event->allByAdminId($data['user']['id']);
    $data['tamu'] = $this->m_event->getAllTamuHadirByEvent($this->session->userdata('sessionEventCek'));

    if ($data['event']['sesi'] > 1) {
      if ($data['event']['sesi_active'] <= 0) {
        $Sesi = $this->db->get_where('event_sesi', ['event_id' => $data['event']['id']])->row_array();
        $this->db->set('sesi_active', $Sesi['id'])->where('id', $data['event']['id'])->update('event');
      }
      $data['sesievent'] = $this->db->get_where('event_sesi', ['id' => $data['event']['sesi_active']])->row_array();
    }

    if ($data['user']['active'] !== "1") {
      redirect('auth/logout');
    }

    $jmlEvent = $this->m_event->jmlEventByAdmin($data['user']['id']);
    if ($jmlEvent < 1) {
      $this->session->set_flashdata('error', 'CREAT EVENT BARU..!');
      redirect('setting');
    }

    $data['judul'] = 'Daftartamu';
    $this->load->view('temp/header', $data);
    $this->load->view('home/index', $data);
  }


  public function setActive($id)
  {
    $this->session->set_userdata('sessionEventCek', $id);
  }

  public function setEventUser($id)
  {
    $this->session->set_userdata('sessionEventCek', $id);
    redirect('home');
  }





  public function checkin3()
  {
    $id = trim($this->input->post('id'));
    $jml = trim($this->input->post('jml'));

    $time = time();
    $timer = $time + (10);


    $idEvent = $this->session->userdata('sessionEventCek');
    $event = $this->m_event->byId($idEvent);
    $sesi = $this->db->get_where('event_sesi', ['id' => $event['sesi_active']])->row_array();
    // if ($sesi) {
    //   $cekTamu = $this->db->get_where('tamu', ['id' => $id])->row_array();
    //   if ($sesi['sesi'] != $cekTamu['sesi']) {
    //     $this->db->set('sesi', $sesi['sesi']);
    //   }
    // }

    $this->db->set('sapa', 0)->where(['event_id' => $idEvent])->update('tamu');

    $cekTamu = $this->db->get_where('tamu', ['id' => $id])->row_array();
    if ($cekTamu) {
      # code...
      $this->db->set([
        'kehadiran' => $jml,
        'hadir' => $time,
        'sapa' => 1,
        'timer' => $timer
      ])->where('id', $cekTamu['id'])->update('tamu');
      echo 1;
    } else {
      # code...
      echo 2;
    }
  }



  public function checkin4()
  {
    $nama = trim($this->input->post('nama'));
    $jml = trim($this->input->post('jml'));

    $time = time();
    $timer = $time + (10);


    $idEvent = $this->session->userdata('sessionEventCek');

    $event = $this->m_event->byId($idEvent);
    $sesi = $this->db->get_where('event_sesi', ['id' => $event['sesi_active']])->row_array();
    // if ($sesi) {
    //   $cekTamu = $this->db->get_where('tamu', ['nama' => $nama, 'event_id' => $idEvent])->row_array();
    //   if ($sesi['sesi'] != $cekTamu['sesi']) {
    //     $this->db->set('sesi', $sesi['sesi']);
    //   }
    // }

    $this->db->set('sapa', 0)->where(['event_id' => $idEvent])->update('tamu');

    $cekTamu = $this->db->get_where('tamu', ['nama' => $nama, 'event_id' => $idEvent])->row_array();
    if ($cekTamu) {
      # code...
      $this->db->set([
        'kehadiran' => $jml,
        'hadir' => $time,
        'sapa' => 1,
        'timer' => $timer
      ])->where('id', $cekTamu['id'])->update('tamu');
      echo 1;
    } else {
      # code...
      echo 2;
    }
  }



  public function chekIn()
  {
    $barcode = trim($this->input->post('barcode'));

    $time = time();
    $timer = $time + (10);


    $idEvent = $this->session->userdata('sessionEventCek');

    $this->db->set('sapa', 0)->where(['event_id' => $idEvent])->update('tamu');

    $cekTamu = $this->db->get_where('tamu', ['nama' => $barcode, 'event_id' => $idEvent])->row_array();
    if ($cekTamu == true) {
      if ($cekTamu['hadir'] == 0) {

        $event = $this->m_event->byId($idEvent);
        $sesi = $this->db->get_where('event_sesi', ['id' => $event['sesi_active']])->row_array();
        // if ($sesi) {
        //   $cekTamu = $this->db->get_where('tamu', ['nama' => $barcode, 'event_id' => $idEvent])->row_array();
        //   if ($sesi['sesi'] != $cekTamu['sesi']) {
        //     $this->db->set('sesi', $sesi['sesi']);
        //   }
        // }

        $this->db->set(['hadir' => $time, 'sapa' => 1, 'timer' => $timer])->where('id', $cekTamu['id'])->update('tamu');
        $json['kode'] = 1;
        $json['pesan'] = 'Terimakasih, SELAMAT DATANG ' . $cekTamu['nama'];
        echo json_encode($json);
        return false;
      } else {
        $this->db->set(['sapa' => 1, 'timer' => $timer])->where('id', $cekTamu['id'])->update('tamu');
        $json['kode'] = 2;
        $json['pesan'] = 'TerimaKasih, Kamu Sudah Checkin Sebelumnya.!';
        echo json_encode($json);
        return false;
      }
    } else {
      $json['kode'] = 3;
      $json['pesan'] = 'Barcode tidak dikenal, SILAHKAN ULANG LAGI!';
      echo json_encode($json);
      return false;
    }
  }

  public function chekcode()
  {
    $barcode = trim($this->input->post('barcode'));

    $time = time();
    $timer = $time + (10);


    $idEvent = $this->session->userdata('sessionEventCek');
    $this->db->set('sapa', 0)->where(['event_id' => $idEvent])->update('tamu');


    if ($barcode == "" || $barcode == null) {
      $json['kode'] = 0;
      echo json_encode($json);
      return false;
    }

    $cekTamu = $this->db->get_where('tamu', ['nama' => $barcode, 'event_id' => $idEvent])->row_array();

    if ($cekTamu == true) {
      if ($cekTamu['hadir'] == 0) {

        $event = $this->m_event->byId($idEvent);
        $sesi = $this->db->get_where('event_sesi', ['id' => $event['sesi_active']])->row_array();
        // if ($sesi) {
        //   $cekTamu = $this->db->get_where('tamu', ['nama' => $barcode, 'event_id' => $idEvent])->row_array();
        //   if ($sesi['sesi'] != $cekTamu['sesi']) {
        //     $this->db->set('sesi', $sesi['sesi']);
        //   }
        // }

        $this->db->set(['hadir' => $time, 'sapa' => 1, 'timer' => $timer])->where('id', $cekTamu['id'])->update('tamu');
        $json['kode'] = 1;
        $json['pesan'] = 'Terimakasih, SELAMAT DATANG ' . $cekTamu['nama'];
        echo json_encode($json);
        return false;
      } else {
        $this->db->set(['sapa' => 1, 'timer' => $timer])->where('id', $cekTamu['id'])->update('tamu');
        $json['kode'] = 2;
        $json['pesan'] = 'TerimaKasih, Kamu Sudah Checkin Sebelumnya.!';
        echo json_encode($json);
        return false;
      }
    } else {
      $json['kode'] = 3;
      $json['pesan'] = 'Barcode tidak dikenal, SILAHKAN ULANG LAGI!';
      echo json_encode($json);
      return false;
    }
  }



  public function listTamu()
  {
    $tamu = $this->m_event->getAllTamuHadirByEvent($this->session->userdata('sessionEventCek'));
    $i = 1;
    foreach ($tamu as $key) {
      $data = '<tr>';
      $data .= '</td><td style="font-size: 13px;">' . $i++ . '</td>';
      $data .= '</td><td style="font-size: 13px;">' . $key['nama'] . '</td>';
      $data .= '</td><td style="font-size: 13px;">' . $key['alamat'] . '</td>';
      $data .= '</td><td style="font-size: 13px;">' . date('d/m/Y H:i:s', $key['hadir']) . '</td>';
      $data .= '</tr>';
      echo $data;
    }
  }

  public function jamNya()
  {
    $jam = date('H:i:s');
    echo $jam;
  }



  public function manual()
  {
    $eventId = $this->session->userdata('sessionEventCek');
    $nama = trim(htmlspecialchars($this->input->post('nama')));
    $alamat = trim(htmlspecialchars($this->input->post('alamat')));
    $jml = trim(htmlspecialchars($this->input->post('jml')));
    if ($alamat == "") {
      $alamat = '-';
    }

    $event = $this->m_event->byId($this->session->userdata('sessionEventCek'));
    $sesi = $this->db->get_where('event_sesi', ['id' => $event['sesi_active']])->row_array();
    if ($sesi) {
      $sesinya = $sesi['sesi'];
    } else {
      $sesinya = 0;
    }

    $this->db->set('sapa', 0)->where(['event_id' => $eventId])->update('tamu');

    $cekTamu = $this->db->get_where('tamu', ['nama' => $nama, 'event_id' => $eventId])->row_array();
    if ($cekTamu) {
      $json['kode'] = 3;
      $json['pesan'] = 'NAMA Yang sama sudah terdaftar, Silahkan gunakan NAMA LAIN Atau tambahkan HURUP/Karakter';
      echo json_encode($json);
      return false;
    }

    $time = time();
    $timer = $time + (10);

    $data = [
      'nama' => $nama,
      'alamat' => $alamat,
      'telp' => 0,
      'event_id' => $eventId,
      'poto' => 'tamu.jpg',
      'kehadiran' => $jml,
      'hadir' => $time,
      'qr' => time() . uniqid(),
      'sapa' => 1,
      'timer' => $timer,
      'sesi' => $sesinya
    ];
    $this->db->insert('tamu', $data);

    $json['kode'] = 1;
    $json['pesan'] = 'Selamat Datang.!';
    echo json_encode($json);
    return false;
  }





  public function cariTamu()
  {
    $eventId = $this->session->userdata('sessionEventCek');
    $nama = $this->input->post('isi');
    $query = $this->m_event->getAllTamuNoHadirByEvent($eventId, $nama);

    if ($query) {
      # code...
      $data = '<ul>';
      foreach ($query as $key) {
        $data .= '<li><a href="' . $key['id'] . '">' . $key['nama'] . '</a></li>';
      }
      $data .= '</ul>';
      echo $data;
    } else {
      echo '<ul><li><a>Data Tidak ditemukan</a></li></ul>';
    }
  }




  public function saveImg()
  {
    $id = $this->input->post('id');
    $tamu = $this->m_event->getTamubyId($id);

    $img = $this->input->post('img');
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $img = base64_decode($img);
    $nImg = uniqid() . time() . '.png';
    file_put_contents('./guestbook/assets/images/guest/' . $nImg, $img);

    if ($tamu['poto'] !== 'tamu.jpg') {
      unlink(FCPATH . 'guestbook/assets/images/guest/' . $tamu['poto']);
    }

    $this->db->set('poto', $nImg)->where('id', $id)->update('tamu');
  }






  public function accessLock()
  {
    $user = $this->db->get_where('user', ['email' => $this->session->userdata('emailGuestBook')])->row_array();
    if ($user['kunci'] === '1') {
      echo '1';
    } else {
      $this->db->set('kunci', 1)->where('id', $user['id'])->update('user');
      echo '2';
    }
  }



  public function openAccess()
  {
    $user = $this->db->get_where('user', ['email' => $this->session->userdata('emailGuestBook')])->row_array();
    $pass = $this->input->post('pass');
    if (passVerf($pass, $user['password'])) {
      $this->db->set('kunci', 0)->where('id', $user['id'])->update('user');
      $this->session->set_flashdata('success', 'Open Access OK');
      redirect('home');
    } else {
      $this->session->set_flashdata('error', 'Password Konfirm Tidak DIKENAL..!');
      redirect('home');
    }
  }


  public function clertab()
  {
    redirect('home/box');

    $query = $this->db->empty_table('konek');
    if ($query) {
      echo 'ok';
    } else {
      echo 'gagal';
    }
  }




  // WELCOME
  public function welcome()
  {
    $data['event'] = $this->m_event->byId($this->session->userdata('sessionEventCek'));
    $data['judul'] = 'Welcome';
    $this->load->view('home/welcome', $data);
  }


  public function autoLoadPage()
  {
    $time = time();
    $event = $this->m_event->byId($this->session->userdata('sessionEventCek'));
    $this->db->set('sapa', 0)->where(['event_id' => $event['id'], 'timer <' => $time])->update('tamu');
    $tamu = $this->db->get_where('tamu', ['event_id' => $event['id'], 'sapa' => 1])->row_array();

    if ($tamu['vip'] == 'vip') {
      $vip = '<span class="badge badge-pill badge-primary px-5">VIP</span>';
    } else {
      $vip = '';
    }

    if (!$tamu) {
      $data = '<div style="width: 100vw;height: 100vh; background: url(' . base_url('guestbook/assets/images/event/' . $event['poto']) . '); background-size: cover;background-position: center;" id="bgImg"><div style="display;none;" hidden  class="kodeWelcome">2</div></div>';
      echo $data;
    } else {
      if (file_exists('guestbook/assets/images/auth/' . $event['warna_bg'])) {
        $data = '<div style="width: 100vw;height: 100vh; background: url(' . base_url('guestbook/assets/images/auth/' . $event['warna_bg']) . '); background-size: cover;background-position: center;text-align: center;padding-top: 30.5vh;color:' . $event['warna'] . ';" id="bgImg">';
      } else {
        $data = '<div style="width: 100vw;height: 100vh; background: ' . $event['warna_bg'] . ';text-align: center;padding-top: 25vh;color:' . $event['warna'] . ';" id="bgColor">';
      }
      $data .= '<div class="row">';
      $data .= '<div class="col-sm-12"><h5 style="font-size: 3.5vw;">' . $event['welcome'] . '</h5></div>';
      $data .= '<div class="col-sm-12 mt-4"><h5 style="font-size: 7vw;">' . $tamu['nama'] . '</h5></div>';
      $data .= '<div class="col-sm-12 mt-4"><h6 style="font-size: 2vw;">' . $tamu['alamat'] . '</h6>';
      $data .= '<div class="col-sm-12 mt-4"><h6 style="font-size: 3vw;">' . $vip . '</h6>';
      $data .= '<h6 style="font-size: 1vw;">' . date('d/m/Y H:i:s', $tamu['hadir']) . '</h6>';
      $data .= '<div style="display;none;" hidden  class="kodeWelcome">' . $tamu['sapa'] . '</div><div style="display:none;" id="audioNya">' . base_url('guestbook/assets/audio/audio.mp3') . '</div></div>';
      $data .= '</div></div>';
      echo $data;
    }
  }



  public function tutor()
  {
    sedangLogout();


    if (!$this->session->userdata('sessionEventCek')) {
      $this->session->set_flashdata('error', 'Select Event Active.!!');
      redirect('home');
    }

    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('emailGuestBook')])->row_array();
    cekColor();
    $data['event'] = $this->m_event->byId($this->session->userdata('sessionEventCek'));
    $data['seting'] = $this->db->get('seting')->row_array();
    $data['judul'] = 'UserGuide';
    $this->load->view('temp/header', $data);
    $this->load->view('home/userguide', $data);
  }
}