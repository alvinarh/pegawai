<?php
defined('BASEPATH') or exit('No direct script access allowed');


class User_model extends CI_Model
{

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}
	public function getUserById($id)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('kode_pegawai', $id);
		return $this->db->get()->row_array();
	}
}

/* End of file AuthModel_model.php */
/* Location: ./application/models/AuthModel_model.php */
