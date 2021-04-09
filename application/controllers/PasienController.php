<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PasienController extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('PasienModel');
  }

  public function index()
  {
    $content['main_view'] = 'PasienView';
    $content['title'] = 'Data Pasien';

    $this->load->view('Body', $content);
  }

  public function profile()
  {
    $content['main_view'] = 'ProfileView';
    $content['title'] = "Profile " . $this->session->userdata('nama');
    $this->load->view('Body', $content);
  }

  public function all_data_pasien()
  {
    $data = $this->PasienModel->GetAllPasien();

    echo json_encode($data);
  }

  public function delete_pasien($username)
  {
    $this->PasienModel->deletePasien($username);
  }

  public function data_pasien($username)
  {
    $data = $this->PasienModel->getPasien($username);
    echo json_encode($data);
  }

  public function update_profile($username)
  {
    $data = [];
    $msg = array('success' => false, 'messages' => array());
    $this->form_validation->set_rules("nip", "NIP", "trim|required");
    $this->form_validation->set_rules("username", "Username", "trim|required");
    $this->form_validation->set_rules("name", "name", "trim|required");
    $this->form_validation->set_error_delimiters('<div class="error text-danger">', '</div>');

    if ($this->form_validation->run()) {
      $msg['success'] = true;
      foreach ($_POST as $key => $value) {
        $data[$key] = $value;
      }

      if ($data['password']) {
        $data1 = [
          'username' => $data['username'],
          'password' => password_hash($data['password'], PASSWORD_DEFAULT)
        ];

        $data2 = [
          'nip' => $data['nip'],
          'nama' => $data['name']
        ];
      } else {
        $data1 = [
          'username' => $data['username']
        ];

        $data2 = [
          'nip' => $data['nip'],
          'nama' => $data['name']
        ];
      }
      $this->session->set_userdata("username", $data['username']);
      $this->session->set_userdata("name", $data['name']);
      $this->PasienModel->updateProfile($data2, $username);
      $this->PasienModel->updateAkun($data1, $username);
    } else {
      foreach ($_POST as $key => $value) {
        $msg['messages'][$key] = form_error($key);
      }
    }
    echo json_encode($msg);
  }

  public function update_pasien($username)
  {
    $data = [];
    $msg = array('success' => false, 'messages' => array());
    $this->form_validation->set_rules("nip", "NIP", "trim|required");
    $this->form_validation->set_rules("username", "Username", "trim|required");
    $this->form_validation->set_rules("name", "name", "trim|required");
    $this->form_validation->set_error_delimiters('<div class="error text-danger">', '</div>');

    if ($this->form_validation->run()) {
      $msg['success'] = true;
      foreach ($_POST as $key => $value) {
        $data[$key] = $value;
      }

      $data1 = [
        'username' => $data['username']
      ];

      $data2 = [
        'nip' => $data['nip'],
        'nama' => $data['name']
      ];

      $this->PasienModel->updatePasien($data2, $username);
      $this->PasienModel->updateAkun($data1, $username);
    } else {
      foreach ($_POST as $key => $value) {
        $msg['messages'][$key] = form_error($key);
      }
    }
    echo json_encode($msg);
  }
}
