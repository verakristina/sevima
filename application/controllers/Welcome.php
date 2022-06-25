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
}
