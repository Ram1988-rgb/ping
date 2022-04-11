<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Cash extends MY_Controller {
    
  function __construct() {
    parent::__construct(); 
    $this->load->model('plan_model');         
    $this->load->model('cash_model');         
    check_admin_login();
    $this->header_data['headTitle'] = "Nuvest : Admin Cash"; 
  }
    
 /**
  * @access public
  * 
  */   
  public function index()
  {    
    $this->data['all_record'] = $this->cash_model->allRecord();
    $this->render('admin/cash/view');
  }

  public function send_status_notification(){
      $id = $this->input->post('id');
      $cash_detail = $this->cash_model->getCashDetail($id);
      statusCashNotification($cash_detail, 'WEB');
  }

  public function view($id){
    $this->data['details'] = $this->cash_model->getCashDetail($id);
    $this->data['cash_payment'] = $this->cash_model->get_cash_payment_data($id);
    $this->render('admin/cash/details');
  }

  function change_status(){
    $id = $_POST['id'];
    $status = $this->cash_model->change_status($id);
    echo  JSON_ENCODE(array('status' => $status));
  }

//End of class    
}

