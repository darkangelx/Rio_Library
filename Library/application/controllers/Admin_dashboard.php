<?php defined('BASEPATH') OR exit('No direct script accesss allowed');

class Admin_dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin_dashboard');
	}	

	public function index()
	{
		$this->load->helper('url');
		if($this->session->userdata('logged_in')){
			$book = $this->m_admin_dashboard->get_bookname();
			$data['book'] = $book;

			$author = $this->m_admin_dashboard->get_bookauthor();
			$data['author'] = $author;

 			$genre = $this->m_admin_dashboard->get_bookgenre();
			$data['genre'] = $genre;

			$section = $this->m_admin_dashboard->get_booksection();
			$data['section'] = $section;
			$this->load->view('Admin_dashboard', $data);
		}
		else {
			redirect('admin_login?redirect='.current_url(), 'refresh');
		}
	}

	public function book_list() {
		$list = $this->m_admin_dashboard->get_book_data();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $book) {
			$no++;
			$row = array();
			$row[] = $book->book_name;
			$row[] = $book->author;
			$row[] = $book->book_genre;
			$row[] = $book->lib_section;
			$avail = $book->status;
			if($avail){
				$row[] = "Available";
			}
 			$row[] = '<button class="btn btn-info btn-sm" onclick="edit_book('."'".$book->book_id."'".')" data-toggle="tooltip" data-placement="bottom" title="Click to edit"><span class="fa fa-pencil"></span></button>
                      <button class="btn btn-danger btn-sm" onclick="delete_book('."'".$book->book_id."'".')" data-toggle="tooltip" data-placement="bottom" title="Click to delete"><span class="fa fa-trash-o"></span></button>';
            $data[] = $row;
		}
		$output = array("draw" => $_POST['draw'],
						"recordsTotal" => $this->m_admin_dashboard->book_count_all(),
						"recordsFiltered" => $this->m_admin_dashboard->book_count_filtered(),
						"data" => $data,);
		echo json_encode($output);
	}
	
	public function edit_book($book_id) {
		$data = $this->m_admin_dashboard->get_book($book_id);
		echo json_encode($data);
	}

	public function add_book() {
		$this->book_validate();
		$data = array(
			'book_name' => $this->input->post('book_name'),
			'author' => $this->input->post('author'),
			'genre_id' => $this->input->post('genre'),
			'sec_id' => $this->input->post('section'),
			'status	' => $this->input->post('status'),
			);
		$insert = $this->m_admin_dashboard->save_book($data);
		echo json_encode(array("status" => TRUE));
	}

	public function update_book() {
		$this->book_validate();
		$data = array(
			'book_name' => $this->input->post('book_name'),
			'author' => $this->input->post('author'),
			'genre_id' => $this->input->post('genre'),
			'sec_id' => $this->input->post('section'),
			'status	' => $this->input->post('status'),
			);
		$this->m_admin_dashboard->update_book(array('book_id' => $this->input->post('book_id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete_book($book_id) {
		$this->m_admin_dashboard->delete_book($book_id);
		echo json_encode(array("status" => TRUE));
	}

	private function book_validate() {
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('book_name') == ''){
			$data['inputerror'][] = 'book_name';
			$data['error_string'][] = 'Book Field is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('author') == ''){
			$data['inputerror'][] = 'author';
			$data['error_string'][] = 'Author Field is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('genre') == ''){
			$data['inputerror'][] = 'genre';
			$data['error_string'][] = 'Genre Field is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('section') == ''){
			$data['inputerror'][] = 'section';
			$data['error_string'][] = 'Section Field is required';
			$data['status'] = FALSE;
		}
	}
}