<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Auth_model extends CI_Model
{

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}
	public function auth($email, $password, $field)
	{
		$this->db->select('*');
		$this->db->from($field);
		$this->db->where('email', $email);
		$this->db->where('password', $password);
		$this->db->where('status', 'Aktif');

		return $this->db->get()->row_array();
	}

	public function validateEMail($email, $field)
	{
		$this->db->select('*');
		$this->db->from($field);
		$this->db->where('email', $email);
		return $this->db->get()->row_array();
	}

	public function auth2($email, $password, $field)
	{
		$this->db->select('*');
		$this->db->from($field);
		$this->db->where('email', $email);
		$this->db->where('password', $password);
		return $this->db->get()->row_array();
	}
}

/* End of file AuthModel_model.php */
/* Location: ./application/models/AuthModel_model.php */
