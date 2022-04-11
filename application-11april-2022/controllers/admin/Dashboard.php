<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Dashboard extends MY_Controller {
    
    function __construct() {
          parent::__construct();
          check_admin_login();
          $this->load->model('user_model');
          $this->load->model('plan_model');
          $this->load->model('login_model');
          $this->load->model('investment_model');
          $this->load->model('cash_model');
       }
    
 /**
  * @access public
  * 
  */   
public function index()
{   $this->data['userCount'] = $this->user_model->get_count_record();
    $this->data['planCount'] = $this->plan_model->get_count_record();
    $this->data['totalSaving'] = 0;
    $this->data['totalInvestment'] = 0;
    $this->header_data['headTitle'] = "Nuvest : Dashboard | Admin Panel";
    $this->render('admin/dashboard');
}

public function changepassword(){
    if($_POST){
        $_POST['adminId'] = $this->session->userdata('ADMINID');
       $res =  $this->login_model->changePassword($this->input->post());
       if($res){
            $this->session->set_flashdata('success', 'Password has been changed successfully.');
        }else{
            $this->session->set_flashdata('error', 'Something went wrong');
        }
        redirect('/admin/dashboard/changepassword');
    }
    $this->header_data['headTitle'] = "Nuvest : Admin | Change Password";
    $this->render('admin/changepassword');
}

public function logout(){
	$this->session->unset_userdata('ADMINID');
    $this->session->unset_userdata('ADMINNAME');
    redirect('admin');
}

public function checkPassword(){
    $_POST['adminId'] = $this->session->userdata('ADMINID');
    $result = $this->login_model->checkPassword($this->input->post());
    if(!$result){
        $response = array(
            'valid' => false,
            'message' => 'Current password is not correct. Please enter valid password'
        );
    }else{
        $response = array('valid' => true);
    }

    echo json_encode($response);
}
 //End of class    
}

