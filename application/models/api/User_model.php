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
}

/* End of file AuthModel_model.php */
/* Location: ./application/models/AuthModel_model.php */
