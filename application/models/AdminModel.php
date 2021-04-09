<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminModel extends CI_Model
{
    public function GetAdmin()
    {
        $query = $this->db->query('SELECT * FROM admin');

        return $query->result();
    }

    public function addAkun($data)
    {
        $this->db->insert('akun', $data);
        return $this->db->insert_id();
    }

    public function addAdmin($data)
    {
        $this->db->insert('admin', $data);
        return $this->db->insert_id();
    }
}
