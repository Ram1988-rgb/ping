<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Cash extends MY_Controller {
    
  function __construct() {
    parent::__construct(); 
    $this->load->model('plan_model');         
    $this->load->model('cash_model');         
    check_front_login();
    $this->customerId = $this->session->userdata('CUSTOMERID');
  }
    
 /**
  * @access public
  * 
  */   
  public function index()
  {
    $this->header_data['headTitle'] = "Nuvest : Customer Cash Summary"; 
    $this->data['active_cash_data'] = $this->cash_model->active_cash_record($this->customerId);
    $this->data['all_record'] = $this->cash_model->allRecord($this->customerId);
    $this->render('front/cash/cash_summary');
  }

public function addcash()
{ 
  
  $this->header_data['headTitle'] = "Nuvest : Customer Add Cash";
  if($this->input->post()){    
    $_POST['user_id'] =  $this->customerId;
    $plan_rate =  $this->plan_model->getPlanPaymentDuration($_POST['plan_id'],$_POST['payment_duration']);
    $_POST['plan_rate'] =  JSON_ENCODE($plan_rate);
    $_POST['interest_rate'] =  $plan_rate->rate;
    if($insId = $this->cash_model->save_data($this->input->post())){
      $this->session->set_flashdata('success', 'Cash Plan has been generated successfully. for activation please contact to admin.');
      $cashDetail = $this->cash_model->getCashDetail($insId);
      $this->cash_model->insert_payment_date($insId);
      saveCashNotification($cashDetail, 'WEB');
      redirect("/user/cash");
    }else{
      $this->session->set_flashdata('errordata', 'Something went wrong try again');
      redirect("/user/cash"); 
    }
  } 

  $this->data['all_cash'] = $this->plan_model->get_plan_by_category('CASH');
  
  $this->render('front/cash/addcash');
}

public function get_payment_plan_duration(){  
  try{
    $plan_id = $_POST['plan_id'];
    $data = [];
    $data['plan_type_duration'] = $this->plan_model->get_plan_type_duration($plan_id);
    $data['payment_type_duration'] = $this->plan_model->get_plan_payment_duration($plan_id);
    echo JSON_ENCODE($data);
  }catch(Exception $error){
    echo 'Message: ' .$e->getMessage();
  }  
}

public function get_plan_duration(){  
  try{
    $plan_id = $_POST['plan_id'];
    $duration_id = $_POST['duration_id'];
    $data = [];
    $data = $this->plan_model->getPlanPaymentDuration($plan_id,$duration_id);
    echo JSON_ENCODE($data);
  }catch(Exception $error){
    echo 'Message: ' .$e->getMessage();
  }  
}

function cash_detail($cash_id){
  $this->header_data['headTitle'] = "Nuvest : Customer Cash Detail"; 
  $this->data['record'] = $this->cash_model->getCashDetail($cash_id);
  $this->data['cash_payment'] = $this->cash_model->get_cash_payment_data($cash_id);
  $this->render('front/cash/cash_detail');
}

function move_to_wallet(){
   $id = $_POST['id'];
  $pdetail = $this->cash_model->get_cash_payment_detail($id);
  $this->cash_model->insert_fund_history($pdetail);
  $this->cash_model->update_cash_payment($id);
  echo JSON_ENCODE(array('status'=>true));
}

function cash_payment(){
  $cash_payment_date_id =  $this->input->post('cashPayment_date_id');
  $cash_payment_date_detail = $this->cash_model->cash_payment_date_detail($cash_payment_date_id);
  if(!$cash_payment_date_detail){
    echo JSON_ENCODE(array('status'=>false));
  }
  $cash_detail = $this->cash_model->getCashDetail($cash_payment_date_detail->cash_id);
  $inpid = $this->cash_model->updateFundHistory($cash_detail, $cash_payment_date_id,  $cash_payment_date_detail->payment_date);
  echo JSON_ENCODE(array(
      'status'=>true,
      'cpid'=>$inpid,
      'payment_date' => showDateFormateTime(date('Y-m-d H:i:s')),
      'cash_saving' => $this->cash_model->get_cash_saving($cash_detail->user_id)

    ));
}

public function check_plan_duration(){  
  try{
    $resp = array('valid'=>true);
    if(isset($_POST['payment_type'])){
    $payment_type = isset($_POST['payment_type'])?$_POST['payment_type']:'';
    $duration_id = $_POST['payment_duration'];
    $payment_type_detail = $this->plan_model->getPaymentType($payment_type);
    $data = $this->plan_model->getPaymentDuration($duration_id);
   
    if($payment_type_detail->days > $data->month*30){
      $resp['valid'] = false;
      $resp['message'] = "Please select according to payment type";
    }
  }
    echo json_encode($resp);
    
  }catch(Exception $error){
    echo 'Message: ' .$e->getMessage();
  }  
}
 


//End of class    
}

