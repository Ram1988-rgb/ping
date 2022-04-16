<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Plan extends MY_Controller {
    
    function __construct() {
          parent::__construct();
          check_admin_login();
          $this->load->model('plan_model');
          $this->load->model('paymenttype_model');
          $this->load->model('paymentduration_model');
          $this->header_data['headTitle'] = "Nuvest : Plan | Admin Panel";
       }
    
 /**
  * @access public
  * 
  */   
  public function index()
  {   
    $this->data['all_record'] = $this->plan_model->get_all_record();    
    $this->render('admin/plan/view');
  }

  public function add()
  {   
    if($this->input->post())
		{
      // if($this->plan_model->checkPlan($this->input->post())){
      //   $this->session->set_flashdata('errordata', 'This Plan name Already exist.Please choose another name');
      //   redirect('/admin/plan/add');
      // }
      $addPlan = $this->plan_model->addPlan($this->security->xss_clean($this->input->post()));
      if($addPlan){
        $this->session->set_flashdata('success', 'Plan successfully added');
        redirect("/admin/plan");
      }
      $this->session->set_flashdata('errordata', 'Something went wrong try again');
      redirect("/admin/plan/add");
    }
    $this->data['all_paymentType'] = $this->paymenttype_model->get_all_record();
    $this->data['all_paymentDuration'] = $this->paymentduration_model->get_all_record();
    $this->render('admin/plan/add');
  }

  public function edit($id)
  {   
    if($this->input->post())
		{
      //print_r($_POST);die;
      if($this->plan_model->checkPlan($this->security->xss_clean($this->input->post()), $id)){
        $this->session->set_flashdata('errordata', 'plan Already exist.Please choose another plan');
        redirect('/admin/plan/edit/'.$id);
      }
      $addData = $this->plan_model->editPlan($this->security->xss_clean($this->input->post()), $id);
      if($addData){
        $this->session->set_flashdata('success', 'Data successfully Updated');
        redirect("/admin/plan");
      }
      $this->session->set_flashdata('errordata', 'Something went wrong try again');
      redirect("/admin/plan/edit");
    }
    $detail = $this->plan_model->getrecord($id);
    if(!$detail){
      $this->session->set_flashdata('error', 'No record found!');
      redirect('/adminplan/view');  
    }
    $this->data['detail'] = $detail;
    $this->data['all_paymentType'] = $this->paymenttype_model->get_all_record();
    $this->data['all_paymentDuration'] = $this->paymentduration_model->get_all_record();
    $this->render('admin/plan/edit');
  }

  function deleterecord($id){
    $del = $this->plan_model->deleteRecord($id);
    if($del){
        $this->session->set_flashdata('success', 'Your Information has been deleted successfully!!!');
    }else{
        $this->session->set_flashdata('error', 'There is some problem in deletion!!!');
    }
    redirect('/admin/plan');
  }

 function check_payment_type(){
  // print_r($_POST);
 }

 //End of class    
}

