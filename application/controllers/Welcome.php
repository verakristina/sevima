<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{
		$this->load->view('template/header');
		$this->load->view('index');
		$this->load->view('template/footer');
	}

	public function validateLogin()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'required' => 'Harap isi bidang email!',
            'valid_email' => 'Email tidak valid!',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required' => 'Harap isi bidang password!',
        ]);
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('false-login', true);
            $this->session->set_flashdata('validateLoginFalse', $this->form_validation->error_array());
            $this->load->library('user_agent');
            redirect($this->agent->referrer());
        } else {
            //validasi sukses
            $this->login();
        }
    }

	private function login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('siswa', ['email' => $email])->row_array();

        if ($user) {
            //user ada
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                    ];

                    $this->session->set_userdata($data);
                    redirect(base_url('user'));
                } else {
                    $this->session->set_flashdata('fail-pass', 'Gagal!');
                    redirect(base_url('welcome'));
                }
            } else {
                $this->session->set_flashdata('fail-email', 'Gagal!');
                redirect(base_url('welcome'));
            }
        } else {
            $this->session->set_flashdata('fail-login', 'Gagal!');
            redirect(base_url('welcome'));
        }
    }
	//admin
	public function admin()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'required' => 'Harap isi bidang email!',
            'valid_email' => 'Email tidak valid!',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required' => 'Harap isi bidang password!',
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('admin/login');
        } else {
            //validasi sukses
            $this->adminlogin();
        }
    }

    private function adminlogin()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('admin', ['email' => $email])->row_array();

        if ($user) {
            //cek password
            if (password_verify($password, $user['password'])) {
                $data = [

                    'email' => $user['email'],
                    'nama' => $user['username'],

                ];
                $this->session->set_userdata($data);
                redirect(base_url('admin'));
            } else {
                $this->session->set_flashdata('email', $email);
                $this->session->set_flashdata('password', $password);
                $this->session->set_flashdata('fail-pass', 'Gagal!');
                redirect(base_url('welcome/admin'));
            }
        } else {
            $this->session->set_flashdata('email', $email);
            $this->session->set_flashdata('password', $password);
            $this->session->set_flashdata('fail-login', 'Gagal!');
            redirect(base_url('welcome/admin'));
        }
    }

	    // Guru
		public function guru()
		{
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
				'required' => 'Harap isi bidang email!',
				'valid_email' => 'Email tidak valid!',
			]);
			$this->form_validation->set_rules('password', 'Password', 'trim|required', [
				'required' => 'Harap isi bidang password!',
			]);
			if ($this->form_validation->run() == false) {
				$this->load->view('welcome');
			} else {
				//validasi sukses
				$this->guru_login_process();
			}
		}
	
		private function guru_login_process()
		{
			$email = $this->input->post('email');
			$password = $this->input->post('password');
	
			$user = $this->db->get_where('guru', ['email' => $email])->row_array();
	
			if ($user) {
				//cek password
				if (password_verify($password, $user['password'])) {
					$data = [
	
						'email' => $user['email'],
						'nama_guru' => $user['nama_guru'],
	
					];
					$this->session->set_userdata($data);
					redirect(base_url('guru'));
				} else {
					$this->session->set_flashdata('email', $email);
					$this->session->set_flashdata('password', $password);
					$this->session->set_flashdata('fail-pass', 'Gagal!');
					redirect(base_url('welcome'));
				}
			} else {
				$this->session->set_flashdata('email', $email);
				$this->session->set_flashdata('password', $password);
				$this->session->set_flashdata('fail-login', 'Gagal!');
				redirect(base_url('welcome'));
			}
		}
	
}
