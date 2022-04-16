<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Loan extends MY_Controller {
    
    function __construct() {
          parent::__construct();
          $this->load->model('loan_model');
          check_admin_login();
          $this->header_data['headTitle'] = "Nuvest : Admin Loan";
       }
    
 /**
  * @access public
  * 
  */   
public function index()
{
    $this->data['all_record'] = $this->loan_model->get_all_loan_record(); 
    $this->render('admin/loan/view');
}

public function view($id)
{
	$loanDetail = $this->loan_model->getRecord($id);
    if(!$loanDetail){
      $this->session->set_flashdata('error', 'No record found!');
      redirect('/admin/user');  
    }
    $this->data['details'] = $loanDetail;
    $this->data['loan_payment'] = $this->loan_model->get_loan_payment_data($id);
    $this->render('admin/loan/details');
}

function updateStatus(){
    $id = $this->security->xss_clean($_POST['id']);
    $status = $this->loan_model->change_status($id);
    echo  JSON_ENCODE(array('status' => $status));
}
 
 //End of class    
}

