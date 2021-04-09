<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PendaftarController extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('PendaftarModel');
  }

  public function index()
  {
    $content['main_view'] = 'PendaftarView';
    $content['title'] = 'Data Pendaftaran';

    $this->load->view('Body', $content);
  }

  public function data_pendaftar()
  {
    $data = $this->PendaftarModel->GetPendaftar();

    echo json_encode($data);
  }

  public function data_one_pendaftar($nip)
  {
    $data = $this->PendaftarModel->GetOnePendaftar($nip);
    echo json_encode($data);
  }

  public function data_pendaftar_by_id($id)
  {
    $data = $this->PendaftarModel->getPendaftarById($id);
    echo json_encode($data);
  }

  public function data_different_jadwal($id_jadwal)
  {
    $data = $this->PendaftarModel->getDifferentJadwal($id_jadwal);
    echo json_encode($data);
  }

  public function delete_pendaftar($id_tabel_pendaftar)
  {
    $this->PendaftarModel->deletePendaftar($id_tabel_pendaftar);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data ' . $id_tabel_pendaftar . ' Berhasil Dihapus</div>');
  }

  public function add_pendaftar()
  {
    $data = [];
    $msg = array('success' => false, 'messages' => array());
    $this->form_validation->set_rules("nip", "NIP", "trim|required");
    $this->form_validation->set_rules("no_antrian", "No Antrian", "trim|required");
    $this->form_validation->set_rules("usia_anak", "Usia Anak", "trim|required");
    $this->form_validation->set_rules("tinggi_anak", "Tinggi Anak", "trim|required");
    $this->form_validation->set_rules("berat_anak", "Berat Anak", "trim|required");
    $this->form_validation->set_rules("keluhan", "Keluhan", "trim|required");
    $this->form_validation->set_rules("tanggal", "Tanggal", "trim|required|callback_check_tanggal");
    $this->form_validation->set_error_delimiters('<div class="error text-danger">', '</div>');

    if ($this->form_validation->run()) {
      $msg['success'] = true;
      foreach ($_POST as $key => $value) {
        $data[$key] = $value;
      }
      $data1 = [
        'nip' => $data['nip'],
        'id_jadwal' => $data['tanggal'],
        'no_antrian' => $data['no_antrian'],
        'usia_anak' => $data['usia_anak'] . ' ' . $data['usia'],
        'tinggi_anak' => $data['tinggi_anak'] . ' cm',
        'berat_anak' => $data['berat_anak'] . ' kg',
        'keluhan' => $data['keluhan']
      ];
      $this->PendaftarModel->addPendaftar($data1);
    } else {
      foreach ($_POST as $key => $value) {
        $msg['messages'][$key] = form_error($key);
      }
    }
    echo json_encode($msg);
  }

  public function update_pendaftar($id)
  {
    $data = [];
    $msg = array('success' => false, 'messages' => array());
    $this->form_validation->set_rules("nip-edit", "NIP", "trim|required");
    $this->form_validation->set_rules("no_antrian-edit", "No Antrian", "trim|required");
    $this->form_validation->set_rules("usia_anak-edit", "Usia Anak", "trim|required");
    $this->form_validation->set_rules("tinggi_anak-edit", "Tinggi Anak", "trim|required");
    $this->form_validation->set_rules("berat_anak-edit", "Berat Anak", "trim|required");
    $this->form_validation->set_rules("keluhan-edit", "Keluhan", "trim|required");
    $this->form_validation->set_rules("tanggal-edit", "Tanggal", "trim|required|callback_update_tanggal");
    $this->form_validation->set_error_delimiters('<div class="error text-danger">', '</div>');

    if ($this->form_validation->run()) {
      $msg['success'] = true;

      foreach ($_POST as $key => $value) {
        $data[$key] = $value;
      }

      $data1 = [
        'nip' => $data['nip-edit'],
        'id_jadwal' => $data['tanggal-edit'],
        'no_antrian' => $data['no_antrian-edit'],
        'usia_anak' => $data['usia_anak-edit'] . ' ' . $data['usia-edit'],
        'tinggi_anak' => $data['tinggi_anak-edit'] . ' cm',
        'berat_anak' => $data['berat_anak-edit'] . ' kg',
        'keluhan' => $data['keluhan-edit']
      ];
      $this->PendaftarModel->updatePendaftar($data1, $id);
    } else {
      foreach ($_POST as $key => $value) {
        $msg['messages'][$key] = form_error($key);
      }
    }
    echo json_encode($msg);
  }

  function update_tanggal()
  {
    foreach ($_POST as $key => $value) {
      $data[$key] = $value;
    }

    if ($data['tanggal-edit'] == $data['tanggal-hidden']) {
      return TRUE;
    } else {
      $query = $this->db->query("SELECT `id_jadwal` FROM `tabel_pendaftar_imunisasi` WHERE `nip` = " . $data['nip-edit'] . " AND `id_jadwal` = " . $data['tanggal-edit']);
      if ($query->num_rows() > 0) {
        $this->form_validation->set_message('update_tanggal', "You've already registered for this date");
        return FALSE;
      } else {
        return TRUE;
      }
    } 
  }

  function check_tanggal()
  {
    foreach ($_POST as $key => $value) {
      $data[$key] = $value;
    }

    $query = $this->db->query("SELECT `id_jadwal` FROM `tabel_pendaftar_imunisasi` WHERE `nip` = " . $data['nip'] . " AND `id_jadwal` = " . $data['tanggal']);

    if ($query->num_rows() > 0) {
      $this->form_validation->set_message('check_tanggal', "You've already registered for this date");
      return FALSE;
    } else {
      return TRUE;
    }
  }

  public function count_jadwal($id_jadwal)
  {
    $data = $this->PendaftarModel->countJadwal($id_jadwal);
    echo json_encode($data);
  }
}
