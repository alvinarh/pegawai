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

	public function getCutiSakit($kode_pegawai, $ket_cuti)
	{
		$tanggalSekarang = date('Y-m-d');
		$this->db->select('*');
		$this->db->where('kode_pegawai', $kode_pegawai);
		$this->db->where('keterangan', $ket_cuti);
		$this->db->where('status', 0);
		$this->db->where('verifikasi', 1);
		$this->db->from('permohonan_cuti');
		$query = $this->db->get();
		return $query->row_array();
	}


	public function cekCutiSakitMenunggu($kode_pegawai, $ket_cuti)
	{
		$tanggalSekarang = date('Y-m-d');
		// $tanggalBerakhir = date('Y-m-d', strtotime('+1 days', strtotime($tanggalSekarang)));
		$this->db->select('*');
		$this->db->where('kode_pegawai', $kode_pegawai);
		$this->db->where('keterangan', $ket_cuti);
		$this->db->where('verifikasi', 3);
		$this->db->from('permohonan_cuti');
		$query = $this->db->get();
		return $query->row_array();
	}

	public function updateStatusCuti($id_cuti, $keterangan_cuti, $data)
	{
		$this->db->where('id_cuti', $id_cuti);
		$this->db->where('keterangan', $keterangan_cuti);
		$this->db->update('permohonan_cuti', $data);
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
