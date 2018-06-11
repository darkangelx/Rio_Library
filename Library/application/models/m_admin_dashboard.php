<?php

class M_admin_dashboard extends CI_Model
{
	//books var
	var $reg_column_order = array('book_name','author','book_genre','lib_section','status',null);
	var $reg_column_search = array('book_name','author','book_genre','lib_section','status');
	var $reg_order = array('book_name' => 'asc');

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function get_all_books()
	{
		return $this->db->count_all_results('books');
	}

	private function get_bookTable_query() {
		$this->db->from('books');
		$this->db->join('book_genre','books.genre_id = book_genre.genre_id');
		$this->db->join('book_section','books.sec_id = book_section.sec_id');
		$this->db->where('status = 1');
		
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

    function get_name_field()
    {
        if(isset($_POST['columns'][0]['search']['value']) and $_POST['columns'][0]['search']['value'] !=''){
            $this->db->where('book_id',$_POST['columns'][0]['search']['value']);
        }
    }
    function get_author_field()
    {
        if(isset($_POST['columns'][1]['search']['value']) and $_POST['columns'][1]['search']['value'] !=''){
            $this->db->where('book_id',$_POST['columns'][1]['search']['value']);
        }
    }
    function get_genre_field()
    {
        if(isset($_POST['columns'][2]['search']['value']) and $_POST['columns'][2]['search']['value'] !=''){
            $this->db->where('books.genre_id',$_POST['columns'][2]['search']['value']);
        }
    }
    function get_section_field()
    {
        if(isset($_POST['columns'][3]['search']['value']) and $_POST['columns'][3]['search']['value'] !=''){
            $this->db->where('books.sec_id',$_POST['columns'][3]['search']['value']);
        }
    }
	public function get_book_data() {
		$this->get_bookTable_query();
		$this->get_name_field();
		$this->get_author_field();
		$this->get_genre_field();
		$this->get_section_field();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function book_count_filtered() {
		$this->get_bookTable_query();
		$this->get_name_field();
		$this->get_author_field();
		$this->get_genre_field();
		$this->get_section_field();
		$query = $this->db->get();
		return $query->num_rows();
	}	

	public function book_count_all() {
		$this->db->from('books');
		return $this->db->count_all_results();
	}

	public function get_bookname() {
		$query = $this->db->query("SELECT * FROM books ORDER BY book_name ASC");
		return ($query->num_rows() > 0) ? $query->result() : false;
	}

	public function get_bookauthor() {
		$query = $this->db->query("SELECT * FROM books WHERE author IS NOT NULL ORDER BY author ASC");
		return ($query->num_rows() > 0) ? $query->result() : false;
	}

	public function get_bookgenre() {
		$query = $this->db->query("SELECT * FROM book_genre ORDER BY book_genre ASC");
		return ($query->num_rows() > 0) ? $query->result() : false;
	}

	public function get_booksection() {
		$query = $this->db->query("SELECT * FROM book_section ORDER BY lib_section ASC");
		return ($query->num_rows() > 0) ? $query->result() : false;
	}

	public function get_book($book_id) {
		$this->db->from('books');
		$this->db->where('book_id', $book_id);
		$query = $this->db->get();

		return $query->row();
	}
	public function save_book($data) {
		$this->db->insert('books', $data);
		return $this->db->insert_id();
	}

	public function update_book($where, $data) {
		$this->db->update('books', $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_book($book_id) {
		$this->db->query("DELETE FROM books WHERE book_id = '".$book_id."'");
	}

}
?>