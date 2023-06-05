<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller Pegawai
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @author    Raul Guerrero <r.g.c@me.com>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Pegawai extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('api/user_model');
		$this->load->model('api/cuti_model');
	}

	public function getCutiByUserId()
	{
		$userId = $this->input->get('user_id');
		$keterangan = $this->input->get('keterangan');
		echo json_encode($this->cuti_model->getCutiByUserId($userId, $keterangan));
	}

	public function getAllCutiByUserId()
	{
		$userId = $this->input->get('user_id');
		echo json_encode($this->cuti_model->getAllCutiByUserId($userId));
	}

	public function getShowCuti()
	{
		$userId = $this->input->get('user_id');
		echo json_encode($this->cuti_model->getShowCuti($userId));
	}
}
