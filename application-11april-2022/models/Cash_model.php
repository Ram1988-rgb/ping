<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cash_model extends CI_Model {

  public function __construct() {
      parent::__construct();
      $this->load->library("session");
  }

  public function save_data($post){
    if($post!=NULL)
      { 
        $plan_rate =  $this->plan_model->getPlanPaymentDuration($_POST['plan_id'],$_POST['payment_duration']);
          // print_r($plan_rate);
          $post['plan_rate'] =  isset($plan_rate )? $plan_rate->rate: 0;     
        $ins['user_id'] =  $post['user_id'];
        $ins['payment_type_id'] = $post['payment_type'];
        $ins['payment_duration_id'] = $post['payment_duration'];
        $ins['amount'] = $post['amount'];
        $ins['plan_id'] = $post['plan_id'];
        $ins['interest_rate'] = isset($plan_rate )? $plan_rate->rate: 0;
        $ins['start_date'] = insertFormateDate($post['start_date']);
        $ins['status'] = 0;
        $ins['deletedAt'] = 0;   
        if($post['comes_from']){
          $ins['amount_comes_from_id'] = $post['comes_from'];
        }    
        if($this->db->insert(TBL_CASH,$ins))
        {
          $id = $this->db->insert_id();
          $this->manageCashDetail($id, $post);
          return $id;
        }
      }
      return false;
  }

  function manageCashDetail($cashId, $post){
    $paymentType = getRecord($post['payment_type'], TBL_PAYMENTTYPE);
    $paymentDuration = getRecord($post['payment_duration'], TBL_PAYMENTDURATION);
    $plan = getRecord($post['plan_id'], TBL_PLAN);
    $mInstallment = manageInstallment($paymentType->days, $paymentDuration->month, insertFormateDate($post['start_date']), $post['amount']);
    // update TBL_CASH
    $this->db->where('id', $cashId);
    $this->db->update(TBL_CASH, array(
      'install_amount' => $mInstallment['installment_amount'],
      'days_between' => $mInstallment['days_between'],
      'end_date' => $mInstallment['endDate'],
      'installment_count' => $mInstallment['countInstallment'],
    ));

    //add cashdetail
    $ins['cash_id'] = $cashId;
    $ins['plan_rate'] = $post['plan_rate'];
    $ins['payment_type_data'] = JSON_ENCODE($paymentType);
    $ins['payment_deuration_data'] = JSON_ENCODE($paymentDuration);;
    $ins['plan_data'] = JSON_ENCODE($plan);
    if($this->db->insert(TBL_CASHDETAIL,$ins))
    {
      return true;
    }
    return false;
  }

  public function getCashDetail($id){
	  $this->db->select('a.*,b.*,c.*,c.id as `cid`, b.id as `bid`, a.id as `id`, a.status as `status`, a.createdAt as `createdAt`'); 
    $this->db->from(TBL_CASH.' a');    
    $this->db->join(TBL_CASHDETAIL.' b', 'a.id = b.cash_id'); 
    $this->db->join(TBL_USER.' c', 'a.user_id = c.id');
	  $this->db->where('a.id',$id);
	
    $query = $this->db->get(); 
    return $query->row();
 	}
  
  public function allRecord($user_id=''){
		$this->db->select('a.*,b.*, c.*, c.id as `cid`, b.id as `bid`, a.id as `id`, a.status as `status`'); 
    $this->db->from(TBL_CASH.' a');
    if($user_id){
      $this->db->where('a.user_id',$user_id);
    }
    $this->db->join(TBL_CASHDETAIL.' b', 'a.id = b.cash_id'); 
    $this->db->join(TBL_USER.' c', 'a.user_id = c.id');
    $this->db->order_by('a.id', 'DESC');
    $query = $this->db->get(); 
    return $query->result();
 	}

   public function active_cash_record($user_id =''){
    
    $this->db->select('a.*,b.*, c.*, c.id as `cid`, b.id as `bid`, a.id as `id`, a.status as `status`'); 
    $this->db->from(TBL_CASH.' a');
    if($user_id){
      $this->db->where('a.user_id',$user_id);
    }
    $this->db->where('a.start_date <=',date('Y-m-d'));
    $this->db->where('a.end_date >=',date('Y-m-d'));
    $this->db->where('a.status',1);
    $this->db->join(TBL_CASHDETAIL.' b', 'a.id = b.cash_id'); 
    $this->db->join(TBL_USER.' c', 'a.user_id = c.id');
    $query = $this->db->get(); 
    return $query->result();
   }

   function insert_payment_date($id){
     $cashDetail = $this->getCashDetail($id);
     $payment_detail = $this->getPaymentType($cashDetail->payment_type_id);
     $start_date =$cashDetail->start_date;
     $end_date =$cashDetail->end_date;
     $ins['payment_type'] = $payment_detail->label;
     $ins['cash_id'] = $id;
    
      $ins['payment_date'] =  $cashDetail->start_date;
      $this->db->insert(TBL_CASH_PAYMENT_DATE,$ins);
     
     if($payment_detail->days ==1){      
      while($start_date <= $end_date) {        
        $start_date = date('Y-m-d', strtotime("+1 days", strtotime($start_date)));
        $ins['payment_date'] =  $start_date;
        if($start_date < $end_date){
         $this->db->insert(TBL_CASH_PAYMENT_DATE,$ins);
        }
      }
     }

     if($payment_detail->days ==7){      
      while($start_date < $end_date) {        
        $start_date = date('Y-m-d', strtotime("+1 weeks", strtotime($start_date)));
        $ins['payment_date'] =  $start_date;
        if($start_date < $end_date){
         $this->db->insert(TBL_CASH_PAYMENT_DATE,$ins);
        }
      }
     }

     if($payment_detail->days ==30){
      while($start_date < $end_date) {        
        $start_date = date('Y-m-d', strtotime("+1 months", strtotime($start_date)));
        $ins['payment_date'] =  $start_date;
        if($start_date < $end_date){
         $this->db->insert(TBL_CASH_PAYMENT_DATE,$ins);
        }
      }
    }

      if($payment_detail->days ==365){
        while($start_date < $end_date) {        
          $start_date = date('Y-m-d', strtotime("+1 years", strtotime($start_date)));
          $ins['payment_date'] =  $start_date;
          if($start_date < $end_date){
            $this->db->insert(TBL_CASH_PAYMENT_DATE,$ins);
          }
        }

      }
   }

   public function getPaymentType($id){
     $this->db->where('id', $id);
     $this->db->from(TBL_PAYMENTTYPE);
     return $this->db->get()->row();
     //echo $this->db->last_query();

   }

   function get_cash_payment($cash_id){
    $this->db->where('cash_id', $cash_id);
		$this->db->from(TBL_CASH_PAYMENT);
		$query = $this->db->get();
    if($query->num_rows()>0){
      return $query->result();
    }
    return NULL;
   }

   function get_cash_payment_data($cash_id){
    $this->db->select('a.*,b.*, b.id as `bid`, a.id as `id`, a.status as `status`, a.payment_date as `cpdate`'); 
    $this->db->where('a.cash_id', $cash_id);
    $this->db->from(TBL_CASH_PAYMENT_DATE.' a');
    $this->db->join(TBL_CASH_PAYMENT.' b', 'a.id = b.cash_payment_date_id', 'LEFT');
    $query = $this->db->get();
   // echo $this->db->last_query(); 
    return $query->result();
   }

  function get_cash_payment_detail($id){
    $this->db->where('id', $id);
		$this->db->from(TBL_CASH_PAYMENT);
		$query = $this->db->get();
    if($query->num_rows()>0){
      return $query->row();
    }
    return NULL;
   }

   function cash_payment_date_detail($id){
    $this->db->where('id', $id);
		$this->db->from(TBL_CASH_PAYMENT_DATE);
		$query = $this->db->get();
    //echo $this->db->last_query();
    if($query->num_rows()>0){
      return $query->row();
    }
    return NULL;
   }

   function insert_fund_history($pdetail){
    $ins['cash_id'] = $pdetail->cash_id;
		$ins['mode'] = 'Cash';
		$ins['message'] = "Interest amount added successfully";
		$ins['user_id'] = $pdetail->user_id;
		$ins['amount'] = $pdetail->interest_amount;
		$ins['detail'] = JSON_ENCODE($pdetail);
		$ins['status'] = 1;
		$ins['in_out'] = 'IN';
		$data = $this->db->insert(TBL_FUND_HISTORY,$ins);
    sendCashInterestNotification($ins,'WEB');
		return $data;
   }

   function update_cash_payment($id){
    $this->db->where('id', $id);
    $this->db->update(TBL_CASH_PAYMENT, array(
      'move_to_wallet' => 1      
    ));
   }

   function get_total_cash($user_id = ''){
    $this->db->select_sum('amount');
    $this->db->select('amount');
    $this->db->where('status',1);
    $this->db->from(TBL_CASH);
    
    $query = $this->db->get();
    if($query->num_rows()>0){
      return $query->row();
    }
    return 0;
   }

   public function get_one_list_forapp($cash_id, $user_id){
    $this->db->select('a.*,b.*,c.*,c.id as `cid`, b.id as `bid`, a.id as `id`, a.status as `status`, a.createdAt as `createdAt`'); 
    $this->db->from(TBL_CASH.' a');   
    $this->db->where('a.id', $cash_id); 
    $this->db->where('a.user_id', $user_id); 
    $this->db->join(TBL_CASHDETAIL.' b', 'a.id = b.cash_id'); 
    $this->db->join(TBL_USER.' c', 'a.user_id = c.id');
	
    $query = $this->db->get(); 
    return $query->row();
   }

   public function get_all_list_forapp($user_id){
    $this->db->select('a.*,b.*,c.*,c.id as `cid`, b.id as `bid`, a.id as `id`, a.status as `status`, a.createdAt as `createdAt`'); 
    $this->db->from(TBL_CASH.' a');   
    //$this->db->where('a.status', 1); 
    $this->db->where('a.user_id', $user_id); 
    $this->db->join(TBL_CASHDETAIL.' b', 'a.id = b.cash_id'); 
    $this->db->join(TBL_USER.' c', 'a.user_id = c.id');
    $this->db->order_by('a.id','DESC');
	
    $query = $this->db->get(); 
    return $query->result();
   }

   function change_status($id){
    $this->db->where('id', $id);
		$this->db->from(TBL_CASH);
		$query = $this->db->get();
    if($query->num_rows()>0){
      $row =  $query->row();
      $status = 1;
      if($row->status ==1){
        $status =0;
      }
      $this->db->where('id', $id);
      $this->db->update(TBL_CASH, array(
        'status' => $status     
      ));
      if($status){
        if($row->start_date == date('Y-m-d')){
          if($cash_payment_id = $this->check_cash_payment($id)){
            $cashDetail =  $this->getCashDetail($id);
            $this->updateFundHistory($cashDetail, $cash_payment_id);
          
          }
        }
      }
      return $status;
    }
    return 0;
   }

   function check_cash_payment($cash_id){
    $this->db->where('cash_id',$cash_id);
    $this->db->where('payment_date',date('Y-m-d'));
    $this->db->where('status',0);
    $query = $this->db->get(TBL_CASH_PAYMENT_DATE);
    if($query->num_rows()){
      $row = $query->row();
      return $row->id;
    }
   }

  function updateFundHistory($pdetail, $cash_payment_id, $cpDdate ='') {  
    // cash deduct 
    $ins['cash_id'] = $pdetail->cash_id;
		$ins['mode'] = 'Cash';
		$ins['message'] = "Amount has been Deducted successfully";
		$ins['user_id'] = $pdetail->user_id;
		$ins['amount'] = $pdetail->amount;
		$ins['detail'] = JSON_ENCODE($pdetail);
		$ins['status'] = 1;
		$ins['in_out'] = 'OUT';
		$data = $this->db->insert(TBL_FUND_HISTORY,$ins);
    sendCashPaidNotification($ins);
    //interest_amount
    if(!$cpDdate){
      $inr['cash_id'] = $pdetail->cash_id;
      $inr['mode'] = 'Cash';
      $inr['message'] = "Interest amount has been Added successfully";
      $inr['user_id'] = $pdetail->user_id;
      $inr['amount'] = ($pdetail->amount*$pdetail->interest_rate)/100;
      $inr['detail'] = JSON_ENCODE($pdetail);
      $inr['status'] = 1;
      $inr['in_out'] = 'IN';
      $inr['interest_status'] = 1;
      $data = $this->db->insert(TBL_FUND_HISTORY,$inr);
      sendCashInterestNotification($inr,'WEB');
    }

    //update cash_payment_date
    if(!$cpDdate){
      $inp['move_to_wallet'] = 1;
    }
    if(!$cpDdate){
      $cpDdate = date('Y-m-d');
    }
    $this->db->where('cash_id',$pdetail->cash_id);
    $this->db->where('payment_date',$cpDdate);
    $this->db->update(TBL_CASH_PAYMENT_DATE, array(
      'status' => 1    
    ));

    //insert cash_payment
      $inp['cash_id'] = $pdetail->cash_id;
      $inp['cash_payment_date_id'] = $cash_payment_id;
      $inp['user_id'] = $pdetail->user_id;
      $inp['amount'] = $pdetail->amount;
      $inp['interest_rate'] = $pdetail->interest_rate;
      $inp['interest_amount'] = ($pdetail->amount*$pdetail->interest_rate)/100;
      
      $data = $this->db->insert(TBL_CASH_PAYMENT,$inp);
      $inpd = $this->db->insert_id();
      
      //interest earned
      $er['cash_id'] = $pdetail->cash_id;
      $er['user_id'] = $pdetail->user_id;
      $er['cash_payment_id'] = $inpd;
      $er['amount'] = $pdetail->amount;
      $er['interest_rate'] = $pdetail->interest_rate;
      $er['interest_amount'] = ($pdetail->amount*$pdetail->interest_rate)/100;;
      $er['module'] = 'Cash';
      $data = $this->db->insert(TBL_EARNED_INTEREST,$er);
      return $inpd;

  }

  function get_cash_saving($user_id=''){
    $this->db->select_sum('a.amount'); 
    $this->db->from(TBL_CASH_PAYMENT.' a');
    $this->db->join(TBL_CASH.' b', 'a.cash_id = b.id'); 
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
     
}
?>
