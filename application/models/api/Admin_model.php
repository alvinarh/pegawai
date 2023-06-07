<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Admin_model
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

class Admin_model extends CI_Model
{

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}

	public function getMyProfile($id)
	{
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('id_admin', $id);
		return $this->db->get()->row_array();
	}

	public function edit($id, $data)
	{
		$this->db->where('id_admin', $id);
		$update = $this->db->update('admin', $data);
		if ($update) {
			return true;
		} else {
			return false;
		}
	}
}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */
