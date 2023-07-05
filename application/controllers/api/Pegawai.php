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
		$this->load->library('dompdfgenerator');
		$this->load->model('api/auth_model', 'auth_model');
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

	public function downloadLaporanCutiSakit($id)
	{
		$this->data['title_pdf']    = 'Surat Cuti Sakit <= 14 Hari';
		$query = "SELECT u.*, pc.* FROM user u, permohonan_cuti pc WHERE u.kode_pegawai=pc.kode_pegawai and pc.id_cuti='" . $id . "'";
		$this->data['row'] = $this->db->query($query)->row_array();

		// filename dari pdf ketika didownload
		$file_pdf = 'Surat Cuti Sakit <= 14 Hari';
		// setting paper
		$paper = 'A4';
		//orientasi paper potrait / landscape
		$orientation = "portrait";

		$html = $this->load->view('pegawai/laporan_cuti/laporan_cutisakit', $this->data, true);

		// run dompdf
		$this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
	}

	public function downloadLaporanCutiSakit14($id)
	{
		$this->data['title_pdf']    = 'Surat Cuti Sakit > 14 Hari';
		$query = "SELECT u.*, pc.* FROM user u, permohonan_cuti pc WHERE u.kode_pegawai=pc.kode_pegawai and pc.id_cuti='" . $id . "'";
		$this->data['row'] = $this->db->query($query)->row_array();

		// filename dari pdf ketika didownload
		$file_pdf = 'Surat Cuti Sakit > 14 Hari';
		// setting paper
		$paper = 'A4';
		//orientasi paper potrait / landscape
		$orientation = "portrait";

		$html = $this->load->view('pegawai/laporan_cuti/laporan_cutisakit14', $this->data, true);

		// run dompdf
		$this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
	}

	public function downloadLaporanCutiMelahirkan($id)
	{
		$data['title_pdf']    = 'Surat Cuti Melahirkan';
		$query = "SELECT u.*, pc.* FROM user u, permohonan_cuti pc WHERE u.kode_pegawai=pc.kode_pegawai and pc.id_cuti='" . $id . "'";
		$this->data['row'] = $this->db->query($query)->row_array();

		// filename dari pdf ketika didownload
		$file_pdf = 'Surat Cuti Melahirkan';
		// setting paper
		$paper = 'A4';
		//orientasi paper potrait / landscape
		$orientation = "portrait";

		$html = $this->load->view('pegawai/laporan_cuti/laporan_melahirkan', $this->data, true);

		// run dompdf
		$this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
	}

	public function downloadLaporanCutiPenting($id)
	{
		$this->data['title_pdf']    = 'Surat Cuti Alasan Penting';
		$query = "SELECT u.*, pc.* FROM user u, permohonan_cuti pc WHERE u.kode_pegawai=pc.kode_pegawai and pc.id_cuti='" . $id . "'";
		$this->data['row'] = $this->db->query($query)->row_array();

		// filename dari pdf ketika didownload
		$file_pdf = 'Surat Cuti Alasan Penting';
		// setting paper
		$paper = 'A4';
		//orientasi paper potrait / landscape
		$orientation = "portrait";

		$html = $this->load->view('pegawai/laporan_cuti/laporan_alasanpenting', $this->data, true);

		// run dompdf
		$this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
	}

	public function downloadSuratLampiranCutiPegawai($CutiId, $jenis)
	{
		if ($jenis == 'kurang') {
			$surat = $this->cuti_model->getCutiById($CutiId)['surat_dokter'];
		} else if ($jenis == 'lebih') {
			$surat = $this->cuti_model->getCutiById($CutiId)['surat_dokter14'];
		} else if ($jenis == 'melahirkan') {
			$surat = $this->cuti_model->getCutiById($CutiId)['surat_melahirkan'];
		} else if ($jenis == 'penting') {
			$surat = $this->cuti_model->getCutiById($CutiId)['surat_alasanpenting'];
		}

		$path = './assets/data/' . $surat;
		header('Content-Type: application/pdf');

		// Mengatur header untuk mengunduh file
		header('Content-Disposition: attachment; filename="' . basename($path) . '"');
		header('Content-Length: ' . filesize($path));

		// Membaca dan mengirimkan file ke pengguna
		readfile($path);
	}

	public function insertCutiMelahirkan()
	{
		$kodePegawai = $this->input->post('user_id');
		$tanggalCuti = $this->input->post('tgl_cuti');
		$tanggalSelesai = $this->input->post('tgl_selesai');

		$dataUser = $this->user_model->getUserById($kodePegawai);
		$nik = $dataUser['nik'];
		$nama = $dataUser['nama'];

		$config['upload_path']          = './assets/data/';
		// size 5mb
		$config['max_size']             = 5120;
		$config['allowed_types']        = 'pdf';

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('lampiran')) {
			$response = [
				'status' => 404,
				'message' => 'Format file tidak sesuai'
			];
			echo json_encode($response);
		} else {

			$data = array('upload_data' => $this->upload->data());
			$file_name = $data['upload_data']['file_name'];

			$dataUser = [
				'cuti' => 2,

			];

			$dataCuti = [
				'kode_pegawai' => $kodePegawai,
				'nik' => $nik,
				'nama' => $nama,
				'tanggal_pengajuan' => date('Y-m-d'),
				'mulai_cuti' => $tanggalCuti,
				'akhir_cuti' => $tanggalSelesai,
				'surat_melahirkan' => $file_name,
				'keterangan' => 'Cuti Melahirkan',
				'verifikasi' => 3,
				'status' => 0
			];

			$trans = $this->cuti_model->insertCuti($kodePegawai, $dataUser, $dataCuti);
			if ($trans == true) {
				$response = [
					'status' => 200
				];
				echo json_encode($response);
			} else {
				$response = [
					'status' => 404,
					'message' => 'Gagal mengajukan cuti'
				];
				echo json_encode($response);
			}
		}
	}

	public function insertCutiKurang14()
	{
		$kodePegawai = $this->input->post('user_id');
		$tanggalCuti = $this->input->post('tgl_cuti');
		$tanggalSelesai = $this->input->post('tgl_selesai');

		$dataUser = $this->user_model->getUserById($kodePegawai);
		$nik = $dataUser['nik'];
		$nama = $dataUser['nama'];

		$config['upload_path']          = './assets/data/';
		// size 5mb
		$config['max_size']             = 5120;
		$config['allowed_types']        = 'pdf';

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('lampiran')) {
			$response = [
				'status' => 404,
				'message' => 'Format file tidak sesuai'
			];
			echo json_encode($response);
		} else {

			$data = array('upload_data' => $this->upload->data());
			$file_name = $data['upload_data']['file_name'];

			$dataUser = [
				'cuti' => 2,

			];

			$dataCuti = [
				'kode_pegawai' => $kodePegawai,
				'nik' => $nik,
				'nama' => $nama,
				'tanggal_pengajuan' => date('Y-m-d'),
				'mulai_cuti' => $tanggalCuti,
				'perihal' => $this->input->post('perihal'),
				'akhir_cuti' => $tanggalSelesai,
				'surat_dokter' => $file_name,
				'keterangan' => 'Cuti Sakit < 14',
				'verifikasi' => 3,
				'status' => 0
			];

			$trans = $this->cuti_model->insertCuti($kodePegawai, $dataUser, $dataCuti);
			if ($trans == true) {
				$response = [
					'status' => 200
				];
				echo json_encode($response);
			} else {
				$response = [
					'status' => 404,
					'message' => 'Gagal mengajukan cuti'
				];
				echo json_encode($response);
			}
		}
	}

	public function insertCutiLebih14()
	{
		$kodePegawai = $this->input->post('user_id');
		$tanggalCuti = $this->input->post('tgl_cuti');
		$tanggalSelesai = $this->input->post('tgl_selesai');

		$dataUser = $this->user_model->getUserById($kodePegawai);
		$nik = $dataUser['nik'];
		$nama = $dataUser['nama'];

		$config['upload_path']          = './assets/data/';
		// size 5mb
		$config['max_size']             = 5120;
		$config['allowed_types']        = 'pdf';

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('lampiran')) {
			$response = [
				'status' => 404,
				'message' => 'Format file tidak sesuai'
			];
			echo json_encode($response);
		} else {

			$data = array('upload_data' => $this->upload->data());
			$file_name = $data['upload_data']['file_name'];

			$dataUser = [
				'cuti' => 2,

			];

			$dataCuti = [
				'kode_pegawai' => $kodePegawai,
				'nik' => $nik,
				'nama' => $nama,
				'tanggal_pengajuan' => date('Y-m-d'),
				'mulai_cuti' => $tanggalCuti,
				'perihal' => $this->input->post('perihal'),
				'akhir_cuti' => $tanggalSelesai,
				'surat_dokter' => $file_name,
				'keterangan' => 'Cuti Sakit > 14',
				'verifikasi' => 3,
				'status' => 0
			];

			$trans = $this->cuti_model->insertCuti($kodePegawai, $dataUser, $dataCuti);
			if ($trans == true) {
				$response = [
					'status' => 200
				];
				echo json_encode($response);
			} else {
				$response = [
					'status' => 404,
					'message' => 'Gagal mengajukan cuti'
				];
				echo json_encode($response);
			}
		}
	}

	public function insertCutiPenting()
	{
		$kodePegawai = $this->input->post('user_id');
		$tanggalCuti = $this->input->post('tgl_cuti');
		$tanggalSelesai = $this->input->post('tgl_selesai');

		$dataUser = $this->user_model->getUserById($kodePegawai);
		$nik = $dataUser['nik'];
		$nama = $dataUser['nama'];

		$config['upload_path']          = './assets/data/';
		// size 5mb
		$config['max_size']             = 5120;
		$config['allowed_types']        = 'pdf';

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('lampiran')) {
			$response = [
				'status' => 404,
				'message' => 'Format file tidak sesuai'
			];
			echo json_encode($response);
		} else {

			$data = array('upload_data' => $this->upload->data());
			$file_name = $data['upload_data']['file_name'];

			$dataUser = [
				'cuti' => 2,

			];

			$dataCuti = [
				'kode_pegawai' => $kodePegawai,
				'nik' => $nik,
				'nama' => $nama,
				'tanggal_pengajuan' => date('Y-m-d'),
				'mulai_cuti' => $tanggalCuti,
				'perihal' => $this->input->post('perihal'),
				'akhir_cuti' => $tanggalSelesai,
				'surat_alasanpenting' => $file_name,
				'keterangan' => 'Cuti Alasan Penting',
				'verifikasi' => 3,
				'status' => 0
			];

			$trans = $this->cuti_model->insertCuti($kodePegawai, $dataUser, $dataCuti);
			if ($trans == true) {
				$response = [
					'status' => 200
				];
				echo json_encode($response);
			} else {
				$response = [
					'status' => 404,
					'message' => 'Gagal mengajukan cuti'
				];
				echo json_encode($response);
			}
		}
	}

	public function getMyProfile()
	{
		$id = $this->input->get('id');
		echo json_encode($this->user_model->getUserById($id));
	}

	public function checkCutiAktif()
	{
		$dateNow = date('Y-m-d');
		$id = $this->input->get('id');
		$data = $this->cuti_model->checkCutiAktif($id);
		if ($data != null) {
			if ($dateNow >= $data['akhir_cuti']) {
				echo json_encode($data);
			} else {
			}
		} else {
		}
	}

	public function konfirmasiCutiSelesai()
	{
		$id  = $this->input->post('id');
		$dataCuti = [
			'status' => 1
		];

		$userId = $this->input->post('user_id');
		$dataUser = [
			'cuti' => 0
		];

		$trans = $this->cuti_model->konfirCutiSelesai($id, $dataCuti, $userId, $dataUser);
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

	public function dismissNotif()
	{
		$id = $this->input->post('user_id');
		$data = [
			'status_pengajuan' => 0
		];

		$update = $this->user_model->updateUser($id, $data);

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

	public function editProfile()
	{
		$email = $this->input->post('email');
		$userId = $this->input->post('user_id');

		$validateEmail = $this->auth_model->validateEMail($email, 'user');

		if ($validateEmail != null) {
			if ($validateEmail['kode_pegawai'] == $userId) {

				$dataProfile = [
					'nik' => $this->input->post('nik'),
					'nama' => $this->input->post('nama'),
					'alamat' => $this->input->post('alamat'),
					'no_telp' => $this->input->post('no_telp'),
					'email' => $this->input->post('email'),
					'password' => $this->input->post('password'),
				];

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
			$dataProfile = [
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'no_telp' => $this->input->post('no_telp'),
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password'),
			];

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

	public function getTotalCuti()
	{
		$userId = $this->input->get('user_id');
		$verifikasi = $this->input->get('verifikasi');
		echo json_encode($this->cuti_model->getCutiVerifikasi($userId, $verifikasi));
	}

	public function editPhotoProfile()
	{
		$userId = $this->input->post('user_id');

		$config['upload_path']          = './assets/data/photo_profile/pegawai/';
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

			$update = $this->user_model->updateUser($userId, $dataUser);
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

	function checkTotalCuti()
	{
		$kodePegawai = $this->input->get('kode_pegawai');
		$data = [
			'message' => $this->cuti_model->checkTotalCuti($kodePegawai)
		];
		echo json_encode($data);
	}

	function checkTotalCutiMelahirkan()
	{
		$kodePegawai = $this->input->get('kode_pegawai');
		$data = [
			'message' => $this->cuti_model->checkTotalCutiMelahirkan($kodePegawai)
		];
		echo json_encode($data);
	}
}
