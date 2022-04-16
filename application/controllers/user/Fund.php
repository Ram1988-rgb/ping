<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Fund extends MY_Controller {
    
    function __construct() {
          parent::__construct();
          $this->load->model('fund_type_model');
          $this->load->model('fund_model');
          check_front_login();
          $this->customerId = $this->session->userdata('CUSTOMERID');
       }
    
 /**
  * @access public
  * 
  */   
public function index()
{ 
  $this->header_data['headTitle'] = "Nuvest : Customer Fund";  
  $this->data['all_record'] = $this->fund_model->get_all_record($this->customerId); 
  $this->data['total_fund'] = getCurrentBalence($this->customerId); 
  $this->render('front/fund/view');
}
public function add()
  { 
	  $this->header_data['headTitle'] = "Nuvest : Customer Add Fund"; 
	if($this->input->post())
	{
		$this->data['fund_id'] = $this->security->xss_clean($this->input->post('fund_type'));  
		$this->render('front/fund/amount');
	}
		$this->data['all_record'] = $this->fund_type_model->get_all_record();  
		$this->render('front/fund/add');
  }
 
public function save_data(){
	if($this->input->post()){
      $_POST['user_id'] = $this->session->userdata('CUSTOMERID'); 
      $recieptname = '';
      $back_side = '';
      $front_side = '';
      if(isset($_FILES['receipt']['name'])){
        $recieptname = uploadImageWeb(
          'receipt',
          $_FILES, UPLOAD_FUND_IMAGE_ORIGINAL,
          UPLOAD_FUND_IMAGE_THUMB, THUMB_WIDTH,
          THUMB_HEIGHT
        );
      }
      if(isset($_FILES['front_side']['name'])){
        $front_side = uploadImageWeb(
          'front_side',
          $_FILES, UPLOAD_FUND_IMAGE_ORIGINAL,
          UPLOAD_FUND_IMAGE_THUMB, THUMB_WIDTH,
          THUMB_HEIGHT
        );
      }
      if(isset($_FILES['back_side']['name'])){
        $back_side = uploadImageWeb(
          'back_side',
          $_FILES, UPLOAD_FUND_IMAGE_ORIGINAL,
          UPLOAD_FUND_IMAGE_THUMB, THUMB_WIDTH,
          THUMB_HEIGHT
        );
      }
      $_POST['bankdeposite_upload'] = $recieptname;
      $_POST['check_front_upload'] = $front_side;
      $_POST['check_back_upload'] = $back_side;
      $addFund = $this->fund_model->addFund($this->security->xss_clean($this->input->post()));
      if($addFund){
        $fundDetail = $this->fund_model->getrecord($addFund);
        saveFundNotification($fundDetail, 'WEB');
        $this->session->set_flashdata('success', 'Fund successfully added');
        redirect("/user/fund");
      }else{
		  $this->session->set_flashdata('errordata', 'Something went wrong try again');
		  redirect("/user/fund/add");
	  }
  }
}

 function deleterecord($id){
	 //echo $id ; die;
    $del = $this->fund_model->deleteRecord($id);
    if($del){
        $this->session->set_flashdata('success', 'Your Information has been deleted successfully!!!');
    }else{
        $this->session->set_flashdata('error', 'There is some problem in deletion!!!');
    }
    redirect('/user/fund');
  }
  function uploadImage($field_name, $FILES, $originalpath, $thumb_path, $thum_width, $thumb_height){        
    
    if(isset($FILES[$field_name]['name'])){
      $filename                   = $FILES[$field_name]['name'];
      $config['upload_path']      = $originalpath;;
      $config['file_name']        = $filename;
       $config['allowed_types']    = ALLOWED_IMAGE_EXTENSION;
      // $config['max_size']         = USER_IMAGE_MAX_SIZE;
      // $config['max_width']        = DEFAULT_IMAGE_MAX_WIDTH;
      // $config['max_height']       = DEFAULT_IMAGE_MAX_HEIGHT;
      $config['encrypt_name']     = TRUE; 
      
      $this->load->library('upload');
      $this->upload->initialize($config);
        
      if($this->upload->do_upload($field_name)){
         $filename1                          = $this->upload->data('file_name');
        die;
        $upload_arr                         = array();
        $upload_arr['file_name']            = $filename1;
        $upload_arr['image_height']         = $width;
        $upload_arr['image_width']          = $height;
        //print_r($upload_arr); exit;
        $this->image_resize($thum_width, $thumb_height, $upload_arr, $originalpath, $thumb_path);
        return $filename1;
      }
     echo "ramupload". print_r($this->upload->display_errors());die;
    }   

  }

  public function detail($id){
    $cashDetail = $this->fund_model->getrecord($id);
    $this->data['details'] = $cashDetail;
    $this->render('front/fund/detail');

  }

  public function check_agent_code(){
    $agent_special_code = $_POST['agent_special_code'];
    $check = $this->fund_model->check_agent_code($agent_special_code);
    if($check){
      $response = array('valid'=>true);
    }else{
      $response = array('valid'=>false, 'message'=>'This special code is not valid. Please contact for valid special code');
    }
    echo json_encode($response);
  }

  public function fund_history(){
    if($this->input->post()){
      $fromDate = $this->input->post('fromdate');
       $toDate = $this->input->post('todate');
      $plan = $this->input->post('plan');
      $query = '?1=1';
      if(isset($fromDate) & isset($toDate)){
        $query = $query."&fromdate=".$fromDate."&todate=".$toDate;
      }
      if($plan){
        $query = $query."&plan=".$plan;
      }
      redirect(base_url('user/fund/fund_history'.$query));
    }
    $fund_history = $this->fund_model->get_fund_history($this->session->userdata('CUSTOMERID'));
    $this->data['details'] = $fund_history;
    $this->render('front/fund/fund_history');
  }

  

  function account_report(){
    $this->data['user_id'] = $this->session->userdata('CUSTOMERID');
    $this->render('front/fund/account_report');
  }
 //End of class    
}

