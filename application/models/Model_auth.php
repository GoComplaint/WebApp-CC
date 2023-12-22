<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_auth extends CI_Model
{
	const SESSION_KEY = 'user_id';

	public function rules()
	{
		return [
			[
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required'
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required|max_length[255]'
			]
		];
	}

	public function login($email, $password)
	{
		$api_post = $this->config->item('api_url')."/auth/login";
		$data_payload = json_encode(array(
            'email' => $email,
            'password' => $password
        ));

		$data_res = json_decode($this->Model_global->postCURL($api_post, $data_payload));

		// cek apakah user sudah terdaftar?
		if (!$data_res || $data_res->user->role != 'admin') {
			return FALSE;
		}

		// bikin session
		$this->session->set_userdata([self::SESSION_KEY => $data_res->id, 'username' => $data_res->user->username, 'accessToken' => $data_res->access_token, 'refreshToken' => $data_res->refresh_token]);

		return $this->session->has_userdata(self::SESSION_KEY);
	}

	public function current_user()
	{
		if (!$this->session->has_userdata(self::SESSION_KEY)) {
			return null;
		}
		return TRUE;
	}

	public function logout()
	{

		// Call API Logout
		$api_post = $this->config->item('api_url')."/auth/logoutAll";
		$data_payload = json_encode(array(
            'refresh_token' => $this->session->userdata['refresh_token'],
        ));
		$data_res = $this->Model_global->postCURL($api_post, $data_payload);

		
		$this->session->unset_userdata(self::SESSION_KEY);
		return !$this->session->has_userdata(self::SESSION_KEY);
	}

	public function sanitize_trim_numchar($value){
		$value = strip_tags($value);
		$is_secure = preg_match("/^[a-zA-Z0-9]+$/", $value);

		return $is_secure;
	}
}
