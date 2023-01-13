<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_Cuti extends CI_Model
{

  //dashboard
  public function dataCutiSakit()
  {
    $this->db->select('*');
    $this->db->from('permohonan_cuti');
    $this->db->where('verifikasi', 1);
    $where = '(verifikasi=1)';
    $this->db->where($where);
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function dataCutiSakit14()
  {
    $this->db->select('*');
    $this->db->from('permohonan_cuti');
    $this->db->where('verifikasi', 2);
    $where = '(verifikasi=2)';
    $this->db->where($where);
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function dataCutiMelahirkan()
  {
    $this->db->select('*');
    $this->db->from('permohonan_cuti');
    $this->db->where('verifikasi', 3);
    $where = '(verifikasi=3)';
    $this->db->where($where);
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function dataCutiAlasanPenting()
  {
    $this->db->select('*');
    $this->db->from('permohonan_cuti');
    $this->db->where('verifikasi', 4);
    $where = '(verifikasi=4)';
    $this->db->where($where);
    $query = $this->db->get();
    return $query->num_rows();
  }

  // public function dataCutiBesar()
  // {
  //   $this->db->select('*');
  //   $this->db->from('permohonan_cuti');
  //   $this->db->where('verifikasi', 4);
  //   $where = '(verifikasi=4)';
  //   $this->db->where($where);
  //   $query = $this->db->get();
  //   return $query->num_rows();
  // }

  // public function dataCutiTahunan()
  // {
  //   $this->db->select('*');
  //   $this->db->from('permohonan_cuti');
  //   $this->db->where('verifikasi', 5);
  //   $where = '(verifikasi=5)';
  //   $this->db->where($where);
  //   $query = $this->db->get();
  //   return $query->num_rows();
  // }

  // public function dataCutiDiluarTN()
  // {
  //   $this->db->select('*');
  //   $this->db->from('permohonan_cuti');
  //   $this->db->where('verifikasi', 6);
  //   $where = '(verifikasi=6)';
  //   $this->db->where($where);
  //   $query = $this->db->get();
  //   return $query->num_rows();
  // }

  //riwayatcuti
  public function cutiSakit($kode_pegawai)
  {
    $query = "SELECT * from permohonan_cuti where kode_pegawai = '$kode_pegawai' and keterangan = 'Cuti Sakit < 14' order by id_cuti DESC";
		return $this->db->query($query)->result();
  }

  public function cutiSakit14($kode_pegawai)
  {
    $query = "SELECT * from permohonan_cuti where kode_pegawai = '$kode_pegawai' and keterangan = 'Cuti Sakit > 14' order by id_cuti DESC";
		return $this->db->query($query)->result();
  }

  public function cutiMelahirkan($kode_pegawai)
  {
    $query = "SELECT * from permohonan_cuti where kode_pegawai = '$kode_pegawai' and keterangan = 'Cuti Melahirkan' order by id_cuti DESC";
		return $this->db->query($query)->result();
  }

  public function cutiAlasanPenting($kode_pegawai)
  {
    $query = "SELECT * from permohonan_cuti where kode_pegawai = '$kode_pegawai' and keterangan = 'Cuti Alasan Penting' order by id_cuti DESC";
		return $this->db->query($query)->result();
  }

  // public function cutiBesar($kode_pegawai)
  // {
  //   $query = "SELECT * from permohonan_cuti where kode_pegawai = '$kode_pegawai' and keterangan = 'Cuti Besar' ";
	// 	return $this->db->query($query)->result();
  // }

  // public function cutiTahunan($kode_pegawai)
  // {
  //   $query = "SELECT * from permohonan_cuti where kode_pegawai = '$kode_pegawai' and keterangan = 'Cuti Tahunan' ";
	// 	return $this->db->query($query)->result();
  // }

  // public function cutiDiluarTN($kode_pegawai)
  // {
  //   $query = "SELECT * from permohonan_cuti where kode_pegawai = '$kode_pegawai' and keterangan = 'Cuti Diluar Tanggungan Negara' ";
	// 	return $this->db->query($query)->result();
  // }

  //membuat laporan pdf cuti pegawai
  public function cetakCutiSakit($kode_pegawai)
  {
    $this->db->select('user.*,permohonan_cuti.keterangan,permohonan_cuti.perihal,permohonan_cuti.mulai_cuti,permohonan_cuti.akhir_cuti');
    $this->db->from('user');
    $this->db->join('permohonan_cuti', 'permohonan_cuti.kode_pegawai=user.kode_pegawai');
    $this->db->where ('permohonan_cuti.keterangan', 'Cuti Sakit < 14');
    $this->db->where('user.kode_pegawai', $kode_pegawai);
    $query = $this->db->get();
    return $query->row_array();
  }

  public function laporanCutiSakit($kode_pegawai)
  {
    $this->db->select('user.kode_pegawai,user.nama,user.jabatan,permohonan_cuti.*');
    $this->db->from('user');
    $this->db->join('permohonan_cuti', 'permohonan_cuti.kode_pegawai=user.kode_pegawai');
    $this->db->where('user.kode_pegawai', $kode_pegawai);
    $query = $this->db->get();
    return $query->row_array();
  }

  public function cetakCutiSakit14($kode_pegawai)
  {
    $this->db->select('user.*,permohonan_cuti.keterangan,permohonan_cuti.perihal,permohonan_cuti.mulai_cuti,permohonan_cuti.akhir_cuti');
    $this->db->from('user');
    $this->db->join('permohonan_cuti', 'permohonan_cuti.kode_pegawai=user.kode_pegawai');
    $this->db->where ('permohonan_cuti.keterangan', 'Cuti Sakit > 14');
    $this->db->where('user.kode_pegawai', $kode_pegawai);
    $query = $this->db->get();
    return $query->row_array();
  }

  public function laporanCutiSakit14($kode_pegawai)
  {
    $this->db->select('user.kode_pegawai,user.nama,user.jabatan,permohonan_cuti.*');
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
    $this->db->where ('permohonan_cuti.keterangan', 'Cuti Melahirkan');
    $this->db->where('user.kode_pegawai', $kode_pegawai);
    $query = $this->db->get();
    return $query->row_array();
  }

  public function laporanCutiMelahirkan($kode_pegawai)
  {
    $this->db->select('user.kode_pegawai,user.nama,user.jabatan,permohonan_cuti.*');
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

  public function laporanCutiAlasanPenting($kode_pegawai)
  {
    $this->db->select('user.kode_pegawai,user.nama,user.jabatan,permohonan_cuti.*');
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

  // public function laporanCutiBesar($kode_pegawai)
  // {
  //   $this->db->select('user.kode_pegawai,user.nama,user.jabatan,permohonan_cuti.*');
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

  // public function laporanCutiTahunan($kode_pegawai)
  // {
  //   $this->db->select('user.kode_pegawai,user.nama,user.jabatan,permohonan_cuti.*');
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

  // public function laporanCutiDiluarTN($kode_pegawai)
  // {
  //   $this->db->select('user.kode_pegawai,user.nama,user.jabatan,permohonan_cuti.*');
  //   $this->db->from('user');
  //   $this->db->join('permohonan_cuti', 'permohonan_cuti.kode_pegawai=user.kode_pegawai');
  //   $this->db->where('user.kode_pegawai', $kode_pegawai);
  //   $query = $this->db->get();
  //   return $query->row_array();
  // }

}
