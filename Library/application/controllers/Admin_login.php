<?php defined('BASEPATH') OR exit('No direct script accesss allowed');

class Admin_login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin_login');
	}

	public function index()
	{
		$redirect = $this->input->get('redirect');
		if($this->session->userdata('logged_in'))
		{
			$redirect = ($redirect) ? $redirect:base_url().'admin_dashboard';
			redirect($redirect,'refresh');
		}
		else
		{
			$data['redirect'] = $redirect;
			$this->load->view('admin_login_page',$data);
		}
	}

	public function submit_login()
	{
		$redirect = $this->input->post('redirect');
		if(!$redirect) $redirect = $this->input->get('redirect');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

		if($this->form_validation->run() == FALSE)
		{
			$data = array();
			if(validation_errors() != '')
			{
				$data['error'] = validation_errors();
			}
			$data['redirect'] = $redirect;
			$this->load->view('admin_login_page',$data);
		}
		else
		{
			$redirect = ($redirect) ? $redirect:base_url().'admin_dashboard';
			redirect($redirect,'refresh');
		}
	}

	public function check_database($password)
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$result = $this->m_admin_login->login($username,$password);
		if($result)
		{
			foreach($result as $row)
			{
				$sess_array = array('login_id' => $row->login_id,
					'login_firstname' => $row->login_firstname,
					'login_lastname' => $row->login_lastname,
					'login_username' => $row->login_username,
					'login_password' => $row->login_password,
					'logged_in' => true);
				$this->session->set_userdata($sess_array);
			}
			return true;
		}
		else
		{
			$this->form_validation->set_message('check_database', 'Invalid username or password');
			return false;
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect(base_url().'admin_login', 'refresh');
	}
}