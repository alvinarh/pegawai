<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PermohonanCuti extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('pegawai/M_Permohonan');
		$this->load->model('admin/M_Pegawai');
		$this->load->model('User_model');
	}

	public function cutiSakit()
	{
		$this->form_validation->set_rules('mulai', 'mulai', 'required');
		$data['jenis'] = $this->M_Permohonan->selectKetCuti();
		$data['select'] = $this->M_Permohonan->selectIdCuti();
		$data['ket'] = $this->M_Permohonan->getAllKeterangan();

		if ($this->form_validation->run() == FALSE) {
			$data['title']  = 'Permohonan Cuti Sakit <= 14 Hari';
			$data['session'] = $this->session->userdata('nama');
			// get data nama user (untuk tampil di sidebar dan navbar)
			$data['user']   = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
			$this->load->view('theme_pegawai/header', $data);
			$this->load->view('pegawai/permohonan_cuti/cuti_sakit', $data);
			$this->load->view('theme_pegawai/footer', $data);
		} else {
			$id_cuti = $this->input->post('id_cuti');
			$cuti = $this->M_Permohonan->getDataCutiDetail($id_cuti);
			$id = $this->input->post('kode_pegawai');
			$pegawai = $this->M_Permohonan->getDataPegawaiDetail($id);
			$kode_pegawai = $this->input->post('kode_pegawai');
			$nik = $this->M_Pegawai->getDataNIK($kode_pegawai);
			$id_pegawai = $this->User_model->getIdPegawai();

			$config['upload_path'] = './assets/data';
			$config['allowed_types'] = 'pdf';
			$config['file_name']    = 'surat-dokter' . $id_pegawai . '-' . date('d-m-Y');

			$this->load->library('upload', $config, 'surat_pengantar');
			$this->surat_pengantar->initialize($config);
			$upload_surat_pengantar = $this->surat_pengantar->do_upload('surat_pengantar');

			if ($upload_surat_pengantar == TRUE) {
				date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
				$now = date('Y-m-d H:i:s');
				$data = array(
					'kode_pegawai'  => $this->input->post('kode_pegawai'),
					'nik'  			=> $nik['nik'],
					'nama'  		=> $pegawai['nama'],
					'perihal'		=> $this->input->post('perihal'),
					'tanggal_pengajuan' => $now,
					'mulai_cuti'    => $this->input->post('mulai'),
					'akhir_cuti'    => $this->input->post('berakhir'),
					'surat_dokter' 	=> $this->surat_pengantar->data("file_name"),
					'keterangan'    => "Cuti Sakit < 14",
					'verifikasi' 	=> 3,
				);
				$this->db->insert('permohonan_cuti', $data);

				// // Set message
				$this->session->set_flashdata('message', '<div class="alert alert-success" style="color:green;" role="success">Data berhasil</div>');
				redirect('pegawai/PermohonanCuti/cutiSakit', $data);
			} else{
				$this->session->set_flashdata('msg', '<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
				  <div class="modal-content">
					<div class="modal-header">
					  <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
					  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					</div>
					<div class="modal-body">
					  Surat yang Anda Masukan Salah!!
					</div>
					<div class="modal-footer">
					  <button class="btn btn-primary" data-dismiss="modal">Close</button>
					</div>
				  </div>
				 </div>
			  	</div>');
				redirect('pegawai/PermohonanCuti/cutiSakit');
			}
		}
	}

	public function cutiSakit14()
	{
		$this->form_validation->set_rules('mulai', 'mulai', 'required');
		$data['jenis'] = $this->M_Permohonan->selectKetCuti();
		$data['select'] = $this->M_Permohonan->selectIdCuti();
		$data['ket'] = $this->M_Permohonan->getAllKeterangan();

		if ($this->form_validation->run() == FALSE) {
			$data['title']  = 'Permohonan Cuti Sakit > 14 Hari';
			$data['session'] = $this->session->userdata('nama');
			// get data nama user (untuk tampil di sidebar dan navbar)
			$data['user']   = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
			$this->load->view('theme_pegawai/header', $data);
			$this->load->view('pegawai/permohonan_cuti/cuti_sakit14', $data);
			$this->load->view('theme_pegawai/footer', $data);
		} else {
			$id_cuti = $this->input->post('id_cuti');
			$cuti = $this->M_Permohonan->getDataCutiDetail($id_cuti);
			$id = $this->input->post('kode_pegawai');
			$pegawai = $this->M_Permohonan->getDataPegawaiDetail($id);
			$kode_pegawai = $this->input->post('kode_pegawai');
			$nik = $this->M_Pegawai->getDataNIK($kode_pegawai);
			$id_pegawai = $this->User_model->getIdPegawai();

			$config['upload_path'] = './assets/data';
			$config['allowed_types'] = 'pdf';
			$config['file_name']    = 'surat-dokter14' . $id_pegawai . '-' . date('d-m-Y');

			$this->load->library('upload', $config, 'surat_pengantar');
			$this->surat_pengantar->initialize($config);
			$upload_surat_pengantar = $this->surat_pengantar->do_upload('surat_pengantar');

			if ($upload_surat_pengantar == TRUE) {
				date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
				$now = date('Y-m-d H:i:s');
				$data = array(
					'kode_pegawai'  => $this->input->post('kode_pegawai'),
					'nik'  			=> $nik['nik'],
					'nama'  		=> $pegawai['nama'],
					'perihal'		=> $this->input->post('perihal'),
					'tanggal_pengajuan' => $now,
					'mulai_cuti'    => $this->input->post('mulai'),
					'akhir_cuti'    => $this->input->post('berakhir'),
					'surat_dokter' 	=> $this->surat_pengantar->data("file_name"),
					'keterangan'    => "Cuti Sakit > 14",
					'verifikasi' 	=> 3,
				);
				$this->db->insert('permohonan_cuti', $data);

				// // Set message
				$this->session->set_flashdata('message', '<div class="alert alert-success" style="color:green;" role="success">Data berhasil</div>');
				redirect('pegawai/PermohonanCuti/cutiSakit14', $data);
			} else{
				$this->session->set_flashdata('msg', '<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
				  <div class="modal-content">
					<div class="modal-header">
					  <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
					  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					</div>
					<div class="modal-body">
					  Surat yang Anda Masukan Salah!!
					</div>
					<div class="modal-footer">
					  <button class="btn btn-primary" data-dismiss="modal">Close</button>
					</div>
				  </div>
				 </div>
			  	</div>');
				redirect('pegawai/PermohonanCuti/cutiSakit14');
			}
		}
	}

	public function cutiMelahirkan()
	{
		$this->form_validation->set_rules('mulai', 'mulai', 'required');
		$data['jenis'] = $this->M_Permohonan->selectKetCuti();
		$data['select'] = $this->M_Permohonan->selectIdCuti();
		$data['ket'] = $this->M_Permohonan->getAllKeterangan();
		$data['jenis_kelamin'] = $this->db->query('select * from user where kode_pegawai = "' . $_SESSION['userid'] . '"')->row_array();
		if ($this->form_validation->run() == FALSE) {
			$data['title']  = 'Permohonan Cuti Melahirkan';
			$data['session'] = $this->session->userdata('nama');
			// get data nama user (untuk tampil di sidebar dan navbar)
			$data['user']   = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
			$this->load->view('theme_pegawai/header', $data);
			$this->load->view('pegawai/permohonan_cuti/cuti_melahirkan', $data);
			$this->load->view('theme_pegawai/footer', $data);
		} else {
			$id_cuti = $this->input->post('id_cuti');
			$cuti = $this->M_Permohonan->getDataCutiDetail($id_cuti);
			$id = $this->input->post('kode_pegawai');
			$pegawai = $this->M_Permohonan->getDataPegawaiDetail($id);
			$kode_pegawai = $this->input->post('kode_pegawai');
			$nik = $this->M_Pegawai->getDataNIK($kode_pegawai);
			$id_pegawai = $this->User_model->getIdPegawai();

			$config['upload_path'] = './assets/data';
			$config['allowed_types'] = 'pdf';
			$config['file_name']    = 'surat-melahirkan' . $id_pegawai . '-' . date('d-m-Y');

			$this->load->library('upload', $config, 'surat_pengantar');
			$this->surat_pengantar->initialize($config);
			$upload_surat_pengantar = $this->surat_pengantar->do_upload('surat_pengantar');

			if ($upload_surat_pengantar == TRUE) {
				date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
				$now = date('Y-m-d H:i:s');
				$data = array(
					'kode_pegawai'  => $this->input->post('kode_pegawai'),
					'nik'  			=> $nik['nik'],
					'nama'  		=> $pegawai['nama'],
					'tanggal_pengajuan' => $now,
					'mulai_cuti'    => $this->input->post('mulai'),
					'akhir_cuti'    => $this->input->post('berakhir'),
					'surat_melahirkan' 	=> $this->surat_pengantar->data("file_name"),
					'keterangan'    => "Cuti Melahirkan",
					'verifikasi' 	=> 3,
				);
				$this->db->insert('permohonan_cuti', $data);

				// // Set message
				$this->session->set_flashdata('message', '<div class="alert alert-success" style="color:green;" role="success">Data berhasil</div>');
				redirect('pegawai/PermohonanCuti/cutiMelahirkan', $data);
			} else{
				$this->session->set_flashdata('msg', '<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
				  <div class="modal-content">
					<div class="modal-header">
					  <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
					  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					</div>
					<div class="modal-body">
					  Surat yang Anda Masukan Salah!!
					</div>
					<div class="modal-footer">
					  <button class="btn btn-primary" data-dismiss="modal">Close</button>
					</div>
				  </div>
				 </div>
			  	</div>');
				redirect('pegawai/PermohonanCuti/cutiMelahirkan');
			}
		}
	}

	public function cutiAlasanPenting()
	{
		$this->form_validation->set_rules('mulai', 'mulai', 'required');
		$data['jenis'] = $this->M_Permohonan->selectKetCuti();
		$data['select'] = $this->M_Permohonan->selectIdCuti();
		$data['ket'] = $this->M_Permohonan->getAllKeterangan();

		if ($this->form_validation->run() == FALSE) {
			$data['title']  = 'Permohonan Cuti Alasan Penting';
			$data['session'] = $this->session->userdata('nama');
			// $data['project']=$this->Feedback_Model->selectIdProject();
			// get data nama user (untuk tampil di sidebar dan navbar)
			$data['user']   = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
			$this->load->view('theme_pegawai/header', $data);
			$this->load->view('pegawai/permohonan_cuti/cuti_alasanpenting', $data);
			$this->load->view('theme_pegawai/footer', $data);
		} else {
			$id_cuti = $this->input->post('id_cuti');
			$cuti = $this->M_Permohonan->getDataCutiDetail($id_cuti);

			$id = $this->input->post('kode_pegawai');
			$pegawai = $this->M_Permohonan->getDataPegawaiDetail($id);
			$kode_pegawai = $this->input->post('kode_pegawai');
			$nik = $this->M_Pegawai->getDataNIK($kode_pegawai);
			$id_pegawai = $this->User_model->getIdPegawai();

			$config['upload_path'] = './assets/data';
			$config['allowed_types'] = 'pdf';
			$config['file_name']    = 'surat-alasanpenting' . $id_pegawai . '-' . date('d-m-Y');

			$this->load->library('upload', $config, 'surat_pengantar');
			$this->surat_pengantar->initialize($config);
			$upload_surat_pengantar = $this->surat_pengantar->do_upload('surat_pengantar');

			if ($upload_surat_pengantar == TRUE) {
				date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
				$now = date('Y-m-d H:i:s');
				$data = array(
					'kode_pegawai'  => $this->input->post('kode_pegawai'),
					'nik'  			=> $nik['nik'],
					'nama'  		=> $pegawai['nama'],
					'perihal'		=> $this->input->post('perihal'),
					'tanggal_pengajuan' => $now,
					'mulai_cuti'    => $this->input->post('mulai'),
					'akhir_cuti'    => $this->input->post('berakhir'),
					'surat_alasanpenting' 	=> $this->surat_pengantar->data("file_name"),
					'keterangan'    => "Cuti Alasan Penting",
					'verifikasi' 	=> 3,

				);
				$this->db->insert('permohonan_cuti', $data);

				// // Set message
				$this->session->set_flashdata('message', '<div class="alert alert-success" style="color:green;" role="success">Data berhasil</div>');
				redirect('pegawai/PermohonanCuti/cutiAlasanPenting', $data);
			} else{
				$this->session->set_flashdata('msg', '<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
				  <div class="modal-content">
					<div class="modal-header">
					  <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
					  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					</div>
					<div class="modal-body">
					  Surat yang Anda Masukan Salah!!
					</div>
					<div class="modal-footer">
					  <button class="btn btn-primary" data-dismiss="modal">Close</button>
					</div>
				  </div>
				 </div>
			  	</div>');
				redirect('pegawai/PermohonanCuti/cutiAlasanPenting');
			}
		}
	}

	// public function cutiBesar()
	// {
	// 	$this->form_validation->set_rules('mulai', 'mulai', 'required');
	// 	$data['jenis'] = $this->M_Permohonan->selectKetCuti();
	// 	$data['select'] = $this->M_Permohonan->selectIdCuti();
	// 	$data['ket'] = $this->M_Permohonan->getAllKeterangan();

	// 	if ($this->form_validation->run() == FALSE) {
	// 		$data['title']  = 'Permohonan Cuti Besar';
	// 		$data['session'] = $this->session->userdata('nama');
	// 		// $data['project']=$this->Feedback_Model->selectIdProject();
	// 		// get data nama user (untuk tampil di sidebar dan navbar)
	// 		$data['user']   = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
	// 		$this->load->view('theme_pegawai/header', $data);
	// 		$this->load->view('pegawai/permohonan_cuti/cuti_besar', $data);
	// 		$this->load->view('theme_pegawai/footer', $data);
	// 	} else {
	// 		$id_cuti = $this->input->post('id_cuti');
	// 		$cuti = $this->M_Permohonan->getDataCutiDetail($id_cuti);

	// 		$id = $this->input->post('kode_pegawai');
	// 		$pegawai = $this->M_Permohonan->getDataPegawaiDetail($id);

	// 		$id_pegawai = $this->User_model->getIdPegawai();

	// 		$config['upload_path'] = './assets/data';
	// 		$config['allowed_types'] = 'pdf';
	// 		$config['file_name']    = 'surat-besar' . $id_pegawai . '-' . date('d-m-Y');

	// 		$this->load->library('upload', $config, 'surat_pengantar');
	// 		$this->surat_pengantar->initialize($config);
	// 		$upload_surat_pengantar = $this->surat_pengantar->do_upload('surat_pengantar');

	// 		if ($upload_surat_pengantar == TRUE) {
	// 			date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
	// 			$now = date('Y-m-d H:i:s');
	// 			$data = array(
	// 				'kode_pegawai'  => $this->input->post('kode_pegawai'),
	// 				'nama'  		=> $pegawai['nama'],
	// 				'perihal'		=> $this->input->post('perihal'),
	// 				'tanggal_pengajuan' => $now,
	// 				'mulai_cuti'    => $this->input->post('mulai'),
	// 				'akhir_cuti'    => $this->input->post('berakhir'),
	// 				'surat_besar' 	=> $this->surat_pengantar->data("file_name"),
	// 				'keterangan'    => "Cuti Besar",
	// 				'verifikasi' 	=> 3,
	// 			);
	// 			$this->db->insert('permohonan_cuti', $data);

	// 			// // Set message
	// 			$this->session->set_flashdata('data_ditambahkan', 'Data berhasil ditambah');

	// 			redirect('pegawai/PermohonanCuti/cutiBesar', $data);
	// 			// var_dump($data);
	// 		}
	// 		// else {
	// 		// 	var_dump($data);
	// 		// }
	// 	}
	// }

	// public function cutiTahunan()
	// {
	// 	$this->form_validation->set_rules('mulai', 'mulai', 'required');
	// 	$data['jenis'] = $this->M_Permohonan->selectKetCuti();
	// 	$data['select'] = $this->M_Permohonan->selectIdCuti();
	// 	$data['ket'] = $this->M_Permohonan->getAllKeterangan();

	// 	if ($this->form_validation->run() == FALSE) {
	// 		$data['title']  = 'Permohonan Cuti Tahunan';
	// 		$data['session'] = $this->session->userdata('nama');
	// 		// $data['project']=$this->Feedback_Model->selectIdProject();
	// 		// get data nama user (untuk tampil di sidebar dan navbar)
	// 		$data['user']   = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
	// 		$this->load->view('theme_pegawai/header', $data);
	// 		$this->load->view('pegawai/permohonan_cuti/cuti_tahunan', $data);
	// 		$this->load->view('theme_pegawai/footer', $data);
	// 	} else {
	// 		$id_cuti = $this->input->post('id_cuti');
	// 		$cuti = $this->M_Permohonan->getDataCutiDetail($id_cuti);

	// 		$id = $this->input->post('kode_pegawai');
	// 		$pegawai = $this->M_Permohonan->getDataPegawaiDetail($id);

	// 		$id_pegawai = $this->User_model->getIdPegawai();

	// 		$config['upload_path'] = './assets/data';
	// 		$config['allowed_types'] = 'pdf';
	// 		$config['file_name']    = 'surat-tahunan' . $id_pegawai . '-' . date('d-m-Y');

	// 		$this->load->library('upload', $config, 'surat_pengantar');
	// 		$this->surat_pengantar->initialize($config);
	// 		$upload_surat_pengantar = $this->surat_pengantar->do_upload('surat_pengantar');

	// 		if ($upload_surat_pengantar == TRUE) {
	// 			date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
	// 			$now = date('Y-m-d H:i:s');
	// 			$data = array(
	// 				'kode_pegawai'  => $this->input->post('kode_pegawai'),
	// 				'nama'  		=> $pegawai['nama'],
	// 				'perihal'		=> $this->input->post('perihal'),
	// 				'tanggal_pengajuan' => $now,
	// 				'mulai_cuti'    => $this->input->post('mulai'),
	// 				'akhir_cuti'    => $this->input->post('berakhir'),
	// 				'surat_tahunan' 	=> $this->surat_pengantar->data("file_name"),
	// 				'keterangan'    => "Cuti Tahunan",
	// 				'verifikasi' 	=> 3,
	// 			);
	// 			$this->db->insert('permohonan_cuti', $data);

	// 			// // Set message
	// 			$this->session->set_flashdata('data_ditambahkan', 'Data berhasil ditambah');

	// 			redirect('pegawai/PermohonanCuti/cutiTahunan', $data);
	// 			// var_dump($data);
	// 		}
	// 		// else {
	// 		// 	var_dump($data);
	// 		// }
	// 	}
	// }

	// public function cutiDiluarTN()
	// {
	// 	$this->form_validation->set_rules('mulai', 'mulai', 'required');
	// 	$data['jenis'] = $this->M_Permohonan->selectKetCuti();
	// 	$data['select'] = $this->M_Permohonan->selectIdCuti();
	// 	$data['ket'] = $this->M_Permohonan->getAllKeterangan();

	// 	if ($this->form_validation->run() == FALSE) {
	// 		$data['title']  = 'Permohonan Cuti Diluar Tanggungan Negara';
	// 		$data['session'] = $this->session->userdata('nama');
	// 		// $data['project']=$this->Feedback_Model->selectIdProject();
	// 		// get data nama user (untuk tampil di sidebar dan navbar)
	// 		$data['user']   = $this->db->query('select * from user where nama = "' . $_SESSION['nama'] . '"')->row();
	// 		$this->load->view('theme_pegawai/header', $data);
	// 		$this->load->view('pegawai/permohonan_cuti/cuti_diluartn', $data);
	// 		$this->load->view('theme_pegawai/footer', $data);
	// 	} else {
	// 		$id_cuti = $this->input->post('id_cuti');
	// 		$cuti = $this->M_Permohonan->getDataCutiDetail($id_cuti);

	// 		$id = $this->input->post('kode_pegawai');
	// 		$pegawai = $this->M_Permohonan->getDataPegawaiDetail($id);

	// 		$id_pegawai = $this->User_model->getIdPegawai();

	// 		$config['upload_path'] = './assets/data';
	// 		$config['allowed_types'] = 'pdf';
	// 		$config['file_name']    = 'surat-diluartn' . $id_pegawai . '-' . date('d-m-Y');

	// 		$this->load->library('upload', $config, 'surat_pengantar');
	// 		$this->surat_pengantar->initialize($config);
	// 		$upload_surat_pengantar = $this->surat_pengantar->do_upload('surat_pengantar');

	// 		if ($upload_surat_pengantar == TRUE) {
	// 			date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
	// 			$now = date('Y-m-d H:i:s');
	// 			$data = array(
	// 				'kode_pegawai'  => $this->input->post('kode_pegawai'),
	// 				'nama'  		=> $pegawai['nama'],
	// 				'perihal'		=> $this->input->post('perihal'),
	// 				'tanggal_pengajuan' => $now,
	// 				'mulai_cuti'    => $this->input->post('mulai'),
	// 				'akhir_cuti'    => $this->input->post('berakhir'),
	// 				'surat_diluartn' 	=> $this->surat_pengantar->data("file_name"),
	// 				'keterangan'    => "Cuti Diluar Tanggungan Negara",
	// 				'verifikasi' 	=> 3,
	// 			);
	// 			$this->db->insert('permohonan_cuti', $data);

	// 			// // Set message
	// 			$this->session->set_flashdata('data_ditambahkan', 'Data berhasil ditambah');

	// 			redirect('pegawai/PermohonanCuti/cutiDiluarTN', $data);
	// 			// var_dump($data);
	// 		}
	// 	}
	// }
}

