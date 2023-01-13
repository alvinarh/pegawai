<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pegawai extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		// check_login();
		$this->load->model('pegawai/M_Pegawai');
		$this->load->model('User_model');
		$this->load->library('form_validation');
		$this->load->helper('url','form');
	}

    public function index(){

		$data['title']          = 'Data Pegawai';
		$data['dataPegawai']	= $this->M_Pegawai->getDataPegawai();
		$data['user']   = $this->db->query('select * from user where nama_pegawai = "' . $_SESSION['pegawai'] . '"')->row();
		$this->load->view('theme_pegawai/header', $data);
		$this->load->view('pegawai/pegawai/daftar_pegawai',$data);
		$this->load->view('theme_pegawai/footer', $data);
	}

    public function tambah(){
			$this->form_validation->set_rules('nama','masukan Nama Pegawai','required');
			$data['jenis']=$this->M_Pegawai->selectJenisKel();
			if($this->form_validation->run() == FALSE){
				$data['title']  = 'Masukan Data Pegawai';
				// $data['project']=$this->Feedback_Model->selectIdProject();
				// get data nama user (untuk tampil di sidebar dan navbar)
			$data['user']   = $this->db->query('select * from user where nama_pegawai = "' . $_SESSION['pegawai'] . '"')->row();
			$this->load->view('theme_pegawai/header', $data);
            $this->load->view('pegawai/pegawai/tambah_pegawai',$data);
            $this->load->view('theme_pegawai/footer', $data);
			}else{
				$id_pegawai =$this->User_model->getIdPegawai();
					$data = array(
						'kode_pegawai' =>$id_pegawai,
                        'nama_pegawai'   => $this->input->post('nama'),
                        'alamat'    => $this->input->post('alamat'),
                        'jabatan' => $this->input->post('jabatan'),
                        'jenis_kel'=>$this->input->post('jenis_kel'),
                        'no_telp' => $this->input->post('notelp'),
                        'email' => $this->input->post('email'),
                        'status' => 1,
					);
					$this->db->insert('user', $data);

            // // Set message
            $this->session->set_flashdata('data_ditambahkan', 'Data berhasil ditambah');

            redirect('pegawai/Pegawai/index',$data);
			}
	}

	public function edit($id){
		// $id = $this->uri->segment(4);
		$this->form_validation->set_rules('nama','masukan Nama Pegawai','required');
		$data['dataPegawai']	= $this->M_Pegawai->getDataPegawai();
		$data['jenis']=$this->M_Pegawai->selectJenisKel();
		$data['status']=$this->M_Pegawai->selectStatusPegawai();
		if($this->form_validation->run() == FALSE){
			$data['title']  = 'Edit Pegawai';
			$data['data']	= $this->M_Pegawai->detailData($id);
			// get data nama user (untuk tampil di sidebar dan navbar)
			$data['user']   = $this->db->query('select * from user where username = "' . $_SESSION['username'] . '"')->row();
			// $data['edit_data'] = $this->Feedback_Model->editFeedback($id);
			$this->load->view('theme_pegawai/header', $data);
            $this->load->view('pegawai/pegawai/edit_pegawai',$data);
            $this->load->view('theme_pegawai/footer', $data);
		}else{
			$id_pegawai =$this->User_model->getIdPegawai();
					$data = array(
						'kode_pegawai' =>$id_pegawai,
                        'nama_pegawai'   => $this->input->post('nama'),
                        'alamat'    => $this->input->post('alamat'),
                        'jabatan' => $this->input->post('jabatan'),
                        'jenis_kel'=>$this->input->post('jenis_kel'),
                        'no_telp' => $this->input->post('notelp'),
                        'email' => $this->input->post('email'),
                        'status' => $this->input->post('status'),
					);

			$this->db->where('kode_pegawai',$id);
      		$this->db->update('user',$data);
			// redirect($_SERVER['HTTP_REFERER']);
			redirect('pegawai/Pegawai/index',$data);

     	}

	}

	//membuat function delete
	public function deletePegawai($id){
		$this->M_Pegawai->deleteDataPegawai($id);
		redirect(base_url('pegawai/Pegawai/index'));
	}

}