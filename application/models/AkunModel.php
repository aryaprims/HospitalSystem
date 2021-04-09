<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AkunModel extends CI_Model
{
    public function GetAkun()
    {
        $query = $this->db->query('SELECT `akun`.`username`, COALESCE(`admin`.`nama`, `dokter`.`nama`, `pasien_user`.`nama`) `nama`, `akun`.`hak_akses`
        FROM `akun` 
            LEFT JOIN `admin` ON `admin`.`username` = `akun`.`username` 
            LEFT JOIN `dokter` ON `dokter`.`username` = `akun`.`username` 
            LEFT JOIN `pasien_user` ON `pasien_user`.`username` = `akun`.`username`;');

        return $query->result();
    }

    public function delete_akun($username)
    {
        $this->db->where('username', $username);
        return $this->db->delete('akun');
    }
}
