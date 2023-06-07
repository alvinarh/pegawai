<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller Pimpinan
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

class Pimpinan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('api/user_model');
		$this->load->model('api/cuti_model');
		$this->load->library('dompdfgenerator');
		$this->load->model('api/auth_model', 'auth_model');
		$this->load->model('api/pimpinan_model', 'pimpinan_model');
	}

	public function getAllPengajuanCuti()
	{
		echo json_encode($this->cuti_model->getAllPengajuanCuti());
	}

	public function getAllPengajuanCutiByKeterangan()
	{
		$keterangan = $this->input->get('keterangan');
		echo json_encode($this->cuti_model->getAllPengajuanCutiByKeterangan($keterangan));
	}

	public function tolakCuti()
	{
		$userId = $this->input->post('user_id');
		$cutiId = $this->input->post('cuti_id');

		$dataUser = [
			'cuti' => 0,
			'status_pengajuan' => 2
		];

		$dataCuti = [
			'verifikasi' => 2
		];

		$trans = $this->cuti_model->keputusanCuti($cutiId, $dataCuti, $userId, $dataUser);
		if ($trans == true) {
			$response = [
				'status' => 200
			];
			echo json_encode($response);
		} else {
			$response = [
				'status' => 404
			];
			echo json_encode($response);
		}
	}

	public function setujuCuti()
	{
		$userId = $this->input->post('user_id');
		$cutiId = $this->input->post('cuti_id');

		$dataUser = [
			'cuti' => 1,
			'status_pengajuan' => 1
		];

		$dataCuti = [
			'verifikasi' => 1
		];

		$trans = $this->cuti_model->keputusanCuti($cutiId, $dataCuti, $userId, $dataUser);
		if ($trans == true) {
			$response = [
				'status' => 200
			];
			echo json_encode($response);
		} else {
			$response = [
				'status' => 404
			];
			echo json_encode($response);
		}
	}

	public function getMyProfile()
	{
		$userId = $this->input->get('user_id');
		echo json_encode($this->pimpinan_model->getMyProfile($userId));
	}

	public function editPhotoProfile()
	{
		$userId = $this->input->post('user_id');

		$config['upload_path']          = './assets/data/photo_profile/pimpinan/';
		// size 5mb
		$config['max_size']             = 5120;
		$config['allowed_types']        = 'png|jpg|jpeg';

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('foto')) {
			$response = [
				'status' => 404,
				'message' => 'Format file tidak sesuai'
			];
			echo json_encode($response);
		} else {

			$data = array('upload_data' => $this->upload->data());
			$file_name = $data['upload_data']['file_name'];

			$dataUser = [
				'foto' => $file_name,

			];

			$update = $this->pimpinan_model->update($userId, $dataUser);
			if ($update == true) {
				$response = [
					'status' => 200
				];
				echo json_encode($response);
			} else {
				$response = [
					'status' => 404,
					'message' => 'Gagal mengubah foto profil'
				];
				echo json_encode($response);
			}
		}
	}

	public function editProfile()
	{
		$email = $this->input->post('email');
		$userId = $this->input->post('user_id');

		$validateEmail = $this->auth_model->validateEMail($email, 'pimpinan');

		if ($validateEmail != null) {
			if ($validateEmail['kode_pimpinan'] == $userId) {

				$dataProfile = [
					'nama' => $this->input->post('nama'),
					'no_telp' => $this->input->post('no_telp'),
					'email' => $this->input->post('email'),
					'password' => $this->input->post('password'),
				];

				$update = $this->pimpinan_model->update($userId, $dataProfile);
				if ($update == true) {
					$response = [
						'status' => 200
					];
					echo json_encode($response);
				} else {
					$response = [
						'status' => 404,
						'message' => 'Gagal mengubah profil'

					];
					echo json_encode($response);
				}
			} else {
				$response = [
					'status' => 404,
					'message' => 'Email telah terdaftar'
				];

				echo json_encode($response);
			}
		} else {
			$dataProfile = [
				'nama' => $this->input->post('nama'),
				'no_telp' => $this->input->post('no_telp'),
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password'),
			];

			$update = $this->pimpinan_model->update($userId, $dataProfile);
			if ($update == true) {
				$response = [
					'status' => 200
				];
				echo json_encode($response);
			} else {
				$response = [
					'status' => 404,
					'message' => 'Gagal mengubah profil'
				];
				echo json_encode($response);
			}
		}
	}
}


/* End of file Pimpinan.php */
/* Location: ./application/controllers/Pimpinan.php */
