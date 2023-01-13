<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanCuti extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		// check_login();
		$this->load->model('pegawai/M_Laporan');
		$this->load->model('pegawai/M_Cuti');

		$this->load->library('dompdfgenerator');
		// if (!$this->session->userdata('pegawai') == true) {
		// 	redirect('User');
		// }
	}

	public function cutiSakit()
	{
		$data['title']          = 'Laporan Cuti Sakit < 14 Hari';
		$user = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
		$data['laporan_cutiSakit'] = $this->M_Laporan->dataCutiSakit($user->kode_pegawai);
		$data['user']   = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
		$this->load->view('theme_pegawai/header', $data);
		$this->load->view('pegawai/laporan_cuti/cuti_sakit', $data);
		$this->load->view('theme_pegawai/footer', $data);
	}

	public function laporanCutiSakit($id)
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

	public function cutiSakit14()
	{
		$data['title']          = 'Laporan Cuti Sakit > 14 Hari';
		$user = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
		$data['laporan_cutiSakit14'] = $this->M_Laporan->dataCutiSakit14($user->kode_pegawai);
		$data['user']   = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
		$this->load->view('theme_pegawai/header', $data);
		$this->load->view('pegawai/laporan_cuti/cuti_sakit14', $data);
		$this->load->view('theme_pegawai/footer', $data);
	}

	public function laporanCutiSakit14($id)
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

	public function cutiMelahirkan()
	{
		$data['title']          = 'Laporan Cuti Melahirkan';
		$user = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
		$data['laporan_cutiMelahirkan'] = $this->M_Laporan->dataCutiMelahirkan($user->kode_pegawai);
		$data['user']   = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
		$this->load->view('theme_pegawai/header', $data);
		$this->load->view('pegawai/laporan_cuti/cuti_melahirkan', $data);
		$this->load->view('theme_pegawai/footer', $data);
	}

	public function laporanCutiMelahirkan($id)
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

	public function cutiAlasanPenting()
	{
		$data['title']          = 'Laporan Cuti Alasan Penting';
		$user = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
		$data['laporan_cutiAlasanPenting'] = $this->M_Laporan->dataCutiAlasanPenting($user->kode_pegawai);
		$data['user']   = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
		$this->load->view('theme_pegawai/header', $data);
		$this->load->view('pegawai/laporan_cuti/alasan_penting', $data);
		$this->load->view('theme_pegawai/footer', $data);
	}

	public function laporanCutiAlasanPenting($id)
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

	// public function cutiBesar()
	// {
	// 	$data['title']          = 'Laporan Cuti Besar';
	// 	$user = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
	// 	$data['laporan_cutiBesar'] = $this->M_Laporan->dataCutiBesar($user->kode_pegawai);
	// 	$data['user']   = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
	// 	$this->load->view('theme_pegawai/header', $data);
	// 	$this->load->view('pegawai/laporan_cuti/cuti_besar', $data);
	// 	$this->load->view('theme_pegawai/footer', $data);
	// }

	// public function laporanCutiBesar()
	// {
	// 	$this->data['title_pdf']    = 'Surat Cuti Besar';
	// 	$user = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
	// 	$this->data['row']           =  $this->M_Cuti->cetakCutiBesar($user->kode_pegawai);

	// 	// filename dari pdf ketika didownload
	// 	$file_pdf = 'Surat Cuti Besar';
	// 	// setting paper
	// 	$paper = 'A4';
	// 	//orientasi paper potrait / landscape
	// 	$orientation = "portrait";

	// 	$html = $this->load->view('pegawai/laporan_cuti/laporan_besar', $this->data, true);

	// 	// run dompdf
	// 	$this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
	// }

	// public function cutiTahunan()
	// {
	// 	$data['title']          = 'Laporan Cuti Tahunan';
	// 	$user = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
	// 	$data['laporan_cutiTahunan'] = $this->M_Laporan->dataCutiTahunan($user->kode_pegawai);
	// 	$data['user']   = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
	// 	$this->load->view('theme_pegawai/header', $data);
	// 	$this->load->view('pegawai/laporan_cuti/cuti_tahunan', $data);
	// 	$this->load->view('theme_pegawai/footer', $data);
	// }

	// public function laporanCutiTahunan()
	// {
	// 	$this->data['title_pdf']    = 'Surat Cuti Tahunan';
	// 	$user = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
	// 	$this->data['row']           =  $this->M_Cuti->cetakCutiTahunan($user->kode_pegawai);

	// 	// filename dari pdf ketika didownload
	// 	$file_pdf = 'Surat Cuti Tahunan';
	// 	// setting paper
	// 	$paper = 'A4';
	// 	//orientasi paper potrait / landscape
	// 	$orientation = "portrait";

	// 	$html = $this->load->view('pegawai/laporan_cuti/laporan_tahunan', $this->data, true);

	// 	// run dompdf
	// 	$this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
	// }


	// public function cutiDiluarTN()
	// {
	// 	$data['title']          = 'Laporan Cuti Diluar Tanggungan Negara';
	// 	$user = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
	// 	$data['laporan_cutiDiluarTN'] = $this->M_Laporan->dataCutiMelahirkan($user->kode_pegawai);
	// 	$data['user']   = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
	// 	$this->load->view('theme_pegawai/header', $data);
	// 	$this->load->view('pegawai/laporan_cuti/cuti_diluartn', $data);
	// 	$this->load->view('theme_pegawai/footer', $data);
	// }

	// public function laporanCutiDiluarTN()
	// {
	// 	$this->data['title_pdf']    = 'Surat Cuti Diluar Tanggungan Negara';
	// 	$user = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
	// 	$this->data['row']           =  $this->M_Cuti->cetakCutiDiluarTN($user->kode_pegawai);

	// 	// filename dari pdf ketika didownload
	// 	$file_pdf = 'Surat Cuti Diluar Tanggungan Negara';
	// 	// setting paper
	// 	$paper = 'A4';
	// 	//orientasi paper potrait / landscape
	// 	$orientation = "portrait";

	// 	$html = $this->load->view('pegawai/laporan_cuti/laporan_diluartn', $this->data, true);

	// 	// run dompdf
	// 	$this->dompdfgenerator->generate($html, $file_pdf, $paper, $orientation);
	// }
}
