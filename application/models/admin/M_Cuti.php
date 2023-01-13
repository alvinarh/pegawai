<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_Cuti extends CI_Model {

  //dashboard
  public function dataCutiSakit(){
		$this->db->select('*');
    	$this->db->from('permohonan_cuti');
        $this->db->where('verifikasi',1);
        $where = '(verifikasi=1)';
        $this->db->where($where);
    	$query=$this->db->get();
		return $query->num_rows();
	}

  public function dataCutiSakit14(){
		$this->db->select('*');
    	$this->db->from('permohonan_cuti');
        $this->db->where('verifikasi',2);
        $where = '(verifikasi=2)';
        $this->db->where($where);
    	$query=$this->db->get();
		return $query->num_rows();
	}

  public function dataCutiMelahirkan(){
		$this->db->select('*');
    	$this->db->from('permohonan_cuti');
        $this->db->where('verifikasi',3);
        $where = '(verifikasi=3)';
        $this->db->where($where);
    	$query=$this->db->get();
		return $query->num_rows();
	}

  public function dataCutiAlasanPenting(){
		$this->db->select('*');
    	$this->db->from('permohonan_cuti');
        $this->db->where('verifikasi',4);
        $where = '(verifikasi=4)';
        $this->db->where($where);
    	$query=$this->db->get();
		return $query->num_rows();
	}

  // public function dataCutiBesar(){
	// 	$this->db->select('*');
  //   	$this->db->from('permohonan_cuti');
  //       $this->db->where('verifikasi',4);
  //       $where = '(verifikasi=4)';
  //       $this->db->where($where);
  //   	$query=$this->db->get();
	// 	return $query->num_rows();
	// }

  // public function dataCutiTahunan(){
	// 	$this->db->select('*');
  //   	$this->db->from('permohonan_cuti');
  //       $this->db->where('verifikasi',5);
  //       $where = '(verifikasi=5)';
  //       $this->db->where($where);
  //   	$query=$this->db->get();
	// 	return $query->num_rows();
	// }

  // public function dataCutiDiluarTN(){
	// 	$this->db->select('*');
  //   	$this->db->from('permohonan_cuti');
  //       $this->db->where('verifikasi',6);
  //       $where = '(verifikasi=6)';
  //       $this->db->where($where);
  //   	$query=$this->db->get();
	// 	return $query->num_rows();
	// }

  //datacuti
  public function cutiSakit()
  {
    $query = "SELECT * from permohonan_cuti where keterangan = 'Cuti Sakit < 14' order by id_cuti DESC";
		return $this->db->query($query)->result();
  }

  public function cutiSakit14()
  {
    $query = "SELECT * from permohonan_cuti where keterangan = 'Cuti Sakit > 14' order by id_cuti DESC";
		return $this->db->query($query)->result();
  }


  public function cutiMelahirkan()
  {
    $query = "SELECT * from permohonan_cuti where keterangan = 'Cuti Melahirkan' order by id_cuti DESC";
		return $this->db->query($query)->result();
  }

  public function cutiAlasanPenting()
  {
    $query = "SELECT * from permohonan_cuti where keterangan = 'Cuti Alasan Penting' order by id_cuti DESC";
		return $this->db->query($query)->result();
  }

  // public function cutiBesar()
  // {
  //   $query = "SELECT * from permohonan_cuti where keterangan = 'Cuti Besar' ";
	// 	return $this->db->query($query)->result();
  // }
    
  // public function cutiTahunan()
  // {
  //   $query = "SELECT * from permohonan_cuti where keterangan = 'Cuti Tahunan' ";
	// 	return $this->db->query($query)->result();
  // }
  // public function cutiDiluarTN()
  // {
  //   $query = "SELECT * from permohonan_cuti where keterangan = 'Cuti Diluar Tanggungan Negara' ";
	// 	return $this->db->query($query)->result();
  // }
  
}