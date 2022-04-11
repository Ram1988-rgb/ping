<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	function __construct() {
    parent::__construct();
    $this->load->helper('cookie');
    $this->load->model('agent_model');
  }

  public function index(){
    if($this->input->post()){
      if($this->agent_model->login($this->input->post())){
        redirect('agent/dashboard/index');
      }else{
        redirect('/agent');
      }
    }
    $this->load->view('/agent/login');
  }

	
	
}
