<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_settings extends CI_Controller
{
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('m_admin_settings');
	}

	public function index()
	{
		$this->load->helper('url');
		if($this->session->userdata('logged_in')) {
			$this->load->view('admin_settings');
		} else {
			redirect('admin_login?redirect='.current_url(), 'refresh');
		}
	}

	public function genre_list() {
		$list = $this->m_admin_settings->get_genre_data();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $genre) {
			$no++;
			$row = array();
			$row[] = $genre->book_genre;
			$row[] = '<button class="btn btn-info btn-sm" onclick="edit_genre('."'".$genre->genre_id."'".')" data-toggle="tooltip" data-placement="bottom" title="Click to edit"><span class="fa fa-pencil"></span></button>
                      <button class="btn btn-danger btn-sm" onclick="delete_genre('."'".$genre->genre_id."'".')" data-toggle="tooltip" data-placement="bottom" title="Click to delete"><span class="fa fa-trash-o"></span></button>';
            $data[] = $row;
		}
		$output = array("draw" => $_POST['draw'],
						"recordsTotal" => $this->m_admin_settings->genre_count_all(),
						"recordsFiltered" => $this->m_admin_settings->genre_count_filtered(),
						"data" => $data,);
		echo json_encode($output);
	}

	public function section_list() {
		$list = $this->m_admin_settings->get_section_data();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $section) {
			$no++;
			$row = array();
			$row[] = $section->lib_section;
			$row[] = '<button class="btn btn-info btn-sm" onclick="edit_section('."'".$section->sec_id."'".')" data-toggle="tooltip" data-placement="bottom" title="Click to edit"><span class="fa fa-pencil"></span></button>
                      <button class="btn btn-danger btn-sm" onclick="delete_section('."'".$section->sec_id."'".')" data-toggle="tooltip" data-placement="bottom" title="Click to delete"><span class="fa fa-trash-o"></span></button>';
            $data[] = $row;
		}
		$output = array("draw" => $_POST['draw'],
						"recordsTotal" => $this->m_admin_settings->section_count_all(),
						"recordsFiltered" => $this->m_admin_settings->section_count_filtered(),
						"data" => $data,);
		echo json_encode($output);
	}

	public function user_list() {
		$list = $this->m_admin_settings->get_user_data();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $user) {
			$no++;
			$row = array();
			$row[] = $user->login_firstname;
			$row[] = $user->login_lastname;
			$row[] = '<button class="btn btn-info btn-sm" onclick="edit_user('."'".$user->login_id."'".')" data-toggle="tooltip" data-placement="bottom" title="Click to edit"><span class="fa fa-pencil"></span></button>
                      <button class="btn btn-danger btn-sm" onclick="delete_user('."'".$user->login_id."'".')" data-toggle="tooltip" data-placement="bottom" title="Click to delete"><span class="fa fa-trash-o"></span></button>';
            $data[] = $row;
		}
		$output = array("draw" => $_POST['draw'],
						"recordsTotal" => $this->m_admin_settings->user_count_all(),
						"recordsFiltered" => $this->m_admin_settings->user_count_filtered(),
						"data" => $data,);
		echo json_encode($output);
	}

	public function edit_genre($genre_id) {
		$data = $this->m_admin_settings->get_genre($genre_id);
		echo json_encode($data);
	}

	public function edit_section($sec_id) {
		$data = $this->m_admin_settings->get_section($sec_id);
		echo json_encode($data);
	}

	public function edit_user($user_id) {
		$data = $this->m_admin_settings->get_user($user_id);
		echo json_encode($data);
	}


	public function add_genre() {
		$this->genre_validate();
		$data = array(
			'book_genre' => $this->input->post('book_genre'),
			);
		$insert = $this->m_admin_settings->save_genre($data);
		echo json_encode(array("status" => TRUE));
	}

	public function update_genre() {
		$this->genre_validate();
		$data = array(
			'book_genre' => $this->input->post('book_genre'),
			);
		$this->m_admin_settings->update_genre(array('genre_id' => $this->input->post('genre_id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete_genre($genre_id) {
		$this->m_admin_settings->delete_genre($genre_id);
		echo json_encode(array("status" => TRUE));
	}

	private function genre_validate() {
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('book_genre') == ''){
			$data['inputerror'][] = 'book_genre';
			$data['error_string'][] = 'Genre is required';
			$data['status'] = FALSE;
		}
	}


	public function add_section() {
		$this->section_validate();
		$data = array(
			'lib_section' => $this->input->post('lib_section'),
			);
		$insert = $this->m_admin_settings->save_section($data);
		echo json_encode(array("status" => TRUE));
	}

	public function update_section() {
		$this->section_validate();
		$data = array(
			'lib_section' => $this->input->post('lib_section'),
			);
		$this->m_admin_settings->update_section(array('sec_id' => $this->input->post('sec_id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete_section($sec_id) {
		$this->m_admin_settings->delete_section($sec_id);
		echo json_encode(array("status" => TRUE));
	}

	private function section_validate() {
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('lib_section') == ''){
			$data['inputerror'][] = 'lib_section';
			$data['error_string'][] = 'Section is required';
			$data['status'] = FALSE;
		}
	}


	public function add_user() {
		$this->user_validate();
		$data = array(
			'login_firstname' => $this->input->post('firstname'),
			'login_lastname' => $this->input->post('lastname'),
			);
		$insert = $this->m_admin_settings->save_user($data);
		echo json_encode(array("status" => TRUE));
	}

	public function update_user() {
		$this->user_validate();
		$data = array(
			'login_firstname' => $this->input->post('firstname'),
			'login_lastname' => $this->input->post('lastname'),
			);
		$this->m_admin_settings->update_user(array('login_id' => $this->input->post('login_id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete_user($login_id) {
		$this->m_admin_settings->delete_user($login_id);
		echo json_encode(array("status" => TRUE));
	}

	private function user_validate() {
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('firstname') == ''){
			$data['inputerror'][] = 'firstname';
			$data['error_string'][] = 'Firstname is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('lastname') == ''){
			$data['inputerror'][] = 'lastname';
			$data['error_string'][] = 'Lastname is required';
			$data['status'] = FALSE;
		}
	}
}