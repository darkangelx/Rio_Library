<?php

class M_admin_login extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function login($username, $password)
	{
		$this->db->select('login_id, login_firstname, login_lastname, login_username, login_password');
		$this->db->from('tbl_login');
		$this->db->where('login_username', $username);
		$this->db->where('login_password', $password);
		$this->db->limit(1);

		$query = $this->db->get();

		if($query->num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
}