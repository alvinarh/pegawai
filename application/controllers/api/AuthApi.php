<?php
defined('BASEPATH') or exit('No direct script access allowed');



class AuthApi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api/Auth_model', 'auth_model');
	}

	public function login()
	{

		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$pegawai = $this->auth_model->auth($email, $password, 'user');
		$pimpinan =  $this->auth_model->auth2($email, $password, 'pimpinan');
		$admin =  $this->auth_model->auth2($email, $password, 'admin');

		if ($pegawai != null) {
			$response = [
				'code' => 200,
				'user_id' => $pegawai['kode_pegawai'],
				'nama' => $pegawai['nama'],
				'role' => 3,
				'jabatan' => $pegawai['jabatan'],
			];
			echo json_encode($response);
		} else if ($pimpinan != null) {
			$response = [
				'code' => 200,
				'user_id' => $pimpinan['kode_pimpinan'],
				'nama' => $pimpinan['nama'],
				'role' => 2,
				'jabatan' => $pimpinan['jabatan'],
			];
			echo json_encode($response);
		} else if ($admin != null) {
			$response = [
				'code' => 200,
				'user_id' => $admin['id_admin'],
				'nama' => $admin['nama'],
				'role' => 1,
			];
			echo json_encode($response);
		} else {
			$response = [
				'code' => 404,
				'status' => false,
				'message' => 'Username atau password salah'
			];
			echo json_encode($response);
		}
	}
}


/* End of file AuthApi.php */
/* Location: ./application/controllers/AuthApi.php */
