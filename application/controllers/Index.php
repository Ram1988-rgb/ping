<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	
	function __construct() {
    parent::__construct();
    $this->load->helper('cookie');
    $this->load->model('user_model');
    $this->load->model('cms_model');
  }

	public function index()
	{
    if($this->input->post()){
      if($this->user_model->login($this->security->xss_clean($this->input->post()))){
        redirect('user/dashboard/index');
      }else{
        redirect('/');
      }
    }
		$this->load->view('/front/login');
	}

	public function signup(){
    if($this->input->post()){
      if($this->user_model->checkUser($this->security->xss_clean($this->input->post()))){
        $this->session->set_flashdata('errordata', 'User Already exist.Please choose another email');
        redirect('/index/signup');
      }
      if($this->user_model->checkPhone($this->security->xss_clean($this->input->post()))){
        $this->session->set_flashdata('errordata', 'Phone Already exist.Please choose another phone');
        redirect('/index/signup');
      }
      $addUser = $this->user_model->addUser($this->security->xss_clean($this->input->post()));
      if($addUser){
        $this->session->set_flashdata('success', 'User successfully added');
        redirect("/index/signup");
      }
      $this->session->set_flashdata('errordata', 'Something went wrong try again');
      redirect("/index/signup");

    }
		$this->load->view('/front/signup');
	}
	
	public function forgotpassword(){
    if($this->input->post())
    {
      $emailData = $this->login_model->isExistsAdminEmailId($this->security->xss_clean($this->input->post('email')));
      if(!$emailData){
        redirect('welcome/forgotpassword');
      }
      $this->login_model->adminResendPassword($this->security->xss_clean($_POST));
    }
    $this->load->view('forgot');
	}

  function page($page){
    $record = $this->cms_model->get_page_by_page($page);
    $this->load->view('front/cms/index', array('record'=>$record)); 
  }

  function tofaotp(){
    $user = $this->user_model->getrecord($this->session->userdata('CUSTOMERID'));
    if($_POST){
      $otp = $this->security->xss_clean($_POST['otp']);
      if($user->tofaotp == $otp){
        redirect('user/dashboard/index');
      }else{
        $this->session->set_flashdata('errordata', 'Please enter valid otp');
        redirect("/index/tofaotp");
      }
    }
    $this->load->view('front/tofaotp');
  }
  
	
}
