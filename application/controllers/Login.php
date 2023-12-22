<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function index()
	{
		show_404();
	}

    public function auth()
	{	
		$this->load->library('form_validation');

		$rules = $this->Model_auth->rules();
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() == FALSE){
			return $this->load->view('./auth/login');
		}

		$email = $this->input->post('email');
		$password = $this->input->post('password');
		
        $data['email'] = $email;
        $data['password'] = $password;
		
        if($this->Model_auth->login($email, $password)){
            redirect('Home');
        }else{
            $data['STATUS'] = 'invalid';
        }

		$this->load->view('./auth/login', $data);
	}

	public function logout()
	{
		$this->Model_auth->logout();
		redirect('Login/auth');
	}
}
