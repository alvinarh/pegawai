<?php
defined('BASEPATH') or exit('No direct script access allowed');


class User_model extends CI_Model
{

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}
	public function getUserById($id)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('kode_pegawai', $id);
		return $this->db->get()->row_array();
	}

	public function updateUser($id, $data)
	{
		$this->db->where('kode_pegawai', $id);
		$update = $this->db->update('user', $data);
		if ($update) {
			return true;
		} else {
			return false;
		}
	}

	public function getAllUser()
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->order_by('kode_pegawai', 'desc');
		return $this->db->get()->result();
	}

	public function getPegawaiTidakPernahCuti()
	{
		$this->db->select('user.*');
		$this->db->from('user');
		$this->db->join('permohonan_cuti', 'user.kode_pegawai = permohonan_cuti.kode_pegawai', 'left');
		$this->db->where('permohonan_cuti.kode_pegawai', null);
		$this->db->order_by('kode_pegawai', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function insertPegawai($data)
	{
		$insert = $this->db->insert('user', $data);
		if ($insert) {
			return true;
		} else {
			return false;
		}
	}

	public function getIdPegawai()
	{
		$this->db->select('MAX(RIGHT(kode_pegawai,5)) as kode_pegawai', FALSE);
		$this->db->from('user');
		$this->db->where('kode_pegawai !=', 'NULL');
		$query = $this->db->get();
		$kode = $query->row();
		$num = substr($kode->kode_pegawai, 1, 5);
		$add = (int)$num + 1;
		if (strlen($add) == 1) {
			$kodebaru = "0000" . $add;
		} else if (strlen($add) == 2) {
			$kodebaru = "000" . $add;
		} else if (strlen($add) == 3) {
			$kodebaru = "00" . $add;
		} else if (strlen($add) == 4) {
			$kodebaru = "0" . $add;
		} else {
			$kodebaru = "" . $add;
		}
		$id_pegawai = 'PGW-' . date('Y') . '-' . $kodebaru;

		return $id_pegawai;
	}
	public function deleteUser($idUser)
	{
		$this->db->trans_start();
		$this->db->where('kode_pegawai', $idUser);
		$this->db->delete('user');

		$this->db->where('kode_pegawai', $idUser);
		$this->db->delete('permohonan_cuti');

		$this->db->trans_complete();

		if ($this->db->trans_status() == true) {
			return true;
		} else {
			return false;
		}
	}
}

/* End of file AuthModel_model.php */
/* Location: ./application/models/AuthModel_model.php */
