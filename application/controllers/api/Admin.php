<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller Admin
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

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('api/user_model');
		$this->load->model('api/cuti_model');
		$this->load->model('');

		$this->load->library('dompdfgenerator');
		$this->load->model('api/auth_model', 'auth_model');
		$this->load->model('api/admin_model', 'admin_model');
		$this->load->model('api/pimpinan_model', 'pimpinan_model');
	}

	public function getMyProfile()
	{
		$userId = $this->input->get('user_id');
		echo json_encode($this->admin_model->getMyProfile($userId));
	}

	public function getAllUser()
	{
		echo json_encode($this->user_model->getAllUser());
	}

	public function getAllUserTidakPernahCuti()
	{
		echo json_encode($this->user_model->getPegawaiTidakPernahCuti());
	}

	public function getAllTotalPengajuanCuti()
	{
		$keterangan = $this->input->get('keterangan');
		echo json_encode($this->cuti_model->getAllTotalPengajuanCuti($keterangan));
	}

	public function insertPegawai()
	{
		$id_pegawai = $this->user_model->getIdPegawai();
		$email = $this->input->post('email');
		$validateEmail = $this->auth_model->validateEMail($email, 'user');

		if ($validateEmail != null) {
			$response = [
				'status' => 404,
				'message' => 'Email telah terdaftar'
			];
			echo json_encode($response);
		} else {
			$dataProfile = [
				'kode_pegawai' => $id_pegawai,
				'nik'   => $this->input->post('nik'),
				'nama'   => $this->input->post('nama'),
				'alamat'    => $this->input->post('alamat'),
				'jabatan' => $this->input->post('jabatan'),
				'jenis_kel' => $this->input->post('jenis_kel'),
				'no_telp' => $this->input->post('notelp'),
				'email' => $this->input->post('email'),
				'status' => 'Aktif',
				'password' => $this->input->post('password'),
				'role' => 3,
			];

			$insert = $this->user_model->insertPegawai($dataProfile);
			if ($insert == true) {
				$response = [
					'status' => 200
				];
				echo json_encode($response);
			} else {
				$response = [
					'status' => 404,
					'message' => 'Gagal menambahkan pegawai baru'
				];
				echo json_encode($response);
			}
		}
	}


	public function editPegawai()
	{
		$email = $this->input->post('email');
		$userId = $this->input->post('user_id');
		$status = $this->input->post('status');

		$validateEmail = $this->auth_model->validateEMail($email, 'user');

		if ($validateEmail != null) {
			if ($validateEmail['kode_pegawai'] == $userId) {
				if ($status == 'Keluar') {
					$dataProfile = [
						'nik'   => $this->input->post('nik'),
						'nama'   => $this->input->post('nama'),
						'alamat'    => $this->input->post('alamat'),
						'jabatan' => '',
						'jenis_kel' => $this->input->post('jenis_kel'),
						'no_telp' => $this->input->post('notelp'),
						'email' => $this->input->post('email'),
						'status' => $status,
					];
				} else {
					$dataProfile = [
						'nik'   => $this->input->post('nik'),
						'nama'   => $this->input->post('nama'),
						'alamat'    => $this->input->post('alamat'),
						'jabatan' => $this->input->post('jabatan'),
						'jenis_kel' => $this->input->post('jenis_kel'),
						'no_telp' => $this->input->post('notelp'),
						'email' => $this->input->post('email'),
						'status' => $status,
					];
				}




				$update = $this->user_model->updateUser($userId, $dataProfile);
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
			if ($status == 'Keluar') {
				$dataProfile = [
					'nik'   => $this->input->post('nik'),
					'nama'   => $this->input->post('nama'),
					'alamat'    => $this->input->post('alamat'),
					'jabatan' => '',
					'jenis_kel' => $this->input->post('jenis_kel'),
					'no_telp' => $this->input->post('notelp'),
					'email' => $this->input->post('email'),
					'status' => $status,
				];
			} else {
				$dataProfile = [
					'nik'   => $this->input->post('nik'),
					'nama'   => $this->input->post('nama'),
					'alamat'    => $this->input->post('alamat'),
					'jabatan' => $this->input->post('jabatan'),
					'jenis_kel' => $this->input->post('jenis_kel'),
					'no_telp' => $this->input->post('notelp'),
					'email' => $this->input->post('email'),
					'status' => $status,
				];
			}



			$update = $this->user_model->updateUser($userId, $dataProfile);
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

	public function deleteUser()
	{
		$userId = $this->input->post('user_id');
		$delete = $this->user_model->deleteUser($userId);
		if ($delete == true) {
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

	public function getAllPengajuanCutiAdminKeterangan()
	{
		$keterangan = $this->input->get('keterangan');
		echo json_encode($this->cuti_model->getAllPengajuanCutiAdminKeterangan($keterangan));
	}

	public function getAllPengajuanCutiAdminSelesai()
	{
		$keterangan = $this->input->get('keterangan');

		echo json_encode($this->cuti_model->getAllPengajuanCutiAdminSelesai($keterangan));
	}

	public function editMyProfile()
	{
		$userId = $this->input->post('user_id');
		$data = [
			'email' => $this->input->post('email'),
			'nama' => $this->input->post('nama'),
			'password' => $this->input->post('password'),
		];

		$update = $this->admin_model->edit($userId, $data);
		if ($update == true) {
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

	public function editPhotoProfile()
	{
		$userId = $this->input->post('user_id');

		$config['upload_path']          = './assets/data/photo_profile/admin/';
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

			$update = $this->admin_model->edit($userId, $dataUser);
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
}


/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */
