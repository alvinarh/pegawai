<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SendEmail extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('email'));
		$this->load->library(array('email'));




		// Load library form validation dan helper form
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('download');
		$this->load->model('pimpinan/M_Laporan');
	}


	public function index($id)
	{


		$data = array(
			'verifikasi' => $this->input->post('verifikasi'),
			'keterangan' => $this->input->post('keterangan')
		);
		$this->M_Laporan->update_cuti($id, $data);
		//get user
		$data['data_pegawai'] = $this->M_Laporan->get_user_by_id($this->input->post('kode_pegawai'));
		$data['detail_cuti'] = $this->M_Laporan->get_detail_cuti_by_id($id);
		$nama_pegawai = $data['data_pegawai']['nama'];
		$nik = $data['data_pegawai']['nik'];
		$jabatan = $data['data_pegawai']['jabatan'];
		$tgl_pengajuan_cuti = $data['detail_cuti']['tanggal_pengajuan'];
		$mulai_cuti = $data['detail_cuti']['mulai_cuti'];
		$akhir_cuti = $data['detail_cuti']['akhir_cuti'];
		$perihal = $data['detail_cuti']['perihal'];
		$email = $data['data_pegawai']['email'];





		if ($this->input->post('verifikasi') == 1) {
			// Konfigurasi email
			$subject = 'Persetujuan Pengajuan Cuti';
			$message =
				"
		<p>Halo $nama_pegawai,</p>
		<p>Berkaitan dengan pengajuan cuti anda pada tanggal <b>$tgl_pengajuan_cuti</b> bahwa permohonan cuti anda <b>disetujui</b>.</p>

		<p>Nik : <b>$nik</b></p>
		<p>Nama Lengkap : <b>$nama_pegawai</b></p>
		<p>Jabatan : <b>$jabatan</b></p>
		<p>Tanggal Mulai Cuti : <b>$mulai_cuti</b></p>
		<p>Tanggal Akhir Cuti : <b>$akhir_cuti</b></p>
		<p>Perihal : <b>$perihal</b></p>
		<br><br>
		<p>Demikian informasi dari kami, terima kasih.</p>
		<p>Salam Hangat</p>
		<br>
		<b>Pimpinan DPRD Jawa Tengah</b>
		";
		} else {
			// Konfigurasi email
			$subject = 'Penolakan Pengajuan Cuti';
			$message =
				"
	<p>Halo $nama_pegawai,</p>
	<p>Berkaitan dengan pengajuan cuti anda pada tanggal <b>$tgl_pengajuan_cuti</b> bahwa permohonan cuti anda <b>ditolak</b>.</p>

	<p>Nik : <b>$nik</b></p>
	<p>Nama Lengkap : <b>$nama_pegawai</b></p>
	<p>Jabatan : <b>$jabatan</b></p>
	<p>Tanggal Mulai Cuti : <b>$mulai_cuti</b></p>
	<p>Tanggal Akhir Cuti : <b>$akhir_cuti</b></p>
	<p>Perihal : <b>$perihal</b></p>
	<br><br>
	<p>Demikian informasi dari kami, terima kasih.</p>
	<p>Salam Hangat</p>
	<br>
	<b>Pimpinan DPRD Jawa Tengah</b>
	";
		}





		$this->sendEmail($message, $subject, $email, $email);
	}
	function sendEmail($message, $subject, $email, $username)
	{

		// Config email
		$this->load->library('PHPMailer_load'); //Load Library PHPMailer
		$mail = $this->phpmailer_load->load(); // Mendefinisikan Variabel Mail
		$mail->isSMTP();  // Mengirim menggunakan protokol SMTP
		$mail->Host = 'smtp.gmail.com'; // Host dari server SMTP
		$mail->SMTPAuth = true; // Autentikasi SMTP
		$mail->Username = 'cisiang8@gmail.com';
		$mail->Password = 'sheehiukbezndfuw';
		$mail->SMTPSecure = 'tls';
		$mail->Port = 587;
		$mail->setFrom('Cupi@gmail.com', 'SICUPI-DPRD-JATENG'); // Sumber email
		$mail->addAddress($email, $username); // Alamat tujuan
		$mail->Subject = $subject; // Subjek Email

		$mail->msgHtml($message);

		if (!$mail->send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
			// $this->session->set_flashdata('send_email', 'Email gagal dikirim!');
			// redirect('admin/index');
		} else {
			$this->session->set_flashdata('send_email', 'Email berhasil dikirim!');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
}
