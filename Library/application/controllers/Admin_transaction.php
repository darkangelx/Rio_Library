<?php defined('BASEPATH') OR exit('No direct script accesss allowed');

class Admin_transaction extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin_transaction');
	}	

	public function index()
	{
		$this->load->helper('url');
		if($this->session->userdata('logged_in')){
			$book = $this->m_admin_transaction->get_bookname();
			$data['book'] = $book;

			$book1 = $this->m_admin_transaction->get_allbooks();
			$data['book1'] = $book1;

			$user = $this->m_admin_transaction->get_user();
			$data['user'] = $user;
			$this->load->view('admin_transaction', $data);
		}
		else {
			redirect('admin_login?redirect='.current_url(), 'refresh');
		}
	}

	public function transaction_list() {
		$list = $this->m_admin_transaction->get_transaction_data();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $t) {
			$no++;
			$row = array();
			$row[] = $t->transaction_id;
			$row[] = $t->login_firstname. " " .$t->login_lastname;
			$row[] = $t->book_name;
			$row[] = $t->date_borrowed;
			$row[] = $t->date_return;
			$row[] = $t->date_transaction;
			//$row[] = $t->book_status;
			$avail = $t->book_status;
			if($avail == 1){
				$row[] = "Return";
			}else{
				$row[] = "Borrowed";
			}
 			$row[] = '<button class="btn btn-info btn-sm" onclick="edit_transaction('."'".$t->transaction_id."'".')" data-toggle="tooltip" data-placement="bottom" title="Click to edit"><span class="fa fa-pencil"></span></button>';
            $data[] = $row;
		}
		$output = array("draw" => $_POST['draw'],
						"recordsTotal" => $this->m_admin_transaction->transaction_count_all(),
						"recordsFiltered" => $this->m_admin_transaction->transaction_count_filtered(),
						"data" => $data,);
		echo json_encode($output);
	}

	public function edit_transaction($id) {
		$data = $this->m_admin_transaction->get_transaction($id);
		echo json_encode($data);
	}

	public function update_transaction(){
		$data2 = array(
			'book_status' => 1,
			);
		$this->m_admin_transaction->update_transaction(array('transaction_id' => $this->input->post('transaction_id')), $data2);
		//echo json_encode(array("status" => TRUE));

		
		$data3 = array(
			'status' => 1,
			);
		$this->m_admin_transaction->update_status(array('book_id' => $this->input->post('book_id')), $data3);
		echo json_encode(array("status" => TRUE));
		
	}

	public function add_transaction() {
		//$this->book_validate();
		$date = date('Y-m-d');
		$data = array(
			'user_id' => $this->input->post('user_id'),
			'book_id' => $this->input->post('book_id'),
			'date_borrowed' => $date,
			'date_return' => $this->input->post('d_return'),
			'date_transaction' => $date,
			'book_status	' => $this->input->post('status'),
			);
		$insert = $this->m_admin_transaction->save_transaction($data);
		//echo json_encode(array("status" => TRUE));

		$data1 = array(
			'status' => 0,
			);
		$this->m_admin_transaction->update_status(array('book_id' => $this->input->post('book_id')), $data1);
		echo json_encode(array("status" => TRUE));
	}
}