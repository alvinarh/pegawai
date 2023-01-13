<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanCuti extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		// check_login();
		$this->load->model('admin/M_Laporan');
		$this->load->model('admin/M_Cuti');
	}

	public function cutiSakit()
	{
		$data['title'] = 'Laporan Cuti Sakit < 14 Hari';
		$data['cuti_sakit'] = $this->M_Laporan->dataCutiSakit();
		$data['user']   = $this->db->query('select * from admin where nama = "' . $_SESSION['nama'] . '"')->row();
		$this->load->view('theme_admin/header', $data);
		$this->load->view('admin/laporan_cuti/cuti_sakit', $data);
		$this->load->view('theme_admin/footer', $data);
	}

	public function cutiSakit14()
	{
		$data['title'] = 'Laporan Cuti Sakit > 14 Hari';
		$data['cuti_sakit14'] = $this->M_Laporan->dataCutiSakit14();
		$data['user']   = $this->db->query('select * from admin where nama = "' . $_SESSION['nama'] . '"')->row();
		$this->load->view('theme_admin/header', $data);
		$this->load->view('admin/laporan_cuti/cuti_sakit14', $data);
		$this->load->view('theme_admin/footer', $data);
	}

	public function cutiMelahirkan()
	{
		$data['title']          = 'Laporan Cuti Melahirkan';
		$data['cuti_melahirkan'] = $this->M_Laporan->dataCutiMelahirkan();
		$data['user']   = $this->db->query('select * from admin where nama = "' . $_SESSION['nama'] . '"')->row();
		$this->load->view('theme_admin/header', $data);
		$this->load->view('admin/laporan_cuti/cuti_melahirkan', $data);
		$this->load->view('theme_admin/footer', $data);
	}

	public function cutiAlasanPenting()
	{
		$data['title']          = 'Laporan Cuti Alasan Penting';
		$data['cuti_alasanpenting'] = $this->M_Laporan->dataCutiAlasanPenting();
		$data['user']   = $this->db->query('select * from admin where nama = "' . $_SESSION['nama'] . '"')->row();
		$this->load->view('theme_admin/header', $data);
		$this->load->view('admin/laporan_cuti/alasan_penting', $data);
		$this->load->view('theme_admin/footer', $data);
	}

// 	public function cutiBesar()
// 	{
// 		$data['title']          = 'Laporan Cuti Besar';
// 		$data['cuti_besar'] = $this->M_Laporan->dataCutiBesar();
// 		$data['user']   = $this->db->query('select * from admin where nama = "' . $_SESSION['nama'] . '"')->row();
// 		$this->load->view('theme_admin/header', $data);
// 		$this->load->view('admin/laporan_cuti/cuti_besar', $data);
// 		$this->load->view('theme_admin/footer', $data);
// 	}

// 	public function cutiTahunan()
// 	{
// 		$data['title']          = 'Laporan Cuti Tahunan';
// 		$data['cuti_tahunan'] = $this->M_Laporan->dataCutiTahunan();
// 		$data['user']   = $this->db->query('select * from admin where nama = "' . $_SESSION['nama'] . '"')->row();
// 		$this->load->view('theme_admin/header', $data);
// 		$this->load->view('admin/laporan_cuti/cuti_tahunan', $data);
// 		$this->load->view('theme_admin/footer', $data);
// 	}

// 	public function cutiDiluarTN()
// 	{
// 		$data['title']          = 'Laporan Cuti Diluar Tanggungan Negara';
// 		$data['cuti_diluarTN'] = $this->M_Laporan->dataCutiDiluarTN();
// 		$data['user']   = $this->db->query('select * from admin where nama = "' . $_SESSION['nama'] . '"')->row();
// 		$this->load->view('theme_admin/header', $data);
// 		$this->load->view('admin/laporan_cuti/cuti_diluartn', $data);
// 		$this->load->view('theme_admin/footer', $data);
// 	}

}
