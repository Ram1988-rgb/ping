<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Investment extends MY_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('investment_model');
    check_admin_login();
    $this->header_data['headTitle'] = "Nuvest : Admin Investment";
 }

 function index(){
   $this->data['all_record'] = $this->investment_model->getAllRecord();
  // pr($this->data,1);
  $this->render('admin/investment/view');
 }

 function investment_detail($id){
  $this->data['record'] = $this->investment_model->getRecord($id);
  $this->data['cash_payment'] = $this->investment_model->get_investment_payment_data($id);

  $this->render('admin/investment/detail');
 }

 function updateStatus(){	
    $id = $_POST['id'];
    $status = $this->investment_model->change_status($id);
    echo  JSON_ENCODE(array('status' => $status));
  }
}
?>
