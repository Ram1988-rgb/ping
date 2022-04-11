<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Home extends MY_Controller {
    
    function __construct() {
          parent::__construct();
          check_front_login();
          $this->load->model('fund_model');
          $this->load->model('bank_model');
          $this->load->model('user_model');
          $this->load->model('home_model');
          $this->load->model('investment_model');
          $this->load->model('cash_model');
		  
       }
    
 /**
  * @access public
  * 
  */   
public function index()
{ 
    $this->header_data['headTitle'] = "Nuvest : Customer Profile";
    $this->data['total_fund'] = $this->fund_model->get_total_fund();
    $this->data['total_loan'] = $this->fund_model->get_total_loan();
	$this->data['userData'] = $this->user_model->getrecord($this->session->userdata('CUSTOMERID'));
    $this->render('front/home');
}

public function bank(){
	$this->header_data['headTitle'] = "Nuvest : Customer My Bank";
	$this->data['all_record'] = $this->bank_model->get_all_record();
	$this->render('front/home/bank/view');
}

public function add(){   
	$this->header_data['headTitle'] = "Nuvest : Customer Add Bank";    
     if($this->input->post()){
		 $_POST['user_id'] = $this->session->userdata('CUSTOMERID');
		  $addBank = $this->bank_model->addBank($this->input->post());
		  if($addBank){
			  sendNotificationProfileBank($_POST, 'WEB');
			$this->session->set_flashdata('success', 'Card Added Successfully');
			redirect("/user/home/bank");
		  }else{
			  $this->session->set_flashdata('errordata', 'Something went wrong try again');
			  redirect("/user/home");
		  }
	}
	$this->render('front/home/bank/add');
}

public function nif(){  
	$this->header_data['headTitle'] = "Nuvest : Customer Verify NIF";     
     if($this->input->post()){
		 $nif_image = '';
		if(isset($_FILES['nif_image']['name'])){
			$nif_image = uploadImageWeb(
			  'nif_image',
			  $_FILES,
			  UPLOAD_NIF_IMAGE_ORIGINAL,
			  UPLOAD_NIF_IMAGE_THUMB,
			  THUMB_WIDTH,
			  THUMB_HEIGHT
			);
		  }
		  $_POST['nif_image'] = $nif_image;
		  $_POST['user_id'] = $this->session->userdata('CUSTOMERID');
		  $addNif = $this->home_model->addNIF($this->input->post(),$this->session->userdata('CUSTOMERID'));
		  if($addNif){
			$data = array(
				'status'=>3,
				'doc_type'=>'Nif',
				'user_id'=>$_POST['user_id']
			  );
			  $this->user_model->insert_verify_docs($data);
			$this->session->set_flashdata('success', "Your nif verification is at observation of Nusol. team Nusol will let you know once it's verified.");
			redirect("/user/home");
		  }else{
			  $this->session->set_flashdata('errordata', 'Something went wrong try again');
			  redirect("/user/home");
		  }
	}
	$this->data['record'] = $this->home_model->get_nif($this->session->userdata('CUSTOMERID'));
	$this->data['userData'] = $this->user_model->getrecord($this->session->userdata('CUSTOMERID'));
	
	$this->render('front/home/nif/nif');
}

public function contact(){
	$this->header_data['headTitle'] = "Nuvest : Customer Verified Contact"; 
	$CUSTOMERID = $this->session->userdata('CUSTOMERID');
	if($this->input->post()){
		$checkPhone = $this->user_model->checkPhone($this->input->post());
		
		if(!$checkPhone){
			$this->session->set_flashdata('errordata', 'This phone no not exist. Please enter correct phone no.');			  
			redirect("/user/home/contact");
		}
		$this->home_model->send_otp('VERIFYCONTACT', $CUSTOMERID);
		
		redirect("/user/home/verify_contact/".md5($this->input->post('phone')));
	}
	$this->home_model->delete_otp('VERIFYCONTACT',$CUSTOMERID);
	$this->render('front/home/contact/contact');
}

function verify_contact($phone){
	$CUSTOMERID = $this->session->userdata('CUSTOMERID');
	$otpdetail = $this->home_model->get_otp('VERIFYCONTACT', $CUSTOMERID);
	$start = strtotime($otpdetail->createdAt);
	$end = strtotime(date('Y-m-d H:i:s'));

	$time = $end - $start;
	$userData = $this->user_model->getrecord($this->session->userdata('CUSTOMERID'));
	if(md5($userData->phone) != $phone){
		$this->session->set_flashdata('errordata', 'Something went wrong. Please try again.');			  
		redirect("/user/home/contact");
	}	
	$this->data['otpDetail'] = $otpdetail;
	$this->data['time'] = $time;
	$this->data['phone'] = $phone;
	$this->render('front/home/contact/verify_contact');
}
function verify_otp(){
	$CUSTOMERID = $this->session->userdata('CUSTOMERID');
	$otpdetail = $this->home_model->get_otp('VERIFYCONTACT', $CUSTOMERID);
	if($otpdetail->otp == $_POST['otp']){
		$start = strtotime($otpdetail->createdAt);
		$end = strtotime(date('Y-m-d H:i:s'));

		$time = $end - $start;
		if($time >180){
			echo JSON_ENCODE(array(
				'status' =>false,
				'message' => "Your time up"
			));
			return false;
		}
		
		echo JSON_ENCODE(array(
			'status' =>true,
			'message' => "Your Phone no has been  verified successfully"
		));
		$this->home_model->verify_mobile($CUSTOMERID);
		$this->session->set_flashdata('success', 'Your Phone no has been  verified successfully.');			  
	
		return true;
		
	}else{
		echo JSON_ENCODE(array(
			'status' =>false,
			'message' => "Your otp is wrong. Please try again."
		));
		return false;
	}	
}

public function send_otp(){
	$data = array('status'=>true);
	$CUSTOMERID = $this->session->userdata('CUSTOMERID');
	$userData = $this->user_model->getrecord($this->session->userdata('CUSTOMERID'));
	if(md5($userData->phone) != $_POST['phone']){
		$this->session->set_flashdata('errordata', 'Something went wrong. Please try again.');			  
		$data['status'] = false;
		$data['message'] = "Your phone no not valid. Please try again";
		echo JSON_ENCODE($data);
		return true;
	}	
	$this->home_model->delete_otp('VERIFYCONTACT',$CUSTOMERID);
	$this->home_model->send_otp('VERIFYCONTACT', $CUSTOMERID);
	$this->session->set_flashdata('success', 'Your otp has been sent to your mobile no.');			  
		
	$data['message'] = "Your otp has been sent to your mobile no.";
	echo JSON_ENCODE($data);
}

function verify_email(){
	$this->header_data['headTitle'] = "Nuvest : Customer Verify Emai Address"; 
	if($this->input->post()){
		$userData = $this->user_model->getrecord($this->session->userdata('CUSTOMERID'));
		if($userData->email == $this->input->post('email')){
			$this->home_model->verify_email($this->session->userdata('CUSTOMERID'));
			$this->session->set_flashdata('success', 'Your email has been verified successfully.');			  
			redirect('user/home');
		}
		$this->session->set_flashdata('errordata', 'Your email is not correct.Please tray again.');			  
			redirect('user/home/verify_email');

	}
	$this->render('front/home/email/verify_email');
}

function verify_dermalog(){
	$this->header_data['headTitle'] = "Nuvest : Customer  Verify Dermalog";
	if($this->input->post() || $_FILES){
		if(isset($_FILES['proof_image']['name'])){
			$proof_image = uploadImageWeb(
			  'proof_image',
			  $_FILES,
			  UPLOAD_DERMALOG_IMAGE_ORIGINAL,
			  UPLOAD_DERMALOG_IMAGE_THUMB,
			  THUMB_WIDTH,
			  THUMB_HEIGHT
			);
		  }
		  if(isset($_FILES['selfie_image']['name'])){
			$selfie_image = uploadImageWeb(
			  'selfie_image',
			  $_FILES,
			  UPLOAD_DERMALOG_IMAGE_ORIGINAL,
			  UPLOAD_DERMALOG_IMAGE_THUMB,
			  THUMB_WIDTH,
			  THUMB_HEIGHT
			);
		  }
		  $_POST['proof_image'] = $proof_image;
		  $_POST['selfie_image'] = $selfie_image;
		  $_POST['user_id'] = $this->session->userdata('CUSTOMERID');
		 // print_r($_POST);die;
		  
		 $dermalog =  $this->home_model->verify_dermalog($this->input->post());
		 if($dermalog){
			$data = array(
				'status'=>3,
				'doc_type'=>'Dermalog',
				'user_id'=>$_POST['user_id']
			  );
			  $this->user_model->insert_verify_docs($data);
			$this->session->set_flashdata('success', "Your dermalog verification is at observation of Nusol. Team Nusol will let you know onceit's verified.");			  
			redirect('user/home');
		 }
		 $this->session->set_flashdata('errordata', 'Some thing went wrong.Please try again');			  
		redirect('user/home/verify_dermalog');
	}
	$this->header_data['headTitle'] = "Nuvest : Dermalog";	
	$this->data['userData'] = $this->user_model->getrecord($this->session->userdata('CUSTOMERID'));
	$this->data['dermalog'] = $this->home_model->get_dermolog($this->session->userdata('CUSTOMERID'));
	$this->render('front/home/darmalog/verify_darmalog');
}

function edit_profile(){
	$this->data['userData'] = $this->user_model->getrecord($this->session->userdata('CUSTOMERID'));
	if($this->input->post()){
		$_POST['user_id'] = $this->session->userdata('CUSTOMERID');
		if($this->user_model->checkUser($this->input->post(),$_POST['user_id'])){
			$this->session->set_flashdata('errordata', 'This emailId already exist. Please choose another.');			  
			redirect('user/home/edit_profile');
		}
		if($this->user_model->checkPhone($this->input->post(),$_POST['user_id'])){
			$this->session->set_flashdata('errordata', 'This phone no already exist. Please choose another.');			  
			redirect('user/home/edit_profile');
		}
		$image =$this->data['userData']->image;;
		if(($_FILES['image']['name'])){
			$image = uploadImageWeb(
			  'image',
			  $_FILES,
			  UPLOAD_USER_IMAGE_ORIGINAL,
			  UPLOAD_USER_IMAGE_THUMB,
			  THUMB_WIDTH,
			  THUMB_HEIGHT
			);
			
		  }
		  $_POST['image'] = $image;
		  $_POST['type'] = 'home';
		  
		
		$edit = $this->user_model->editUser($this->input->post(),$_POST['user_id']);
		if($edit){
			$newdata = array(
				'CUSTOMERNAME' => $_POST['name'],                        
				'CUSTOMERPHONE' => $_POST['phone'], 
				'CUSTOMEREMAIL' => $_POST['email'],                       
				'CUSTOMERIMAGE' => $_POST['image'],                        
			   );
			   $this->session->set_userdata($newdata);

			   sendNotificationEditProfile(array('user_id'=>$_POST['user_id']),'WEB');
			$this->session->set_flashdata('success', "Your profile has been updated successfully.");			  
			redirect('user/home');
		 }
		 $this->session->set_flashdata('errordata', 'Some thing went wrong.Please try again');			  
		redirect('user/home/edit_profile');
	}
	
	$this->render('front/home/profile/edit');
}
function tofa(){
	$_POST['user_id'] = $this->session->userdata('CUSTOMERID');
    $this->home_model->update_tofa($_POST);
    echo "2FA status has been changed";
  }

 //End of class    
}

