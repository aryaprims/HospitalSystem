<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminController extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('AdminModel');
  }

  public function index()
  {
    $content['main_view'] = 'AdminView';
    $content['title'] = 'Data Admin';

    $this->load->view('Body', $content);
  }

  public function data_admin()
  {
    $data = $this->AdminModel->GetAdmin();

    echo json_encode($data);
  }

  public function add_admin()
  {
    $data = [];
    $msg = array('success' => false, 'messages' => array());
    $this->form_validation->set_rules("username", "Username", "trim|required|is_unique[akun.username]");
    $this->form_validation->set_rules("password", "Password", "trim|required|min_length[5]");
    $this->form_validation->set_rules("name", "name", "trim|required");
    $this->form_validation->set_error_delimiters('<div class="error text-danger">', '</div>');

    if ($this->form_validation->run()) {
      $msg['success'] = true;
      foreach ($_POST as $key => $value) {
        $data[$key] = $value;
      }
      $data1 = [
        'username' => $data['username'],
        'password' => password_hash($data['password'], PASSWORD_DEFAULT),
        'hak_akses' => 1
      ];
      $data2 = [
        'username' => $data['username'],
        'nama' => $data['name'],
      ];
      $this->AdminModel->addAkun($data1);
      $this->AdminModel->addAdmin($data2);
    } else {
      foreach ($_POST as $key => $value) {
        $msg['messages'][$key] = form_error($key);
      }
    }
    echo json_encode($msg);
  }
}
