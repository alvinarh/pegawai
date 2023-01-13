<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_Laporan extends CI_Model
{

	public function dataCutiSakit()
	{
		$query = "SELECT u.jabatan,p.* from permohonan_cuti p , user u where  u.kode_pegawai = p.kode_pegawai and p.keterangan = 'Cuti Sakit < 14' and p.verifikasi = '1'";
		return $this->db->query($query)->result();
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

  public function dataCutiSakit14()
	{
		$query = "SELECT u.jabatan,p.* from permohonan_cuti p , user u where  u.kode_pegawai = p.kode_pegawai and p.keterangan = 'Cuti Sakit > 14' and p.verifikasi = '1'";
		return $this->db->query($query)->result();
	}


	public function dataCutiMelahirkan()
	{
		$query = "SELECT u.jabatan,p.* from permohonan_cuti p , user u where  u.kode_pegawai = p.kode_pegawai and p.keterangan = 'Cuti Melahirkan' and p.verifikasi = '1'";
		return $this->db->query($query)->result();
	}

	public function dataCutiAlasanPenting()
	{
		$query = "SELECT u.jabatan,p.* from permohonan_cuti p , user u where  u.kode_pegawai = p.kode_pegawai and p.keterangan = 'Cuti Alasan Penting' and p.verifikasi = '1'";
		return $this->db->query($query)->result();
	}

	// public function dataCutiBesar()
	// {
	// 	$query = "SELECT u.jabatan,p.* from permohonan_cuti p , user u where  u.kode_pegawai = p.kode_pegawai and p.keterangan = 'Cuti Besar' and p.verifikasi = '1'";
	// 	return $this->db->query($query)->result();
	// }

	// public function dataCutiTahunan()
	// {
	// 	$query = "SELECT u.jabatan,p.* from permohonan_cuti p , user u where  u.kode_pegawai = p.kode_pegawai and p.keterangan = 'Cuti Tahunan' and p.verifikasi = '1'";
	// 	return $this->db->query($query)->result();
	// }

	// public function dataCutiDiluarTN()
	// {
	// 	$query = "SELECT u.jabatan,p.* from permohonan_cuti p , user u where  u.kode_pegawai = p.kode_pegawai and p.keterangan = 'Cuti Diluar Tanggungan' and p.verifikasi = '1'";
	// 	return $this->db->query($query)->result();
	// }

	public function cetakCutiSakit($kode_pegawai)
  {
    $this->db->select('user.*,permohonan_cuti.*');
    $this->db->from('user');
    $this->db->join('permohonan_cuti', 'permohonan_cuti.kode_pegawai=user.kode_pegawai');
    $this->db->where('user.kode_pegawai', $kode_pegawai);
    $query = $this->db->get();
    return $query->row_array();
  }

  public function cetakCutiSakit14($kode_pegawai)
  {
    $this->db->select('user.*,permohonan_cuti.*');
    $this->db->from('user');
    $this->db->join('permohonan_cuti', 'permohonan_cuti.kode_pegawai=user.kode_pegawai');
    $this->db->where('user.kode_pegawai', $kode_pegawai);
    $query = $this->db->get();
    return $query->row_array();
  }


  public function cetakCutiMelahirkan($kode_pegawai)
  {
    $this->db->select('user.*,permohonan_cuti.*');
    $this->db->from('user');
    $this->db->join('permohonan_cuti', 'permohonan_cuti.kode_pegawai=user.kode_pegawai');
    $this->db->where('user.kode_pegawai', $kode_pegawai);
    $query = $this->db->get();
    return $query->row_array();
  }

  public function cetakCutiAlasanPenting($kode_pegawai)
  {
    $this->db->select('user.*,permohonan_cuti.*');
    $this->db->from('user');
    $this->db->join('permohonan_cuti', 'permohonan_cuti.kode_pegawai=user.kode_pegawai');
    $this->db->where('user.kode_pegawai', $kode_pegawai);
    $query = $this->db->get();
    return $query->row_array();
  }

  // public function cetakCutiBesar($kode_pegawai)
  // {
  //   $this->db->select('user.*,permohonan_cuti.*');
  //   $this->db->from('user');
  //   $this->db->join('permohonan_cuti', 'permohonan_cuti.kode_pegawai=user.kode_pegawai');
  //   $this->db->where('user.kode_pegawai', $kode_pegawai);
  //   $query = $this->db->get();
  //   return $query->row_array();
  // }

  // public function cetakCutiTahunan($kode_pegawai)
  // {
  //   $this->db->select('user.*,permohonan_cuti.*');
  //   $this->db->from('user');
  //   $this->db->join('permohonan_cuti', 'permohonan_cuti.kode_pegawai=user.kode_pegawai');
  //   $this->db->where('user.kode_pegawai', $kode_pegawai);
  //   $query = $this->db->get();
  //   return $query->row_array();
  // }

  // public function cetakCutiDiluarTN($kode_pegawai)
  // {
  //   $this->db->select('user.*,permohonan_cuti.*');
  //   $this->db->from('user');
  //   $this->db->join('permohonan_cuti', 'permohonan_cuti.kode_pegawai=user.kode_pegawai');
  //   $this->db->where('user.kode_pegawai', $kode_pegawai);
  //   $query = $this->db->get();
  //   return $query->row_array();
  // }
}
