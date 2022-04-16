<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 
ini_set('serialize_precision',-1);
require APPPATH . 'libraries/REST_Controller.php';
class Secureapi extends REST_Controller {
    
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
    $this->load->model('card_model');
    $this->load->model('cash_model');
    $this->load->model('cashout_model');
    $this->load->model('referapp_model');
    $this->load->model('interest_model');
    $this->load->model('agent_model');

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
        $this->response($response_data, REST_Controller::HTTP_UNAUTHORIZED);  
        return true;      
      }
    }else{
      $response_data = array('status'=> 401, 'message' => 'Please send valid token', 'data'=>[]);
      $this->response($response_data, REST_Controller::HTTP_UNAUTHORIZED);
      return true;
    }   
  }

   function plan_category_get(){
    $data = $this->plan_model->get_category();  

    $response_data = array(
      'status'=> 200, 
      'message' => 'Plan Detail', 
      "data"=>array(
          "plan"=>$data,
          'wallet_amount'=> "".show_number(getCurrentBalence($this->customer_id)),
          'total_cash'=> show_number($this->cash_model->get_cash_saving($this->customer_id)),
          'total_investment'=>show_number($this->investment_model->get_investment_saving($this->customer_id)),
          'total_loan'=>show_number($this->loan_model->get_total_loan($this->customer_id)->amount),
          'interest_earned'=>"".show_number(get_total_interest($this->customer_id))     
        )
      );
    $this->response($response_data, REST_Controller::HTTP_OK);
  }

  function addwallet(){
    $response_data = array('status'=> 200, 'message' => '', "data"=>$this->tokenData);
	  echo json_encode($response_data);
  }

  public function investmentdata_get(){
    $total_investment = $this->investment_model->get_investment_saving($this->customer_id);
    $data = array('investmentAmount'=>isset($total_investment)?show_number($total_investment):"0.00");    
    $all_investment_plan = $this->plan_model->get_plan_by_category('INVESTMENT');
    $invest = [];
    foreach($all_investment_plan as $investmentPlan){ 
      $invs = $this->investment_model->get_total_investment($investmentPlan->id, $this->customer_id);
      $investmentPlan->amount = isset($invs->amount)?show_number($invs->amount):"0.00";
      $invest[] = $investmentPlan;
    }
    $data['allInvestmentPlan'] =$invest;

    $response_data = array('status'=> 200, 'message' => '', "data"=>$data);
    $this->response($response_data, REST_Controller::HTTP_OK);
	//echo json_encode($response_data);  
  }

  public function investmentSummary(){
    $response_data = array('status'=> 200, 'message' => '', "data"=>$total_investment);
	  echo json_encode($response_data);  
  }

  public function investment_list_get($investment_plan_id){
    $all_list = $this->investment_model->get_all_list_forapp($investment_plan_id, $this->customer_id);
    $all_data = [];
    if(sizeof($all_list)){
      foreach($all_list as $line){
        $comes = comes_from($line->amount_comes_from_id);
        $all_data[] = array(
          'id'=>$line->id,
          'plan_id'=>$line->id,
          'amount'=>show_number($line->amount),
          'start_date'=>$line->start_date,
          'end_date'=>$line->end_date,
          'interest_rate'=>$line->interest_rate,
          'plan_id'=>$line->id,
          'payment_type_id'=>$line->payment_type_id,
          'payment_duration_id'=>$line->payment_duration_id,
          'payment_type'=> ($line->payment_type_data!="null")?JSON_DECODE($line->payment_type_data)->label:'',
          'payment_duration'=> ($line->payment_deuration_data!="null")?JSON_DECODE($line->payment_deuration_data)->label:'',
          'comes_from'=>$comes? $comes->name: '',
          'status'=>$line->status
        );
      }
    }
    $response_data = array('status'=> 200, 'message' => '', "data"=>$all_data);
	  $this->response($response_data, REST_Controller::HTTP_OK);
  }
  //only one investment list
  public function investment_summary_get($investment_id){
    $line = $this->investment_model->get_one_list_forapp($investment_id, $this->customer_id);    
    $comes = comes_from($line->amount_comes_from_id);
    $next_payment_date = next_invest_payment_date($line->id);
    $all_payment_date =  all_invest_payment_date($line->id);
    $all_data = array(
      'id'=>$line->id,
      'plan_id'=>$line->plan_id,
      'amount'=>show_number($line->amount),
      'start_date'=>$line->start_date,
      'end_date'=>$line->end_date,
      'interest_rate'=>$line->interest_rate,
      'payment_type_id'=>$line->payment_type_id,
      'payment_duration_id'=>$line->payment_duration_id,
      'payment_type'=> ($line->payment_type_data!="null")?JSON_DECODE($line->payment_type_data)->label:'',
      'payment_duration'=> ($line->payment_deuration_data!="null")?JSON_DECODE($line->payment_deuration_data)->label:'',
      'comes_from'=>isset($comes)? $comes->name: '',
      'next_payment_date'=> isset($next_payment_date)?$next_payment_date->payment_date:'',
      'next_payment_amount'=>show_number($line->amount),
      'all_payment_date'=>$all_payment_date,
      'mybalence'=>show_number($this->investment_model->get_total_investment($line->plan_id,$this->customer_id)->amount),
      'next_payment_status'=>'Pending'
    );
      
    $response_data = array('status'=> 200, 'message' => '', "data"=>$all_data);
	  $this->response($response_data, REST_Controller::HTTP_OK);
  }

  public function investment_summary_single($investment_id){
    $line = $this->investment_model->get_one_list_forapp($investment_id, $this->customer_id);    
    $comes = comes_from($line->amount_comes_from_id);
    $next_payment_date = next_invest_payment_date($line->id);
    $all_payment_date =  all_invest_payment_date($line->id);
    $all_data = array(
      'id'=>$line->id,
      'plan_id'=>$line->id,
      'amount'=>show_number($line->amount),
      'start_date'=>$line->start_date,
      'end_date'=>$line->end_date,
      'interest_rate'=>$line->interest_rate,
      'plan_id'=>$line->id,
      'payment_type_id'=>$line->payment_type_id,
      'payment_duration_id'=>$line->payment_duration_id,
      'payment_type'=> ($line->payment_type_data!="null")?JSON_DECODE($line->payment_type_data)->label:'',
      'payment_duration'=> ($line->payment_deuration_data!="null")?JSON_DECODE($line->payment_deuration_data)->label:'',
      'comes_from'=>isset($comes)? $comes->name: '',
      'next_payment_date'=> isset($next_payment_date)?$next_payment_date->payment_date:'',
      'next_payment_amount'=>show_number($line->amount),
      'all_payment_date'=>$all_payment_date
    );
      return $all_data;
    $response_data = array('status'=> 200, 'message' => '', "data"=>$all_data);
	  $this->response($response_data, REST_Controller::HTTP_OK);
  }

  public function loan_list_get(){
    $all_list = $this->loan_model->get_all_list_forapp( $this->customer_id);
    $all_data = [];
    if($all_list){
      foreach($all_list as $line){
        $all_data[] = array(
          'id'=>$line->id,
          'plan_id'=>$line->id,
          'status'=>$line->status,
          'plan_name'=> isset($line->plan_data)?JSON_DECODE($line->plan_data)->name:'',
          'loan_amount'=>show_number($line->amount),
          'installment_amount'=>show_number($line->install_amount),
          'start_date'=>$line->start_date,
          'end_date'=>$line->end_date,
          'interest_rate'=>$line->interest_rate,
          'payment_type_id'=>$line->payment_type_id,
          'payment_duration_id'=>$line->loan_duration_id,
          'payment_type'=> ($line->payment_type_data != "null")?JSON_DECODE($line->payment_type_data)->label:'',
          'payment_duration'=> ($line->payment_deuration_data != "null")?JSON_DECODE($line->payment_deuration_data)->label:'',
          
        );
      }
    }
    $response_data = array('status'=> 200, 'message' => '', "data"=>$all_data, 'total_loan'=>show_number($this->loan_model->get_total_loan($this->customer_id)->amount));
	  $this->response($response_data, REST_Controller::HTTP_OK);   
  }

  public function loan_summary_get($loan_id){
    $line = $this->loan_model->get_one_list_forapp( $loan_id, $this->customer_id); 
    if($line){ 
      $next_payment_date = next_loan_payment_date($line->id); 
      $all_payment_date = all_loan_payment_date($line->id);
      $all_data = array(
        'id'=>$line->id,
        'plan_id'=>$line->id,
        'plan_name'=> isset($line->plan_data)?JSON_DECODE($line->plan_data)->name:'',
        'loan_amount'=>show_number($line->amount),
        'installment_amount'=>show_number($line->install_amount),
        'start_date'=>$line->start_date,
        'end_date'=>$line->end_date,
        'interest_rate'=>$line->interest_rate,
        'payment_type_id'=>$line->payment_type_id,
        'payment_duration_id'=>$line->loan_duration_id,
        'payment_type'=> ($line->payment_type_data != "null")?JSON_DECODE($line->payment_type_data)->label:'',
        'payment_duration'=> ($line->payment_deuration_data != "null")?JSON_DECODE($line->payment_deuration_data)->label:'',
        'next_payment_date'=> isset($next_payment_date)?$next_payment_date->payment_date:'',
        'next_payment_amount'=>show_number($line->install_amount),
        'all_payment_date'=>$all_payment_date,
        'mybalence'=>"".show_number($this->loan_model->get_total_loan($this->customer_id)->amount),
      );
        
      $response_data = array('status'=> 200, 'message' => '', "data"=>$all_data, 'total_loan'=>show_number($this->loan_model->get_total_loan($this->customer_id)->amount));
      $this->response($response_data, REST_Controller::HTTP_OK);  
    }else{
      $response_data = array('status'=> 400, 'message' => 'Something went wrong', "data"=>[]);
		  $this->response($response_data, REST_Controller::HTTP_BAD_REQUEST); 
    } 
  }

  public function plandurationfrequency_get($planId){
    $duration = $this->plan_model->get_plan_type_duration($planId);
    $frequency = $this->plan_model->get_plan_payment_duration($planId);
    if($duration && $frequency){
      $response_data = array('status'=> 200, 'message' => '', "data"=>array(
        'planDuration'=>$duration,
        'paymentFrequency'=>$frequency
      ));
		  $this->response($response_data, REST_Controller::HTTP_OK);      
    }else{
      $response_data = array('status'=> 404, 'message' => 'Please enter valid plan Id', "data"=>[]);
      $this->response($response_data, REST_Controller::HTTP_NOT_FOUND); 
	  }
  }

  public function createinvestment_post(){
    $_POST['user_id'] = $this->customer_id;
    
    $paymentDuration = getRecord($this->security->xss_clean($_POST['payment_duration']), TBL_PAYMENTDURATION);
    
      if($_POST['payment_type'] ==5 && $paymentDuration->month < 12){
        $response_data = array('status'=> 404, 'message' => 'Please Select Payment Type monthly', "data"=>[]);
		    $this->response($response_data, REST_Controller::HTTP_NOT_FOUND);
        return true;
      }
      
    if($addId=$this->investment_model->create_plan($this->security->xss_clean($this->input->post()))){
      
      $this->investment_model->insert_fund_history($addId);
      $this->investment_model->insert_payment_date($addId);
      $invest_detail = $this->investment_summary_single($addId);

       $message = $this->set_investment_message($addId);
       $response_data = array('status'=> 200, 'message' => $message, "data"=>$invest_detail);
      
      $this->response($response_data, REST_Controller::HTTP_OK);
    }else{
		$response_data = array('status'=> 404, 'message' => 'Something went wrong', "data"=>[]);
		$this->response($response_data, REST_Controller::HTTP_NOT_FOUND); 
	}
  }

  public function set_investment_message($invid){
    $investment_detail = $this->investment_model->getRecord($invid);
    saveInvestmentNotification($investmentDetail, 'APP');
    $paymentDuration = getRecord($investment_detail->payment_duration_id, TBL_PAYMENTDURATION);
    $paymentType = getRecord($investment_detail->payment_type_id, TBL_PAYMENTTYPE);
      $plan = getRecord($investment_detail->plan_id, TBL_PLAN);
      $earn = $investment_detail->amount*$investment_detail->installment_count;
      $totalearn = show_number(($earn*$investment_detail->interest_rate)/100);
      return $message = 'You are saving '.$investment_detail->amount.' '.$paymentType->label.' for '.$paymentDuration->label.', you will earn '
      .$earn.' and a interest of '.$investment_detail->interest_rate.'% for total HTG '.$totalearn.' '.$plan->name;
      

  }

  public function loandata_get(){
    $loanPlan = $this->plan_model->get_plan_by_category('LOAN');
   // $duration = $this->plan_model->get_plan_type_duration($planId);
    //$frequency = $this->plan_model->get_plan_payment_duration($planId);
   
    $data['loanPlan'] =$loanPlan;
    //$data['planDuration'] = $duration;
    //$data['paymentFrequency'] = $frequency;


    $response_data = array('status'=> 200, 'message' => '', "data"=>$data);
	  $this->response($response_data, REST_Controller::HTTP_OK);
  }

  public function loanFrequencyDuration_get($planId){
    $duration = $this->plan_model->get_plan_type_duration($planId);
    $frequency = $this->plan_model->get_plan_payment_duration($planId);
    $data['planDuration'] = $duration;
    $data['paymentFrequency'] = $frequency;
    $response_data = array('status'=> 200, 'message' => '', "data"=>$data);
	$this->response($response_data, REST_Controller::HTTP_OK);
  }

  public function createloan_post(){
    $_POST['user_id'] = $this->customer_id;
    $_POST['apply_status'] = 1;
    if($loan_id = $this->loan_model->addLoan($this->security->xss_clean($this->input->post()))){
     $data =$this->loan_summary_single($loan_id);
     $recordDetail = $this->loan_model->getRecord($loan_id);
     saveLoanNotification( $recordDetail,'APP');
      $response_data = array('status'=> 200, 'message' => 'Your loan has been added successfully', "data"=>$data);
      $this->response($response_data, REST_Controller::HTTP_OK);
      return true; 
    }
    $response_data = array('status'=> 404, 'message' => 'Something went wrong', "data"=>[]);
	  $this->response($response_data, REST_Controller::HTTP_NOT_FOUND); 
  }

  public function loan_summary_single($loan_id){
    $line = $this->loan_model->get_one_list_forapp($loan_id, $this->customer_id);
   // print_r($line);   
    //$comes = comes_from($line->amount_comes_from_id);
    $next_payment_date = next_loan_payment_date($line->id);
    $all_payment_date =  all_loan_payment_date($line->id);
    $all_data = array(
      'id'=>$line->id,
      'plan_id'=>$line->plan_id,
      'plan_name'=> isset($line->plan_data)?JSON_DECODE($line->plan_data)->name:'',
      'loan_amount'=>show_number($line->amount),
      'installment_amount'=>show_number($line->install_amount),
      'start_date'=>$line->start_date,
      'end_date'=>$line->end_date,
      'interest_rate'=>$line->interest_rate,
      'payment_type_id'=>$line->payment_type_id,
      'payment_duration_id'=>$line->loan_duration_id,
      'payment_type'=> ($line->payment_type_data != "null")?JSON_DECODE($line->payment_type_data)->label:'',
      'payment_duration'=> ($line->payment_deuration_data != "null")?JSON_DECODE($line->payment_deuration_data)->label:'',
      'next_payment_date'=> isset($next_payment_date)?$next_payment_date->payment_date:'',
      'next_payment_amount'=>show_number($line->install_amount),
      'all_payment_date'=>$all_payment_date
    );
      return $all_data;
      
  }

  public function fundtype_get(){
   $fType =  $this->fund_type_model->get_all_record();
   $response_data = array('status'=> 200, 'message' => '', "data"=>$fType);
   $this->response($response_data, REST_Controller::HTTP_OK);
   return true; 
  }

  public function addbank_post(){
    $_POST['user_id'] = $this->customer_id;
    if($this->bank_model->addBank($this->security->xss_clean($this->input->post()))){
      sendNotificationProfileBank($this->security->xss_clean($_POST), 'APP');
      $response_data = array('status'=> 200, 'message' => 'Your bank has been added successfully', "data"=>[]);
      $this->response($response_data, REST_Controller::HTTP_OK);
      return true; 
    }
    $response_data = array('status'=> 404, 'message' => 'Something went wrong', "data"=>[]);
	  $this->response($response_data, REST_Controller::HTTP_NOT_FOUND); 
  }

  public function mybank_get(){
    $user_id = $this->customer_id;
    if($data = $this->bank_model->get_all_record($user_id)){
      $response_data = array('status'=> 200, 'message' => '', "data"=>$data);
     $this->response($response_data, REST_Controller::HTTP_OK);
      return true; 
    }
    $response_data = array('status'=> 404, 'message' => 'Something went wrong', "data"=>[]);
	$this->response($response_data, REST_Controller::HTTP_NOT_FOUND);  
  }

  public function verifymobile_post(){
    $_POST['user_id'] = $this->customer_id;
    $checkPhone = $this->user_model->checkPhone($this->security->xss_clean($this->input->post()));
    if($checkPhone){
		if($otp = $this->home_model->send_otp('VERIFYCONTACT', $this->security->xss_clean($_POST['user_id']))){
			$response_data = array('status'=> 200, 'message' => 'Otp has been send successfully on your register numbers', "data"=>array('otp'=>$otp));
			$this->response($response_data, REST_Controller::HTTP_OK);
			return true; 
		}else{
		  $response_data = array('status'=> 404, 'message' => 'Something went wrong', "data"=>[]);
		 $this->response($response_data, REST_Controller::HTTP_NOT_FOUND); 
		 return true;
		}
    }else{
		$response_data = array('status'=> 404, 'message' => 'This phone no not exist. Please enter correct phone no.', "data"=>[]);
		$this->response($response_data, REST_Controller::HTTP_NOT_FOUND); 
	} 
	$response_data = array('status'=> 404, 'message' => 'Something went wrong', "data"=>[]);
	$this->response($response_data, REST_Controller::HTTP_NOT_FOUND);   
  }
  
  public function verify_otp_post(){
	$CUSTOMERID = $this->customer_id;
	$otpdetail = $this->home_model->get_otp('VERIFYCONTACT', $CUSTOMERID);
	if($otpdetail->otp == $_POST['otp']){
		$start = strtotime($otpdetail->createdAt);
		$end = strtotime(date('Y-m-d H:i:s'));
		$time = $end - $start;
		if($time >1800000000){
			$response_data = array('status'=> 200, 'message' => 'Your time up', "data"=>[]);
			 $this->response($response_data, REST_Controller::HTTP_OK);   
			return true; 
		}		
		$this->home_model->verify_mobile($CUSTOMERID);
		$response_data = array('status'=> 200, 'message' => 'Your Phone no has been  verified successfully', "data"=>[]);
		$this->response($response_data, REST_Controller::HTTP_OK); 
		return true;
	}else{
		$response_data = array('status'=> 404, 'message' => 'Something went wrong', "data"=>[]);
		$this->response($response_data, REST_Controller::HTTP_NOT_FOUND);   
	}	
}

	public function verify_email_post(){
		if($this->input->post()){
			$userData = $this->user_model->getrecord($this->customer_id);
			if($userData->email == $this->security->xss_clean($this->input->post('email'))){  
				$this->home_model->verify_email($this->customer_id);		  
				$response_data = array('status'=> 200, 'message' => 'Your email has been verified successfully.', "data"=>[]);
				$this->response($response_data, REST_Controller::HTTP_OK); 
				return true;
			}else{
				$response_data = array('status'=> 404, 'message' => 'Your email is not correct.Please tray again.', "data"=>[]);
				$this->response($response_data, REST_Controller::HTTP_NOT_FOUND); 
				return true;
			}
			$response_data = array('status'=> 404, 'message' => 'Something went wrong', "data"=>[]);
			$this->response($response_data, REST_Controller::HTTP_NOT_FOUND); 
		}else{
			$response_data = array('status'=> 404, 'message' => 'Something went wrong', "data"=>[]);
			$this->response($response_data, REST_Controller::HTTP_NOT_FOUND);  
		}  
	}
  

  public function addfund_post(){
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
      $recieptname = $recieptname['message'];
    }
    if(isset($_FILES['front_side']['name'])){
      $front_side = uploadImage(
        'front_side',
        $_FILES, UPLOAD_FUND_IMAGE_ORIGINAL,
        UPLOAD_FUND_IMAGE_THUMB, THUMB_WIDTH,
        THUMB_HEIGHT
      );
      $front_side = $front_side['message'];
    }
    if(isset($_FILES['back_side']['name'])){
      $back_side = uploadImage(
        'back_side',
        $_FILES, UPLOAD_FUND_IMAGE_ORIGINAL,
        UPLOAD_FUND_IMAGE_THUMB, THUMB_WIDTH,
        THUMB_HEIGHT
      );
      
      
      $back_side = $back_side['message'];
    }
    $_POST['bankdeposite_upload'] = $recieptname;
    $_POST['check_front_upload'] = $front_side;
    $_POST['check_back_upload'] = $back_side;

    $addFund = $this->fund_model->addFund($this->security->xss_clean($this->input->post()));
    if($addFund){
      $fundDetail = $this->fund_model->getrecord($addFund);
      saveFundNotification($fundDetail, 'APP');
      $response_data = array('status'=> 200, 'message' => 'Your fund has been added successfully', "data"=>[]);
      $this->response($response_data, REST_Controller::HTTP_OK);
      return true; 
    }
    $response_data = array('status'=> 404, 'message' => 'Something went wrong', "data"=>[]);
	  $this->response($response_data, REST_Controller::HTTP_NOT_FOUND);
    
  }

  public function logout_post(){
    $_POST['user_id'] = $this->customer_id;
    $this->user_model->logout($this->security->xss_clean($_POST));
    $response_data = array('status'=> 200, 'message' => 'Logout successfully', "data"=>[]);
    $this->response($response_data, REST_Controller::HTTP_OK); 
    return true; 
  }

  public function fund_recent_activity_get(){
    $_POST['user_id'] = $this->customer_id;
    $data = $this->fund_model->get_fund_recent_activity($this->customer_id);
    $datas = $this->manage_fund_data($data);
    $response_data = array('status'=> 200, 'message' => '', "data"=>array('wallet_amount'=>"".show_number(getCurrentBalence($this->customer_id)),
    'recent_activities'=>$data));
    $this->response($response_data, REST_Controller::HTTP_OK); 
  }
  
  function manage_fund_data($data){
	  $detail = array();
	  foreach($data as $line){
		  $line->amount = show_number($line->amount);
		   if($line->fundtype_id == 1){
			$line->message = "Your Bank deposit successfully";
			}
			 if($line->fundtype_id == 2){
			$line->message = "Check deposited successfully";
			}
		  if($line->fundtype_id == 3){
			$line->message = "Your Agent deposit successfully";
			}
		  $detail[] = $line;
		  }
		  return $detail;
	  
	}

  public function verify_nif_post(){
    $_POST['user_id'] = $this->customer_id;
    if($this->input->post()){
      $nif_image = '';
     if(isset($_FILES['nif_image']['name'])){
       $nif_image = uploadImage(
         'nif_image',
         $_FILES,
         UPLOAD_NIF_IMAGE_ORIGINAL,
         UPLOAD_NIF_IMAGE_THUMB,
         THUMB_WIDTH,
         THUMB_HEIGHT
       );
       $nif_image = $nif_image['message'];
       }
       $_POST['nif_image'] = $nif_image;
       $addNif = $this->home_model->addNIF($this->security->xss_clean($this->input->post()),$this->customer_id);
       if($addNif){
        $response_data = array('status'=> 200, 'message' => "Your nif verification is at observation of Nusol. team Nusol will let you know once it's verified.", "data"=>array());
        $this->response($response_data, REST_Controller::HTTP_OK); 
       }else{
        $response_data = array('status'=> 404, 'message' => 'Something went wrong', "data"=>[]);
        $this->response($response_data, REST_Controller::HTTP_NOT_FOUND);
       }
   }
  }

  function verify_dermalog_post(){
    if($this->input->post() || $_FILES){
      if(isset($_FILES['proof_image']['name'])){
        $proof_image = uploadImage(
          'proof_image',
          $_FILES,
          UPLOAD_DERMALOG_IMAGE_ORIGINAL,
          UPLOAD_DERMALOG_IMAGE_THUMB,
          THUMB_WIDTH,
          THUMB_HEIGHT
        );
        $proof_image=$proof_image['message'];
        }
        if(isset($_FILES['selfie_image']['name'])){
        $selfie_image = uploadImage(
          'selfie_image',
          $_FILES,
          UPLOAD_DERMALOG_IMAGE_ORIGINAL,
          UPLOAD_DERMALOG_IMAGE_THUMB,
          THUMB_WIDTH,
          THUMB_HEIGHT
        );
        
        $selfie_image = $selfie_image['message'];
        }
        $_POST['proof_image'] = $proof_image;
        $_POST['selfie_image'] = $selfie_image;
        $_POST['user_id'] = $this->customer_id;
          // print_r($_POST);die;
        
       $dermalog =  $this->home_model->verify_dermalog($this->security->xss_clean($this->input->post()));
       if($dermalog){
        $response_data = array('status'=> 200, 'message' => "Your dermalog verification is at observation of Nusol. Team Nusol will let you know onceit's verified.", "data"=>array());
        $this->response($response_data, REST_Controller::HTTP_OK); 
       }else{
        $response_data = array('status'=> 404, 'message' => 'Something went wrong', "data"=>[]);
        $this->response($response_data, REST_Controller::HTTP_NOT_FOUND);
       }
    }
  }

  public function add_card_post(){
    $_POST['user_id'] = $this->customer_id;
    $card =  $this->card_model->add_card($this->security->xss_clean($this->input->post()));
    if($card){
      $response_data = array('status'=> 200, 'message' => "Card added Successfully.Now you can freely invest and savings enjoy it.", "data"=>array());
      $this->response($response_data, REST_Controller::HTTP_OK); 
    }else{
      $response_data = array('status'=> 404, 'message' => 'Something went wrong', "data"=>[]);
      $this->response($response_data, REST_Controller::HTTP_NOT_FOUND); 
    }
  }

  public function delete_card_get($id){
    $card =  $this->card_model->delete_card($id);
    if($card){
      $response_data = array('status'=> 200, 'message' => "Card deleted Successfully.", "data"=>array());
      $this->response($response_data, REST_Controller::HTTP_OK); 
    }else{
      $response_data = array('status'=> 404, 'message' => 'Something went wrong', "data"=>[]);
      $this->response($response_data, REST_Controller::HTTP_NOT_FOUND); 
    }
  }

  public function mycard_get(){
    
    $cards =  $this->card_model->list_card($this->customer_id);
   
    if($cards){
      $response_data = array('status'=> 200, 'message' => "Card List", "data"=>$cards);
      $this->response($response_data, REST_Controller::HTTP_OK); 
    }else if(sizeof($cards) == 0){
      $response_data = array('status'=> 200, 'message' => "There is no cards.", "data"=>$cards);
      $this->response($response_data, REST_Controller::HTTP_OK); 
    }else{
      $response_data = array('status'=> 404, 'message' => 'Something went wrong', "data"=>[]);
      $this->response($response_data, REST_Controller::HTTP_NOT_FOUND); 
    }
  }
  public function home_profile_get(){
    $userData = $this->user_model->getrecord($this->customer_id);
    $data = array(
      'verify_contact_number'=>
      array(
        'label' => 'Verify contact Number',
        'code' => 'verify_contact_number',
        'status' => true
      ),
      'verify_email_address'=>
      array(
        'label' => 'Verify email address',
        'code' => 'verify_email_address',
        'status' => true
      ),
      'verify_nif'=>
      array(
        'label' => 'Verify NIF',
        'code' => 'verify_nif',
        'status' => true
      ),
      'verify_dermalog'=>
      array(
        'label' => 'Verify Dermalog',
        'code' => 'verify_dermalog',
        'status' => true
      ),
      'profile'=> array(
        'id'=> $userData->id,
        'name' => $userData->name,
        'image' => $userData->image,
        'email' => $userData->email,
        'phone' => $userData->phone,
        'image_path' => SHOW_USER_IMAGE_THUMB
      )
    );
    $response_data = array('status'=> 200, 'message' => "", "data"=>$data);
    $this->response($response_data, REST_Controller::HTTP_OK);
  }

  public function notifiction_get(){
    $notificationdata =  $this->notification_model->allRecord($this->customer_id);
    $notification = [];
    if(sizeof($notificationdata)){
      foreach($notificationdata as $line){
        $to_time = strtotime(date('Y-m-d h:i:s'));
        $from_time = strtotime($line->createdAt);
        // $hour= round(abs($to_time - $from_time) / 3600,2);
        // if($hour<24){
        //   $date =$hour." hour ago";
        // }else{
        //   $date = $line->createdAt;
        // }
        $date = time_diff_hours($line->createdAt, date('Y-m-d H:i:s'),true);

        $notification[] = array(
          'title'=>$line->title,
          'message'=>$line->message,
          'date'=>$date,
        );
        
       
      }
    }
   
    if($notification){
      $response_data = array('status'=> 200, 'message' => "Notification List", "data"=>$notification);
      $this->response($response_data, REST_Controller::HTTP_OK); 
    }else if(sizeof($notification) == 0){
      $response_data = array('status'=> 200, 'message' => "There is no notification.", "data"=>$notification);
      $this->response($response_data, REST_Controller::HTTP_OK); 
    }else{
      $response_data = array('status'=> 404, 'message' => 'Something went wrong', "data"=>[]);
      $this->response($response_data, REST_Controller::HTTP_NOT_FOUND); 
    }
  }

  public function history_get(){
    $data =  $this->fund_model->get_fund_history($this->customer_id);
    $response_data = array('status'=> 200, 'message' => "History List", "data"=>$data);
    $this->response($response_data, REST_Controller::HTTP_OK);
  }

  public function cashout_type_get(){
    $data =  $this->cashout_model->list_cashout_type();
    $response_data = array('status'=> 200, 'message' => "cashout type list", "data"=>$data);
    $this->response($response_data, REST_Controller::HTTP_OK);
  }

  public function all_wallet_get(){
    $data =  $this->cashout_model->list_wallet();
    $response_data = array('status'=> 200, 'message' => "Wallet list", "data"=>$data);
    $this->response($response_data, REST_Controller::HTTP_OK);
  }

  public function cashout_post(){    
    if($this->input->post()){
      $_POST['user_id'] = $this->customer_id;
      $_POST['bank_detail']= '';
      if(isset($_POST['bank_id'])){
        $_POST['bank_detail'] = $this->bank_model->bank_detail($this->security->xss_clean($_POST['bank_id']));
      }
       $current_balence = getCurrentBalence($this->customer_id);
      if($_POST['amount']>$current_balence){
        $response_data = array('status'=> 200, 'message' => "Amount is not sufficient", "data"=>'');
        $this->response($response_data, REST_Controller::HTTP_OK);
        return true;
      }
      if(isset($_POST['agent_code'])){
      $_POST['agent_id']=$this->agent_model->checkAgentCode($this->security->xss_clean($_POST));
      if(!$_POST['agent_id']){
        $response_data = array('status'=> 404, 'message' => "Please enter valid agent code", "data"=>'');
        $this->response($response_data, REST_Controller::HTTP_OK);
        return true;
      }
    }
      $data =  $this->cashout_model->addcashout($this->security->xss_clean($this->input->post()));
      $response_data = array('status'=> 200, 'message' => "Cashout successfully", "data"=>'');
      $this->response($response_data, REST_Controller::HTTP_OK);
    }else{
      $response_data = array('status'=> 404, 'message' => 'Something went wrong', "data"=>[]);
      $this->response($response_data, REST_Controller::HTTP_NOT_FOUND); 
    }
  }

  public function refer_app_post(){
    if($this->input->post()){
      $_POST['user_id'] = $this->customer_id;
      $add = $this->referapp_model->add($this->security->xss_clean($this->input->post()));
      $response_data = array('status'=> 200, 'message' => "Your request has been sent successfully", "data"=>'');
      $this->response($response_data, REST_Controller::HTTP_OK);
    }else{
      $response_data = array('status'=> 404, 'message' => 'Something went wrong', "data"=>[]);
      $this->response($response_data, REST_Controller::HTTP_NOT_FOUND); 
    }
  }

  public function investment_plan_rate_get($planId){
    $plan_rate = $this->plan_model->getPaymentDurationByPlanId($planId);
    if($plan_rate){
      $response_data = array('status'=> 200, 'message' => "Plan rate", "data"=>$plan_rate);
      $this->response($response_data, REST_Controller::HTTP_OK);
    }else{
      $response_data = array('status'=> 404, 'message' => 'Something went wrong', "data"=>[]);
      $this->response($response_data, REST_Controller::HTTP_NOT_FOUND); 
    }
  }
  public function loan_plan_rate_get($planId){
    $plan_rate = $this->plan_model->getPaymentDurationByPlanId($planId);
    if($plan_rate){
      $response_data = array('status'=> 200, 'message' => "Plan rate", "data"=>$plan_rate);
      $this->response($response_data, REST_Controller::HTTP_OK);
    }else{
      $response_data = array('status'=> 404, 'message' => 'Something went wrong', "data"=>[]);
      $this->response($response_data, REST_Controller::HTTP_NOT_FOUND); 
    }
  }

  public function edit_bank_post($id){
    $_POST['user_id'] = $this->customer_id;
    if($this->bank_model->editBank($this->security->xss_clean($this->input->post()),$id)){
      $response_data = array('status'=> 200, 'message' => 'Your bank has been updated successfully', "data"=>[]);
      $this->response($response_data, REST_Controller::HTTP_OK);
      return true; 
    }
    $response_data = array('status'=> 404, 'message' => 'Something went wrong', "data"=>[]);
	  $this->response($response_data, REST_Controller::HTTP_NOT_FOUND); 
  }

  public function delete_bank_get($id) {
    if($this->bank_model->deleteBank($id)){
      $response_data = array('status'=> 200, 'message' => 'Your bank has been deleted successfully', "data"=>[]);
      $this->response($response_data, REST_Controller::HTTP_OK);
      return true; 
    }
    $response_data = array('status'=> 404, 'message' => 'Something went wrong', "data"=>[]);
	  $this->response($response_data, REST_Controller::HTTP_NOT_FOUND); 
  }

  public function add_friend_post(){
    $_POST['user_id'] = $this->customer_id;
    if($this->user_model->checkFriends($this->security->xss_clean($_POST))){
      $response_data = array('status'=> 200, 'message' => 'Your request has been already sent', "data"=>[]);
      $this->response($response_data, REST_Controller::HTTP_OK);
      return true; 
    }
    if($this->user_model->addFriend($this->security->xss_clean($this->input->post()))){
      $response_data = array('status'=> 200, 'message' => 'Your request has been sent successfully', "data"=>[]);
      $this->response($response_data, REST_Controller::HTTP_OK);
      return true; 
    }
    $response_data = array('status'=> 404, 'message' => 'Something went wrong', "data"=>[]);
	  $this->response($response_data, REST_Controller::HTTP_NOT_FOUND); 
  }

  public function cash_data_get(){
    $data = $this->plan_model->getrecord(1);
    $response_data = array('status'=> 200, 'message' => '', "data"=>array(
      'plan'=>$data,
      'mybalance'=>array('amount'=>show_number($this->cash_model->get_cash_saving($this->customer_id)))
    ));
    $this->response($response_data, REST_Controller::HTTP_OK);
    return true; 
  }

  public function createcash_post(){
    $_POST['user_id'] = $this->customer_id;
    $_POST['plan_id'] = 1;
    if($insId = $this->cash_model->save_data($this->security->xss_clean($_POST))){
      $this->cash_model->insert_payment_date($insId);
      $data = $this->cash_summary_single($insId);
      $cashDetail = $this->cash_model->getCashDetail($insId);
      saveCashNotification($cashDetail, 'APP');
      $response_data = array('status'=> 200, 'message' => 'Your cash plan has been purchased successfully', "data"=>$data);
      $this->response($response_data, REST_Controller::HTTP_OK);
      return true; 
    }
  }

  public function cash_summary_single($cash_id){
    $line = $this->cash_model->get_one_list_forapp($cash_id, $this->customer_id);    
    $comes = comes_from(isset($line->amount_comes_from_id)?$line->amount_comes_from_id:'');
    $next_payment_date = next_cash_payment_date($line->id);
    $all_payment_date =  all_cash_payment_date($line->id);
    $all_data = array(
      'id'=>$line->id,
      'plan_id'=>$line->plan_id,
      'amount'=>show_number($line->amount),
      'start_date'=>$line->start_date,
      'end_date'=>$line->end_date,
      'interest_rate'=>$line->interest_rate,
      'plan_id'=>$line->id,
      'payment_type_id'=>$line->payment_type_id,
      'payment_duration_id'=>$line->payment_duration_id,
      'payment_type'=> ($line->payment_type_data!="null")?JSON_DECODE($line->payment_type_data)->label:'',
      'payment_duration'=> ($line->payment_deuration_data!="null")?JSON_DECODE($line->payment_deuration_data)->label:'',
      'comes_from'=>isset($comes)? $comes->name: '',
      'next_payment_date'=> isset($next_payment_date)?$next_payment_date->payment_date:'',
      'next_payment_amount'=>show_number($line->amount),
      'all_payment_date'=>$all_payment_date,
      'mybalence'=>"".getCurrentBalence($this->customer_id),
      'next_payment_status'=>'Pending'
    );
      return $all_data;
    
  }

  public function cash_summary_get($cash_id){
    $all_data = $this->cash_summary_single($cash_id);
    $response_data = array('status'=> 200, 'message' => '', "data"=>$all_data);
	  $this->response($response_data, REST_Controller::HTTP_OK);
  }

  public function cash_list_get(){
    $all_list = $this->cash_model->get_all_list_forapp( $this->customer_id);
    $all_data = [];
    if(sizeof($all_list)){
      foreach($all_list as $line){
        $comes = comes_from($line->amount_comes_from_id);
        $all_data[] = array(
          'id'=>$line->id,
          'plan_id'=>$line->id,
          'amount'=>show_number($line->amount),
          'start_date'=>$line->start_date,
          'end_date'=>$line->end_date,
          'interest_rate'=>$line->interest_rate,
          'plan_id'=>$line->id,
          'payment_type_id'=>$line->payment_type_id,
          'payment_duration_id'=>$line->payment_duration_id,
          'payment_type'=> ($line->payment_type_data!="null")?JSON_DECODE($line->payment_type_data)->label:'',
          'payment_duration'=> ($line->payment_deuration_data!="null")?JSON_DECODE($line->payment_deuration_data)->label:'',
          'comes_from'=>$comes? $comes->name: '',
          'status'=>$line->status
        );
      }
    }
    $response_data = array('status'=> 200, 'message' => '', "data"=>$all_data);
	  $this->response($response_data, REST_Controller::HTTP_OK);
  }
  public function interest_earned_get(){
    $datas = $this->interest_model->get_interest_earned_data($this->customer_id);
    $data = array();
    foreach($datas as $line){
      $line->sign ="+";
      if($line->module =="LOAN"){
        $line->sign ="-";
      }
      $data[] = $line;
    }
    $total_interest = show_number(get_total_interest($this->customer_id));
    $response_data = array('status'=> 200, 'message' => '', "data"=>$data, 'total_interest'=>show_number($total_interest));
    $this->response($response_data, REST_Controller::HTTP_OK);
    return true; 
  }

  public function tofa_post(){
    $_POST['user_id'] = $this->customer_id;
    $tofa = $_POST['tofa'];
    $st = "disabled";
    if($tofa){
      $st = "enabled";
    }
    if($this->home_model->update_tofa($this->security->xss_clean($_POST))){     
      $response_data = array('status'=> 200, 'message' => '2FA has been '.$st.' successfully', "data"=>[]);
      $this->response($response_data, REST_Controller::HTTP_OK);
      return true; 
    }
  }

  public function verify_tofa_otp_post(){
    $user_id = $this->customer_id;
    $otp = $_POST['otp'] ;
    $user = $this->user_model->getrecord($this->customer_id);
    if($user->tofaotp == $otp){
      update_table_data($user_id, array('tofaotp'=>''), TBL_USER);
      $response_data = array('status'=> 200, 'message' => 'Your otp has been verified', "data"=>[]);
      $this->response($response_data, REST_Controller::HTTP_OK);
    }else{
      $response_data = array('status'=> 404, 'message' => 'Please enter valid otp', "data"=>[]);
	    $this->response($response_data, REST_Controller::HTTP_NOT_FOUND); 
    }

  }
  function account_report_get(){
    $data = array('description'=>ACCOUNT_REPORT_TITLE, 'url'=> base_url('user/index/makefundhistoryPdf/'.$this->customer_id)); 
    $response_data = array('status'=> 200, 'message' => '', "data"=>$data);
    $this->response($response_data, REST_Controller::HTTP_OK);
  }

  function deposite_cash_payment_post(){
    $id = $this->security->xss_clean($_POST['all_payment_date_id']);
    $cash_payment_date_id =  $id;
    $cash_payment_date_detail = $this->cash_model->cash_payment_date_detail($cash_payment_date_id);
    if(!$cash_payment_date_detail){
      $response_data = array('status'=> 404, 'message' => 'Some thing went wrong', "data"=>[]);
	    $this->response($response_data, REST_Controller::HTTP_NOT_FOUND);
      return true;
    }
    $cash_detail = $this->cash_model->getCashDetail($cash_payment_date_detail->cash_id);
    $inpid = $this->cash_model->updateFundHistory($cash_detail, $cash_payment_date_id,  $cash_payment_date_detail->payment_date);
    $response_data = array('status'=> 200, 'message' => 'Your amount has been deposited successfully', "data"=>[]);
    $this->response($response_data, REST_Controller::HTTP_OK);
  
  }

  function move_cash_to_wallet_post(){
    $cash_payment_id = $this->security->xss_clean($_POST['cash_payment_id']);
    $all_payment_date_id = $this->security->xss_clean($_POST['all_payment_date_id']);
    $pdetail = $this->cash_model->get_cash_payment_detail($cash_payment_id);
    $this->cash_model->insert_fund_history($pdetail);
    $this->cash_model->update_cash_payment($cash_payment_id);
    $response_data = array('status'=> 200, 'message' => 'Your amount move to wallet successfully', "data"=>[]);
    $this->response($response_data, REST_Controller::HTTP_OK);
  }

  function deposite_investment_payment_post(){
    $investment_date_id =  $this->security->xss_clean($this->input->post('all_payment_date_id'));
    $investment_payment_date_detail = $this->investment_model->investment_payment_date_detail($investment_date_id);
    if(!$investment_payment_date_detail){
      $response_data = array('status'=> 404, 'message' => 'Some thing went wrong', "data"=>[]);
	    $this->response($response_data, REST_Controller::HTTP_NOT_FOUND);
      return true;
    }
    $investment_detail = $this->investment_model->getRecord($investment_payment_date_detail->investment_id);
    $inpid= $this->investment_model->updateFundHistory($investment_detail, $investment_date_id,  $investment_payment_date_detail->payment_date);
    $response_data = array('status'=> 200, 'message' => 'Your amount has been deposited successfully', "data"=>[]);
    $this->response($response_data, REST_Controller::HTTP_OK);  
  }

  function move_investment_to_wallet_post(){
    $invest_payment_id = $this->security->xss_clean($_POST['invest_payment_id']);
    $all_payment_date_id = $this->security->xss_clean($_POST['all_payment_date_id']);
    $pdetail = $this->investment_model->get_investment_payment_detail($invest_payment_id);
    $this->investment_model->insertInterestinfund($pdetail);
    $this->investment_model->update_investment_payment($invest_payment_id);
    $response_data = array('status'=> 200, 'message' => 'Your amount move to wallet successfully', "data"=>[]);
    $this->response($response_data, REST_Controller::HTTP_OK);
  }

  public function deposite_loan_payment_post(){
    $loan_payment_date_id = $this->security->xss_clean($_POST['all_payment_date_id']);
    $loan_payment_detail = $this->loan_model->loan_payment_date_detail($loan_payment_date_id);
    $loanDetail =  $this->loan_model->getRecord($loan_payment_detail->loan_id);
    $this->loan_model->deduct_loan_install_ammount_with_interest($loanDetail,$loan_payment_date_id, $loan_payment_detail->payment_date);
    $response_data = array('status'=> 200, 'message' => 'Your amount has been deposited successfully', "data"=>[]);
    $this->response($response_data, REST_Controller::HTTP_OK);
  }
    
}
?>
