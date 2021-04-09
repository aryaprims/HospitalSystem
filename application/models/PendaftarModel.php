<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PendaftarModel extends CI_Model
{
  public function GetPendaftar()
  {
    // $query = $this->db->query('SELECT * FROM tabel_pendaftar_imunisasi JOIN  jadwal_imunisasi JOIN  dokter');
    $query = $this->db->query('SELECT * FROM `tabel_pendaftar_imunisasi` JOIN jadwal_imunisasi 
        ON tabel_pendaftar_imunisasi.id_jadwal = jadwal_imunisasi.id_jadwal
        JOIN dokter ON dokter.id_dokter = jadwal_imunisasi.id_dokter');
    return $query->result();
  }

  public function deletePendaftar($id_tabel_pendaftar)
  {
    $this->db->where('id_tabel_pendaftar', $id_tabel_pendaftar);
    return $this->db->delete('tabel_pendaftar_imunisasi');
  }

  public function updatePendaftar($data, $id){
      $this->db->where('id_tabel_pendaftar', $id);
      return $this->db->update('tabel_pendaftar_imunisasi', $data);
  }

  public function addPendaftar($data)
  {
    $this->db->insert('tabel_pendaftar_imunisasi', $data);
    return $this->db->insert_id();
  }

  public function countJadwal($id_jadwal)
  {
    $query = $this->db->query("SELECT `id_jadwal` FROM `tabel_pendaftar_imunisasi` WHERE `id_jadwal` = $id_jadwal");
    return $query->num_rows();
  }

  public function getOnePendaftar($nip)
  {
    $query = $this->db->query("SELECT * FROM `tabel_pendaftar_imunisasi` JOIN jadwal_imunisasi 
        ON tabel_pendaftar_imunisasi.id_jadwal = jadwal_imunisasi.id_jadwal
        JOIN dokter ON dokter.id_dokter = jadwal_imunisasi.id_dokter WHERE tabel_pendaftar_imunisasi.nip = $nip");
    return $query->result();
  }

  public function getPendaftarById($id)
  {
    $query = $this->db->query("SELECT * FROM `tabel_pendaftar_imunisasi` JOIN jadwal_imunisasi 
        ON tabel_pendaftar_imunisasi.id_jadwal = jadwal_imunisasi.id_jadwal
        JOIN dokter ON dokter.id_dokter = jadwal_imunisasi.id_dokter WHERE tabel_pendaftar_imunisasi.id_tabel_pendaftar = $id");
    return $query->row();
  }
}
