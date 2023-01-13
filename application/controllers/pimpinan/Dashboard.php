<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller 
{
    function __construct()
    { 
        parent::__construct();
		// check_login();
        $this->load->model('pimpinan/M_Cuti');
        $this->load->model('pimpinan/M_Pegawai');
        $this->CI = &get_instance();
    }
 
    public function index()
    { 
        $data['title']  = 'Dashboard';
        $data['session'] = $this->session->userdata('nama');
        // $user = $this->db->query('select * from pimpinan where nama = "'.$_SESSION['nama'].'"')->row();

        $data['total_pegawai'] = $this->db->get("user")->num_rows();
        $data['cuti_sakit'] = $this->M_Cuti->dataCutiSakit();
        $data['cuti_sakit14'] = $this->M_Cuti->dataCutiSakit14();
        $data['cuti_melahirkan'] = $this->M_Cuti->dataCutiMelahirkan();
        $data['cuti_alasanpenting'] = $this->M_Cuti->dataCutiAlasanPenting();

        // get data nama user (untuk tampil di sidebar dan navbar)
        $data['nama']   = $this->session->userdata('nama');
        $id = $this->session->userdata('nama');
        $data['user'] = $this->db->get_where('pimpinan', ['nama' => $id])->row();

        $this->load->view('theme_pimpinan/header', $data);
        $this->load->view('pimpinan/dashboard', $data);
        $this->load->view('theme_pimpinan/footer', $data);
    }
    // public function karyawan()
    // {
    //     $data['title']  = 'Total Pegawai';
    //     // get data username user (untuk tampil di sidebar dan navbar)
    //     $data['user']   = $this->db->query('select * from admin where username = "'.$_SESSION['username'].'"')->row();

    //     $this->load->view('theme_admin/header', $data);
    //     $this->load->view('admin/pegawai/daftar_pegawai', $data);
    //     $this->load->view('theme_admin/footer', $data);
    // }
    // public function cuti_Diterima()
    // {
    //     $data['title']  = 'Cuti Diterima';
    //     // get data username user (untuk tampil di sidebar dan navbar)
    //     $data['user']   = $this->db->query('select * from admin where username = "'.$_SESSION['username'].'"')->row();

    //     $this->load->view('theme_admin/header', $data);
    //     $this->load->view('admin/daftar_cuti/diterima', $data);
    //     $this->load->view('theme_admin/footer', $data);
    // }
    // public function total_cuti(){
    //     $this->load->view('admin/daftar_cuti/index');
    // }

}
