<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AkunController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AkunModel');
    }

    public function index()
    {
        $content['main_view'] = 'AkunView';
        $content['title'] = 'Data Akun';

        $this->load->view('Body', $content);
    }

    public function data_akun()
    {
        $data = $this->AkunModel->GetAkun();

        echo json_encode($data);
    }

    public function delete_akun($username)
    {
        $this->AkunModel->delete_akun($username);
    }
}
