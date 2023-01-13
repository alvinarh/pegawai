<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_Laporan extends CI_Model
{

	public function dataCutiSakit($kode_pegawai)
	{
		$query = "SELECT u.kode_pegawai,u.jabatan, p.* from permohonan_cuti p , user u where  u.kode_pegawai = p.kode_pegawai and p.keterangan = 'Cuti Sakit < 14' and u.kode_pegawai = '$kode_pegawai'";
		return $this->db->query($query)->result();
	}

	public function dataCutiSakit14($kode_pegawai)
	{
		$query = "SELECT u.kode_pegawai,u.jabatan, p.* from permohonan_cuti p , user u where  u.kode_pegawai = p.kode_pegawai and p.keterangan = 'Cuti Sakit > 14' and u.kode_pegawai = '$kode_pegawai'";
		return $this->db->query($query)->result();
	}

	public function dataCutiMelahirkan($kode_pegawai)
	{
		$query = "SELECT u.kode_pegawai,u.jabatan, p.* from permohonan_cuti p , user u where  u.kode_pegawai = p.kode_pegawai and p.keterangan = 'Cuti Melahirkan' and u.kode_pegawai = '$kode_pegawai'";
		return $this->db->query($query)->result();
	}

	public function dataCutiAlasanPenting($kode_pegawai)
	{
		$query = "SELECT u.kode_pegawai,u.jabatan, p.* from permohonan_cuti p , user u where  u.kode_pegawai = p.kode_pegawai and p.keterangan = 'Cuti Alasan Penting' and u.kode_pegawai = '$kode_pegawai'";
		return $this->db->query($query)->result();
	}

	// public function dataCutiBesar($kode_pegawai)
	// {
	// 	$query = "SELECT u.kode_pegawai,u.jabatan, p.* from permohonan_cuti p , user u where  u.kode_pegawai = p.kode_pegawai and p.keterangan = 'Cuti Besar' and u.kode_pegawai = '$kode_pegawai'";
	// 	return $this->db->query($query)->result();
	// }

	// public function dataCutiTahunan($kode_pegawai)
	// {
	// 	$query = "SELECT u.kode_pegawai,u.jabatan, p.* from permohonan_cuti p , user u where  u.kode_pegawai = p.kode_pegawai and p.keterangan = 'Cuti Tahunan' and u.kode_pegawai = '$kode_pegawai'";
	// 	return $this->db->query($query)->result();
	// }

	// public function dataCutiDiluarTN($kode_pegawai)
	// {
	// 	$query = "SELECT u.kode_pegawai,u.jabatan, p.* from permohonan_cuti p , user u where  u.kode_pegawai = p.kode_pegawai and p.keterangan = 'Cuti Diluar Tanggungan Negara' and u.kode_pegawai = '$kode_pegawai'";
	// 	return $this->db->query($query)->result();
	// }
}
