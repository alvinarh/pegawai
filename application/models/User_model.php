<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    //id admin
    public function getIdAdmin() {
        $this->db->select('MAX(RIGHT(id_admin,5)) as id_admin',FALSE);
      $this->db->from('admin');
      $this->db->where('id_admin !=','NULL');
      $query=$this->db->get();
      $kode=$query->row();
      $num=substr($kode->id_admin,1,5);
      $add=(int)$num+1;
      if(strlen($add)==1){
          $kodebaru="0000".$add;
      }else if(strlen($add)==2){
          $kodebaru="000".$add;
      }else if(strlen($add)==3){
          $kodebaru="00".$add;
      }else if(strlen($add)==4){
          $kodebaru="0".$add;
      }else{
          $kodebaru="".$add;
      }
      $id_admin='ADM-'.date('Y').'-'.$kodebaru;

      return $id_admin;
    }

    //generate id pimpinan
    public function getIdPimpinan() {
        $this->db->select('MAX(RIGHT(kode_pimpinan,5)) as kode_pimpinan',FALSE);
      $this->db->from('pimpinan');
      $this->db->where('kode_pimpinan !=','NULL');
      $query=$this->db->get();
      $kode=$query->row();
      $num=substr($kode->kode_pimpinan,1,5);
      $add=(int)$num+1;
      if(strlen($add)==1){
          $kodebaru="0000".$add;
      }else if(strlen($add)==2){
          $kodebaru="000".$add;
      }else if(strlen($add)==3){
          $kodebaru="00".$add;
      }else if(strlen($add)==4){
          $kodebaru="0".$add;
      }else{
          $kodebaru="".$add;
      }
      $id_pimpinan='LDR-'.date('Y').'-'.$kodebaru;

      return $id_pimpinan;
    }

    public function getIdPegawai() {
        $this->db->select('MAX(RIGHT(kode_pegawai,5)) as kode_pegawai',FALSE);
      $this->db->from('user');
      $this->db->where('kode_pegawai !=','NULL');
      $query=$this->db->get();
      $kode=$query->row();
      $num=substr($kode->kode_pegawai,1,5);
      $add=(int)$num+1;
      if(strlen($add)==1){
          $kodebaru="0000".$add;
      }else if(strlen($add)==2){
          $kodebaru="000".$add;
      }else if(strlen($add)==3){
          $kodebaru="00".$add;
      }else if(strlen($add)==4){
          $kodebaru="0".$add;
      }else{
          $kodebaru="".$add;
      }
      $id_pegawai='PGW-'.date('Y').'-'.$kodebaru;

      return $id_pegawai;
    }


    public function getDataAdmin($admin_id){
         $results = array();
    	$this->db->select('*');
    	$this->db->from('admin');
    	$this->db->where('admin.id_admin', $admin_id);
        $query=$this->db->get();
       if($query->num_rows()>0){
    		$results = $query->result();
    	} return $results;
    }

    // karyawan log in
    public function login_pegawai($email, $password)
    {
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        return $this->db->get('user', 1);

    }

    //pimpinan log in
    public function login_pimpinan($email, $password){
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        return $this->db->get('pimpinan',1);
    }

    // admin log in
    public function login_admin($email, $password)
    {
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        return $this->db->get('admin', 1);
    }
}
