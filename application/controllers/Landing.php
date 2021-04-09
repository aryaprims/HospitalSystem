<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Landing extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$content['main_view'] = 'LandingView';
		$content['title'] = 'Welcome to Posyandu';
		if ($this->session->userdata('username')) {
			$content['main_view'] = 'DashboardView';
			$content['title'] = 'Dashboard';
		}
		$this->load->view('Body', $content);
	}

	public function logout()
	{
		session_destroy();
		redirect(base_url());
	}

	public function login()
	{
		$this->form_validation->set_rules('username', 'username', 'required|trim');
		$this->form_validation->set_rules('password', 'password', 'required|trim');
		$content['main_view'] = 'LoginView';
		$content['title'] = 'Sign In';

		if ($this->form_validation->run() == false) {
			$this->load->view('Body', $content);
		} else {
			$this->_login();
		}
	}

	private function _login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$query = $this->db->get_where('akun', ['username' => $username])->row_array();
		// var_dump($query);
		// die;

		// kondisi ketika username valid
		if ($query) {
			// kondisi ketika password valid
			if (password_verify($password, $query['password'])) {
				$user = '';
				$data = '';
				if ($query['hak_akses'] == 3) {
					$user = $this->db->get_where('pasien_user', ['username' => $username])->row_array();
					$data = [
						'username' => $user['username'],
						'nama' => $user['nama'],
						'hak_akses' => $query['hak_akses'],
						'id' => $user['nip']
					];
				} else if ($query['hak_akses'] == 2) {
					$user = $this->db->get_where('dokter', ['username' => $username])->row_array();
					$data = [
						'username' => $user['username'],
						'nama' => $user['nama'],
						'hak_akses' => $query['hak_akses'],
						'id' => $user['id_dokter']
					];
				} else {
					$user = $this->db->get_where('admin', ['username' => $username])->row_array();
					$data = [
						'username' => $user['username'],
						'nama' => $user['nama'],
						'hak_akses' => $query['hak_akses'],
						'id' => $user['id_admin']
					];
				}
				$this->session->set_userdata($data);
				redirect('Landing/dashboard');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah!</div>');
				redirect('Landing/login');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username is Not Registered!</div>');
			redirect('Landing/login');
		}
	}

	public function registrasi()
	{
		$this->form_validation->set_rules('nip', 'Nip', 'required|trim|is_unique[pasien_user.nip]', [
			'is_unique' => 'NIP sudah Terdaftar'
		]);
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[pasien_user.username]trim', [
			'is_unique' => 'Username Sudah Terdaftar'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[5]|matches[password2]', [
			'matches' => 'Password dont Match!',
			'min_length' => 'Password too Short'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

		$content['main_view'] = 'RegistrasiView';
		$content['title'] = 'Sign Up';

		if ($this->form_validation->run() == false) {
			$this->load->view('Body', $content);
		} else {

			$data1 = [
				'username' => $this->input->post('username', true),
				'password' => password_hash(
					$this->input->post('password1'),
					PASSWORD_DEFAULT
				),
				'hak_akses' => 3
			];
			$data2 = [
				'username' => $this->input->post('username', true),
				'nip' => $this->input->post('nip', true),
				'nama' => $this->input->post('name', true)


			];

			$this->session->set_flashdata('message', '<div class="alert alert-success" 
            role="alert">Data Berhasil Ditambahkan!</div>');
			$this->db->insert('akun', $data1);
			$this->db->insert('pasien_user', $data2);
			redirect('Landing/login');
		}
	}

	public function dashboard()
	{
		if ($this->session->userdata('username')) {
			$content['title'] = 'Dashboard';
			$content['main_view'] = 'DashboardView';
			$this->load->view('Body', $content);
		} else {
			echo "You need to log in first! Redirecting in 5 seconds";
			header('Refresh:5; url=' . base_url('Landing'));
		}
	}
}
