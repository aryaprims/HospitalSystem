<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JadwalController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('JadwalModel');
    }

    public function index()
    {
        $content['main_view'] = 'JadwalView';
        $content['title'] = 'Data Jadwal Imunisasi';

        $this->load->view('Body', $content);
    }

    public function data_jadwal()
    {
        $data = $this->JadwalModel->GetJadwal();

        echo json_encode($data);
    }
    public function delete_jadwal($id_jadwal)
    {
        $this->JadwalModel->deleteJadwal($id_jadwal);
    }

    public function data_tanggal($id_jadwal)
    {
        $data  = $this->JadwalModel->getTanggal($id_jadwal);

        echo json_encode($data);
    }

    public function add_jadwal()
    {
        $data = [];
        $msg = array('success' => false, 'messages' => array());
        $this->form_validation->set_rules("tanggal", "tanggal", "trim|required|is_unique[jadwal_imunisasi.tanggal]");
        $this->form_validation->set_error_delimiters('<div class="error text-danger">', '</div>');

        if ($this->form_validation->run()) {
            $msg['success'] = true;
            foreach ($_POST as $key => $value) {
                $data[$key] = $value;
            }
            $data1 = [
                'id_dokter' => $data['id_dokter'],
                'tanggal' => $data['tanggal']
            ];
            $this->JadwalModel->addJadwal($data1);
        } else {
            foreach ($_POST as $key => $value) {
                $msg['messages'][$key] = form_error($key);
            }
        }
        echo json_encode($msg);
    }

    public function update_jadwal($id_jadwal)
    {
        $data = [];
        $msg = array('success' => false, 'messages' => array());
        $this->form_validation->set_rules("tanggalJadwal", "Jadwal", "required|is_unique[jadwal_imunisasi.tanggal]");
        $this->form_validation->set_error_delimiters('<div class="error text-danger">', '</div>');

        if ($this->form_validation->run()) {
            $msg['success'] = true;
            foreach ($_POST as $key => $value) {
                $data[$key] = $value;
            }

            $data = [
                'tanggal' => $data['tanggalJadwal']
            ];

            $this->JadwalModel->updateJadwal($data, $id_jadwal);
            
        } else {
            foreach ($_POST as $key => $value) {
                $msg['messages'][$key] = form_error($key);
            }
        }
        echo json_encode($msg);
    }
}
