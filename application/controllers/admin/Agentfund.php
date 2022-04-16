<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Agentfund extends MY_Controller {
    
  function __construct() {
    parent::__construct();
    check_admin_login();   
    $this->load->model('agentfund_model');
    $this->header_data['headTitle'] = "Nuvest : Manage Agent Fund";   
  }

  function index(){
    $this->data['all_record'] = $this->agentfund_model->get_all_record();    
    $this->render('admin/agentfund/view');
  }

  function add(){
    if($_POST){
     
     $document_type = '';
     $document_name = '';
     //print_r($_FILES);
     if(isset($_FILES['document']['name'])){
      $ext = file_extention($_FILES['document']['name']);
      $document_type =$ext;
      $document_name = uploadImageWeb(
        'document',
        $_FILES, UPLOAD_AGENTFUND_IMAGE_ORIGINAL,
        UPLOAD_AGENTFUND_IMAGE_THUMB, THUMB_WIDTH,
        THUMB_HEIGHT
      );
      
    }
    $_POST['document_name'] = $document_name;
    $_POST['document_type'] = $document_type;
    $add =  $this->agentfund_model->add_fund($this->security->xss_clean($_POST));
     if($add){
      $this->session->set_flashdata('success', 'Fund successfully added');
      redirect("/admin/agentfund/index");
     }else{
      $this->session->set_flashdata('errordata', 'Something went wrong try again');
      redirect("/admin/agentfund/add");
     }
    }
    $this->data['all_agent'] = $this->agentfund_model->get_all_agent();
    $this->render('admin/agentfund/add');
  }
  function detail($id){
    $this->data['details'] = $this->agentfund_model->get_record($id);
    $this->render('admin/agentfund/details');
  }
  
}
?>