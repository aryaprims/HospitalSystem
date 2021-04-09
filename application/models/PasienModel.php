<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PasienModel extends CI_Model
{
    public function GetAllPasien()
    {
        $query = $this->db->query('SELECT * FROM pasien_user');
        return $query->result();
    }

    public function deletePasien($username) {
        $this->db->where('username', $username);
        return $this->db->delete('akun');
    }

    public function getPasien($username) {
        $query = $this->db->query("SELECT * FROM pasien_user WHERE username = '$username'");
        return $query->row();
    }

    public function updateAkun($data, $username) {
        $this->db->where('username', $username);
        return $this->db->update('akun', $data);
    }

    public function updateProfile($data, $username) {
        $this->db->where('username', $username);
        return $this->db->update('pasien_user', $data);
    }

    public function updatePasien($data, $username) {
        $this->db->where('username', $username);
        return $this->db->update('pasien_user', $data);
    }
}
