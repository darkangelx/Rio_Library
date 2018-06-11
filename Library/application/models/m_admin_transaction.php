<?php

class M_admin_transaction extends CI_Model
{
	//transaction var
	var $reg_column_order = array('transaction_id','login_firstname','login_lastname','book_name','date_borrowed','date_return','tbl_transaction.book_status','date_transaction',null);
	var $reg_column_search = array('tbl_transaction.transaction_id','tbl_login.login_firstname','tbl_login.login_lastname','books.book_name','tbl_transaction.date_borrowed','tbl_transaction.date_return','tbl_transaction.book_status','tbl_transaction.date_transaction');
	var $reg_order = array('date_transaction' => 'desc');

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

    function get_status_field()
    {
        if(isset($_POST['columns'][6]['search']['value']) and $_POST['columns'][6]['search']['value'] !=''){
            $this->db->where('book_status',$_POST['columns'][6]['search']['value']);
        }
    }

    function get_user_field()
    {
        if(isset($_POST['columns'][1]['search']['value']) and $_POST['columns'][1]['search']['value'] !=''){
            $this->db->where('tbl_transaction.user_id',$_POST['columns'][1]['search']['value']);
        }
    }

    function get_book_field()
    {
        if(isset($_POST['columns'][2]['search']['value']) and $_POST['columns'][2]['search']['value'] !=''){
            $this->db->where('tbl_transaction.book_id',$_POST['columns'][2]['search']['value']);
        }
    }

	private function get_transactionTable_query() {
		$this->db->from('tbl_transaction');
		$this->db->join('tbl_login','tbl_login.login_id = tbl_transaction.user_id');
		$this->db->join('books','books.book_id = tbl_transaction.book_id');
		
		$i = 0;

		foreach ($this->reg_column_search as $sdata) {
			if($_POST['search']['value']) {
				if($i === 0) {
					$this->db->group_start();
					$this->db->like($sdata, $_POST['search']['value']);
				} else {
					$this->db->or_like($sdata, $_POST['search']['value']);
				}
				if(count($this->reg_column_search) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}
		if(isset($_POST['order'])) {
			$this->db->order_by($this->reg_column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if(isset($this->reg_order)) {
			$order = $this->reg_order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	public function get_allbooks() {
		$query = $this->db->query("SELECT * FROM books ORDER BY book_name ASC");
		return ($query->num_rows() > 0) ? $query->result() : false;
	}	

	public function get_bookname() {
		$query = $this->db->query("SELECT * FROM books WHERE status = 1 ORDER BY book_name ASC");
		return ($query->num_rows() > 0) ? $query->result() : false;
	}

	public function get_user() {
		$query = $this->db->query("SELECT * FROM tbl_login ORDER BY login_lastname ASC");
		return ($query->num_rows() > 0) ? $query->result() : false;
	}

	public function get_transaction_data() {
		$this->get_transactionTable_query();
		$this->get_status_field();
		$this->get_user_field();
		$this->get_book_field();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function transaction_count_filtered() {
		$this->get_transactionTable_query();
		$this->get_status_field();
		$this->get_user_field();
		$this->get_book_field();
		$query = $this->db->get();
		return $query->num_rows();
	}	

	public function transaction_count_all() {
		$this->db->from('tbl_transaction');
		return $this->db->count_all_results();
	}

	public function save_transaction($data) {
		$this->db->insert('tbl_transaction', $data);
		return $this->db->insert_id();
	}

	public function get_transaction($id) {
		$this->db->from('tbl_transaction');
		$this->db->where('transaction_id', $id);
		$query = $this->db->get();

		return $query->row();
	}

	public function update_status($where, $data) {
		$this->db->update('books', $data, $where);
		return $this->db->affected_rows();
	}

	public function update_transaction($where, $data) {
		$this->db->update('tbl_transaction', $data, $where);
		return $this->db->affected_rows();
	}
}
?>