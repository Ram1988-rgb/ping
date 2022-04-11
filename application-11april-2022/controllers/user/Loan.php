<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Loan extends MY_Controller {
    
    function __construct() {
          parent::__construct();
          $this->load->model('plan_model');
          $this->load->model('loan_model');
          $this->load->model('user_model');
          check_front_login();
       }
    
 /**
  * @access public
  * 
  */   
public function index()
{ 
    $this->header_data['headTitle'] = "Nuvest : Customer Loan";
    if($this->input->post()){
         $_POST['user_id'] =  $this->session->userdata('CUSTOMERID');
         $_POST['start_date'] =  date("Y-m-d");
         $plan_rate =  $this->plan_model->getPlanPaymentDuration($_POST['plan_id'],$_POST['loan_duration']);
         $_POST['plan_rate'] =  JSON_ENCODE($plan_rate);
         $_POST['interest_rate'] =  $plan_rate->rate;
         $addLoan = $this->loan_model->addLoan($this->input->post());
        // die;
        if($addLoan){          
          redirect("/user/loan/summary/".$addLoan);
        }else{
            $this->session->set_flashdata('errordata', 'Something went wrong try again');
            redirect("/user/loan/add");
        }
    }	
    $this->data['category'] = $this->plan_model->get_plan_by_category('LOAN');
    $this->render('front/loan/add');
}

public function myloan(){
    $_POST['user_id'] = $this->session->userdata('CUSTOMERID');
    $this->data['all_record'] = $this->loan_model->get_all_loan_record($_POST['user_id']);
    $udata = $this->user_model->checkUserForLoan($this->session->userdata('CUSTOMERID'));
   // print_r($udata);
   
    if($udata['kyc'] && $udata['old']){
        $this->render('front/loan/myloan');
    }else{
        $this->data['kyc'] = $udata['kyc'];
        $this->data['old'] = $udata['old'];
        
        $this->render('front/loan/checkuser');       
    }
}
 
public function save_data(){
	$this->data['type_id'] = $this->input->post('type');
	$this->data['loan_duration'] = $this->plan_model->get_plan_type_duration($this->input->post('type'));
    $this->data['payment_duration'] = $this->plan_model->get_plan_payment_duration($this->input->post('type'));
   //print_r($this->data); die();
	$this->render('front/loan/amount');
}

public function record_save(){
	//print_r($this->input->post()); die();
	if($this->input->post()){
      $addFund = $this->loan_model->addLoan($this->input->post());
      if($addFund){
        $this->session->set_flashdata('success', 'Loan successfully added');
        //redirect("/index.php/user/cash");
        redirect("/user/dashboard");
      }else{
		  $this->session->set_flashdata('errordata', 'Something went wrong try again');
		  redirect("/user/loan/add");
	  }
  }	
}

public function summary($id){
  $this->data['record'] = $this->loan_model->getRecord($id);
    if($this->input->post()){
        $applyLoan = $this->loan_model->applyLoan($id);
        if($applyLoan){

            saveLoanNotification( $this->data['record'],'WEB');
            $this->session->set_flashdata('success', 'Loan successfully applied');
            redirect("/user/loan/loan_detail/".$id);
        }else{
            $this->session->set_flashdata('errordata', 'Something went wrong try again');
            redirect("/user/loan/add");
        }
    }        
    $this->render('front/loan/summary');
}

public function getloanform(){
    $plan_id = $this->input->post('plan_id');
    $this->data['plan_id'] = $this->input->post('plan_id');
    $this->data['loan_duration'] = $this->plan_model->get_plan_type_duration($this->input->post('plan_id'));
    $this->data['payment_duration'] = $this->plan_model->get_plan_payment_duration($this->input->post('plan_id'));
    //print_r($this->data); die();
    $this->load->view('front/loan/loanform', $this->data);
}

public function loan_detail($id){
    $loanDetail = $this->loan_model->getRecord($id);
    $this->data['details'] = $loanDetail;
    $this->data['loan_payment'] = $this->loan_model->get_loan_payment_data($id);

    $this->render('front/loan/details');
}

public function loan_payment_data(){
    $loan_payment_date_id = $_POST['loan_date_id'];
    $loan_payment_detail = $this->loan_model->loan_payment_date_detail($loan_payment_date_id);
    $loanDetail =  $this->loan_model->getRecord($loan_payment_detail->loan_id);
    $this->loan_model->deduct_loan_install_ammount_with_interest($loanDetail,$loan_payment_date_id, $loan_payment_detail->payment_date);
    echo JSON_ENCODE(array(
        'status'=>true,
        'payment_date' => showDateFormateTime(date('Y-m-d H:i:s')),  
  
      ));
}

function loan_history(){
    $loanHistory = $this->loan_model->loan_history($this->session->userdata('CUSTOMERID'));
    $this->data['all_record'] = $loanHistory;
   
    $this->render('front/loan/loan_history');
}
 //End of class    
}

