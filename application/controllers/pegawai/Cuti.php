<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cuti extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		// check_login();
		$this->load->model('pegawai/M_Cuti');
	}

	//membuat method function index untuk menampilkan data
	//riwayatcuti
	public function cutiSakit()
	{
		$data['title']          = 'Data Cuti <= 14 Hari';
		$user = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
		$data['cutiSakit']	= $this->M_Cuti->cutiSakit($user->kode_pegawai);
		$data['session'] = $this->session->userdata('nama');
		$data['user']   = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
		$this->load->view('theme_pegawai/header', $data);
		$this->load->view('pegawai/daftar_cuti/cuti_sakit', $data);
		$this->load->view('theme_pegawai/footer', $data);
	}

	public function cutiSakit14()
	{
		$data['title']          = 'Data Cuti > 14 Hari';
		$user = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
		$data['cutiSakit14']	= $this->M_Cuti->cutiSakit14($user->kode_pegawai);
		$data['session'] = $this->session->userdata('nama');
		$data['user']   = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
		$this->load->view('theme_pegawai/header', $data);
		$this->load->view('pegawai/daftar_cuti/cuti_sakit14', $data);
		$this->load->view('theme_pegawai/footer', $data);
	}

	public function cutiMelahirkan()
	{
		$data['title']          = 'Data Cuti';
		$user = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
		$data['cutiMelahirkan']	= $this->M_Cuti->cutiMelahirkan($user->kode_pegawai);
		$data['session'] = $this->session->userdata('nama');
		$data['user']   = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
		$this->load->view('theme_pegawai/header', $data);
		$this->load->view('pegawai/daftar_cuti/cuti_melahirkan', $data);
		$this->load->view('theme_pegawai/footer', $data);
	}

	public function cutiAlasanPenting()
	{
		$data['title']          = 'Data Cuti';
		$user = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
		$data['cutiAlasanPenting']	= $this->M_Cuti->cutiAlasanPenting($user->kode_pegawai);
		$data['session'] = $this->session->userdata('nama');
		$data['user']   = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
		$this->load->view('theme_pegawai/header', $data);
		$this->load->view('pegawai/daftar_cuti/alasan_penting', $data);
		$this->load->view('theme_pegawai/footer', $data);
	}

	// public function cutiBesar()
	// {
	// 	$data['title']          = 'Data Cuti';
	// 	$user = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
	// 	$data['cutiBesar']	= $this->M_Cuti->cutiBesar($user->kode_pegawai);
	// 	$data['session'] = $this->session->userdata('nama');
	// 	$data['user']   = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
	// 	$this->load->view('theme_pegawai/header', $data);
	// 	$this->load->view('pegawai/daftar_cuti/cuti_besar', $data);
	// 	$this->load->view('theme_pegawai/footer', $data);
	// }

	// public function cutiTahunan()
	// {
	// 	$data['title']          = 'Data Cuti';
	// 	$user = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
	// 	$data['cutiTahunan']	= $this->M_Cuti->cutiTahunan($user->kode_pegawai);
	// 	$data['session'] = $this->session->userdata('nama');
	// 	$data['user']   = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
	// 	$this->load->view('theme_pegawai/header', $data);
	// 	$this->load->view('pegawai/daftar_cuti/cuti_tahunan', $data);
	// 	$this->load->view('theme_pegawai/footer', $data);
	// }

	// public function cutiDiluarTN()
	// {
	// 	$data['title']          = 'Data Cuti';
	// 	$user = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
	// 	$data['cutiDiluarTN']	= $this->M_Cuti->cutiDiluarTN($user->kode_pegawai);
	// 	$data['session'] = $this->session->userdata('nama');
	// 	$data['user']   = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
	// 	$this->load->view('theme_pegawai/header', $data);
	// 	$this->load->view('pegawai/daftar_cuti/cuti_diluartn', $data);
	// 	$this->load->view('theme_pegawai/footer', $data);
	// }

	//dashboard
	public function dataCutiSakit()
	{
		$data['title']          = 'Data Cuti Sakit';
		$data['cuti_sakit'] = $this->M_Cuti->dataCutiSakit();
		$data['user']   = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
		$this->load->view('theme_pegawai/header', $data);
		$this->load->view('pegawai/daftar_cuti/cuti_sakit', $data);
		$this->load->view('theme_pegawai/footer', $data);
	}

	public function dataCutiSakit14()
	{
		$data['title']          = 'Data Cuti Sakit';
		$data['cuti_sakit14'] = $this->M_Cuti->dataCutiSakit14();
		$data['user']   = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
		$this->load->view('theme_pegawai/header', $data);
		$this->load->view('pegawai/daftar_cuti/cuti_sakit14', $data);
		$this->load->view('theme_pegawai/footer', $data);
	}

	public function dataCutiMelahirkan()
	{
		$data['title']          = 'Data Cuti Melahirkan';
		$data['cuti_melahirkan'] = $this->M_Cuti->dataCutiMelahirkan();
		$data['user']   = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
		$this->load->view('theme_pegawai/header', $data);
		$this->load->view('pegawai/daftar_cuti/cuti_melahirkan', $data);
		$this->load->view('theme_pegawai/footer', $data);
	}

	public function dataCutiAlasanPenting()
	{
		$data['title']          = 'Data Cuti Alasan Penting';
		$data['cuti_alasanpenting'] = $this->M_Cuti->dataCutiAlasanPenting();
		$data['user']   = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
		$this->load->view('theme_pegawai/header', $data);
		$this->load->view('pegawai/daftar_cuti/alasan_penting', $data);
		$this->load->view('theme_pegawai/footer', $data);
	}

	// public function dataCutiBesar()
	// {
	// 	$data['title']          = 'Data Cuti Besar';
	// 	$data['cuti_besar'] = $this->M_Cuti->dataCutiBesar();
	// 	$data['user']   = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
	// 	$this->load->view('theme_pegawai/header', $data);
	// 	$this->load->view('pegawai/daftar_cuti/cuti_besar', $data);
	// 	$this->load->view('theme_pegawai/footer', $data);
	// }

	// public function dataCutiTahunan()
	// {
	// 	$data['title']          = 'Data Cuti Tahunan';
	// 	$data['cuti_tahunan'] = $this->M_Cuti->dataCutiTahunan();
	// 	$data['user']   = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
	// 	$this->load->view('theme_pegawai/header', $data);
	// 	$this->load->view('pegawai/daftar_cuti/cuti_tahunan', $data);
	// 	$this->load->view('theme_pegawai/footer', $data);
	// }

	// public function dataCutiDiluarTN()
	// {
	// 	$data['title']          = 'Data Cuti Diluar Tanggungan Negara';
	// 	$data['cuti_diluarTN'] = $this->M_Cuti->dataCutiDiluarTN();
	// 	$data['user']   = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
	// 	$this->load->view('theme_pegawai/header', $data);
	// 	$this->load->view('pegawai/daftar_cuti/cuti_diluartn', $data);
	// 	$this->load->view('theme_pegawai/footer', $data);
	// }
}
