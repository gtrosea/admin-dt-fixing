<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_gridm extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }


  public function getTamuByEvent($table, $event)
  {
    $this->db->from($table);

    if ($this->input->post('cari')) {
      $this->db->group_start();
      $this->db->like('nama', $this->input->post('cari'));
      $this->db->or_like('alamat', $this->input->post('cari'));
      $this->db->or_like('vip', $this->input->post('cari'));
      $this->db->group_end();
    }

    $page = $this->input->post('page');
    // $page = ($page - 1);
    // $perpage = 13;
    // $resultFilter = ($perpage * $page);

    $this->db->order_by('nama', 'ASC');

    $this->db->limit($page);

    if ($this->input->post('sesi') || $this->input->post('sesi') != null || $this->input->post('sesi') != '') {
      $this->db->where('sesi', $this->input->post('sesi'));
    }
    $this->db->where('event_id', $event);
    $query = $this->db->get()->result_array();
    return $query;
  }
}