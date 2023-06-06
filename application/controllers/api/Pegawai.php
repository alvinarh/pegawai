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
}
