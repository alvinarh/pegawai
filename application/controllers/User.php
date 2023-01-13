<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('email');
        $this->load->model('User_model');
        $this->load->helper('url', 'form');
        $this->load->model('auth/Auth_model', 'auth');
        $this->load->library(array('form_validation', 'session'));
        $this->CI = &get_instance();
    }

    //membuat method function untuk redirect login 
    function index()
    {
        if (!$this->session->userdata('logged_in') == TRUE) {
            $this->load->view('user/login_admin');
        } else {
            $url = base_url('User');
            redirect($url);
        }
    }

    public function login()
    {
        $this->load->view('user/login');
    }

    public function loginuser()
	{
		$this->form_validation->set_rules('email', 'email', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->load->view('user/login');
		} else {

			// cek username
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$user = $this->auth->getEmailUsers($email);
			// $user_id = $user->kode;
			// if ($query->num_rows() > 0) {

			if ($user) {
				// var_dump($this->db->last_query());
				// die;
				if ($password == $user->password) {
					$query = $this->auth->getUserPassUsers($email, $password);
					$data = $query->row();

					if ($data->role == 1) {
						$this->CI->session->set_userdata('userid', $data->kode);
						$this->CI->session->set_userdata('nama', $data->nama);
						$this->CI->session->set_userdata('email', $data->email);
						$this->CI->session->set_userdata('role_id', 1);
						$this->CI->session->set_userdata('logged_in', true);
						redirect('admin/dashboard');
					} elseif ($data->role == 2) {
						$this->CI->session->set_userdata('userid', $data->kode);
						$this->CI->session->set_userdata('nama', $data->nama);
						$this->CI->session->set_userdata('email', $data->email);
						$this->CI->session->set_userdata('role_id', 2);
						$this->CI->session->set_userdata('logged_in', true);
						redirect('pimpinan/dashboard');
					} elseif ($data->role == 3) {
						$this->CI->session->set_userdata('userid', $data->kode);
						$this->CI->session->set_userdata('nama', $data->nama);
						$this->CI->session->set_userdata('email', $data->email);
						$this->CI->session->set_userdata('role_id', 3);
						$this->CI->session->set_userdata('logged_in', true);
						redirect('pegawai/dashboard');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" style="color:red;" role="alert">Akun Login Salah</div>');
					redirect('user/login');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" style="color:red;" role="alert">' . 'Akun belum terdaftar.' . '</div>');
				redirect('user/login');
			}
		}
    }
}
public function logout()
{
    $this->session->sess_destroy();

    // Set message
    $this->session->set_flashdata('user_loggedout', 'You are now logged out');

    redirect('user/login');
}

   

    



    // Log in pimpinan
    // public function login_pimpinan()
    // {
    //     $this->form_validation->set_rules('email', 'Email', 'trim|required');
    //     $this->form_validation->set_rules('password', 'Password', 'trim|required');

    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('user/login_pimpinan');
    //     } else {
    //         $email = $this->input->post('email', true);
    //         $password = md5($this->input->post('password', true));
    //         $validasi = $this->User_model->login_pimpinan($email, $password);

    //         if ($validasi->num_rows() > 0) {
    //             $data             = $validasi->row_array();
    //             $kode_pimpinan    = $data['kode_pimpinan'];
    //             $nama             = $data['nama'];
    //             $role             = $data['role'];

    //             $sessdata = array(
    //                 'kode_pimpinan '  => $kode_pimpinan,
    //                 'nama'            => $nama,
    //                 'role'            => $role,
    //                 'pimpinan'        => true
    //             );

    //             $this->session->set_userdata($sessdata);
    //             if ($kode_pimpinan  === $kode_pimpinan) {
    //                 redirect('pimpinan/dashboard');
    //             }
    //         } else {
    //             $this->session->set_flashdata('msg', '<div class="alert alert-danger" style="border-radius: 6px;">
    //                                                         <i data-feather="bell"></i>
    //                                                         <p> Password atau Email yang dimasukan salah !!</p>
    //                                                     </div>');

    //             redirect('User');
    //         }
    //     }
    // }

    // Log in pegawai
    // public function login_pegawai()
    // {
    //     $this->form_validation->set_rules('email', 'Email', 'trim|required');
    //     $this->form_validation->set_rules('password', 'Password', 'trim|required');

    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('user/login_pegawai');
    //     } else {
    //         $email = $this->input->post('email', true);
    //         $password = $this->input->post('password', true);
    //         $validasi = $this->User_model->login_pegawai($email, $password);

    //         if ($validasi->num_rows() > 0) {
    //             $data            = $validasi->row_array();
    //             $kode_pegawai    = $data['kode_pegawai'];
    //             $role            = $data['role'];
    //             $nama            = $data['nama'];

    //             $sessdata = array(
    //                 'kode_pegawai '  => $kode_pegawai,
    //                 'nama'           => $nama,
    //                 'role'           => $role,
    //                 'pegawai'        => true
    //             );

    //             $this->session->set_userdata($sessdata);
    //             if ($kode_pegawai  === $kode_pegawai) {
    //                 redirect('pegawai/dashboard');
    //             }
    //         } else {
    //             $this->session->set_flashdata('msg', '<div class="alert alert-danger" style="border-radius: 6px;">
    //                                                         <i data-feather="bell"></i>
    //                                                         <p> Password atau Email yang dimasukan salah !!</p>
    //                                                     </div>');

    //             redirect('User');
    //         }
    //     }
    // }

    // Log in admin
    // public function login_admin()
    // {
    //     $this->form_validation->set_rules('email', 'Email', 'trim|required');
    //     $this->form_validation->set_rules('password', 'Password', 'trim|required');

    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('user/login_admin');
    //     } else {
    //         $email = $this->input->post('email', true);
    //         $password = md5($this->input->post('password', true));
    //         $validasi = $this->User_model->login_admin($email, $password);

    //         if ($validasi->num_rows() > 0) {
    //             $data           = $validasi->row_array();
    //             $userid         = $data['id_admin'];
    //             $username       = $data['username'];
    //             $role           = $data['role'];

    //             $sessdata = array(
    //                 'id_admin'      => $userid,
    //                 'username'      => $username,
    //                 'role'          => $role,
    //                 'admin'         => true
    //             );

    //             $this->session->set_userdata($sessdata);
    //             if ($userid === $userid) {
    //                 redirect('admin/dashboard');
    //             }
    //         } else {
    //             $this->session->set_flashdata('msg', '<div class="alert alert-danger" style="border-radius: 6px;">
    //                                                         <i data-feather="bell"></i>
    //                                                         <p>Wrong username and password !!</p>
    //                                                     </div>');

    //             redirect('User');
    //         }
    //     }
    // }

    // Log user out
    // public function logout()
    // {

    //     $this->session->sess_destroy();

    //     // Set message
    //     $this->session->set_flashdata('user_loggedout', 'You are now logged out');

    //     redirect('User');
    // }

    }

