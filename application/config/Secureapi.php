<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Secureapi extends MY_Controller {
    
  function __construct() {
    parent::__construct();
    $this->load->model('user_model');
    $this->load->model('userpin_model');
    $this->load->model('plan_model');
    $this->load->model('investment_model');
    $this->load->model('loan_model');
    $this->load->model('fund_model');
    $this->load->model('fund_type_model');
    $this->load->model('bank_model');
    $this->load->model('home_model');

    $this->token = $this->input->request_headers('x-access-token');
    $tok_field ='x-access-token';
    if($_SERVER['HTTP_HOST'] == "nuvest.sarasolutions.in"){
      $tok_field ='X-Access-Token';
    }
   
    if($this->token && $this->token[$tok_field]){
      $this->tokenData = validateJWTToken($this->token[$tok_field]);
      $this->customer_id = $this->tokenData->id;
      if(!$this->customer_id){
        $response_data = array('status'=> 401, 'message' => 'Please send valid token', 'data'=>[]);
        echo json_encode($response_data);
      }
    }else{
      $response_data = array('status'=> 401, 'message' => 'Please send valid token', 'data'=>[]);
      echo json_encode($response_data);
    }   
  }

  function plan_category(){
    $data = $this->plan_model->get_category();   
    $response_data = array('status'=> 200, 'message' => '', "data"=>$data);
		echo json_encode($response_data);
  }

  function addwallet(){
    $response_data = array('status'=> 200, 'message' => '', "data"=>$this->tokenData);
		echo json_encode($response_data);

  }

  public function investmentdata(){
    $total_investment = $this->investment_model->get_total_investment(0,$this->customer_id);
    $data = array('investmentAmount'=>isset($total_investment->amount)?(int)$total_investment->amount:(int)0);    
    $all_investment_plan = $this->plan_model->get_plan_by_category('INVESTMENT');
    $invest = [];
    foreach($all_investment_plan as $investmentPlan){ 
      $invs = $this->investment_model->get_total_investment($investmentPlan->id, $this->customer_id);
      $investmentPlan->amount = isset($invs->amount)?$invs->amount:0;
      $invest[] = $investmentPlan;
    }
    $data['allInvestmentPlan'] =$invest;

    $response_data = array('status'=> 200, 'message' => '', "data"=>$data);
		echo json_encode($response_data,JSON_NUMERIC_CHECK);  
  }

  public function investmentSummary(){
    $response_data = array('status'=> 200, 'message' => '', "data"=>$total_investment);
		echo json_encode($response_data);  
  }

  public function plandurationfrequency($planId){
    $duration = $this->plan_model->get_plan_type_duration($planId);
    $frequency = $this->plan_model->get_plan_payment_duration($planId);
    if($duration && $frequency){
      $response_data = array('status'=> 200, 'message' => '', "data"=>array(
        'planDuration'=>$duration,
        'paymentFrequency'=>$frequency
      ));
		  echo json_encode($response_data);  
      die;
    }
    $response_data = array('status'=> 401, 'message' => 'Please enter valid plan Id', "data"=>[]);
		echo json_encode($response_data);  
  }

  public function createinvestment(){
    $_POST['user_id'] = $this->customer_id;
    if($this->investment_model->create_plan($this->input->post())){
      $response_data = array('status'=> 200, 'message' => 'Your investment has been added successfully', "data"=>[]);
      echo json_encode($response_data); 
      die; 
    }
    $response_data = array('status'=> 401, 'message' => 'Something went wrong', "data"=>[]);
		echo json_encode($response_data); 
  }

  public function loandata(){
    $loanPlan = $this->plan_model->get_plan_by_category('LOAN');
   // $duration = $this->plan_model->get_plan_type_duration($planId);
    //$frequency = $this->plan_model->get_plan_payment_duration($planId);
   
    $data['loanPlan'] =$loanPlan;
    //$data['planDuration'] = $duration;
    //$data['paymentFrequency'] = $frequency;


    $response_data = array('status'=> 200, 'message' => '', "data"=>$data);
		echo json_encode($response_data);  
  }

  public function loanFrequencyDuration($planId){
    $duration = $this->plan_model->get_plan_type_duration($planId);
    $frequency = $this->plan_model->get_plan_payment_duration($planId);
    $data['planDuration'] = $duration;
    $data['paymentFrequency'] = $frequency;
    $response_data = array('status'=> 200, 'message' => '', "data"=>$data);
		echo json_encode($response_data);
  }

  public function createloan(){
    $_POST['user_id'] = $this->customer_id;
    if($this->loan_model->addLoan($this->input->post())){
      $response_data = array('status'=> 200, 'message' => 'Your loan has been added successfully', "data"=>[]);
      echo json_encode($response_data); 
      die; 
    }
    $response_data = array('status'=> 401, 'message' => 'Something went wrong', "data"=>[]);
		echo json_encode($response_data); 
  }

  public function fundtype(){
   $fType =  $this->fund_type_model->get_all_record();
   $response_data = array('status'=> 200, 'message' => '', "data"=>$fType);
   echo json_encode($response_data); 
   die; 
  }

  public function addbank(){
    $_POST['user_id'] = $this->customer_id;
    if($this->bank_model->addBank($this->input->post())){
      $response_data = array('status'=> 200, 'message' => 'Your bank has been added successfully', "data"=>[]);
      echo json_encode($response_data); 
      die; 
    }
    $response_data = array('status'=> 401, 'message' => 'Something went wrong', "data"=>[]);
		echo json_encode($response_data); 
  }

  public function mybank(){
    $user_id = $this->customer_id;
    if($data = $this->bank_model->get_all_record($user_id)){
      $response_data = array('status'=> 200, 'message' => '', "data"=>$data);
      echo json_encode($response_data); 
      die; 
    }
    $response_data = array('status'=> 401, 'message' => 'Something went wrong', "data"=>[]);
		echo json_encode($response_data); 
  }

  public function verifymobile(){
    $_POST['user_id'] = $this->customer_id;
    $checkPhone = $this->user_model->checkPhone($this->input->post());
    if($checkPhone){
		if($otp = $this->home_model->send_otp('VERIFYCONTACT', $_POST['user_id'])){
			$response_data = array('status'=> 200, 'message' => 'Otp has been send successfully on your register numbers', "data"=>array('otp'=>$otp));
			  echo json_encode($response_data); 
			  die; 
		}else{
		  $response_data = array('status'=> 401, 'message' => 'Something went wrong', "data"=>[]);
		  echo json_encode($response_data); 
		  die; 
		}
    }else{
		$response_data = array('status'=> 401, 'message' => 'This phone no not exist. Please enter correct phone no.', "data"=>[]);
		echo json_encode($response_data); 
	} 
	$response_data = array('status'=> 401, 'message' => 'Something went wrong', "data"=>[]);
	echo json_encode($response_data);    
  }
  
  public function verify_otp(){
	$CUSTOMERID = $this->customer_id;
	$otpdetail = $this->home_model->get_otp('VERIFYCONTACT', $CUSTOMERID);
	if($otpdetail->otp == $_POST['otp']){
		$start = strtotime($otpdetail->createdAt);
		$end = strtotime(date('Y-m-d H:i:s'));
		$time = $end - $start;
		if($time >1800000000){
			$response_data = array('status'=> 401, 'message' => 'Your time up', "data"=>[]);
			echo json_encode($response_data);    
			die;
		}		
		$this->home_model->verify_mobile($CUSTOMERID);
		$response_data = array('status'=> 200, 'message' => 'Your Phone no has been  verified successfully', "data"=>[]);
		echo json_encode($response_data);
		die;
	}else{
		$response_data = array('status'=> 401, 'message' => 'Something went wrong', "data"=>[]);
		echo json_encode($response_data);    
	}	
}

	public function verify_email(){
		if($this->input->post()){
			$userData = $this->user_model->getrecord($this->customer_id);
			if($userData->email == $this->input->post('email')){  
				$this->home_model->verify_email($this->customer_id);		  
				$response_data = array('status'=> 200, 'message' => 'Your email has been verified successfully.', "data"=>[]);
				echo json_encode($response_data);
				die;
			}else{
				$response_data = array('status'=> 401, 'message' => 'Your email is not correct.Please tray again.', "data"=>[]);
				echo json_encode($response_data);   
				die;
			}
			$response_data = array('status'=> 401, 'message' => 'Something went wrong', "data"=>[]);
			echo json_encode($response_data);
		}else{
			$response_data = array('status'=> 401, 'message' => 'Something went wrong', "data"=>[]);
			echo json_encode($response_data);  
		}  
	}
  

  public function addfund(){
    $_POST['user_id'] = $this->customer_id;
    $recieptname = '';
    $back_side = '';
    $front_side = '';
    if(isset($_FILES['receipt']['name'])){
      $recieptname = uploadImage(
        'receipt',
        $_FILES, UPLOAD_FUND_IMAGE_ORIGINAL,
        UPLOAD_FUND_IMAGE_THUMB, THUMB_WIDTH,
        THUMB_HEIGHT
      );
    }
    if(isset($_FILES['front_side']['name'])){
      $front_side = uploadImage(
        'front_side',
        $_FILES, UPLOAD_FUND_IMAGE_ORIGINAL,
        UPLOAD_FUND_IMAGE_THUMB, THUMB_WIDTH,
        THUMB_HEIGHT
      );
    }
    if(isset($_FILES['back_side']['name'])){
      $back_side = uploadImage(
        'back_side',
        $_FILES, UPLOAD_FUND_IMAGE_ORIGINAL,
        UPLOAD_FUND_IMAGE_THUMB, THUMB_WIDTH,
        THUMB_HEIGHT
      );
    }
    $_POST['bankdeposite_upload'] = $recieptname;
    $_POST['check_front_upload'] = $front_side;
    $_POST['check_back_upload'] = $back_side;

    $addFund = $this->fund_model->addFund($this->input->post());
    if($addFund){
      $response_data = array('status'=> 200, 'message' => 'Your fund has been added successfully', "data"=>[]);
      echo json_encode($response_data); 
      die; 
    }
    $response_data = array('status'=> 401, 'message' => 'Something went wrong', "data"=>[]);
		echo json_encode($response_data);
    
  }

  public function logout(){
    $_POST['user_id'] = $this->customer_id;
    $this->user_model->logout($_POST);
    $response_data = array('status'=> 200, 'message' => 'Logout successfully', "data"=>[]);
    echo json_encode($response_data); 
    die; 
    
    
  }
    
}
?>
