<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pegawai extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		// check_login();
		$this->load->model('pegawai/M_Pegawai');
		$this->load->model('User_model');
		$this->load->model('pegawai/M_Pegawai', 'pegawai');
		$this->load->library('form_validation');
		$this->load->helper('url','form');
	}

	public function editprofil()
    {
		$data['title'] = 'Edit Profil' ;
        $data['dataPegawai']	= $this->M_Pegawai->getDataPegawai();
		$data['session'] = $this->session->userdata('nama');
		$id = $this->session->userdata('userid');
		// $data['user']   = $this->db->query('select * from user where nama = "' . $_SESSION['pegawai'] . '"')->row();
		$data['data'] = $this->pegawai->getPegawaiByEdit($id);

        $this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('nik', 'NIK', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('notelp', 'No Telepon', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('theme_pegawai/header', $data);
            $this->load->view('pegawai/editprofile', $data);
            $this->load->view('theme_pegawai/footer', $data);
        } else {

            $data['user'] = $this->pegawai->editProfil();
            $this->session->set_flashdata('success', 'Diubah!');
            redirect('user/logout');
        }
    }

    public function index(){

		$data['title']          = 'Data Pegawai';
		$data['dataPegawai']	= $this->M_Pegawai->getDataPegawai();
		$data['user']   = $this->db->query('select * from user where nama = "' . $_SESSION['pegawai'] . '"')->row();
		$this->load->view('theme_pegawai/header', $data);
		$this->load->view('pegawai/pegawai/daftar_pegawai',$data);
		$this->load->view('theme_pegawai/footer', $data);
	}

	//membuat function delete
	public function deletePegawai($id){
		$this->M_Pegawai->deleteDataPegawai($id);
		redirect(base_url('pegawai/Pegawai/index'));
	}

}