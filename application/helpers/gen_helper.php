<?php    
    function check_admin_login()
    {
        $ci=& get_instance();
        if (!$ci->login_model->checkSession()) {
                redirect('admin');
            }
    }
    function load_alert()
    {
     $ci=& get_instance();
     $ci->load->view('Layout/alert');
    }

    function check_front_login()
    {
        $ci=& get_instance();
        if (!$ci->login_model->checkFrontSession()) {
                redirect('/');
        }
    }

    function check_agent_login()
    {
        $ci=& get_instance();
        if (!$ci->login_model->checkAgentSession()) {
                redirect('/agent');
        }
    }

    function pr($data, $di){
        echo "<pre>";
        print_r($data);
        if($di){
            die;
        }
    }
    function manageInstallmentLoan($post,$day,$duration,$start_date, $amount){        
        
        if($day){
         
            $end_date = date('Y-m-d', strtotime("+".$duration." months", strtotime($start_date)));
            $days_between = ceil((strtotime($end_date)- strtotime($start_date))/24/3600);
            $installment =floor($days_between/$day);
            $installment_amount = ($amount+($amount*$post['interest_rate']/100))/$duration;
            
            //echo "<br/> end date==".$end_date;
            // echo "amount".$amount.'percent=='.$post['interest_rate'].'duration=='.$duration;
            // echo "<br/>installment_count==".$installment;           
            // echo "<br/>days_between==".$days_between;
            // echo $day."========".$duration."=============".$start_date;
            // echo "<br/>installment_amount==".$installment_amount;
            //$installment_amount = $amount/$installment; //olddie;
            

            if($day ==30){
                $m =-1;
               while($start_date <= $end_date) {        
                  $start_date = date('Y-m-d', strtotime("+1 months", strtotime($start_date)));
                $m++;
               
               }
               $installment = $m;
               $installment_amount = ($amount+($amount*$post['interest_rate']/100))/$duration;

             }

            $arr = array(
                'endDate' => $end_date,
                'days_between' => $days_between,
                'countInstallment' => $installment,
                'installment_amount' => $installment_amount,
            );
            return $arr;
            print_r($arr);die;
        }else{
            $end_date = date('Y-m-d', strtotime("+".$duration." months", strtotime($start_date)));
            $installment_amount = ($amount+($amount*$post['interest_rate']/100));
           
            return array(
                'endDate' => $end_date,
                'days_between' => 0,
                'countInstallment' => 1,
                'installment_amount' => $installment_amount,
            );

        }
      }

    function manageInstallment($day,$duration,$start_date, $amount){
        
        if($day){
        // echo $day."========".$duration."=============".$start_date;
            $end_date = date('Y-m-d', strtotime("+".$duration." months", strtotime($start_date)));
            //echo "<br/> end date==".$endDate;
            $days_between = ceil((strtotime($end_date)- strtotime($start_date))/24/3600);
            //$days_between = ceil(abs($endDate - $start_date) / 86400);
            // echo "<br/>days_between==".$days_between;
            $installment =floor($days_between/$day);
            //echo "<br/>installment_count==".$installment;
            $installment_amount = $amount/$installment;
            //echo "<br/>installment_amount==".$installment_amount;
            if($day == 1){
                 $installment = ceil((strtotime($end_date)- strtotime($start_date))/24/3600);
               
                $installment_amount = $amount/$installment;
            }
            if($day == 7){
                $week =0;
                while($start_date < $end_date) {        
                    $start_date = date('Y-m-d', strtotime("+1 weeks", strtotime($start_date)));
                    
                    $week ++;
                  }
                  $installment = $week;
                  $installment_amount = $amount/$installment;
            }

            if($day ==30){
                $m =0;
               while($start_date < $end_date) {        
                  $start_date = date('Y-m-d', strtotime("+1 months", strtotime($start_date)));
                $m++;
               
               }
               $installment = $m;
               $installment_amount = $amount/$installment;
             }
         
               if($day ==365){
                   $y=0;
                 while($start_date < $end_date) {        
                   $start_date = date('Y-m-d', strtotime("+1 years", strtotime($start_date)));
                   $y++;
                 }
                 $installment = $y;
               $installment_amount = $amount/$installment;
         
               }

            return array(
                'endDate' => $end_date,
                'days_between' => $days_between,
                'countInstallment' => $installment,
                'installment_amount' => $installment_amount,
            );
        }else{
            $end_date = date('Y-m-d', strtotime("+".$duration." months", strtotime($start_date)));
           
            return array(
                'endDate' => $end_date,
                'days_between' => 0,
                'countInstallment' => 1,
                'installment_amount' => $amount,
            );

        }
      }
    

    function insertFormateDate($date){
       return $your_date = date("Y-m-d", strtotime($date));
    }
    function showDateFormate($date){
        if($date){
            return $your_date = date("d-m-Y", strtotime($date));
        }else{
            return "--";
        }
     }

     function showDateFormateEndDate($date){
        if($date){
            $end_date = date('Y-m-d', strtotime($date. ' - 1 days'));
            return $your_date = date("d-m-Y", strtotime($end_date));
        }else{
            return "--";
        }
     }
     function showDateFormateTime($date){
         if($date){
            return $your_date = date("d-m-Y h:i:s", strtotime($date));
        }else{
            return "--";
        }
     }

    function nextPaymentdate($date, $days){
        return date('d M Y', strtotime($date. ' + '.$days.' days'));
    }

    function getRecord($id, $table){
        $ci=& get_instance();
        $ci->db->where("id", $id);
        $query = $ci->db->get($table);
        return $query->row(); 
    }

    function update_table_data($id,$data,$table){
        $ci=& get_instance();
        $ci->db->where("id", $id);
        $query = $ci->db->update($table,$data);
        //echo $ci->db->last_query();
        return true;
    }

  function uploadImage($field_name, $FILES, $originalpath, $thumb_path, $thumb_width, $thumb_height){        
    
    $ci=& get_instance();
    if(isset($FILES[$field_name]['name'])){
      $filename                   = $FILES[$field_name]['name'];
      $config['upload_path']      = $originalpath;
      $config['file_name']        = $filename;
      $config['allowed_types']    = '*';
      $config['max_size']         = USER_IMAGE_MAX_SIZE;
      $config['max_width']        = DEFAULT_IMAGE_MAX_WIDTH;
      $config['max_height']       = DEFAULT_IMAGE_MAX_HEIGHT;
      $config['encrypt_name']     = TRUE; 
      $ci->load->library('upload');
      $ci->upload->initialize($config);
        
      if($ci->upload->do_upload($field_name)){
        $filename1                          = $ci->upload->data('file_name');
       
        $upload_arr                         = array();
        $upload_arr['file_name']            = $filename1;
        $upload_arr['image_height']         = $thumb_width;
        $upload_arr['image_width']          = $thumb_height;
        //print_r($upload_arr); exit;
        image_resize($thumb_width, $thumb_height, $upload_arr, $originalpath, $thumb_path);
        return array('status'=>true, 'message'=> $filename1 );
      }
      $msg = $ci->upload->display_errors();
      return array('status'=>false, 'message'=> $msg  );

    }   

  }

  function uploadImageWeb($field_name, $FILES, $originalpath, $thumb_path, $thumb_width, $thumb_height){        
    
    $ci=& get_instance();
    if(isset($FILES[$field_name]['name'])){
      $filename                   = $FILES[$field_name]['name'];
      $config['upload_path']      = $originalpath;
      $config['file_name']        = $filename;
      $config['allowed_types']    = ALLOWED_IMAGE_EXTENSION;
      $config['max_size']         = USER_IMAGE_MAX_SIZE;
      $config['max_width']        = DEFAULT_IMAGE_MAX_WIDTH;
      $config['max_height']       = DEFAULT_IMAGE_MAX_HEIGHT;
      $config['encrypt_name']     = TRUE; 
      $ci->load->library('upload');
      $ci->upload->initialize($config);
        
      if($ci->upload->do_upload($field_name)){
        $filename1                          = $ci->upload->data('file_name');
       
        $upload_arr                         = array();
        $upload_arr['file_name']            = $filename1;
        $upload_arr['image_height']         = $thumb_width;
        $upload_arr['image_width']          = $thumb_height;
        //print_r($upload_arr); exit;
        image_resize($thumb_width, $thumb_height, $upload_arr, $originalpath, $thumb_path);
       return $filename1;
      }
     echo $msg = $ci->upload->display_errors();die;
      return array('status'=>false, 'message'=> $msg  );

    }   

  }


 function image_resize($max_height, $max_width, $upload_arr, $source_dir, $upload_dir) {
  // pr($upload_arr); exit;
  $ci=& get_instance();
  $filename   = $upload_arr['file_name'];
  $up_height  = $upload_arr['image_height'];
  $up_width   = $upload_arr['image_width'];
  $height     = $max_height;
  $width      = $max_width;
  if ($max_height >= $up_height && $max_width >= $up_width) {
      $height     = $up_height;
      $width      = $up_width;
  }
  if ($up_height > $max_height || $up_width > $max_width) {
      if ($up_height > $max_height && $up_width > $max_width && $up_height == $up_width) {
          $height  = $max_height;
          $width   = $max_width;
      } else {

          if ($up_height > $max_height && $up_width > $max_width) {
              if ($up_height > $up_width) {
                  $height             = $max_height;
                  $differentiate      = $up_height / $max_height;
                  $width              = $up_width / $differentiate;
              }
              if ($up_height < $up_width) {
                  $width = $max_width;
                  $differentiate      = $up_width / $max_width;
                  $height             = $up_height / $differentiate;
              }
          } else {
              if ($up_height > $max_height && $up_width <= $max_width) {
                  if ($up_height > $up_width) {
                      $height         = $max_height;
                      $differentiate  = $up_height / $max_height;
                      $width          = $up_width / $differentiate;
                  }
              } else {
                  if ($up_height <= $max_height && $up_width > $max_width) {

                      $width          = $max_width;
                      $differentiate  = $up_width / $max_width;
                      $height         = $up_height / $differentiate;
                  }
              }
          }
      }
  }

  $config1['image_library']   = 'gd2';
  $config1['new_image']       = $upload_dir . $filename;
  $config1['source_image']    = $source_dir . $filename;
  $config1['create'] = TRUE;
  $config1['maintain_ratio']  = TRUE;
  $config1['width']           = $width;
  $config1['height']          = $height;
  //print_r($config1); exit;
  $ci->image_lib->initialize($config1);
  $ci->image_lib->resize();
  //echo $ci->image_lib->display_errors();
} 

function get_user_detail($id){
    $ci=& get_instance();
    $ci->db->where("id", $id);
    $query = $ci->db->get(TBL_USER);
    return $query->row(); 
}

function createJWTToken($data){
   return $token = JWT::encode($data, JWTSECRETKEY);
}

function validateJWTToken($token){
    return $data = JWT::decode($token, JWTSECRETKEY, true);
}

function getCurrentBalence($user_id =''){   
    $amount_in = 0.00; 
    $amount_out =0.00;
    $ci=& get_instance();
    $ci->db->select_sum('amount');
    $ci->db->where('in_out', "IN");
    $ci->db->where('status', "1");
    if($user_id){
        $ci->db->where('user_id', $user_id);
    }
    $ci->db->from(TBL_FUND_HISTORY);
    $query = $ci->db->get();

    if($query->num_rows()>0){
        $res = $query->row();
        $amount_in = $res->amount;
    }

    $ci=& get_instance();
    $ci->db->select_sum('amount');
    $ci->db->where('in_out', "OUT");
    $ci->db->where('status', "1");
    if($user_id){
        $ci->db->where('user_id', $user_id);
    }
    $ci->db->from(TBL_FUND_HISTORY);
    $query = $ci->db->get();
    if($query->num_rows()>0){
        $res = $query->row();
        $amount_out = $res->amount;
    }
    // echo "amount_in".$amount_in."<br>";
    // echo "amount_out".$amount_out;
    return round(($amount_in - $amount_out),2);
}

//only for notification
function time_diff_hours($startdate, $enddate) {
     $start_date =  date("Y-m-d H:i:s",strtotime("+630 minutes",strtotime($startdate)));
    $date1 = new DateTime($startdate);
//    echo "<br/>".$start_date;
//    echo "<br/>".$enddate;
     $date2 = new DateTime($enddate);
    
     $diff = $date2->diff($date1);

     $diff = abs(strtotime($enddate) - strtotime($start_date));

     
     $days = floor(($diff)/ (60*60*24));
     $hou = floor(($diff)/ (60*60));
     $mi = floor(($diff)/ (60));

     //return $your_date = date("d, M Y", strtotime($startdate));
     if($days>=1){
        return $your_date = date("d,M Y", strtotime($startdate));
     }else if($hou>=1){
        return $hours = $hou." Hours ago";
     }else{
        return $hours = $mi." Minute ago";
     }
     
}

function saveFundHistory($data){
    $ci=& get_instance();
    $ci->db->insert(TBL_FUND_HISTORY,$data);
    return true;    
}

function file_extention($s){
    $n = strrpos($s,".");
    return ($n===false) ? "" : substr($s,$n+1);
}
function getModulePermission($page,$adminId){
    if($adminId){
        return true;
    }
    $ci=& get_instance();
    $ci->db->where('admin_module_id',$page);
    $ci->db->where('permission',1);
    $ci->db->where('admin_id',$adminId);
    $ci->db->from(TBL_ADMIN_PERMISSION);
    
    $query = $ci->db->get();
    return $query->num_rows();  
}

function comes_from($id){
    $ci=& get_instance();
    $ci->db->where('id',$id);
    $ci->db->from(TBL_AMOUNT_COMES_FROM);
    $query = $ci->db->get();
    if($query->num_rows()){
        return $query->row();
    }
    return null;
}

function next_invest_payment_date($investment_id){
    $ci=& get_instance();
    $ci->db->where('investment_id',$investment_id);
    $ci->db->where('status',0);
    $ci->db->from(TBL_INVESTMENT_PAYMENT_DATE);
    $query = $ci->db->get();
    if($query->num_rows()){
        return $query->row();
    }
    return null;
}

function next_loan_payment_date($loan_id){
    $ci=& get_instance();
    $ci->db->where('loan_id',$loan_id);
    $ci->db->where('status',0);
    $ci->db->from(TBL_LOAN_PAYMENT_DATE);
    $query = $ci->db->get();
    if($query->num_rows()){
        return $query->row();
    }
    return null;
}



function all_invest_payment_date($investment_id){
    $ci=& get_instance();
    $ci->db->where('investment_id',$investment_id);
    $ci->db->from(TBL_INVESTMENT_PAYMENT_DATE);
    $query = $ci->db->get();
    if($query->num_rows()){
        $data = $query->result();
        $detail = array();
        foreach($data as $line){
            $investment_payment = getinvestPayment($line->id);
            $line->move_to_wallet = ($investment_payment && $investment_payment->move_to_wallet)?$investment_payment->move_to_wallet:"0";
            $line->investment_payment_id = ($investment_payment && $investment_payment->id)?$investment_payment->id:"";
            $detail[] = $line;
        }
        return $detail;
    }
    return null;
}

function getinvestPayment($id){
    $ci=& get_instance();
    $ci->db->where('investment_payment_date_id',$id);
    $ci->db->from(TBL_INVESTMENT_PAYMENT);
    $query = $ci->db->get();
    if($query->num_rows()){
       return $data = $query->row();
        //return $data->move_to_wallet;
    }
    return null;
}

function all_loan_payment_date($loan_id){
    $ci=& get_instance();
    $ci->db->where('loan_id',$loan_id);
    $ci->db->from(TBL_LOAN_PAYMENT_DATE);
    $query = $ci->db->get();
    if($query->num_rows()){
        return $query->result();
    }
    return null;
}

function ammount_comes_from(){
    $ci=& get_instance();
    $ci->db->from(TBL_AMOUNT_COMES_FROM);
	$ci->db->order_by('sequence','ASC');
	$query = $ci->db->get();
    if($query->num_rows()){
        return $query->result();
    }
    return null;
}

function get_total_interest($user_id=''){
    $earned_amount = 0;
    $loan_amount = 0;
    $ci=& get_instance();
    $ci->db->select_sum('interest_amount');
    if($user_id){
        $ci->db->where('user_id',$user_id);
    }
    $ci->db->where_in('module',['Cash','Investment']);
    $ci->db->from(TBL_EARNED_INTEREST);  
    $query = $ci->db->get();
    if($query->num_rows()>0){
        $result =  $query->row();
       $earned_amount =  $result->interest_amount;
    } 

    $ci=& get_instance();
    $ci->db->select_sum('interest_amount');
    if($user_id){
        $ci->db->where('user_id',$user_id);
    }
    $ci->db->where_in('module',['Loan',]);
    $ci->db->from(TBL_EARNED_INTEREST);  
    $query = $ci->db->get();
    if($query->num_rows()>0){
        $result =  $query->row();
       $loan_amount =  $result->interest_amount;
    } 
    return $earned_amount - $loan_amount;
}

function next_cash_payment_date($cash_id){
    $ci=& get_instance();
    $ci->db->where('cash_id',$cash_id);
    $ci->db->where('status',0);
    $ci->db->from(TBL_CASH_PAYMENT_DATE);
    $query = $ci->db->get();
    if($query->num_rows()){
        return $query->row();
    }
    return null;
}

function all_cash_payment_date($cash_id){
    $ci=& get_instance();
    $ci->db->where('cash_id',$cash_id);
    $ci->db->from(TBL_CASH_PAYMENT_DATE);
    $query = $ci->db->get();
    if($query->num_rows()){
        $data = $query->result();
        $detail = array();
        foreach($data as $line){
            $cash_payment = getcashPayment($line->id);
            $line->move_to_wallet = ($cash_payment && $cash_payment->move_to_wallet)?$cash_payment->move_to_wallet:"0";
            $line->cash_payment_id = ($cash_payment && $cash_payment->id)?$cash_payment->id:"";
            $detail[] = $line;
        }
        return $detail;
    }
    return null;
}

function getcashPayment($id){
    $ci=& get_instance();
    $ci->db->where('cash_payment_date_id',$id);
    $ci->db->from(TBL_CASH_PAYMENT);
    $query = $ci->db->get();
    if($query->num_rows()){
       return $data = $query->row();
        //return $data->move_to_wallet;
    }
    return null;
}

function show_number($number){
    return number_format((float)$number, 2, '.', '');
}

function show_number_decimal_round($number){
    //echo $number;
    return round($number,3);
}

function send_email($data, $email){
    //$emai = "peter12@yopmail.com";
    $ci=& get_instance();
    $ci->load->library('email');
    $ci->email->from(MAILFROMEMAIL, MAILFROMNAME);
    $ci->email->to($email);
    // $ci->email->cc('another@another-example.com');
    // $ci->email->bcc('them@their-example.com');

    $ci->email->subject('2FA OTP');
    $ci->email->message($data);

    $ci->email->send();
}

function generate_pdf($html,$user_id){
    $ci=& get_instance();
    $ci->load->library('m_pdf');
    
    $pdfFilePath =$user_id."-".time().".pdf";
    $pdf = $ci->m_pdf->load();
    
    $pdf->WriteHTML($html,2);    
    $pdf->Output($pdfFilePath, "D");
}

function asiatimezone($rows){
    $rowsData = array();
    foreach($rows as $line){
        $line->createdAt =   date("Y-m-d H:i:s",strtotime("+630 minutes",strtotime($line->createdAt)));
        $rowsData[] = $line;
    }
    return $rowsData;
}

function get_earned_brh($record){
    $todate = date('Y-m-d');
    if($record->matured){
        $todate = $record->matured_date;
    }
    $total_days = get_days($record->start_date, $record->end_date)+1;
    $days = get_days($record->start_date, $todate)+1;
    $interest = ($record->amount * $record->interest_rate)/100;
    // echo "interest====.$interest<br/>";
    // echo "total_days====.$total_days";
    $daily_interest = $interest/$total_days;
    return $show_interest = ($daily_interest*$days);

}

function get_days($earlier, $later){
    $earlier = new DateTime($earlier);
    $later = new DateTime($later);
    return $abs_diff = $later->diff($earlier)->format("%a");
}

function get_investment_brh_charge($key){
    $ci=& get_instance();
    $ci->db->where('label_key',$key);
    $ci->db->from(TBL_CONFIG);
    $query = $ci->db->get();
    if($query->num_rows()>0){
        return $query->row();
    }
    return null;
}

function get_total_sol_intrest($sol_amount, $record){
    $todate = date('Y-m-d');
    if($todate>$record->end_date){
        $todate = $record->end_date;
    }
    $interest = $record->interest_rate;
    $days = get_days($record->start_date, $todate)+1;
    $total_days = get_days($record->start_date, $record->end_date)+1;
     $am = ((($interest/$total_days)/100)*$sol_amount)*$days;
    return $am;
}

function get_total_loan($user_id=''){
    $ci=& get_instance();
    $ci->load->model('cashout_model');
    $loan_amount = $ci->cashout_model->get_total_loan($user_id,'IN');
    return $loan_amount;
}
function get_loan_transfer($user_id){
    $ci=& get_instance();
    $ci->load->model('cashout_model');
    $loan_amount = $ci->cashout_model->get_total_loan($user_id,'OUT');
    return $loan_amount;
}

function getCurrentLoanBalence($user_id){
    $ci=& get_instance();
    return $loan = $ci->cashout_model->get_loan_balance($user_id);
}
?>
