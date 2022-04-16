<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Dashboard extends MY_Controller {
    
    function __construct() {
          parent::__construct();
          check_front_login();
          $this->load->model('fund_model');
          $this->load->model('cash_model');
          $this->load->model('investment_model');
          $this->load->model('loan_model');
          $this->load->model('user_model');
          $this->load->model('notification_model');
       }
    
 /**
  * @access public
  * 
  */   
public function index()
{   
    $this->header_data['headTitle'] = "Nuvest : Customer Dashboard";
    $this->data['total_cash'] = $this->cash_model->get_cash_saving($this->session->userdata('CUSTOMERID'));
    $this->data['total_investment'] = $this->investment_model->get_investment_saving($this->session->userdata('CUSTOMERID'));
    $this->data['total_loan'] = $this->loan_model->get_total_loan($this->session->userdata('CUSTOMERID'));
    $this->data['total_interest'] = get_total_interest($this->session->userdata('CUSTOMERID'));
    $this->render('front/dashboard');
}

public function logout(){
    $this->session->unset_userdata('CUSTOMERID');
    $this->session->unset_userdata('CUSTOMERNAME');
    redirect('/');
}

public function summary()
{   
    
    $this->render('front/pagecustom/summaryloan');
}

public function notification()
{   
    
    $this->render('front/pagecustom/notification');
}

public function sol()
{   
    
    $this->render('front/pagecustom/sol');
}
public function sol_content()
{   
    
    $this->render('front/pagecustom/sol_content');
}
public function vip_content()
{   
    
    $this->render('front/pagecustom/vip_content');
}
public function cashsummary()
{   
    
    $this->render('front/cash/cash_summary');
}
public function addcash()
{   
    
    $this->render('front/cash/addcash');
}

public function changepassword(){
    if($_POST){
        $_POST['customerId'] = $this->session->userdata('CUSTOMERID');
       $res =  $this->user_model->changePassword($this->security->xss_clean($this->input->post()));
       if($res){
            $this->session->set_flashdata('success', 'Password has been changed successfully.');
        }else{
            $this->session->set_flashdata('error', 'Something went wrong');
        }
        redirect('/user/dashboard/changepassword');
    }
    $this->header_data['headTitle'] = "Nuvest : Customer | Change Password";
    $this->render('front/changepassword');
}

public function checkPassword(){
    $_POST['customerId'] = $this->session->userdata('CUSTOMERID');
    $result = $this->user_model->checkPassword($this->security->xss_clean($this->input->post()));
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

function get_notification(){
   $detail = $this->notification_model->get_notification($this->session->userdata('CUSTOMERID'));
   echo JSON_ENCODE(array('total'=>sizeOf($detail), 'data'=>$detail));
}
 //End of class    
}

