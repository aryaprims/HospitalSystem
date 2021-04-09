<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DokterModel extends CI_Model
{

    public function GetDokter()
    {
        $query = $this->db->query('SELECT * FROM  dokter');

        return $query->result();
    }
    public function deleteDokter($username)
    {
        $this->db->where('username', $username);
        return $this->db->delete('akun');
    }
    public function addAkun($data)
    {
        $this->db->insert('akun', $data);
        return $this->db->insert_id();
    }
    public function addDokter($data)
    {
        $this->db->insert('dokter', $data);
        return $this->db->insert_id();
    }

    public function editDokter($data, $username)
    {
        $this->db->where('username', $username);
        return $this->db->update('dokter', $data);
    }

    public function editAkun($data, $username)
    {
        $this->db->where('username', $username);
        return $this->db->update('akun', $data);
    }

    public function getOneDokter($username)
    {
        $query = $this->db->query("SELECT * FROM dokter WHERE username = '$username'");
        return $query->row();
    }
}
