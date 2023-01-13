<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		// check_login();
		$this->load->model('pegawai/M_Cuti');
		$this->load->model('pegawai/M_Pegawai');
	}

	public function index()
	{
		$data['title']  = 'Dashboard';
		$user = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
		$data['session'] = $this->session->userdata('nama');
		$id = $this->session->userdata('userid');
		$data['total_pegawai'] = $this->db->get("user")->num_rows();
		$data['cuti_sakit'] = $this->M_Cuti->dataCutiSakit($id);
        $data['cuti_sakit14'] = $this->M_Cuti->dataCutiSakit14($id);
		$data['cuti_melahirkan'] = $this->M_Cuti->dataCutiMelahirkan($id);
		$data['cuti_alasanpenting'] = $this->M_Cuti->dataCutiAlasanPenting($id);

		// get data nama user (untuk tampil di sidebar dan navbar)
		$data['user']   = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();

		$this->load->view('theme_pegawai/header', $data);
		$this->load->view('pegawai/dashboard', $data);
		$this->load->view('theme_pegawai/footer', $data);
	}
}
