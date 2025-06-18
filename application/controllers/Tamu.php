<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tamu extends CI_Controller
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

    redirect('tamu/tamulist');



    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('emailGuestBook')])->row_array();
    $data['event'] = $this->m_event->byId($this->session->userdata('sessionEventCek'));
    $data['listEvent'] = $this->m_event->allByAdminId($data['user']['id']);
    $data['tamu'] = $this->m_event->getAllTamuHadirByEvent($this->session->userdata('sessionEventCek'));

    $jmlEvent = $this->m_event->jmlEventByAdmin($data['user']['id']);
    if ($jmlEvent < 1) {
      $this->session->set_flashdata('error', 'CREAT EVENT BARU..!');
      redirect('setting');
    }
    $data['judul'] = 'Rekap Data';
    $this->load->view('temp/header', $data);
    $this->load->view('guest/index', $data);
  }

  public function tamulist()
  {
    sedangLogout();

    if (!$this->session->userdata('filterHadirTamu')) {
      $this->setFilterTamu2();
    }

    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('emailGuestBook')])->row_array();
    $data['event'] = $this->m_event->byId($this->session->userdata('sessionEventCek'));
    $data['listEvent'] = $this->m_event->allByAdminId($data['user']['id']);
    $data['tamu'] = $this->m_event->getAllTamuHadirByEvent($this->session->userdata('sessionEventCek'));

    $jmlEvent = $this->m_event->jmlEventByAdmin($data['user']['id']);
    if ($jmlEvent < 1) {
      $this->session->set_flashdata('error', 'CREAT EVENT BARU..!');
      redirect('setting');
    }
    $data['judul'] = 'Rekap Data';
    $this->load->view('temp/header', $data);
    $this->load->view('guest/index', $data);
  }


  public function setFilterTamu($filter)
  {
    $this->session->set_userdata('filterHadirTamu', $filter);
  }

  public function setFilterTamu2()
  {
    $this->session->set_userdata('filterHadirTamu', 1);
    redirect('tamu/tamulist');
  }




  public function jmlAllTamu()
  {
    $id = $this->session->userdata('sessionEventCek');
    $this->db->select('SUM(kehadiran) as total');
    $this->db->from('tamu');
    $this->db->where('event_id', $id);
    $this->db->where('hadir >', 0);
    $jml = $this->db->get()->row()->total;
    echo $jml . ' Tamu';
  }




  public function datatable()
  {
    $event = $this->session->userdata('sessionEventCek');
    $this->load->model('m_gridh');
    $table = 'tamu';
    $col_order = [null, 'nama', 'alamat', 'telp'];
    $order = ['id' => 'desc'];
    $search = ['nama', 'alamat', 'telp'];

    $where = ['event_id'];
    $valu = [$event];
    $list = $this->m_gridh->get_datatables($table, $col_order, $order, $search, $where, $valu);

    $data = array();
    $no = $_POST['start'];

    foreach ($list as $key) {

      if ($key['vip'] == 'vip') {
        $vip = '<span style="font-size:11px;padding: 4px 4px" class="badge badge-pill badge-primary float-left">VIP</span>';
      } else {
        $vip = '';
      }

      $no++;
      $row = array();
      $row[] = $no;
      $row[] = $key['nama'];
      $row[] = $key['alamat'];
      $row[] = $vip;
      $row[] = $key['keterangan'];
      $row[] = $key['kehadiran'] . '  tamu';
      if ($key['hadir'] == 0) {
        $row[] = '<span style="font-size:11px;padding: 4px 10px" class="badge badge-pill badge-danger">No</span>';
      } else {
        $row[] = date('d/m/Y H:i:s', $key['hadir']);
      }
      
      // Add reset button for guests who have checked in
      if ($key['hadir'] > 0) {
        $row[] = '<button class="btn btn-warning btn-sm btnResetHadir" data-id="' . $key['id'] . '" data-nama="' . $key['nama'] . '"><i class="mdi mdi-refresh"></i> Reset</button>';
      } else {
        $row[] = '<span class="text-muted">-</span>';
      }

      $data[] = $row;
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->m_gridh->count_all($table, $where, $valu),
      "recordsFiltered" => $this->m_gridh->count_filter($table, $col_order, $order, $search, $where, $valu),
      "data" => $data,
    );
    //output to json format
    echo json_encode($output);
  }


  public function listTamu()
  {
    $tamu = $this->m_event->getAllTamuHadirByEvent($this->session->userdata('sessionEventCek'));
    $i = 1;
    foreach ($tamu as $key) {
      $data = '<tr>';
      $data .= '<td style="font-size: 13px;">' . $i++ . '</td>';
      $data .= '</td><td style="font-size: 13px;">' . $key['nama'] . '</td>';
      $data .= '</td><td style="font-size: 13px;">' . $key['alamat'] . '</td>';
      $data .= '</td><td style="font-size: 13px;">' . date('d/m/Y H:i:s', $key['hadir']) . '</td>';
      $data .= '</tr>';
      echo $data;
    }
  }




  public function export()
  {
    $event = $this->session->userdata('sessionEventCek');
    if ($this->session->userdata('filterHadirTamu')) {
      if ($this->session->userdata('filterHadirTamu') == "1") {
        $this->db->where('hadir >', 0);
      } else {
        $this->db->where('hadir', 0);
      }
    } else {
      $this->db->where('hadir', 550);
    }
    $this->db->where('event_id', $event);
    $tamu = $this->db->get('tamu')->result_array();
    $data['tamu'] = $tamu;
    $data['event'] = $this->m_event->byId($this->session->userdata('sessionEventCek'));
    $nama = str_replace('&amp;', '', $data['event']['nama']);

    $data['namaFile'] = $nama . '_' . $data['event']['tgl'];
    $data['judul'] = 'Export Data';
    $this->load->view('guest/export', $data);
  }



  public function downloadImg($id)
  {
    $tamu = $this->db->get_where('tamu', ['id' => $id])->row_array();

    $path = base_url('guestbook/assets/images/guest/');
    $img = $path . $tamu['poto'];

    force_download($id . '-' . $tamu['nama'] . '.jpg', file_get_contents($img));
  }

  public function resetHadir()
  {
    $id = $this->input->post('id');
    
    // Get guest data before reset
    $tamu = $this->db->get_where('tamu', ['id' => $id])->row_array();
    
    if ($tamu) {
      // Reset attendance status to 0
      $this->db->set([
        'hadir' => 0,
        'sapa' => 0,
        'timer' => 0,
        'kehadiran' => 0
      ])->where('id', $id)->update('tamu');
      
      $json['kode'] = 1;
      $json['pesan'] = 'Status kehadiran tamu berhasil direset!';
    } else {
      $json['kode'] = 0;
      $json['pesan'] = 'Data tamu tidak ditemukan!';
    }
    
    echo json_encode($json);
  }
}