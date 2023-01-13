<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_Pegawai extends CI_Model {

    public function getDataPegawai(){
        $query=$this->db->get('user');
        return $query->result();
     }

  public function selectJenisKel(){
        $this->db->select('jenis_kel');
        $this->db->from('user');
        $query = $this->db->get();

        if ( $query->num_rows() > 0 )
        {
            $row = $query->row_array();
            return $row;
        }
     } 

    public function getPegawaiByEdit($id)
    {
        return $this->db->get_where('user', ['kode_pegawai' => $id])->row_array();
    }

    public function editProfil()
    {
        $data = [

            "nik" => $this->input->post('nik', true),
            "nama" => $this->input->post('nama', true),
            "alamat" => $this->input->post('alamat', true),
            "jabatan" => $this->input->post('jabatan', true),
            "no_telp" => $this->input->post('notelp', true),
            "jenis_kel" => $this->input->post('jeniskel', true),
            "email" => $this->input->post('email', true),
            "password" => $this->input->post('password', true),
        ];

        $this->db->where('kode_pegawai', $this->input->post('kode_pegawai'));
        $this->db->update('user', $data);
    }
}