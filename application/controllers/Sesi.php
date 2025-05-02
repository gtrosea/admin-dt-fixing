<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sesi extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_user');
    $this->load->model('m_event');
  }

  public function index()
  {
    redirect();
    sedangLogout();

    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('emailGuestBook')])->row_array();

    $data['event'] = $this->m_event->byId($this->session->userdata('sessionEventCek'));
    $data['eventSesi'] = $this->db->get_where('event_sesi', ['event_id' => $data['event']['id']])->result_array();

    $data['judul'] = 'Setting Sesi';
    $this->load->view('temp/header', $data);
    $this->load->view('setting/card', $data);
  }



  public function cariTamu()
  {
    $cari = trim($this->input->post('cari'));
    $even = $this->m_event->byId($this->session->userdata('sessionEventCek'));
    $cari = strtolower($cari);
    if ($cari == 'all') {
      # code...
      $tamu = $this->db->where(['event_id' => $even['id'], 'sesi' => 0]);
      $tamu = $this->db->get('tamu')->result_array();
    } else {
      # code...
      $tamu = $this->db->like('nama', $cari);
      $tamu = $this->db->where(['event_id' => $even['id'], 'sesi' => 0]);
      $tamu = $this->db->get('tamu')->result_array();
    }
    if ($tamu) {
      # code...
      $data = '<ul>';
      foreach ($tamu as $key) {
        $data .= '<li class="text-truncate" data-id="' . $key['id'] . '">' . $key['nama'] . '</li>';
      }
      $data .= '<ul>';

      echo $data;
    } else {
      echo '<ul><li>Tidak ditemukan</li></ul>';
    }
  }


  public function setSesi()
  {
    $sesi = $this->input->post('sesi');
    $id = $this->input->post('id');
    $this->db->set('sesi', $sesi)->where('id', $id)->update('tamu');
  }

  public function removeSesi()
  {
    $id = $this->input->post('id');
    $this->db->set('sesi', 0)->where('id', $id)->update('tamu');
  }

  public function activeSesi()
  {
    $id = $this->input->post('id');
    $even = $this->m_event->byId($this->session->userdata('sessionEventCek'));
    $this->db->set('sesi_active', $id)->where('id', $even['id'])->update('event');
  }

  public function sesiJam()
  {
    $id = $this->input->post('id');
    $wkt = $this->input->post('wkt');
    $this->db->set('jam', $wkt)->where('id', $id)->update('event_sesi');
  }


  public function loadSesi()
  {
    $sesi = $this->input->post('sesi');
    $even = $this->m_event->byId($this->session->userdata('sessionEventCek'));
    $tamu = $this->db->where(['event_id' => $even['id'], 'sesi' => $sesi]);
    $tamu = $this->db->get('tamu')->result_array();

    if ($tamu) {
      # code...
      $data = '<ul>';
      foreach ($tamu as $key) {
        $data .= '<li class="text-truncate">' . $key['nama'] . ' <a href="" data-id="' . $key['id'] . '"><i class="mdi mdi-delete"></i></a></li>';
      }
      $data .= '<ul>';

      echo $data;
    } else {
      echo '<ul><li style="color:yellow">Belum ada data</li></ul>';
    }
  }
}