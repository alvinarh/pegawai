<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cuti extends CI_Controller
{
    function __construct()
    { 
        parent::__construct();
		// check_login();
        $this->load->model('pimpinan/M_Cuti');

        // if(!$this->session->userdata('pimpinan') == true){
        //     redirect('User');
        // }
    }
 
    //membuat method function index untuk menampilkan data project
	
	//datacuti
	public function cutiSakit(){
		$data['title']          = 'Data Cuti <= 14 Hari';
		$data['session']   = $this->session->userdata('nama');
		// $user = $this->db->query('select * from pimpinan where nama = "' . $this->session->userdata('nama') . '"')->row();
		$data['cutiSakit']	= $this->M_Cuti->cutiSakit();
		$data['user']   = $this->db->query('select * from pimpinan where nama = "' . $this->session->userdata('nama') . '"')->row();
		$this->load->view('theme_pimpinan/header', $data);
		$this->load->view('pimpinan/daftar_cuti/cuti_sakit',$data);
		$this->load->view('theme_pimpinan/footer', $data);
	}

	public function cutiSakit14(){
		$data['title']          = 'Data Cuti > 14 Hari';
		$data['session']   = $this->session->userdata('nama');
		// $user = $this->db->query('select * from pimpinan where nama = "' . $this->session->userdata('nama') . '"')->row();
		$data['cutiSakit14']	= $this->M_Cuti->cutiSakit14();
		$data['user']   = $this->db->query('select * from pimpinan where nama = "' . $this->session->userdata('nama') . '"')->row();
		$this->load->view('theme_pimpinan/header', $data);
		$this->load->view('pimpinan/daftar_cuti/cuti_sakit14',$data);
		$this->load->view('theme_pimpinan/footer', $data);
	}

	public function cutiMelahirkan(){
		$data['title']          = 'Data Cuti';
		$data['session']   = $this->session->userdata('nama');
		// $user = $this->db->query('select * from pimpinan where nama = "' . $_SESSION['nama'] . '"')->row();
		$data['cutiMelahirkan']	= $this->M_Cuti->cutiMelahirkan();
		$data['user']   = $this->db->query('select * from pimpinan where nama = "' . $_SESSION['nama'] . '"')->row();
		$this->load->view('theme_pimpinan/header', $data);
		$this->load->view('pimpinan/daftar_cuti/cuti_melahirkan',$data);
		$this->load->view('theme_pimpinan/footer', $data);
	}

	public function cutiAlasanPenting(){
		$data['title']          = 'Data Cuti';
		$data['session']   = $this->session->userdata('nama');
		// $user = $this->db->query('select * from pimpinan where nama = "' . $_SESSION['nama'] . '"')->row();
		$data['cutiAlasanPenting']	= $this->M_Cuti->cutiAlasanPenting();
		$data['user']   = $this->db->query('select * from pimpinan where nama = "' . $_SESSION['nama'] . '"')->row();
		$this->load->view('theme_pimpinan/header', $data);
		$this->load->view('pimpinan/daftar_cuti/alasan_penting',$data);
		$this->load->view('theme_pimpinan/footer', $data);
	}

	// public function cutiBesar(){
	// 	$data['title']          = 'Data Cuti';
	// 	$data['session']   = $this->session->userdata('nama');
	// 	// $user = $this->db->query('select * from pimpinan where nama = "' . $_SESSION['nama'] . '"')->row();
	// 	$data['cutiBesar']	= $this->M_Cuti->cutiBesar();
	// 	$data['user']   = $this->db->query('select * from pimpinan where nama = "' . $_SESSION['nama'] . '"')->row();
	// 	$this->load->view('theme_pimpinan/header', $data);
	// 	$this->load->view('pimpinan/daftar_cuti/cuti_besar',$data);
	// 	$this->load->view('theme_pimpinan/footer', $data);
	// }

	// public function cutiTahunan(){
	// 	$data['title']          = 'Data Cuti';
	// 	$data['session']   = $this->session->userdata('nama');
	// 	// $user = $this->db->query('select * from pimpinan where nama = "' . $_SESSION['nama'] . '"')->row();
	// 	$data['cutiTahunan']	= $this->M_Cuti->cutiTahunan();
	// 	$data['user']   = $this->db->query('select * from pimpinan where nama = "' . $_SESSION['nama'] . '"')->row();
	// 	$this->load->view('theme_pimpinan/header', $data);
	// 	$this->load->view('pimpinan/daftar_cuti/cuti_tahunan',$data);
	// 	$this->load->view('theme_pimpinan/footer', $data);
	// }

	// public function cutiDiluarTN(){
	// 	$data['title']          = 'Data Cuti';
	// 	$data['session']   = $this->session->userdata('nama');
	// 	// $user = $this->db->query('select * from pimpinan where nama = "' . $_SESSION['nama'] . '"')->row();
	// 	$data['cutiDiluarTN']	= $this->M_Cuti->cutiDiluarTN();
	// 	$data['user']   = $this->db->query('select * from pimpinan where nama = "' . $_SESSION['nama'] . '"')->row();
	// 	$this->load->view('theme_pimpinan/header', $data);
	// 	$this->load->view('pimpinan/daftar_cuti/cuti_diluartn',$data);
	// 	$this->load->view('theme_pimpinan/footer', $data);
	// }

	//dashboard
	public function dataCutiSakit(){
		$data['title']          = 'Data Cuti Sakit';
		$data['cuti_sakit']	= $this->M_Cuti->dataCutiSakit();
		$data['user']   = $this->db->query('select * from pimpinan where nama = "' . $_SESSION['nama'] . '"')->row();
		$this->load->view('theme_pimpinan/header', $data);
		$this->load->view('pimpinan/daftar_cuti/cuti_sakit',$data);
		$this->load->view('theme_pimpinan/footer', $data);
	}

	public function dataCutiSakit14(){
		$data['title']          = 'Data Cuti Sakit';
		$data['cuti_sakit14']	= $this->M_Cuti->dataCutiSakit14();
		$data['user']   = $this->db->query('select * from pimpinan where nama = "' . $_SESSION['nama'] . '"')->row();
		$this->load->view('theme_pimpinan/header', $data);
		$this->load->view('pimpinan/daftar_cuti/cuti_sakit14',$data);
		$this->load->view('theme_pimpinan/footer', $data);
	}


	public function dataCutiMelahirkan(){
		$data['title']          = 'Data Cuti Melahirkan';
		$data['cuti_melahirkan']=$this->M_Cuti->dataCutiMelahirkan();
		$data['user']   = $this->db->query('select * from pimpinan where nama = "' . $_SESSION['nama'] . '"')->row();
		$this->load->view('theme_pimpinan/header', $data);
		$this->load->view('pimpinan/daftar_cuti/cuti_melahirkan',$data);
		$this->load->view('theme_pimpinan/footer', $data);
	}

	public function dataCutiAlasanPenting(){
		$data['title']          = 'Data Cuti Alasan Penting';
		$data['cuti_alasanpenting']=$this->M_Cuti->dataCutiAlasanPenting();
		$data['user']   = $this->db->query('select * from pimpinan where nama = "' . $_SESSION['nama'] . '"')->row();
		$this->load->view('theme_pimpinan/header', $data);
		$this->load->view('pimpinan/daftar_cuti/alasan_penting',$data);
		$this->load->view('theme_pimpinan/footer', $data);
	}

	// public function dataCutiBesar(){
	// 	$data['title']          = 'Data Cuti Besar';
	// 	$data['cuti_besar']=$this->M_Cuti->dataCutiBesar();
	// 	$data['user']   = $this->db->query('select * from pimpinan where nama = "' . $_SESSION['nama'] . '"')->row();
	// 	$this->load->view('theme_pimpinan/header', $data);
	// 	$this->load->view('pimpinan/daftar_cuti/cuti_besar',$data);
	// 	$this->load->view('theme_pimpinan/footer', $data);
	// }

	// public function dataCutiTahunan(){
	// 	$data['title']          = 'Data Cuti Tahunan';
	// 	$data['cuti_tahunan']=$this->M_Cuti->dataCutiTahunan();
	// 	$data['user']   = $this->db->query('select * from pimpinan where nama = "' . $_SESSION['nama'] . '"')->row();
	// 	$this->load->view('theme_pimpinan/header', $data);
	// 	$this->load->view('pimpinan/daftar_cuti/cuti_tahunan',$data);
	// 	$this->load->view('theme_pimpinan/footer', $data);
	// }

	// public function dataCutiDiluarTN(){
	// 	$data['title']          = 'Data Cuti Diluar Tanggungan Negara';
	// 	$data['cuti_diluarTN']=$this->M_Cuti->dataCutiDiluarTN();
	// 	$data['user']   = $this->db->query('select * from pimpinan where nama = "' . $_SESSION['nama'] . '"')->row();
	// 	$this->load->view('theme_pimpinan/header', $data);
	// 	$this->load->view('pimpinan/daftar_cuti/cuti_diluartn',$data);
	// 	$this->load->view('theme_pimpinan/footer', $data);
	// }

	public function edit($id){
		// $id = $this->uri->segment(4);
		$this->form_validation->set_rules('tgl_pengajuan','Pengajuan Cuti','required');
		$data['data_cuti']=$this->M_Cuti->getDataCutiDetail($id);
		$data['jenis']=$this->M_Cuti->getAllJenis();
		$data['select']=$this->M_Cuti->pilihKeteranganCuti();

		$data['nama']=$this->M_Cuti->getPimpinan();
		$data['pilih']=$this->M_Cuti->pilihIdPimpinan();
		if($this->form_validation->run() == FALSE){
			$data['title']  = 'Edit Cuti';
			$data['data']	= $this->M_Cuti->getDataCutiDetail($id);
			// get data nama user (untuk tampil di sidebar dan navbar)
					$data['user']   = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
			// $data['edit_data'] = $this->Feedback_Model->editFeedback($id);
			$this->load->view('theme_pegawai/header', $data);
			$this->load->view('pegawai/daftar_cuti/edit', $data);
			$this->load->view('theme_pegawai/footer', $data);
		}else{
            $id_pimpinan = $this->input->post('kode_pimpinan');
			$cuti =$this->M_Cuti->getIdPimpinan($id_pimpinan);
			$data = array(
           	'tanggal_pengajuan'   => $this->input->post('tgl_pengajuan'),
            'mulai_cuti' => $this->input->post('mulai_cuti'),
            'akhir_cuti' => $this->input->post('akhir_cuti'),
			'keterangan' => $this->input->post('ket_cuti'),
			'kode_pimpinan' => $cuti['kode_pimpinan'],
			);

			$this->db->where('id_cuti',$id);
      		$this->db->update('permohonan_cuti',$data);
			// redirect($_SERVER['HTTP_REFERER']);
			redirect('pegawai/Cuti/index',$data);

     	}

	}

}
