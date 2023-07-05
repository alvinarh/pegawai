<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Cuti_model
 *
 * This Model for ...
 * 
 * @package		CodeIgniter
 * @category	Model
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Cuti_model extends CI_Model
{

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function getCutiVerifikasi($id, $verif)
	{
		$this->db->select('*');
		$this->db->from('permohonan_cuti');
		$this->db->where('kode_pegawai', $id);
		$this->db->where('verifikasi', $verif);

		$this->db->order_by('id_cuti', 'desc');
		return $this->db->get()->result();
	}


	public function getCutiByUserId($id, $keterangan)
	{
		$this->db->select('*');
		$this->db->from('permohonan_cuti');
		$this->db->where('kode_pegawai', $id);
		$this->db->where('keterangan', $keterangan);
		$this->db->order_by('id_cuti', 'desc');
		return $this->db->get()->result();
	}

	public function getAllCutiByUserId($id)
	{
		$this->db->select('*');
		$this->db->from('permohonan_cuti');
		$this->db->where('kode_pegawai', $id);
		$this->db->order_by(' id_cuti', 'desc');
		return $this->db->get()->result();
	}

	public function getCutiById($id)
	{
		$this->db->select('*');
		$this->db->from('permohonan_cuti');
		$this->db->where('id_cuti', $id);
		$this->db->order_by('id_cuti', 'desc');
		return $this->db->get()->row_array();
	}

	public function getShowCuti($id)
	{
		$this->db->select('*');
		$this->db->from('permohonan_cuti');
		$this->db->where('verifikasi', 3);
		$this->db->where('kode_pegawai', $id);
		$result1 = $this->db->get()->row_array();

		if ($result1 == null) {
			$this->db->select('*');
			$this->db->from('permohonan_cuti');
			$this->db->where('verifikasi', 1);
			$this->db->where('status', 0);
			$this->db->where('kode_pegawai', $id);
			$result2 = $this->db->get()->row_array();
			return $result2;
		} else {
			return $result1;
		}
	}

	public function insertCuti($id, $dataPegawai, $dataCuti)
	{
		$this->db->trans_start();
		$this->db->where('kode_pegawai', $id);
		$this->db->update('user', $dataPegawai);
		$this->db->insert('permohonan_cuti', $dataCuti);
		$this->db->trans_complete();

		if ($this->db->trans_status() == true) {
			return true;
		} else {
			return false;
		}
	}

	public function checkCutiAktif($id)
	{

		$this->db->select('*');
		$this->db->from('permohonan_cuti');
		$this->db->where('kode_pegawai', $id);
		$this->db->where('verifikasi', 1);
		$this->db->where('status', 0);
		$data = $this->db->get()->row_array();
		return $data;
	}

	public function konfirCutiSelesai($id, $dataCuti, $userId, $dataUser)
	{
		$this->db->trans_start();
		$this->db->where('id_cuti', $id);
		$this->db->update('permohonan_cuti', $dataCuti);
		$this->db->where('kode_pegawai', $userId);
		$this->db->update('user', $dataUser);
		$this->db->trans_complete();

		if ($this->db->trans_status() == true) {
			return true;
		} else {
			return false;
		}
	}

	public function getAllPengajuanCuti()
	{
		$this->db->select('*');
		$this->db->from('permohonan_cuti');
		$this->db->where('verifikasi', 3);
		$this->db->order_by('id_cuti', 'desc');
		return $this->db->get()->result();
	}


	public function getAllPengajuanCutiByKeterangan($keterangan)
	{
		$this->db->select('*');
		$this->db->from('permohonan_cuti');
		$this->db->where('verifikasi !=', 3);
		$this->db->where('keterangan', $keterangan);
		$this->db->order_by('id_cuti', 'desc');
		$this->db->order_by('id_cuti', 'desc');

		return $this->db->get()->result();
	}

	public function keputusanCuti($id, $dataCuti, $userId, $dataUser)
	{
		$this->db->trans_start();
		$this->db->where('id_cuti', $id);
		$this->db->update('permohonan_cuti', $dataCuti);

		$this->db->where('kode_pegawai', $userId);
		$this->db->update('user', $dataUser);
		$this->db->trans_complete();

		if ($this->db->trans_status() == true) {
			return true;
		} else {
			return false;
		}
	}


	public function getAllTotalPengajuanCuti($keterangan)
	{
		$this->db->select('*');
		$this->db->from('permohonan_cuti');
		$this->db->where('keterangan', $keterangan);
		$this->db->order_by('id_cuti', 'desc');
		return $this->db->get()->result();
	}

	public function getAllPengajuanCutiAdminKeterangan($keterangan)
	{
		$this->db->select('*');
		$this->db->from('permohonan_cuti');
		$this->db->where('keterangan', $keterangan);
		$this->db->order_by('id_cuti', 'desc');
		return $this->db->get()->result();
	}

	public function getAllPengajuanCutiAdminSelesai($keterangan)
	{
		$this->db->select('*');
		$this->db->from('permohonan_cuti');
		$this->db->where('keterangan', $keterangan);
		$this->db->where('status', 1);
		$this->db->order_by('id_cuti', 'desc');
		return $this->db->get()->result();
	}

	function checkTotalCuti($kodePegawai)
	{
		$yearNow = date('Y');
		$this->db->select('id_cuti');
		$this->db->from('permohonan_cuti');
		$this->db->where('kode_pegawai', $kodePegawai);
		$this->db->where('YEAR(tanggal_pengajuan)', $yearNow, false);
		$this->db->where('verifikasi', 1);
		$this->db->order_by('id_cuti', 'desc');
		return $this->db->get()->num_rows();
	}

	function checkTotalCutiMelahirkan($kodePegawai)
	{
		$yearNow = date('Y');
		$this->db->select('id_cuti');
		$this->db->from('permohonan_cuti');
		$this->db->where('kode_pegawai', $kodePegawai);
		$this->db->where('YEAR(tanggal_pengajuan)', $yearNow, false);
		$this->db->where('verifikasi', 1);
		$this->db->where('keterangan', 'Cuti Melahirkan');
		$this->db->order_by('id_cuti', 'desc');
		return $this->db->get()->num_rows();
	}
}

/* End of file Cuti_model.php */
/* Location: ./application/models/Cuti_model.php */
