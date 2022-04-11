<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class User extends MY_Controller {
    
    function __construct() {
          parent::__construct();
          check_admin_login();
          $this->load->model('user_model');
          $this->load->model('bank_model');
          $this->load->model('home_model');
          $this->load->model('card_model');
          $this->load->model('loan_model');
          $this->load->model('investment_model');
          $this->load->model('cash_model');
          $this->header_data['headTitle'] = "Nuvest : User | Admin Panel";
       }
    
 /**
  * @access public
  * 
  */   
  public function index()
  {   
    $this->data['all_record'] = $this->user_model->get_all_record();    
    $this->render('admin/user/view');
  }

  public function add()
  {   
    if($this->input->post())
		{
      if($this->user_model->checkUser($this->input->post())){
        $this->session->set_flashdata('errordata', 'User Already exist.Please choose another email');
        redirect('/admin/user/add');
      }
      $addUser = $this->user_model->addUser($this->input->post());
      if($addUser){
        $this->session->set_flashdata('success', 'User successfully added');
        redirect("/admin/user");
      }
      $this->session->set_flashdata('errordata', 'Something went wrong try again');
      redirect("/admin/user/add");
    }
    $this->data['post_data'] = $this->input->post()?$this->input->post():[];
    $this->render('admin/user/add');
  }
  public function detail($id)
  {   
    $this->data['details'] = $this->user_model->getrecord($id);    
    $this->data['wallet_amount']= show_number(getCurrentBalence($id));
    $this->data['loan_record'] = $this->loan_model->get_all_loan_record($id);    
    $this->data['investment_record'] = $this->investment_model->getAllRecord($id);    
    $this->render('admin/user/detail');
  }


  public function edit($id)
  {   
    if($this->input->post())
		{
      if($this->user_model->checkUser($this->input->post(), $id)){
        $this->session->set_flashdata('errordata', 'User Already exist.Please choose another email');
        redirect('/admin/user/edit/'.$id);
      }
      $addUser = $this->user_model->editUser($this->input->post(), $id);
      if($addUser){
        $this->session->set_flashdata('success', 'User successfully Updated');
        redirect("/admin/user");
      }
      $this->session->set_flashdata('errordata', 'Something went wrong try again');
      redirect("/admin/user/edit");
    }
    $userDetail = $this->user_model->getrecord($id);
    if(!$userDetail){
      $this->session->set_flashdata('error', 'No record found!');
      redirect('/admin/user');  
    }
    $this->data['userDetail'] = $userDetail;
    $this->render('admin/user/edit');
  }

  function deleterecord($id){
    $del = $this->user_model->deleteRecord($id);
    if($del){
        $this->session->set_flashdata('success', 'Your Information has been deleted successfully!!!');
    }else{
        $this->session->set_flashdata('error', 'There is some problem in deletion!!!');
    }
    redirect('/admin/user');
  }

  function bank($user_id){
    $this->data['all_record'] = $this->bank_model->get_all_record();
    $this->data['userDetail'] = $this->user_model->getrecord($user_id);
    $this->render('admin/user/bank/view');
  }

  function card($user_id){
    $this->data['all_record'] = $this->card_model->list_card($user_id);
    $this->data['userDetail'] = $this->user_model->getrecord($user_id);
    $this->render('admin/user/card/view');
  }

  function dermalog($user_id){
    $this->data['dermalog'] = $this->home_model->get_dermolog($user_id);
    $this->data['userDetail'] = $this->user_model->getrecord($user_id);
    $this->data['dermalog_detail'] = $this->user_model->get_dermolog_detail($user_id);
    $this->render('admin/user/dermalog/detail');
  }

  function status_dermalog($user_id){
    $status =$this->input->get_post('verify_dermalog');
    $this->data['userDetail'] = $this->user_model->update_status_dermalog($user_id,$status);
    $adminId = $this->session->userdata('ADMINID');
    $data = array(
      'status'=>$status,
      'doc_type'=>'Dermalog',
      'user_id'=>$user_id,
      'verified_by'=>$adminId
    );
    $this->user_model->insert_verify_docs($data);
    if($status == 0){
      $st = "Pending";
    }
    if($status == 3){
      $st = "Requested";
    }
    if($status == 1){
      $st = "Refused";
    }
    if($status == 2){
      $st = "Verified";
    }
    $this->session->set_flashdata('success', 'Dermalog status has been changed to '.$st.'.');    
   redirect("admin/user/dermalog/".$user_id);
  }

  function status_nif($user_id){
    $status =$this->input->get_post('verify_nif');
    $this->data['userDetail'] = $this->user_model->update_status_nif($user_id,$status);
    $adminId = $this->session->userdata('ADMINID');
    $data = array(
      'status'=>$status,
      'doc_type'=>'Nif',
      'user_id'=>$user_id,
      'verified_by'=>$adminId
    );
    $this->user_model->insert_verify_docs($data);
    if($status == 0){
      $st = "Pending";
    }
    if($status == 3){
      $st = "Requested";
    }
    if($status == 1){
      $st = "Refused";
    }
    if($status == 2){
      $st = "Verified";
    }
    $this->session->set_flashdata('success', 'Nif status has been changed to '.$st.'.');    
   redirect("admin/user/nif/".$user_id);
  }

   function transaction($user_id){
    $this->data['all_record'] =[];
    $this->data['userDetail'] = $this->user_model->getrecord($user_id);
    $this->render('admin/user/transaction/view');
  }

  function nif($user_id){
    $this->data['nif'] = $this->home_model->get_nif($user_id);
    $this->data['userDetail'] = $this->user_model->getrecord($user_id);
    $this->data['nif_detail'] = $this->user_model->get_nif_detail($user_id);

    $this->render('admin/user/nif/detail');
  }

  
 //End of class    
}

