<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_auth extends CI_Model
{
	private $_table = "m_user";
	const SESSION_KEY = 'user_id';

	public function rules()
	{
		return [
			[
				'field' => 'username',
				'label' => 'Username or Email',
				'rules' => 'required'
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required|max_length[255]'
			]
		];
	}

	public function login($username, $password, $role)
	{
		$query = $this->db->query("SELECT * FROM m_user WHERE ACTIVE_FLAG = 'Y' AND ROLE = '$role' AND (EMAIL = '$username' OR USERNAME = '$username')");
		$user = $query->row();

		// cek apakah user sudah terdaftar?
		if (!$user) {
			return FALSE;
		}

		// cek apakah passwordnya benar?
		if (!password_verify($password, $user->PASSWORD)) {
			return FALSE;
		}

		// bikin session
		$this->session->set_userdata([self::SESSION_KEY => $user->USER_ID, 'role' => $user->ROLE]);
		$this->_update_last_login($user->USER_ID);

		return $this->session->has_userdata(self::SESSION_KEY);
	}

	public function loginClient($username, $password, $role)
	{
		$query = $this->db->query("SELECT * FROM m_user WHERE ACTIVE_FLAG = 'Y' AND ROLE = '$role' AND (EMAIL = '$username' OR USERNAME = '$username')");
		$user = $query->row();
		$this->load->library('encryption');

		// cek apakah user sudah terdaftar?
		if (!$user) {
			return FALSE;
		}

		// cek apakah passwordnya benar?
		$user->PASSWORD = $this->encryption->decrypt($user->PASSWORD);
		if ($password != $user->PASSWORD) {
			return FALSE;
		}

		// bikin session
		$this->session->set_userdata([self::SESSION_KEY => $user->USER_ID, 'role' => $user->ROLE, 'ID_USER'=> $user->USER_ID]);
		$this->_update_last_login($user->USER_ID);

		return $this->session->has_userdata(self::SESSION_KEY);
	}

	public function current_user($role)
	{
		if (!$this->session->has_userdata(self::SESSION_KEY)) {
			return null;
		}

		$user_id = $this->session->userdata(self::SESSION_KEY);
		$query = $this->db->get_where($this->_table, ['USER_ID' => $user_id, 'ROLE' => $role]);
		return $query->row();
	}

	public function logout()
	{
		$this->session->unset_userdata(self::SESSION_KEY);
		return !$this->session->has_userdata(self::SESSION_KEY);
	}

	private function _update_last_login($id)
	{
		$data = [
			'LAST_LOGIN' => date("Y-m-d H:i:s"),
		];

		return $this->db->update($this->_table, $data, ['USER_ID' => $id]);
	}

	public function sanitize_trim_numchar($value){
		$value = strip_tags($value);
		$is_secure = preg_match("/^[a-zA-Z0-9]+$/", $value);

		return $is_secure;
	}
}
