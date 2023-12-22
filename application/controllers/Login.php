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

		$username = $this->input->post('username');
		$is_secure = $this->Model_auth->sanitize_trim_numchar($username);

		$password = $this->input->post('password');
		if($is_secure == 1){
			$is_secure = $this->Model_auth->sanitize_trim_numchar($password);
		}
		
		$role = 'ADMIN';

		if($is_secure != 1){
			$data['STATUS'] = 'invalid';
		}else{
			if($this->Model_auth->login($username, $password, $role)){
				redirect('Home');
			}else{
				$data['STATUS'] = 'invalid';
			}
		}

		$this->load->view('login', $data);
	}

	public function logout()
	{
		$this->Model_auth->logout();
		redirect(site_url());
	}
}
