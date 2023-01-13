<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;


class Index_Api extends RestController
{
	public function __construct()
	{
		parent::__construct();
		//load model untuk API
		$this->load->model('admin/Project_Model');
		$this->load->model('admin/Feedback_Model');
		$this->load->model('karyawan/Progress_Model');
		$this->load->model('admin/Pembayaran_Model');
		$this->load->model('admin/CatatanTambahan_Model');
		$this->load->model('User_model');
	}

	/*API ADMIN */


	//endpoint untuk mendapatkan data project yang sudah dibuat


	//endpoint untuk login admin
	public function loginAdmin_post()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Credentials: true");
		header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
		header('Access-Control-Max-Age: 1000');
		// header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

		$username = $this->post('username');
		$password = $this->post('password');

		$this->db->select('username,password,nama,admin_id,status');
		$this->db->from('admin');

		$this->db->where('username', $username);
		$this->db->where('password', md5($password));
		$query = $this->db->get();
		$result = $query->row();

		if ($result != null) {

			$this->response([
				'status' => true,
				'username' => $result->username,
				'nama' => $result->nama,
				'kode'=>$result->admin_id,
				'stats'=>$result->status,
				'message' => 'Welcome back!',
			], RestController::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'data' => [],
				'message' => 'BAD REQUEST. USERNAME OR PASSWORD INVALID!',
			], RestController::HTTP_BAD_REQUEST);
		}
	}

	public function dataProjectAdmin_get()
    {
        $id = $this->get('id');
        if (is_null($id)) {
            $project = $this->db->get('project')->result();
        } else {
            $this->db->where('project_id', $id);
            $project = $this->db->get('project')->result();
        }
		$this->response( $project, RestController::HTTP_OK );
    }

	//endpoint untuk menampilkan data catatan tambahan dari admin
	public function getCatatanAdmin_get()
	{
		$data = $this->CatatanTambahan_Model->getDataCatatan();
		$this->response($data, RestController::HTTP_OK);
	}

	//endopoint untuk menampilkan data karyawawn yang ada
	public function getKaryawanAdmin_get(){
		 $id = $this->get('id');
        if (is_null($id)) {
            $karyawan = $this->db->get('karyawan')->result();
        } else {
            $this->db->where('karyawan_id', $id);
            $karyawan = $this->db->get('karyawan')->result();
        }
		$this->response( $karyawan, RestController::HTTP_OK );

	}

	//endpoint untuk menampilkan data pembayaran karyawan oleh admin
	public function getPembyaranAdmin_get(){
		$data = $this->Pembayaran_Model->getData();
		$this->response($data, RestController::HTTP_OK);
	}

	//endpoint untuk menampilkan data feedback oleh admin
	public function getDataFeedbackAdmin_get(){
		 $id = $this->get('id');
        if (is_null($id)) {
            $data = $this->db->get('feedback')->result();
        } else {
            $this->db->where('project_id', $id);
            $data = $this->db->get('feedback')->result();
        }
		$this->response( $data, RestController::HTTP_OK );
	}


	/*API karyawan */

	//endpoint untuk login karyawan
	public function loginKaryawan_post()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Credentials: true");
		header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
		header('Access-Control-Max-Age: 1000');
		// header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

		$nama = $this->post('nama');
		$email = $this->post('email');

		$this->db->select('nama,email,nama,karyawan_id,status');
		$this->db->from('admin');

		$this->db->where('nama', $nama);
		$this->db->where('email', $email);
		$query = $this->db->get();
		$result = $query->row();

		if ($result != null) {

			$this->response([
				'status' => true,
				'nama' => $result->nama,
				'kode'=>$result->karyawan_id,
				'stats'=>$result->status,
				'message' => 'Welcome back!',
			], RestController::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'data' => [],
				'message' => 'BAD REQUEST. NAMA OR EMAIL INVALID!',
			], RestController::HTTP_BAD_REQUEST);
		}
	}

}
