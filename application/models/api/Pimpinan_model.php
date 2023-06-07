<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Pimpinan_model
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

class Pimpinan_model extends CI_Model
{


	public function getMyProfile($id)
	{
		$this->db->select('*');
		$this->db->from('pimpinan');
		$this->db->where('kode_pimpinan', $id);
		return $this->db->get()->row_array();
	}

	public function update($id, $data)
	{
		$this->db->where('kode_pimpinan', $id);
		$update = $this->db->update('pimpinan', $data);

		if ($update) {
			return true;
		} else {
			return false;
		}
	}
}

/* End of file Pimpinan_model.php */
/* Location: ./application/models/Pimpinan_model.php */
