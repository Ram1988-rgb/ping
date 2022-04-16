<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Transfer extends MY_Controller {
    
    function __construct() {
          parent::__construct();
          check_front_login();    
          $this->load->model('cashout_model');
          $this->load->model('bank_model');
          $this->load->model('agent_model');
          $this->header_data['headTitle'] = "Nuvest : Customer Transfer";   
          $this->customer_id = $this->session->userdata('CUSTOMERID');
     }

     function index(){       
        $this->render('front/transfer/index'); 
     }

     function ownaccount(){
        $this->render('front/transfer/ownaccount');  
     }
     function anotherapp(){
        $this->render('front/transfer/anotherapp');  
     }

     function cashout(){
         if($_POST){
            if($_POST['withdrawl_to'] =="LOAN"){
               $balence =$this->cashout_model->get_loan_balance($this->customer_id);
               if($balence<$_POST['amount']){
                  $this->session->set_flashdata('errordata', 'Amount is not sufficient');
                  redirect("user/transfer/cashout");
               }
            }
            if(isset($_POST['bank_id'])){
               $_POST['bank_detail'] = $this->bank_model->bank_detail($this->security->xss_clean($_POST['bank_id']));
            }
            $_POST['agent_id']=$this->agent_model->checkAgentCode($this->security->xss_clean($_POST));
            $_POST['user_id'] = $this->customer_id;
            if($this->cashout_model->addcashout($this->security->xss_clean($_POST))){
            
               $this->session->set_flashdata('success', 'Cashout successfully');
               redirect("user/transfer/cashout");
            }else{
               $this->session->set_flashdata('errordata', 'Something went wrong try again');
                redirect("user/transfer/cashout");
            }
            
         }
         $this->data['current_loan_balance'] = getCurrentLoanBalence($this->customer_id);
         $this->data['current_balance'] = getCurrentBalence($this->customer_id);
         $this->data['cashouttype'] = $this->cashout_model->list_cashout_type();
         $this->data['all_bank'] = $this->bank_model->get_all_record($this->session->userdata('CUSTOMERID'));
         $this->data['all_wallet'] = $this->cashout_model->list_wallet();
         
        $this->render('front/transfer/cashout');  
     }

     function check_amount(){
      $current_balence = getCurrentBalence($this->customer_id);
      if($_POST['amount']>$current_balence){
         $response = array(
            'valid' => false,
             'message' => 'Amount is not sufficient in wallet.'
            );
       }else{
         $response = array(
            'valid' => true,
             'message' => 'Amount is not sufficient in wallet.'
         );

       }
       echo JSON_ENCODE($response);
     }

     function check_agent_code(){
      $agent_code = $_POST['agent_code'];
         if($this->agent_model->checkAgentCode($this->security->xss_clean($_POST))){
            $response = array(
            'valid' => true,
             'message' => 'Amount is not sufficient in wallet.'
            );
         }else{
            $response = array(
               'valid' => false,
                'message' => 'Agent code is not valid.Please enter valid code.'
            );
         }
         echo JSON_ENCODE($response);
     }
}

?>