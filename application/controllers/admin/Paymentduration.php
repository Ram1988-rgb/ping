<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Paymentduration extends MY_Controller {
    
    function __construct() {
          parent::__construct();
          check_admin_login();
          $this->load->model('paymentduration_model');
          $this->header_data['headTitle'] = "Nuvest : Payment Duration";
       }
    
 /**
  * @access public
  * 
  */   
  public function index()
  {   
    $this->data['all_record'] = $this->paymentduration_model->get_all_record();    
    $this->render('admin/paymentduration/view');
  }

  public function add()
  {   
    if($this->input->post())
		{
      if($this->paymentduration_model->checkRecord($this->input->post())){
        $this->session->set_flashdata('errordata', 'This Payment Frequency Label Already exist.Please choose another name');
        redirect('/admin/paymentduration/add');
      }
      $add = $this->paymentduration_model->add($this->input->post());
      if($add){
        $this->session->set_flashdata('success', 'Data successfully added');
        redirect("/admin/paymentduration");
      }
      $this->session->set_flashdata('errordata', 'Something went wrong try again');
      redirect("/admin/paymentduration/add");
    }
    $this->render('admin/paymentduration/add');
  }

  public function edit($id)
  {   
    if($this->input->post())
		{
      if($this->paymentduration_model->checkRecord($this->input->post(), $id)){
        $this->session->set_flashdata('errordata', 'Payment Frequency label Already exist.Please choose another label');
        redirect('/admin/paymentduration/edit/'.$id);
      }
      $addData = $this->paymentduration_model->edit($this->input->post(), $id);
      if($addData){
        $this->session->set_flashdata('success', 'Data successfully Updated');
        redirect("/admin/paymentduration");
      }
      $this->session->set_flashdata('errordata', 'Something went wrong try again');
      redirect("/admin/paymentduration/edit");
    }
    $detail = $this->paymentduration_model->getrecord($id);
    if(!$detail){
      $this->session->set_flashdata('error', 'No record found!');
      redirect('/admin/paymentduration/view');  
    }
    $this->data['detail'] = $detail;
    $this->render('admin/paymentduration/edit');
  }

  function deleterecord($id){
    $del = $this->paymentduration_model->deleteRecord($id);
    if($del){
        $this->session->set_flashdata('success', 'Your Information has been deleted successfully!!!');
    }else{
        $this->session->set_flashdata('error', 'There is some problem in deletion!!!');
    }
    redirect('/admin/paymentduration');
  }

 //End of class    
}

