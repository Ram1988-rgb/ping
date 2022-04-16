<?php 
function send($device_token,$data)
{
  //$device_token = $this->request->getVar("device_token");

  return $this->sendNotification($device_token, array(
      "title" => $data['title'],
      "body" => $data['message']
  ));
}

// function sendNotification($device_token, $message)
// {
//     $SERVER_API_KEY = SERVER_API_KEY;

//     // payload data, it will vary according to requirement
//     $data = [
//         "to" => $device_token, // for single device id
//         "data" => $message
//     ];
//     $dataString = json_encode($data);

//     $headers = [
//         'Authorization: key=' . $SERVER_API_KEY,
//         'Content-Type: application/json',
//     ];

//     $ch = curl_init();
  
//     curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
//     curl_setopt($ch, CURLOPT_POST, true);
//     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
            
//     $response = curl_exec($ch);
  
//     curl_close($ch);
  
//     return $response;
// }

function get_token($user_id, $device_type){
	$ci=& get_instance();
    $ci->db->where('device_type',$device_type);
    $ci->db->where('user_id',$user_id);
    $ci->db->from(TBL_USER_DEVICE);
    $query = $ci->db->get();
    if($query->num_rows()){
        $data = $query->result();
		$token = array();
		foreach($data as $line){
			$token[] = $line->device_id;
		}
		return $token;
    }
    return array();
}
function send_notification_old($user_id, $data){
	$fcmUrl = 'https://fcm.googleapis.com/fcm/send';
 	$token=['235zgagasd634sdgds46436'];
	 $token = get_token($user_id,'android');
	
	 if(!sizeOf($token)){
		 return true;
	 }

    $notification = [
            'title' =>$data['title'],
            'body' => $data['message'],
            'icon' =>'myIcon', 
            'sound' => 'mySound'
        ];
        $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

        $fcmNotification = [
            'registration_ids' => $token, //multple token array
            // 'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];
		

        $headers = [
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);

		//echo  json_encode($fcmNotification);
        //echo $result;die;
}
function send_notification($user_id, $data){
	$fcmUrl = 'https://fcm.googleapis.com/fcm/send';
	 $token = get_token($user_id,'android');
	 $iostoken = get_token($user_id,'ios');
	 if(!sizeOf($token)){
		 return true;
	 }
	
    $notification = [
            'title' =>$data['title'],
            'body' => $data['message'],
            'icon' =>'myIcon', 
            'sound' => 'mySound'
        ];
        $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

        $fcmNotification = [
            'registration_ids' => $token, //multple token array
            // 'to'        => $token, //single token
            //'notification' => $notification,
            'data' => $notification
        ];
        
        $iosfcmNotification = [
            'registration_ids' => $iostoken,  //multple token array
            // 'to'        => $token, //single token
            'notification' => $notification,
            //'data' => $notification
        ];
		

        $headers = [
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        ];

		if(sizeOf($token)){
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$fcmUrl);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
			$result = curl_exec($ch);
			curl_close($ch);
        
		}
		
		if(sizeOf($iostoken)){
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$fcmUrl);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($iosfcmNotification));
			$result = curl_exec($ch);
			curl_close($ch);
        
		}

		//echo  json_encode($fcmNotification);
        //echo $result;die;
}
//cash
function saveCashNotification($detail, $typeuser='APP'){
	$not_msg = NOTIFICATION['savecash']['message'];
	$amount = show_number($detail->amount);
	$plan_name = JSON_DECODE($detail->plan_data)->name;
	$payment_Type = JSON_DECODE($detail->payment_type_data)->label;
	$not_msg = str_replace('{PLANNAME}', $plan_name, $not_msg);
	$not_msg = str_replace('{CURRENCY}', CURRENCY, $not_msg);
	$not_msg = str_replace('{PAYMENTTYPE}', $payment_Type, $not_msg);
	$not_msg = str_replace('{AMOUNT}', $amount, $not_msg);

	$ins = array(
		'title'=>NOTIFICATION['savecash']['title'],
		'type_of_user' => $typeuser,
		'user_id' => $detail->user_id,
		'module' => 'cash',
		'message' => $not_msg,
		'data'=> JSON_ENCODE($detail)
	);   
	$ci=& get_instance();
	$da= $ci->notification_model->saveData($ins);  
	send_notification($detail->user_id,$ins);
	return $da;
     
}

function statusCashNotification($detail, $typeuser='APP'){
	$not_msg = NOTIFICATION['statuscash']['message'];
    $status ='Deactivated';
    if($detail->status == 1){
        $status ='Activated';
    }
	$amount = show_number($detail->amount);
	$plan_name = JSON_DECODE($detail->plan_data)->name;
	$payment_Type = JSON_DECODE($detail->payment_type_data)->label;
	$not_msg = str_replace('{PLANNAME}', $plan_name, $not_msg);
	$not_msg = str_replace('{CURRENCY}', CURRENCY, $not_msg);
	$not_msg = str_replace('{PAYMENTTYPE}', $payment_Type, $not_msg);
	$not_msg = str_replace('{AMOUNT}', $amount, $not_msg);
	$not_msg = str_replace('{STATUS}', $status, $not_msg);

	$ins = array(
		'title'=>NOTIFICATION['statuscash']['title'],
		'type_of_user' => $typeuser,
		'user_id' => $detail->user_id,
		'module' => 'cash',
		'message' => $not_msg,
		'data'=> JSON_ENCODE($detail)
	);   
	$ci=& get_instance();
	return $ci->notification_model->saveData($ins);
	//echo $ci->db->last_query();  
     
}

function saveFundNotification($detail, $typeuser='APP'){
	$not_msg = NOTIFICATION['addfund']['message'];
	$amount = show_number($detail->amount);	
	$not_msg = str_replace('{FUNDTYPE}', $detail->name, $not_msg);
	$not_msg = str_replace('{CURRENCY}', CURRENCY, $not_msg);	
	$not_msg = str_replace('{AMOUNT}', $amount, $not_msg);

	$ins = array(
		'title'=>NOTIFICATION['addfund']['title'],
		'type_of_user' => $typeuser,
		'user_id' => $detail->user_id,
		'module' => 'fund',
		'submodule' => $detail->name,
		'message' => $not_msg,
		'data'=> JSON_ENCODE($detail)
	);   
	$ci=& get_instance();
	$da = $ci->notification_model->saveData($ins);
	send_notification($ins['user_id'],$ins);
	return $da;
}

function statusfundNotification($detail, $typeuser='APP'){
	$not_msg = NOTIFICATION['statusfund']['message'];
	$amount = show_number($detail->amount);	
	$status ='Deactivated';
    if($detail->status == 1){
        $status ='Activated';
    }
	$not_msg = str_replace('{FUNDTYPE}', $detail->name, $not_msg);
	$not_msg = str_replace('{CURRENCY}', CURRENCY, $not_msg);	
	$not_msg = str_replace('{AMOUNT}', $amount, $not_msg);
	$not_msg = str_replace('{STATUS}', $status, $not_msg);

	$ins = array(
		'title'=>NOTIFICATION['statusfund']['title'],
		'type_of_user' => $typeuser,
		'user_id' => $detail->user_id,
		'module' => 'fund',
		'submodule' => $detail->name,
		'message' => $not_msg,
		'data'=> JSON_ENCODE($detail)
	);   
	$ci=& get_instance();
	$da = $ci->notification_model->saveData($ins);
	send_notification($ins['user_id'],$ins);
	return $da;
}

function saveLoanNotification($detail, $typeuser='APP') {
	$not_msg = NOTIFICATION['createloan']['message'];
	$amount = show_number($detail->amount);	
	$plan_name = JSON_DECODE($detail->plan_data)->name;
	$payment_Type ='';
	if($detail->payment_deuration_data != 'null'){
		$payment_Type = JSON_DECODE($detail->payment_deuration_data)->label;
	}
	$not_msg = str_replace('{LOANPLAN}', $plan_name, $not_msg);
	$not_msg = str_replace('{CURRENCY}', CURRENCY, $not_msg);	
	$not_msg = str_replace('{AMOUNT}', $amount, $not_msg);
	$not_msg = str_replace('{LOANDURATION}', $payment_Type, $not_msg);

	$ins = array(
		'title'=>NOTIFICATION['createloan']['title'],
		'type_of_user' => $typeuser,
		'user_id' => $detail->user_id,
		'module' => 'loan',
		'submodule' => $detail->name,
		'message' => $not_msg,
		'data'=> JSON_ENCODE($detail)
	);   
	$ci=& get_instance();
	$da = $ci->notification_model->saveData($ins);
	send_notification($ins['user_id'],$ins);
	return $da;
}

function statusLoanNotification($detail, $typeuser='APP'){
	$not_msg = NOTIFICATION['loanstatus']['message'];
    $status ='Deactivated';
    if($detail->status == 1){
        $status ='Activated';
    }
	//print_r($detail);die;
	$amount = show_number($detail->amount);
	$plan_name = JSON_DECODE($detail->plan_data)->name;
	$payment_Type = JSON_DECODE($detail->payment_deuration_data)->label;
	$not_msg = str_replace('{LOANPLAN}', $plan_name, $not_msg);
	$not_msg = str_replace('{CURRECNY}', CURRENCY, $not_msg);	
	$not_msg = str_replace('{AMOUNT}', $amount, $not_msg);
	$not_msg = str_replace('{STATUS}', $status, $not_msg);
	$not_msg = str_replace('{LOANDURATION}', $payment_Type, $not_msg);

	$ins = array(
		'title'=>NOTIFICATION['loanstatus']['title'],
		'type_of_user' => $typeuser,
		'user_id' => $detail->user_id,
		'module' => 'loan',
		'message' => $not_msg,
		'data'=> JSON_ENCODE($detail)
	);
	$da =  saveData($ins);
	send_notification($ins['user_id'],$ins);
	return $da;
	//echo $ci->db->last_query();  
     
}



function sendCashInterestNotification($detail, $typeuser='APP'){
	$not_msg = NOTIFICATION['cashinterest']['message'];
	
	$not_msg = str_replace('{AMOUNT}', show_number($detail['amount']), $not_msg);
	$not_msg = str_replace('{CURRENCY}', CURRENCY, $not_msg);
	$ins = array(
		'title'=>NOTIFICATION['cashinterest']['title'],
		'type_of_user' => $typeuser,
		'user_id' => $detail['user_id'],
		'module' => 'cash',
		'submodule' => '',
		'message' => $not_msg,
		'data'=> JSON_ENCODE($detail)
	); 
	$da = saveData($ins);
	send_notification($detail['user_id'],$ins);
	return $da;
}
function sendCashPaidNotification($detail, $typeuser='APP'){
	$not_msg = NOTIFICATION['cashpaid']['message'];
	
	$not_msg = str_replace('{AMOUNT}', show_number($detail['amount']), $not_msg);
	$not_msg = str_replace('{CURRENCY}', CURRENCY, $not_msg);
	$ins = array(
		'title'=>NOTIFICATION['cashpaid']['title'],
		'type_of_user' => $typeuser,
		'user_id' => $detail['user_id'],
		'module' => 'cash',
		'submodule' => '',
		'message' => $not_msg,
		'data'=> JSON_ENCODE($detail)
	); 
	$da = saveData($ins);
	send_notification($ins['user_id'],$ins);
	return $da;
}

//Interest
function saveInvestmentNotification($detail, $typeuser='APP'){
	$not_msg = NOTIFICATION['saveinvestment']['message'];
	$amount = show_number($detail->amount);
	$plan_name = JSON_DECODE($detail->plan_data)->name;
	$payment_Type = JSON_DECODE($detail->payment_type_data)->label;
	$not_msg = str_replace('{PLANNAME}', $plan_name, $not_msg);
	$not_msg = str_replace('{CURRENCY}', CURRENCY, $not_msg);
	$not_msg = str_replace('{PAYMENTTYPE}', $payment_Type, $not_msg);
	$not_msg = str_replace('{AMOUNT}', $amount, $not_msg);

	$ins = array(
		'title'=>NOTIFICATION['saveinvestment']['title'],
		'type_of_user' => $typeuser,
		'user_id' => $detail->user_id,
		'module' => 'interest',
		'message' => $not_msg,
		'data'=> JSON_ENCODE($detail)
	); 
	$da = saveData($ins);
	send_notification($ins['user_id'],$ins);
	return $da;
	//echo $ci->db->last_query();  
     
}

function statusInvestmentNotification($detail, $typeuser='APP'){
	$not_msg = NOTIFICATION['statusinvestment']['message'];
    $status ='Deactivated';
    if($detail->status == 1){
        $status ='Activated';
    }
	$amount = show_number($detail->amount);
	$plan_name = JSON_DECODE($detail->plan_data)->name;
	$payment_Type = JSON_DECODE($detail->payment_type_data)->label;
	$not_msg = str_replace('{PLANNAME}', $plan_name, $not_msg);
	$not_msg = str_replace('{CURRENCY}', CURRENCY, $not_msg);
	$not_msg = str_replace('{PAYMENTTYPE}', $payment_Type, $not_msg);
	$not_msg = str_replace('{AMOUNT}', $amount, $not_msg);
	$not_msg = str_replace('{STATUS}', $status, $not_msg);

	$ins = array(
		'title'=>NOTIFICATION['statusinvestment']['title'],
		'type_of_user' => $typeuser,
		'user_id' => $detail->user_id,
		'module' => 'interest',
		'message' => $not_msg,
		'data'=> JSON_ENCODE($detail)
	);   
	$da = saveData($ins);
	send_notification($ins['user_id'],$ins);
	return $da;
	//echo $ci->db->last_query();  
     
}

function sendInvestmentInterestNotification($detail, $typeuser='APP'){
	$not_msg = NOTIFICATION['investmentinterest']['message'];
	
	$not_msg = str_replace('{AMOUNT}', show_number($detail['amount']), $not_msg);
	$not_msg = str_replace('{CURRENCY}', CURRENCY, $not_msg);
	$ins = array(
		'title'=>NOTIFICATION['investmentinterest']['title'],
		'type_of_user' => $typeuser,
		'user_id' => $detail['user_id'],
		'module' => 'cash',
		'submodule' => '',
		'message' => $not_msg,
		'data'=> JSON_ENCODE($detail)
	); 
	$da =  saveData($ins);
	send_notification($ins['user_id'],$ins);
	return $da;
}

function sendInvestmentMatureNotification($detail, $typeuser='APP'){
	$not_msg = NOTIFICATION['investmentmatured']['message'];
	
	$not_msg = str_replace('{AMOUNT}', show_number($detail['amount']), $not_msg);
	$not_msg = str_replace('{CURRENCY}', CURRENCY, $not_msg);
	$ins = array(
		'title'=>NOTIFICATION['investmentmatured']['title'],
		'type_of_user' => $typeuser,
		'user_id' => $detail['user_id'],
		'module' => 'Investment',
		'submodule' => '',
		'message' => $not_msg,
		'data'=> JSON_ENCODE($detail)
	); 
	$da =  saveData($ins);
	send_notification($ins['user_id'],$ins);
	return $da;
}

function sendInvestmentPaidNotification($detail, $typeuser='APP'){
	$not_msg = NOTIFICATION['investmentpaid']['message'];
	
	$not_msg = str_replace('{AMOUNT}', show_number($detail['amount']), $not_msg);
	$not_msg = str_replace('{CURRENCY}', CURRENCY, $not_msg);
	$ins = array(
		'title'=>NOTIFICATION['investmentpaid']['title'],
		'type_of_user' => $typeuser,
		'user_id' => $detail['user_id'],
		'module' => 'cash',
		'submodule' => '',
		'message' => $not_msg,
		'data'=> JSON_ENCODE($detail)
	); 
	$da = saveData($ins);
	send_notification($ins['user_id'],$ins);
	return $da;
}

function sendLoanInterestNotification($detail, $typeuser='APP'){
	$not_msg = NOTIFICATION['loaninterest']['message'];
	
	$not_msg = str_replace('{AMOUNT}', show_number($detail['amount']), $not_msg);
	$not_msg = str_replace('{CURRENCY}', CURRENCY, $not_msg);
	$ins = array(
		'title'=>NOTIFICATION['loaninterest']['title'],
		'type_of_user' => $typeuser,
		'user_id' => $detail['user_id'],
		'module' => 'loan',
		'submodule' => '',
		'message' => $not_msg,
		'data'=> JSON_ENCODE($detail)
	); 
	$da = saveData($ins);
	send_notification($ins['user_id'],$ins);
	return $da;
}
function sendLoanPaidNotification($detail, $typeuser='APP'){
	$not_msg = NOTIFICATION['loanpaid']['message'];
	
	$not_msg = str_replace('{AMOUNT}', show_number($detail['amount']), $not_msg);
	$not_msg = str_replace('{CURRENCY}', CURRENCY, $not_msg);
	$ins = array(
		'title'=>NOTIFICATION['loanpaid']['title'],
		'type_of_user' => $typeuser,
		'user_id' => $detail['user_id'],
		'module' => 'loan',
		'submodule' => '',
		'message' => $not_msg,
		'data'=> JSON_ENCODE($detail)
	); 
	$da = saveData($ins);
	send_notification($ins['user_id'],$ins);
	return $da;
}

function sendCashoutNotification($detail, $typeuser='APP'){
	$not_msg = NOTIFICATION['cashoutpaid']['message'];
	
	$not_msg = str_replace('{AMOUNT}', show_number($detail['amount']), $not_msg);
	$not_msg = str_replace('{CURRENCY}', CURRENCY, $not_msg);
	$ins = array(
		'title'=>NOTIFICATION['cashoutpaid']['title'],
		'type_of_user' => $typeuser,
		'user_id' => $detail['user_id'],
		'module' => 'cashout',
		'submodule' => '',
		'message' => $not_msg,
		'data'=> JSON_ENCODE($detail)
	); 
	$da = saveData($ins);
	send_notification($ins['user_id'],$ins);
	return $da;
}

function sendNotificationProfileBank($detail,$typeuser='APP'){
	$not_msg = NOTIFICATION['customer']['bankmessage'];
	$not_msg = str_replace('{BANKNAME}', $detail['name'], $not_msg);

	$ins = array(
		'title'=>NOTIFICATION['customer']['banktitle'],
		'type_of_user' => $typeuser,
		'user_id' => $detail['user_id'],
		'module' => 'profile',
		'submodule' => '',
		'message' => $not_msg,
		'data'=> JSON_ENCODE($detail)
	); 
	$da = saveData($ins);
	send_notification($ins['user_id'],$ins);
	return $da;
}

function sendNotificationEditProfile($detail,$typeuser='APP'){
	$not_msg = NOTIFICATION['customer']['profileUpdate'];
	$ins = array(
		'title'=>NOTIFICATION['customer']['profileUpdateTitle'],
		'type_of_user' => $typeuser,
		'user_id' => $detail['user_id'],
		'module' => 'profile',
		'submodule' => '',
		'message' => $not_msg,
		'data'=> JSON_ENCODE($detail)
	); 
	$da = saveData($ins);
	send_notification($ins['user_id'],$ins);
	return $da;
}

function sendNotificationtofa($detail,$typeuser='APP'){
	$not_msg = NOTIFICATION['customer']['tofamessage'];
	
	$status = 'Disable';
	if($detail['tofa']){
		$status = "Enable";
	}
	$not_msg = str_replace('{STATUS}', $status, $not_msg);
	$ins = array(
		'title'=>NOTIFICATION['customer']['tofatitle'],
		'type_of_user' => $typeuser,
		'user_id' => $detail['user_id'],
		'module' => 'profile',
		'submodule' => '',
		'message' => $not_msg,
		'data'=> JSON_ENCODE($detail)
	); 
	$da = saveData($ins);
	send_notification($ins['user_id'],$ins);
	return $da;
}

function sendNotificationVerifyContactNumber(){
	$not_msg = NOTIFICATION['customer']['contactnumbermessage'];
	$ins = array(
		'title'=>NOTIFICATION['customer']['contactnumberTitle'],
		'type_of_user' => $typeuser,
		'user_id' => $detail['user_id'],
		'module' => 'profile',
		'submodule' => '',
		'message' => $not_msg,
		'data'=> JSON_ENCODE($detail)
	); 
	$da = saveData($ins);
	send_notification($ins['user_id'],$ins);
	return $da;
}

function sendNotificationVerifyEmail(){
	$not_msg = NOTIFICATION['customer']['emailmessage'];
	$ins = array(
		'title'=>NOTIFICATION['customer']['emailtitle'],
		'type_of_user' => $typeuser,
		'user_id' => $detail['user_id'],
		'module' => 'profile',
		'submodule' => '',
		'message' => $not_msg,
		'data'=> JSON_ENCODE($detail)
	); 
	$da = saveData($ins);
	send_notification($ins['user_id'],$ins);
	return $da;
}

function send_transfer_notification($detail,$typeuser='APP'){
	$not_msg = NOTIFICATION['cashout']['message'];
	$not_msg = str_replace('{AMOUNT}', show_number($detail['amount']), $not_msg);
	$not_msg = str_replace('{CURRENCY}', CURRENCY, $not_msg);
	$not_msg = str_replace('{TRANSFERED}', $detail['type'], $not_msg);
	$ins = array(
		'title'=>NOTIFICATION['cashout']['title'],
		'type_of_user' => $typeuser,
		'user_id' => $detail['user_id'],
		'module' => 'LOAN',
		'submodule' => '',
		'message' => $not_msg,
		'data'=> JSON_ENCODE($detail)
	); 
	$da = saveData($ins);
	send_notification($ins['user_id'],$ins);
	return $da;
}

function saveData($ins){
	$ci=& get_instance();
	return $ci->notification_model->saveData($ins);
}

?>