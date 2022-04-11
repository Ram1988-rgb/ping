<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Fund extends MY_Controller {
    
    function __construct() {
          parent::__construct();
          $this->load->model('fund_type_model');
          $this->load->model('fund_model');
          check_admin_login();
          $this->header_data['headTitle'] = "Nuvest : Admin Fund"; 
       }
    
 /**
  * @access public
  * 
  */   
public function index()
{   
    $this->data['all_record'] = $this->fund_model->get_all_record(); 
    $this->render('admin/fund/view');
}

public function view($id)
{ 	  
	$cashDetail = $this->fund_model->getrecord($id);
	//print_r($cashDetail->name); die;
    if(!$cashDetail){
      $this->session->set_flashdata('error', 'No record found!');
      redirect('/admin/user');  
    }
    $this->data['details'] = $cashDetail;
    $this->render('admin/fund/details');
}

function updateStatus($id, $status){
	
    $del = $this->fund_model->updateStatus($id, $status);
    if($del){
        $this->session->set_flashdata('success', 'Status has been changed successfully!!!');
    }else{
        $this->session->set_flashdata('error', 'There is some problem in deletion!!!');
    }
    //redirect('/index.php/admin/fund');
    redirect('/admin/fund');
  }

  public function send_status_notification(){
    $id = $this->input->get_post('id');
    $fund_detail = $this->fund_model->getrecord($id);
    statusfundNotification($fund_detail, 'WEB');
}
 //End of class    
}

