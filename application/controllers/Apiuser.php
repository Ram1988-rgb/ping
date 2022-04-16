<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 
ini_set('serialize_precision',-1);
require APPPATH . 'libraries/REST_Controller.php';
class Apiuser extends REST_Controller {
    
    function __construct() {
          parent::__construct();
          $this->load->model('user_model');
          $this->load->model('userpin_model');
          $this->load->model('investment_model');
          $this->load->model('cash_model');
          $this->load->model('loan_model');
       }
    
 /**
  * @access public
  * 
  */   
 public function signup_post()
  {	   
		$data = $this->input->post();		
		if($this->user_model->checkUser($this->input->post())){
			$response_data = array('status'=> 401, 'message' => 'User Already exist.Please choose another email');
			$this->response($response_data, REST_Controller::HTTP_UNAUTHORIZED); 
			return true;
		}
		if($this->user_model->checkPhone($this->input->post())){
			$response_data = array('status'=> 401, 'message' => 'This phone no Already exist.Please choose phone no.');
			$this->response($response_data, REST_Controller::HTTP_UNAUTHORIZED); 
			return true;
		}
		
		if($this->user_model->addUser($this->input->post())){
			$response_data = array('status'=> 200, 'message' => 'User successfully created');
			$this->response($response_data, REST_Controller::HTTP_OK);
			return true;
		}else{
			$response_data = array('status'=> 401, 'message' => 'Something went wrong');
			$this->response($response_data, REST_Controller::HTTP_UNAUTHORIZED); 
			return true;
		}
}

public function signin_post()
{	   	
	$email = $this->security->xss_clean($this->input->post('email'));
	$phone = $this->security->xss_clean($this->input->post('phone'));
	$password = $this->security->xss_clean($this->input->post('password'));
	if(!isset($_POST['device_id'])){
		$_POST['device_id'] = '';	
	}
	if(!isset($_POST['device_type'])){
		$_POST['device_type'] = '';	
	}
	$this->db->select(array('id','tofa', 'name', 'email', 'phone', 'image', 'address', 'password'));
	$this->db->where("email", $email);
	$this->db->or_where("phone", $phone);
	$this->db->where("status", '1');
	$this->db->where("deletedAt", '0');
	$query = $this->db->get(TBL_USER);
	if ($query->num_rows() > 0) {
		foreach ($query->result() as $rows) {
			if (md5($password) == $rows->password) {
				$this->insert_device($rows->id,$this->security->xss_clean($_POST));
				$token = createJWTToken($rows); 
				$rows->tofaotp = '';
				if($rows->tofa){
					$pass= rand(100000, 999999);
					$rows->tofaotp = "".$pass;
					$this->user_model->generate_to_fa_password($rows, $pass);
				}
				//$this->sendSignInNotification($rows->id);
				//$detail =$this->get_profile_data($rows->id);
				$response_data = array('status'=> 200,"data" => $rows, 'message' => 'User login successfully', 'token'=>$token);
				$this->response($response_data, REST_Controller::HTTP_OK);
				return true;
			}else{
				$response_data = array('status'=> 401, 'message' => 'Please enter correct password');
				$this->response($response_data, REST_Controller::HTTP_UNAUTHORIZED);
				return true;
			}
		}
	}else{
		$response_data = array('status'=> 401, 'message' => 'Please enter correct email or phone no.');
		$this->response($response_data, REST_Controller::HTTP_UNAUTHORIZED);
		return true;
	}		
}

public function sendSignInNotification($user_id){
	$data = array(
		'title'=>NOTIFICATION['customer']['signin']['title'],
		'message'=>NOTIFICATION['customer']['signin']['message'],
	);
	send_notification($user_id, $data);
}

public function insert_device($user_id, $post){
	$this->db->where('user_id',$user_id);
	$this->db->where('device_id',$post['device_id']);
	$this->db->where('device_type',$post['device_type']);
	$this->db->from(TBL_USER_DEVICE);
	$query = $this->db->get();
	if ($query->num_rows() == 0) {
		$ins['user_id'] = $user_id;
		$ins['device_id'] = $post['device_id'];
		$ins['device_type'] = $post['device_type'];
		$this->db->insert(TBL_USER_DEVICE,$ins);
	}
	return true;
}

 public function forgotpassword_post(){
		$this->db->where("email", $this->security->xss_clean($this->input->post('email')));
		$this->db->where("status", '1');
		$this->db->where("deletedAt", '0');
        $query = $this->db->get(TBL_USER);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $line) {
                $uid = $line->id;
                $possible = '012dfds3456789bcdfghjkmnpq454rstvwx54yzABCDEFG5HIJ5L45MNOP352QRSTU5VW5Y5Z';
				$code = random_int(100000, 999999);
				$to = $line->email;
				$data = array(
					'code'=>$code, 
					'email_id' => $to, 
					'user_id'=>$line->id, 
					'password'=>md5($this->input->post('password'))
				);
				$this->userpin_model->addUserpin($data);
               
				$to = $line->email;
                $subject = "Forget Password";
                $from = $line->email;
                $message = 'Hi '. $line->name . ' your new pin is ' . $code;                
                @mail($to, $subject, "$message\r\n", "From: $from\n" . "MIME-Version: 1.0\n" . "Content-type:text/html;charset=iso-8859-1" . "\r\n" . 'X-Mailer: PHP/' . phpversion());
                $response_data = array('status'=> 200, 'data' => $code, 'message' => 'New pin send on register emailid, please check');
				$this->response($response_data, REST_Controller::HTTP_OK);
				return true;
		}
	}else{
		$response_data = array('status'=> 401, 'message' => 'User email id not exist.Please choose register email');
		$this->response($response_data, REST_Controller::HTTP_UNAUTHORIZED);
		return true;
	}
}

public function verify_code_post(){
		$this->db->where("code", $this->security->xss_clean($this->input->post('code')));
		$this->db->where("email_id", $this->security->xss_clean($this->input->post('email')));
		$this->db->where("used", '0');
		$this->db->order_by('id','desc');
		$this->db->limit(1);
        $query = $this->db->get(TBL_USERPIN);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $line) {
				update_table_data($line->user_id,array('password'=>$line->password), TBL_USER);
                $uid = $line->id;
                $this->db->where('id', $uid);
                $this->db->update(TBL_USERPIN, array('used'=>"1"));
				
				$response_data = array('status'=> 200, 'message' => 'Pin verify successfully, please proceed next.');
				$this->response($response_data, REST_Controller::HTTP_OK);
				return true;
		}
	}else{
		$response_data = array('status'=> 401, 'message' => 'Wrong pin code, please enter correct pin.');
		$this->response($response_data, REST_Controller::HTTP_UNAUTHORIZED);
		return true;
	}
}

public function change_password_post(){
		$this->db->where("email", $this->security->xss_clean($this->input->post('email')));
		$this->db->where("status", '1');
		$this->db->where("deletedAt", '0');
        $query = $this->db->get(TBL_USER);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $line) {
                $uid = $line->id;
                 $updatedata = array(
                    'password' => md5($this->input->post('password'))
                );
                $this->db->where('id', $uid);
                $this->db->update(TBL_USER, $updatedata);
                
				$response_data = array('status'=> 200, 'message' => 'User password updated successfully.');
				$this->response($response_data, REST_Controller::HTTP_OK);
				return true;
		}
	}else{
		$response_data = array('status'=> 401, 'message' => 'User not register, please check');
		$this->response($response_data, REST_Controller::HTTP_UNAUTHORIZED);
		return true;
	}
}

public function updateprofile_post()
  {	  
	try { 
		$data = $this->input->post();
		$_POST['type']= 'home';	
		$image ='';
		if(isset($_FILES['image']['name'])){
			$image = uploadImage(
			  'image',
			  $_FILES,
			  UPLOAD_USER_IMAGE_ORIGINAL,
			  UPLOAD_USER_IMAGE_THUMB,
			  THUMB_WIDTH,
			  THUMB_HEIGHT
			);
			if(!$image['status']){
				$response_data = array('status'=> 401, 'message' => $image['message']);
				$this->response($response_data, REST_Controller::HTTP_UNAUTHORIZED);
				return true;
			}
			$image = $image['message'];
		  }	
		$_POST['image']= $image;	
		if($this->user_model->checkUser($this->security->xss_clean($this->input->post()),$this->security->xss_clean($_POST['user_id']))){
			$response_data = array('status'=> 401, 'message' => 'User Already exist.Please choose another email');
			$this->response($response_data, REST_Controller::HTTP_UNAUTHORIZED);
			return true;
		}
		if($this->user_model->checkPhone($this->security->xss_clean($this->input->post()),$this->security->xss_clean($_POST['user_id']))){
			$response_data = array('status'=> 401, 'message' => 'This phone no Already exist.Please choose another email');
			$this->response($response_data, REST_Controller::HTTP_UNAUTHORIZED);
			return true;
		}
		if($this->user_model->editUser($this->security->xss_clean($this->input->post()),$this->security->xss_clean($_POST['user_id']))){
			sendNotificationEditProfile(array('user_id'=>$this->security->xss_clean($_POST['user_id'])),'APP');
			$response_data = array('status'=> 200, 'message' => 'User profile updated successfully');
			$this->response($response_data, REST_Controller::HTTP_OK);
			return true;
		}else{
			$response_data = array('status'=> 401, 'message' => 'Something went wrong');
			$this->response($response_data, REST_Controller::HTTP_UNAUTHORIZED);
			return true;
		}
	}catch(Exception $e){
		$response_data = array('status'=> 401, 'message' => $e->getMessage());
		$this->response($response_data, REST_Controller::HTTP_UNAUTHORIZED);
		return true;
		//echo 'Message: ' .$e->getMessage();
	}
  }

  public function get_profile_data($user_id){
	$user_detail = $this->user_model->getrecord($user_id);
	$user_detail->current_balance = show_number(getCurrentBalence($user_id));
	$user_detail->total_investment = show_number($this->investment_model->get_investment_saving($user_id));
	$user_detail->total_savings = show_number($this->cash_model->get_cash_saving($user_id)); 
	return $response_data = array(		
		'data' => $user_detail,		
		'imagepath'=>array(
			'original'=>SHOW_USER_IMAGE_ORIGINAL,
			'thumb'=>SHOW_USER_IMAGE_THUMB
			)			
		);
  }

  public function getprofile_post(){
	  $user_id = $this->security->xss_clean($this->input->post('user_id'));
	  $user_detail = $this->user_model->getrecord($user_id);
	  $user_detail->current_balance = "".getCurrentBalence($user_id);
	  $user_detail->total_investment = $this->investment_model->get_investment_saving($user_id);
	  $user_detail->total_savings = $this->cash_model->get_cash_saving($user_id); 
	  if(!$user_detail){
		$response_data = array('status'=> 401, 'data' => array(), 'message' => 'Please send correct userId');
		$this->response($response_data, REST_Controller::HTTP_OK);
		return true;
	  }
	  unset($user_detail->password);
	  
	  if($user_detail){
		$response_data = array(
			'status'=> 200,
			'data' => $user_detail,
			'message' => '',
			'imagepath'=>array(
				'original'=>SHOW_USER_IMAGE_ORIGINAL,
				'thumb'=>SHOW_USER_IMAGE_THUMB
				)			
			);
		$this->response($response_data, REST_Controller::HTTP_OK);
		return true;
	  }


  }

  public function global_varriable_get(){
	$this->db->from(TBL_AMOUNT_COMES_FROM);
	$this->db->order_by('sequence','ASC');
	$query = $this->db->get();
	$data = array(
		'currency'=> CURRENCY,
		'amount_comes_from'=>$query->result()
	);
	 $response_data = array('status'=> 200, 'message' => '', "data"=>$data);
	$this->response($response_data, REST_Controller::HTTP_OK);
	return true;
   }
  
 //End of class    
}


