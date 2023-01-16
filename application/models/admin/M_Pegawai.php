<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_Pegawai extends CI_Model
{

	public function getDataPegawai()
	{
		$query = $this->db->get('user');
		return $query->result();
	}

	public function getDataPegawaiTidaPernahCuti()
	{
		// $query = "SELECT u.*,p.* from permohonan_cuti p , user u where  u.kode_pegawai = p.kode_pegawai and p.kode_pegawai is null";
		// return $this->db->query($query)->result();
		$this->db->select('user.*');
		$this->db->from('user');
		$this->db->join('permohonan_cuti', 'user.kode_pegawai = permohonan_cuti.kode_pegawai', 'left');
		$this->db->where('permohonan_cuti.kode_pegawai', null);
		$query = $this->db->get();
		return $query->result();
	}

	public function selectJenisKel()
	{
		$this->db->select('jenis_kel');
		$this->db->from('user');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			return $row;
		}
	}

	public function getDataNIK($id)
	{
		$this->db->where('kode_pegawai', $id);
		$query = $this->db->get('user');
		return $query->row_array();
	}

	//untuk memilih status pegawai
	public function selectStatusPegawai()
	{
		$this->db->select('status');
		$this->db->from('user');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			return $row;
		}
	}
	//detail data feedback
	public function detailData($id)
	{
		$this->db->where('kode_pegawai', $id);
		$query = $this->db->get('user');
		return $query->row();
	}


	//function untuk hapus data pegawai
	public  function deleteDataPegawai($id)
	{
		$this->db->where('kode_pegawai', $id);
		$this->db->delete('user');
	}
}
