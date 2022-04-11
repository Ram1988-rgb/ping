<?php 
class Investment_model extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->library("session");
    $this->load->model('plan_model');
    $this->load->model('config_model');
  }
  
  public function index(){
      
  }

  public function create_plan($post){
    if($post!=NULL)
      {
        $plan_rate =  $this->plan_model->getPlanPaymentDuration($_POST['plan_id'],$_POST['payment_duration']);
        $ins['user_id'] =  $post['user_id'];
        $ins['payment_type_id'] = $post['payment_type'];
        $ins['payment_duration_id'] = $post['payment_duration'];
        $ins['amount'] = $post['amount'];
        $ins['plan_id'] = $post['plan_id'];
        $ins['amount_comes_from_id'] = ($post['comes_from'])?$post['comes_from']:1;
        $ins['interest_rate'] = isset($plan_rate )? $plan_rate->rate: 0;
        $ins['start_date'] = insertFormateDate($post['start_date']);
        $ins['status'] = 0;
        $ins['deletedAt'] = 0;
        if($this->db->insert(TBL_INVESTMENTS,$ins))
        {
          $id = $this->db->insert_id();
          $this->manageInvestmentDetail($id, $post);
          
          return $id;
        }
      }
      return false;
  }

  function manageInvestmentDetail($investId, $post){
    $paymentType = getRecord($post['payment_type'], TBL_PAYMENTTYPE);
    $paymentDuration = getRecord($post['payment_duration'], TBL_PAYMENTDURATION);
    $plan = getRecord($post['plan_id'], TBL_PLAN);
    $mInstallment = manageInstallment($paymentType->days, $paymentDuration->month, insertFormateDate($post['start_date']), $post['amount']);
    // update TBL_INVESTMENTS
    $this->db->where('id', $investId);
    $this->db->update(TBL_INVESTMENTS, array(
      'install_amount' => $mInstallment['installment_amount'],
      'days_between' => $mInstallment['days_between'],
      'end_date' => $mInstallment['endDate'],
      'installment_count' => $mInstallment['countInstallment'],
    ));

    //add investdetail
    $ins['investment_id'] = $investId;
    $ins['plan_rate'] = isset($post['plan_rate'])?isset($post['plan_rate']):'2';
    $ins['payment_type_data'] = JSON_ENCODE($paymentType);
    $ins['payment_deuration_data'] = JSON_ENCODE($paymentDuration);;
    $ins['plan_data'] = JSON_ENCODE($plan);;
    if($this->db->insert(TBL_INVESTMENTDETAIL,$ins))
    {
      return true;
    }
    return false;
  }

  function getAllRecord($user_id = ''){
    $this->db->select('a.*,b.*, c.*, c.id as `cid`, b.id as `bid`, a.id as `id`, a.status as `status`, a.createdAt as `createdAt`'); 
    $this->db->from(TBL_INVESTMENTS.' a');
    if($user_id){
      $this->db->where('a.user_id',$user_id);
    }
    $this->db->join(TBL_INVESTMENTDETAIL.' b', 'a.id = b.investment_id'); 
    $this->db->join(TBL_USER.' c', 'a.user_id = c.id');
    $this->db->order_by('a.id', 'DESC');
    $query = $this->db->get(); 
    return $query->result();
  }
  // here in_plan_id is sol vip, or brh
  function get_all_list_forapp($in_plan_id, $user_id){
    $this->db->select('a.*,b.*, b.id as `bid`, a.id as `id`, a.status as `status`, a.createdAt as `createdAt`'); 
    $this->db->from(TBL_INVESTMENTS.' a');
    $this->db->where('a.plan_id',$in_plan_id);
    if($user_id){
      $this->db->where('a.user_id',$user_id);
    }
    $this->db->join(TBL_INVESTMENTDETAIL.' b', 'a.id = b.investment_id'); 
    $this->db->join(TBL_USER.' c', 'a.user_id = c.id');
    $this->db->order_by('a.id', 'DESC');
    $query = $this->db->get(); 
    return $query->result();
  }

  function get_one_list_forapp($id, $user_id){
    $this->db->select('a.*,b.*, b.id as `bid`, a.id as `id`, a.status as `status`, a.createdAt as `createdAt`'); 
    $this->db->from(TBL_INVESTMENTS.' a');
    $this->db->where('a.id',$id);
    if($user_id){
      $this->db->where('a.user_id',$user_id);
    }
    $this->db->join(TBL_INVESTMENTDETAIL.' b', 'a.id = b.investment_id'); 
    $this->db->join(TBL_USER.' c', 'a.user_id = c.id');
    $this->db->order_by('a.id', 'DESC');
    $query = $this->db->get(); 
    return $query->row();
  }

  function getRecord($id){
    $this->db->select('a.*,b.*, c.*, c.id as `cid`, b.id as `bid`, a.id as `id`, a.status as `status`,a.createdAt as `createdAt`'); 
    $this->db->where('a.id',$id);
    $this->db->from(TBL_INVESTMENTS.' a');
    $this->db->join(TBL_INVESTMENTDETAIL.' b', 'a.id = b.investment_id'); 
    $this->db->join(TBL_USER.' c', 'a.user_id = c.id');
    $query = $this->db->get(); 
    return $query->row();
  }

  function updateStatus($id, $status){
    $data   = array(
      'status'    => $status
    );
    if($this->db->where('id', $id)->update(TBL_INVESTMENTS
    ,$data)){
      return true;
    }
    return false;
  }

  function get_total_investment($plan_id=0, $user_id = ''){
    $this->db->select_sum('amount');
    $this->db->where('status',1);
    //$this->db->where('apply_status', 1);
    if($user_id){
      $this->db->where('user_id',$user_id);
    }
    $this->db->from(TBL_INVESTMENTS);
    if($plan_id){
      $this->db->where('plan_id',$plan_id);
    }
    $query = $this->db->get();
    if($query->num_rows()>0){
      return $query->row();
    }
    return null;
    
  }


  public function getPaymentType($id){
    $this->db->where('id', $id);
    $this->db->from(TBL_PAYMENTTYPE);
    return $this->db->get()->row();
    //echo $this->db->last_query();

  }

  function insert_payment_date($id){
    $investDetail = $this->getRecord($id);
    $payment_detail = $this->getPaymentType($investDetail->payment_type_id);
    $start_date =$investDetail->start_date;
    $end_date =$investDetail->end_date;
    $ins['payment_type'] = $payment_detail->label;
    $ins['investment_id'] = $id;
   
     $ins['payment_date'] =  $investDetail->start_date;
     $this->db->insert(TBL_INVESTMENT_PAYMENT_DATE,$ins);
    
    if($payment_detail->days ==1){      
     while($start_date <= $end_date) {        
       $start_date = date('Y-m-d', strtotime("+1 days", strtotime($start_date)));
       $ins['payment_date'] =  $start_date;
       if($start_date < $end_date){
        $this->db->insert(TBL_INVESTMENT_PAYMENT_DATE,$ins);
       }
     }
    }

    if($payment_detail->days ==7){      
     while($start_date < $end_date) {        
       $start_date = date('Y-m-d', strtotime("+1 weeks", strtotime($start_date)));
       $ins['payment_date'] =  $start_date;
       if($start_date < $end_date){
        $this->db->insert(TBL_INVESTMENT_PAYMENT_DATE,$ins);
       }
     }
    }

    if($payment_detail->days ==30){
     while($start_date < $end_date) {        
       $start_date = date('Y-m-d', strtotime("+1 months", strtotime($start_date)));
       $ins['payment_date'] =  $start_date;
       if($start_date < $end_date){
        $this->db->insert(TBL_INVESTMENT_PAYMENT_DATE,$ins);
       }
     }
   }

     if($payment_detail->days ==365){
       while($start_date < $end_date) {        
         $start_date = date('Y-m-d', strtotime("+1 years", strtotime($start_date)));
         $ins['payment_date'] =  $start_date;
         if($start_date < $end_date){
          $this->db->insert(TBL_INVESTMENT_PAYMENT_DATE,$ins);
         }
       }

     }
  }

  public function insert_fund_history($id){
    $line = $this->getRecord($id);
    $ins['investment_id'] = $line->id;
		$ins['mode'] = 'Investment';
		$ins['message'] = "Invest Payment successfully";
		$ins['user_id'] = $line->user_id;
		$ins['user_id'] = $line->user_id;
		$ins['amount'] = $line->amount;
		$ins['detail'] = JSON_ENCODE($line);
		$ins['status'] = 1;
		$ins['in_out'] = 'OUT';
		$data = $this->db->insert(TBL_FUND_HISTORY,$ins);
		return $data;
  }

  function insertInterestinfund($pdetail){
		$ins['investment_id'] = $pdetail->investment_id;
		$ins['mode'] = 'Investment';
		$ins['message'] = "Interest amount added successfully";
		$ins['user_id'] = $pdetail->user_id;
		$ins['amount'] = $pdetail->interest_amount;
		$ins['detail'] = JSON_ENCODE($pdetail);
		$ins['status'] = 1;
		$ins['in_out'] = 'IN';
		$data = $this->db->insert(TBL_FUND_HISTORY,$ins);
    sendInvestmentInterestNotification($ins);
		return $data;
	}

  function insertInterestinfundsol($amount_recieved, $pdetail){
      
      $interest_amount = show_number_decimal_round(get_total_sol_intrest($amount_recieved,$pdetail));
      $ins['investment_id'] = $pdetail->id;
      $ins['mode'] = 'Investment';
      $ins['message'] = "Interest amount added successfully";
      $ins['user_id'] = $pdetail->user_id;
      $ins['amount'] = $interest_amount;
      $ins['detail'] = JSON_ENCODE($pdetail);
      $ins['status'] = 1;
      $ins['in_out'] = 'IN';
      $data = $this->db->insert(TBL_FUND_HISTORY,$ins);
      $this->update_table_earned_intrest_sol($amount_recieved,$pdetail);
      sendInvestmentInterestNotification($ins);
		  return $data;
  }

  function insertInterestinfundbrh($pdetail){
    $interest_amount = $pdetail->interest_amount;
    if($pdetail->start_date< $pdetail->end_date){
      $interest_amount = show_number_decimal_round(get_earned_brh($pdetail));
    }
		$ins['investment_id'] = $pdetail->investment_id;
		$ins['mode'] = 'Investment';
		$ins['message'] = "Interest amount added successfully";
		$ins['user_id'] = $pdetail->user_id;
		$ins['amount'] = $interest_amount;
		$ins['detail'] = JSON_ENCODE($pdetail);
		$ins['status'] = 1;
		$ins['in_out'] = 'IN';
		$data = $this->db->insert(TBL_FUND_HISTORY,$ins);
    $this->update_table_earned_intrest($pdetail);
    sendInvestmentInterestNotification($ins);
		return $data;
	}

  function insertmaturefundsol($amount_recieved,$pdetail){
    $charge = 0;
    $data = '';
    if($pdetail->start_date< $pdetail->end_date){
      $charge_row = $this->config_model->getConfig_value('SOL_UNMATURED_CHARGE');
      $charge = $charge_row->value; 
      $data =" with deduct charges ".$charge;
    }
    $ins['investment_id'] = $pdetail->id;
		$ins['mode'] = 'Investment';
		$ins['message'] = "Amount added successfully".$data;
		$ins['user_id'] = $pdetail->user_id;
		$ins['amount'] = $amount_recieved-$charge;
		$ins['detail'] = JSON_ENCODE($pdetail);
		$ins['status'] = 1;
		$ins['in_out'] = 'IN';
		$data = $this->db->insert(TBL_FUND_HISTORY,$ins);
    sendInvestmentMatureNotification($ins);
		return $data;
  }

  function insertmaturefundVIP($pdetail){
    $charge = 0;
    $data = '';
    if($pdetail->start_date< $pdetail->end_date){
      $charge_row = $this->config_model->getConfig_value('VIP_UNMATURED_CHARGE');
      $charge = $charge_row->value; 
      $data =" with deduct charges ".$charge;
    }
    $ins['investment_id'] = $pdetail->id;
		$ins['mode'] = 'Investment';
		$ins['message'] = "Amount added successfully".$data;
		$ins['user_id'] = $pdetail->user_id;
		$ins['amount'] = $pdetail->amount-$charge;
		$ins['detail'] = JSON_ENCODE($pdetail);
		$ins['status'] = 1;
		$ins['in_out'] = 'IN';
		$data = $this->db->insert(TBL_FUND_HISTORY,$ins);
    sendInvestmentMatureNotification($ins);
		return $data;
  }

  function insertmaturefund($pdetail){
    $charge = 0;
    $data = '';
    if($pdetail->start_date< $pdetail->end_date){
      $charge_row = $this->config_model->getConfig_value('BRH_UNMATURED_CHARGE');
      $charge = $charge_row->value; 
      $data =" with deduct charges ".$charge;
    }
    $ins['investment_id'] = $pdetail->investment_id;
		$ins['mode'] = 'Investment';
		$ins['message'] = "Amount added successfully".$data;
		$ins['user_id'] = $pdetail->user_id;
		$ins['amount'] = $pdetail->amount-$charge;
		$ins['detail'] = JSON_ENCODE($pdetail);
		$ins['status'] = 1;
		$ins['in_out'] = 'IN';
		$data = $this->db->insert(TBL_FUND_HISTORY,$ins);
    sendInvestmentMatureNotification($ins);
		return $data;
  }

  function get_investment_payment($investmentId){
    $this->db->where('investment_id', $investmentId);
		$this->db->from(TBL_INVESTMENT_PAYMENT);
		$query = $this->db->get();
    if($query->num_rows()>0){
      return $query->result();
    }
    return NULL;
  }
  function get_investment_payment_detail($id){
    $this->db->select('a.*, b.start_date, b.end_date, b.plan_id, b.payment_type_id, b.matured, b.matured_date');
    $this->db->where('a.id', $id);
		$this->db->from(TBL_INVESTMENT_PAYMENT.' a');
    $this->db->join(TBL_INVESTMENTS.' b', 'a.investment_id = b.id');
		$query = $this->db->get();
    if($query->num_rows()>0){ 
          
      return $query->row();
    }
    return NULL;
  }

  function get_investment_payment_data($investment_id){
    $this->db->select('a.*,b.*, b.id as `bid`, a.id as `id`, a.status as `status`, a.payment_date as `cpdate`'); 
    $this->db->where('a.investment_id', $investment_id);
    $this->db->from(TBL_INVESTMENT_PAYMENT_DATE.' a');
    $this->db->join(TBL_INVESTMENT_PAYMENT.' b', 'a.id = b.investment_payment_date_id', 'LEFT');
    $query = $this->db->get();    
    return $query->result();
   }

  function update_investment_payment($id){
    $this->db->where('id', $id);
    $this->db->update(TBL_INVESTMENT_PAYMENT, array(
      'move_to_wallet' => 1      
    ));
   // echo $this->db->last_query();
   }
   function update_investment_payment_sol($id){
    $this->db->where('investment_id', $id);
    $this->db->update(TBL_INVESTMENT_PAYMENT, array(
      'move_to_wallet' => 1      
    ));
   // echo $this->db->last_query();
   }

   function change_status($id){

    $this->db->where('id', $id);
		$this->db->from(TBL_INVESTMENTS);
		$query = $this->db->get();

    if($query->num_rows()>0){
      $row =  $query->row();
      
      $status = 1;
      if($row->status ==1){
        $status =0;
      }

      $this->db->where('id', $id);
      $this->db->update(TBL_INVESTMENTS, array(
        'status' => $status     
      ));
      if($row->plan_id ==2 && $row->payment_type_id){
        $this->brh_payment($id);
        return $status;
      }
      if($row->plan_id ==3){
        $this->sol_payment($id);
        return $status;
      }
      if($status){
        $idetail = $this->getRecord($id);
        statusInvestmentNotification($idetail,'WEB');
        if($row->start_date == date('Y-m-d')){
          if($investment_payment_id = $this->check_investment_payment($id)){
            $investDetail =  $this->getRecord($id);
            $this->updateFundHistory($investDetail, $investment_payment_id);
          
          }
        }
      }
      return $status;
    }
    return 0;
   }

   function brh_payment($id){
    $inpdetail = $this->get_investment_payment_date_detail($id);
    $investment_date_id =  $inpdetail->id;
    $investment_payment_date_detail = $this->investment_payment_date_detail($investment_date_id);
    if(!$investment_payment_date_detail){
      return 'not';
    }
    $investment_detail = $this->getRecord($investment_payment_date_detail->investment_id);
    $inpid= $this->updateFundHistory($investment_detail, $investment_date_id,  $investment_payment_date_detail->payment_date);
   }

   function sol_payment($id){
    $inpdetail = $this->get_investment_payment_date_detail($id);
    $investment_date_id =  $inpdetail->id;
    $investment_payment_date_detail = $this->investment_payment_date_detail($investment_date_id);
    if(!$investment_payment_date_detail){
      return 'not';
    }
    $investment_detail = $this->getRecord($investment_payment_date_detail->investment_id);
    $inpid= $this->updateFundHistory($investment_detail, $investment_date_id,  $investment_payment_date_detail->payment_date);
   }

   function check_investment_payment($investment_id){
    $this->db->where('investment_id',$investment_id);
    $this->db->where('payment_date',date('Y-m-d'));
    $this->db->where('status',0);
    $query = $this->db->get(TBL_INVESTMENT_PAYMENT_DATE);
    if($query->num_rows()){
      $row = $query->row();
      return $row->id;
    }
   }

   function updateFundHistory($investDetail, $invest_payment_id, $cpDdate ='' ){
     // investment deduct 
    $ins['investment_id'] = $investDetail->investment_id;
		$ins['mode'] = 'Investment';
		$ins['message'] = "Amount has been Deducted successfully";
		$ins['user_id'] = $investDetail->user_id;
		$ins['amount'] = $investDetail->amount;
		$ins['detail'] = JSON_ENCODE($investDetail);
		$ins['status'] = 1;
		$ins['in_out'] = 'OUT';
		$data = $this->db->insert(TBL_FUND_HISTORY,$ins);
    sendInvestmentPaidNotification($ins);

    //interest_amount
    if(!$cpDdate){
      $inr['investment_id'] = $investDetail->investment_id;
      $inr['mode'] = 'Investment';
      $inr['message'] = "Interest amount has been Added successfully";
      $inr['user_id'] = $investDetail->user_id;
      $inr['amount'] = ($investDetail->amount*$investDetail->interest_rate)/100;
      $inr['detail'] = JSON_ENCODE($investDetail);
      $inr['status'] = 1;
      $inr['in_out'] = 'IN';
      $inr['interest_status'] = 1;
      $data = $this->db->insert(TBL_FUND_HISTORY,$inr);
      sendInvestmentInterestNotification($inr,'WEB');

    }
    
    
    if(!$cpDdate){
      $inp['move_to_wallet'] = 1;
    }
    if(!$cpDdate){
      $cpDdate = date('Y-m-d');
    }
    //update cash_payment_date
    $this->db->where('investment_id',$investDetail->investment_id);
    $this->db->where('payment_date',$cpDdate);
    $this->db->update(TBL_INVESTMENT_PAYMENT_DATE, array(
      'status' => 1    
    ));

    //insert cash_payment
      $inp['investment_id'] = $investDetail->investment_id;
      $inp['investment_payment_date_id'] = $invest_payment_id;
      $inp['user_id'] = $investDetail->user_id;
      $inp['amount'] = $investDetail->amount;
      $inp['interest_rate'] = $investDetail->interest_rate;
      $inp['interest_amount'] = ($investDetail->amount*$investDetail->interest_rate)/100;
      //$inp['move_to_wallet'] = 1;
      $data = $this->db->insert(TBL_INVESTMENT_PAYMENT,$inp);
      $inpd = $this->db->insert_id();

      //interest earned
      if(($investDetail->plan_id!=2 && $investDetail->payment_type_id !=6)){

      }else if($investDetail->plan_id ==3){

      }else{
        $er['investment_id'] = $investDetail->investment_id;
        $er['user_id'] = $investDetail->user_id;
        $er['investment_payment_id'] = $inpd;
        $er['amount'] = $investDetail->amount;
        $er['interest_rate'] = $investDetail->interest_rate;
        $er['interest_amount'] = ($investDetail->amount*$investDetail->interest_rate)/100;;
        $er['module'] = 'Investment';
        $data = $this->db->insert(TBL_EARNED_INTEREST,$er);
      }
        return $inpd;
      
   }

   function update_table_earned_intrest($pdetail){
    $interest_amount =show_number_decimal_round(get_earned_brh($pdetail));
    $er['investment_id'] = $pdetail->investment_id;
    $er['user_id'] = $pdetail->user_id;
    $er['investment_payment_id'] = $pdetail->id;
    $er['amount'] = $pdetail->amount;
    $er['interest_rate'] = $pdetail->interest_rate;
    $er['interest_amount'] = $interest_amount;
    $er['module'] = 'Investment';
    $data = $this->db->insert(TBL_EARNED_INTEREST,$er);
   }

   function update_table_earned_intrest_sol($amount_recieved,$pdetail){
    $interest_amount = show_number_decimal_round(get_total_sol_intrest($amount_recieved,$pdetail));
    // $ins['investment_id'] = $pdetail->id;
    // $ins['mode'] = 'Investment';
    // $ins['message'] = "Interest amount added successfully";
    // $ins['user_id'] = $pdetail->user_id;
    // $ins['amount'] = $interest_amount;
    // $ins['detail'] = JSON_ENCODE($pdetail);
    // $ins['status'] = 1;
    // $ins['in_out'] = 'IN';
    // $data = $this->db->insert(TBL_FUND_HISTORY,$ins);
    // $this->update_table_earned_intrest($amount_recieved,$pdetail);
    // sendInvestmentInterestNotification($ins);
    // return $data;
    $er['investment_id'] = $pdetail->id;
    $er['user_id'] = $pdetail->user_id;
    $er['investment_payment_id'] = 0;
    $er['amount'] = $amount_recieved;
    $er['interest_rate'] = $pdetail->interest_rate;
    $er['interest_amount'] = $interest_amount;
    $er['module'] = 'Investment';
    $data = $this->db->insert(TBL_EARNED_INTEREST,$er);
   }

   function investment_payment_date_detail($id){
    $this->db->where('id', $id);
		$this->db->from(TBL_INVESTMENT_PAYMENT_DATE);
		$query = $this->db->get();
    //echo $this->db->last_query();
    if($query->num_rows()>0){
      return $query->row();
    }
    return NULL;
   }

   function get_investment_payment_date_detail($investment_id){
    $this->db->where('investment_id', $investment_id);
		$this->db->from(TBL_INVESTMENT_PAYMENT_DATE);
		$query = $this->db->get();
    //echo $this->db->last_query();
    if($query->num_rows()>0){
      return $query->row();
    }
    return NULL;
   }

   function get_investment_saving($user_id = ''){
    $this->db->select_sum('a.amount'); 
    $this->db->from(TBL_INVESTMENT_PAYMENT.' a');
    $this->db->join(TBL_INVESTMENTS.' b', 'a.investment_id = b.id'); 
    $this->db->where('b.status', 1); 
    if($user_id){
      $this->db->where('b.user_id', $user_id);
    } 
    $this->db->where('b.start_date <=', date('Y-m-d')); 
    $this->db->where('b.end_date >=', date('Y-m-d')); 
    $query = $this->db->get();
    if($query->num_rows()){
      $row = $query->row();
      return $row->amount;
    }

    return 0;
   }

   function invest_maturity_update($id){
    $data   = array(
      'matured'    => 1,
      'matured_date'=> date('Y-m-d')
    );
    if($this->db->where('id', $id)->update(TBL_INVESTMENTS
    ,$data)){
      return true;
    }
    return false;
   }

   function get_sol_total_recieved($invid){
    $this->db->select_sum('a.amount'); 
    $this->db->where('a.investment_id', $invid); 
    $this->db->from(TBL_INVESTMENT_PAYMENT.' a');
    // $this->db->join(TBL_INVESTMENTS.' b', 'a.investment_id = b.id'); 
    // $this->db->where('b.status', 1); 
    // if($user_id){
    //   $this->db->where('b.user_id', $user_id);
    // } 
    // $this->db->where('b.start_date <=', date('Y-m-d')); 
    // $this->db->where('b.end_date >=', date('Y-m-d')); 
    $query = $this->db->get();
    if($query->num_rows()){
      $row = $query->row();
      return $row->amount;
    }

    return 0;
   }


  
}
