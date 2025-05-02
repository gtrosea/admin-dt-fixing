<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setingunser extends CI_Controller
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
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('emailGuestBook')])->row_array();

    if ($data['user']['role'] !== "3") {
      redirect('home');
    }

    $data['event'] = $this->db->get_where('event', ['id' => $this->session->userdata('sessionEventCek')])->result_array();
    $data['eventActive'] = $this->m_event->byId($this->session->userdata('sessionEventCek'));

    $data['lokasiApk'] = $this->db->get_where('undangan', ['status' => 2])->row_array();

    $data['judul'] = 'Settings';
    $this->load->view('temp/header', $data);
    $this->load->view('setting/setuser', $data);
  }
}