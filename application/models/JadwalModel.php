<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JadwalModel extends CI_Model
{

    public function GetJadwal()
    {
        $query = $this->db->query('SELECT * FROM jadwal_imunisasi JOIN dokter WHERE dokter.id_dokter = jadwal_imunisasi.id_dokter');

        return $query->result();
    }
    public function deleteJadwal($id_jadwal)
    {
        $this->db->where('id_jadwal', $id_jadwal);
        return $this->db->delete('jadwal_imunisasi');
    }
    public function addJadwal($data)
    {
        $this->db->insert('jadwal_imunisasi', $data);
        return $this->db->insert_id();
    }

    public function updateJadwal($data, $id_jadwal)
    {
        $this->db->where('id_jadwal', $id_jadwal);
        return $this->db->update('jadwal_imunisasi', $data);
    }

    public function getTanggal($id_jadwal)
    {
        $query = $this->db->query("SELECT tanggal FROM jadwal_imunisasi where jadwal_imunisasi.id_jadwal = $id_jadwal");
        return $query->row();
    }
}

/* End of file JadwalModel.php */
/* Location: ./application/models/JadwalModel.php */
