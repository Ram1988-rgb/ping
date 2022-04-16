<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class PaymentType extends MY_Controller {
    
    function __construct() {
          parent::__construct();
          check_admin_login();
          $this->load->model('paymenttype_model');
          $this->header_data['headTitle'] = "Nuvest : Payment Frequency";
       }
    
 /**
  * @access public
  * 
  */   
  public function index()
  {   
    $this->data['all_record'] = $this->paymenttype_model->get_all_record();    
    $this->render('admin/paymenttype/view');
  }

  public function add()
  {   
    if($this->input->post())
		{
      if($this->paymenttype_model->checkRecord($this->input->post())){
        $this->session->set_flashdata('errordata', 'This Payment Frequency Label Already exist.Please choose another name');
        redirect('/admin/paymenttype/add');
      }
      $add = $this->paymenttype_model->add($this->input->post());
      if($add){
        $this->session->set_flashdata('success', 'Data successfully added');
        redirect("/admin/paymenttype");
      }
      $this->session->set_flashdata('errordata', 'Something went wrong try again');
      redirect("/admin/paymenttype/add");
    }
    $this->render('admin/paymenttype/add');
  }

  public function edit($id)
  {   
    if($this->input->post())
		{
      if($this->paymenttype_model->checkRecord($this->input->post(), $id)){
        $this->session->set_flashdata('errordata', 'Payment Frequency label Already exist.Please choose another label');
        redirect('/admin/paymenttype/edit/'.$id);
      }
      $addData = $this->paymenttype_model->edit($this->input->post(), $id);
      if($addData){
        $this->session->set_flashdata('success', 'Data successfully Updated');
        redirect("/admin/paymenttype");
      }
      $this->session->set_flashdata('errordata', 'Something went wrong try again');
      redirect("/admin/paymenttype/edit");
    }
    $detail = $this->paymenttype_model->getrecord($id);
    if(!$detail){
      $this->session->set_flashdata('error', 'No record found!');
      redirect('/admin/paymenttype/view');  
    }
    $this->data['detail'] = $detail;
    $this->render('admin/paymenttype/edit');
  }

  function deleterecord($id){
    $del = $this->paymenttype_model->deleteRecord($id);
    if($del){
        $this->session->set_flashdata('success', 'Your Information has been deleted successfully!!!');
    }else{
        $this->session->set_flashdata('error', 'There is some problem in deletion!!!');
    }
    redirect('/admin/paymenttype');
  }

 //End of class    
}

