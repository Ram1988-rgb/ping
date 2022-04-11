<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {	
	function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
    }
	public function index()
	{
		$this->header_data['headTitle'] = "Nuvest :Admin Login";
		if($this->input->post())
		{
			$this->form_validation->set_rules('userName', 'login ID', 'trim|required|min_length[4]|max_length[20]');
			$this->form_validation->set_rules('userPassword', 'password', 'trim|required|min_length[1]|max_length[20]');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if ($this->form_validation->run() == TRUE) {
				$result = $this->login_model->adminLogin($this->input->post());
				if ($result) {
				   
					if ($this->session->userdata('RETURN_URL')) {
						
						redirect($this->session->userdata('RETURN_URL'));
					} else {
					    redirect('admin/dashboard');
					}
				} else {
					$this->session->set_flashdata('errordata', 'Please enter valid email and password');
					redirect('admin/welcome');
				}
			}
			$this->session->set_flashdata('errordata', 'Please enter valid email and password');
			redirect('admin/welcome');
		}else{			
			$this->load->view('login');
		}
	}
	
	public function forgotpassword(){
		if($this->input->post())
		{
			$emailData = $this->login_model->isExistsAdminEmailId($this->input->post('email'));
			if(!$emailData){
				redirect('welcome/forgotpassword');
			}
			$this->login_model->adminResendPassword($_POST);
		}
		$this->load->view('forgot');
	}
	
}
