<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_Permohonan extends CI_Model
{

  
  
  public function selectKetCuti()
  {
    $query = "SELECT `ket_cuti`.keterangan as id, `permohonan_cuti`.`keterangan` FROM  `ket_cuti` JOIN `permohonan_cuti` ON `permohonan_cuti`.`keterangan` = `ket_cuti`.`id`";
    return $this->db->query($query)->row_array();
  }

  public function selectIdCuti()
  {
    $query = "SELECT `ket_cuti`.id as id, `permohonan_cuti`.`id_cuti` FROM  `ket_cuti` JOIN `permohonan_cuti` ON `permohonan_cuti`.`id_cuti` = `ket_cuti`.`id`";
    return $this->db->query($query)->row_array();
  }

  public function getAllKeterangan()
  {
    return $this->db->get('ket_cuti')->result_array();
  }

  public function getDataCutiDetail($id)
  {
    $this->db->where('id', $id);
    $query = $this->db->get('ket_cuti');
    return $query->row_array();
  }

  public function getDataPegawaiDetail($id)
  {
    $this->db->where('kode_pegawai', $id);
    $query = $this->db->get('user');
    return $query->row_array();
  }
}
