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
	}


	public function getCutiByUserId($id, $keterangan)
	{
		$this->db->select('*');
		$this->db->from('permohonan_cuti');
		$this->db->where('kode_pegawai', $id);
		$this->db->where('keterangan', $keterangan);
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
}

/* End of file Cuti_model.php */
/* Location: ./application/models/Cuti_model.php */
