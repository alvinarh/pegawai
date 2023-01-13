<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanCuti extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		// check_login();
		$this->load->model('pimpinan/M_Laporan');
		$this->load->model('pimpinan/M_Cuti');
		$this->load->library('dompdfgenerator');

		// if (!$this->session->userdata('pimpinan') == true) {
		// 	redirect('User');
		// }

	}

	public function cutiSakit()
	{
		$data['title']          = 'Laporan Cuti Sakit <= 14 Hari';
		$data['cuti_sakit'] = $this->M_Laporan->dataCutiSakit();
		$data['session']   = $this->session->userdata('nama');
		$data['user']   = $this->db->query('select * from pimpinan where nama = "' . $_SESSION['nama'] . '"')->row();
		$this->load->view('theme_pimpinan/header', $data);
		$this->load->view('pimpinan/laporan_cuti/cuti_sakit', $data);
		$this->load->view('theme_pimpinan/footer', $data);
	}

	public function editCuti($id)
	{
		$data['id'] = $id;
		$this->db->set('verifikasi', $this->input->post('verifikasi'));
		$this->db->set('keterangan', $this->input->post('keterangan'));
		$this->db->where('id_cuti', $id);
		$this->db->update('permohonan_cuti');
		$this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Menu Berhasil Diubah!</div>');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function cutiSakit14()
	{
		$data['title']          = 'Laporan Cuti Sakit > 14 Hari';
		$data['cuti_sakit14'] = $this->M_Laporan->dataCutiSakit14();
		$data['session']   = $this->session->userdata('nama');
		$data['user']   = $this->db->query('select * from pimpinan where nama = "' . $_SESSION['nama'] . '"')->row();
		$this->load->view('theme_pimpinan/header', $data);
		$this->load->view('pimpinan/laporan_cuti/cuti_sakit14', $data);
		$this->load->view('theme_pimpinan/footer', $data);
	}


	public function cutiMelahirkan()
	{
		$data['title']          = 'Laporan Cuti Melahirkan';
		$data['cuti_melahirkan'] = $this->M_Laporan->dataCutiMelahirkan();
		$data['session']   = $this->session->userdata('nama');
		$data['user']   = $this->db->query('select * from pimpinan where nama = "' . $_SESSION['nama'] . '"')->row();
		$this->load->view('theme_pimpinan/header', $data);
		$this->load->view('pimpinan/laporan_cuti/cuti_melahirkan', $data);
		$this->load->view('theme_pimpinan/footer', $data);
	}

	public function cutiAlasanPenting()
	{
		$data['title']          = 'Laporan Cuti Alasan Penting';
		$data['cuti_alasanpenting'] = $this->M_Laporan->dataCutiAlasanPenting();
		$data['session']   = $this->session->userdata('nama');
		$data['user']   = $this->db->query('select * from pimpinan where nama = "' . $_SESSION['nama'] . '"')->row();
		$this->load->view('theme_pimpinan/header', $data);
		$this->load->view('pimpinan/laporan_cuti/alasan_penting', $data);
		$this->load->view('theme_pimpinan/footer', $data);
	}

	// public function cutiBesar()
	// {
	// 	$data['title']          = 'Laporan Cuti Besar';
	// 	$data['cuti_besar'] = $this->M_Laporan->dataCutiBesar();
	// 	$data['session']   = $this->session->userdata('nama');
	// 	$data['user']   = $this->db->query('select * from pimpinan where nama = "' . $_SESSION['nama'] . '"')->row();
	// 	$this->load->view('theme_pimpinan/header', $data);
	// 	$this->load->view('pimpinan/laporan_cuti/cuti_besar', $data);
	// 	$this->load->view('theme_pimpinan/footer', $data);
	// }

	// public function cutiTahunan()
	// {
	// 	$data['title']          = 'Laporan Cuti Tahunan';
	// 	$data['cuti_tahunan'] = $this->M_Laporan->dataCutiTahunan();
	// 	$data['session']   = $this->session->userdata('nama');
	// 	$data['user']   = $this->db->query('select * from pimpinan where nama = "' . $_SESSION['nama'] . '"')->row();
	// 	$this->load->view('theme_pimpinan/header', $data);
	// 	$this->load->view('pimpinan/laporan_cuti/cuti_tahunan', $data);
	// 	$this->load->view('theme_pimpinan/footer', $data);
	// }

	// public function cutiDiluarTN()
	// {
	// 	$data['title']          = 'Laporan Cuti Diluar Tanggungan Negara';
	// 	$data['cuti_diluarTN'] = $this->M_Laporan->dataCutiDiluarTN();
	// 	$data['session']   = $this->session->userdata('nama');
	// 	$data['user']   = $this->db->query('select * from pimpinan where nama = "' . $_SESSION['nama'] . '"')->row();
	// 	$this->load->view('theme_pimpinan/header', $data);
	// 	$this->load->view('pimpinan/laporan_cuti/cuti_diluartn', $data);
	// 	$this->load->view('theme_pimpinan/footer', $data);
	// }
}
