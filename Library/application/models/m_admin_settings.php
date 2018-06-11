<?php

class M_admin_settings extends CI_Model
{
	//genre var
	var $g_column_order = array('book_genre',null);
	var $g_column_search = array('book_genre');
	var $g_order = array('book_genre' => 'asc');

	//sectiom var
	var $s_column_order = array('lib_section',null);
	var $s_column_search = array('lib_section');
	var $s_order = array('lib_section' => 'asc');

	//users var
	var $u_column_order = array('login_firstname','login_lastname',null);
	var $u_column_search = array('login_firstname','login_lastname');
	var $u_order = array('login_lastname' => 'asc');

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	private function get_genreTable_query() {
		$this->db->from('book_genre');
		$i = 0;

		foreach ($this->g_column_search as $sdata) {
			if($_POST['search']['value']) {
				if($i === 0) {
					$this->db->group_start();
					$this->db->like($sdata, $_POST['search']['value']);
				} else {
					$this->db->or_like($sdata, $_POST['search']['value']);
				}
				if(count($this->g_column_search) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}
		if(isset($_POST['order'])) {
			$this->db->order_by($this->g_column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if(isset($this->g_order)) {
			$order = $this->g_order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	public function get_genre_data() {
		$this->get_genreTable_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function genre_count_filtered() {
		$this->get_genreTable_query();
		$query = $this->db->get();
		return $query->num_rows();
	}	

	public function genre_count_all() {
		$this->db->from('book_genre');
		return $this->db->count_all_results();
	}


	public function get_genre($genre_id) {
		$this->db->from('book_genre');
		$this->db->where('genre_id', $genre_id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save_genre($data) {
		$this->db->insert('book_genre', $data);
		return $this->db->insert_id();
	}

	public function update_genre($where, $data) {
		$this->db->update('book_genre', $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_genre($genre_id) {
		$this->db->query("DELETE FROM book_genre WHERE genre_id = '".$genre_id."'");
	}

	private function get_sectionTable_query() {
		$this->db->from('book_section');
		$i = 0;

		foreach ($this->s_column_search as $sdata) {
			if($_POST['search']['value']) {
				if($i === 0) {
					$this->db->group_start();
					$this->db->like($sdata, $_POST['search']['value']);
				} else {
					$this->db->or_like($sdata, $_POST['search']['value']);
				}
				if(count($this->s_column_search) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}
		if(isset($_POST['order'])) {
			$this->db->order_by($this->s_column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if(isset($this->s_order)) {
			$order = $this->s_order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	public function get_section_data() {
		$this->get_sectionTable_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function section_count_filtered() {
		$this->get_sectionTable_query();
		$query = $this->db->get();
		return $query->num_rows();
	}


	public function section_count_all() {
		$this->db->from('book_section');
		return $this->db->count_all_results();
	}

	public function get_section($sec_id) {
		$this->db->from('book_section');
		$this->db->where('sec_id', $sec_id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save_section($data) {
		$this->db->insert('book_section', $data);
		return $this->db->insert_id();
	}

	public function update_section($where, $data) {
		$this->db->update('book_section', $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_section($sec_id) {
		$this->db->query("DELETE FROM book_section WHERE sec_id = '".$sec_id."'");
	}


	private function get_userTable_query() {
		$this->db->from('tbl_login');
		$i = 0;

		foreach ($this->u_column_search as $sdata) {
			if($_POST['search']['value']) {
				if($i === 0) {
					$this->db->group_start();
					$this->db->like($sdata, $_POST['search']['value']);
				} else {
					$this->db->or_like($sdata, $_POST['search']['value']);
				}
				if(count($this->u_column_search) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}
		if(isset($_POST['order'])) {
			$this->db->order_by($this->u_column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if(isset($this->u_order)) {
			$order = $this->u_order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	public function get_user_data() {
		$this->get_userTable_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function user_count_filtered() {
		$this->get_userTable_query();
		$query = $this->db->get();
		return $query->num_rows();
	}


	public function user_count_all() {
		$this->db->from('tbl_login');
		return $this->db->count_all_results();
	}

	public function get_user($user_id) {
		$this->db->from('tbl_login');
		$this->db->where('login_id', $user_id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save_user($data) {
		$this->db->insert('tbl_login', $data);
		return $this->db->insert_id();
	}

	public function update_user($where, $data) {
		$this->db->update('tbl_login', $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_user($login_id) {
		$this->db->query("DELETE FROM tbl_login WHERE login_id = '".$login_id."'");
	}
}