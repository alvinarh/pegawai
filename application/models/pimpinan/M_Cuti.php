<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_Cuti extends CI_Model {

    public function dataCutiSakit(){
		$this->db->select('*');
    	$this->db->from('permohonan_cuti');
      $this->db->where('keterangan','Cuti Sakit < 14');
    	$query=$this->db->get();
		return $query->num_rows();
	}

  public function dataCutiSakit14(){
		$this->db->select('*');
    	$this->db->from('permohonan_cuti');
      $this->db->where('keterangan','Cuti Sakit > 14');
    	$query=$this->db->get();
		return $query->num_rows();
	}

  public function dataCutiMelahirkan(){
		$this->db->select('*');
    	$this->db->from('permohonan_cuti');
        $this->db->where('keterangan','Cuti Melahirkan');
    	$query=$this->db->get();
		return $query->num_rows();
	}

  public function dataCutiAlasanPenting(){
		$this->db->select('*');
    	$this->db->from('permohonan_cuti');
        $this->db->where('keterangan','Cuti Alasan Penting');
    	$query=$this->db->get();
		return $query->num_rows();
	}

  // public function dataCutiBesar(){
	// 	$this->db->select('*');
  //   	$this->db->from('permohonan_cuti');
  //       $this->db->where('keterangan','Cuti Besar');
  //   	$query=$this->db->get();
	// 	return $query->num_rows();
	// }

  // public function dataCutiTahunan(){
	// 	$this->db->select('*');
  //   	$this->db->from('permohonan_cuti');
  //       $this->db->where('keterangan','Cuti Tahunan');
  //   	$query=$this->db->get();
	// 	return $query->num_rows();
	// }

  // public function dataCutiDiluarTN(){
	// 	$this->db->select('*');
  //   	$this->db->from('permohonan_cuti');
  //       $this->db->where('keterangan','Cuti Diluar Tanggungan Negara');
  //   	$query=$this->db->get();
	// 	return $query->num_rows();
	// }


  //riwayatcuti
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
  //   $query = "SELECT * from permohonan_cuti where keterangan = 'Cuti Besar' and verifikasi = '3' order by id_cuti DESC";
	// 	return $this->db->query($query)->result();
  // }
    
  // public function cutiTahunan()
  // {
  //   $query = "SELECT * from permohonan_cuti where keterangan = 'Cuti Tahunan' and verifikasi = '3' order by id_cuti DESC";
	// 	return $this->db->query($query)->result();
  // }

  // public function cutiDiluarTN()
  // {
  //   $query = "SELECT * from permohonan_cuti where keterangan = 'Cuti Diluar Tanggungan Negara' and verifikasi = '3' order by id_cuti DESC";
	// 	return $this->db->query($query)->result();
  // }

    public function getDataCutiDetail($id){
    $this->db->where('id_cuti',$id);
    $query=$this->db->get('permohonan_cuti');
    return $query->row_array();
   }

    public function getDataPimpinanDetail($id){
    $this->db->where('kode_pimpinan',$id);
    $query=$this->db->get('pimpinan');
    return $query->row_array();
   }

    public function selectStatus(){
        $this->db->select('verifikasi');
        $this->db->from('permohonan_cuti');
        $query = $this->db->get();

        if($query->num_rows() > 0){
            $row = $query->row_array();
            return $row;
        }
     }
}