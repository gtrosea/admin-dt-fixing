<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');


class M_apinya extends CI_Model
{

  public function updateCheck($id)
  {
    $set = date('Y-m-d', strtotime('+2 day'));
    $this->db->set('checkin', $set)->where('id', $id);
    return $this->db->update('user');
  }
}