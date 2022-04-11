<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cashout_model extends CI_Model {

  public function __construct() {
      parent::__construct();
      $this->load->library("session");
  }
  
  public function list_cashout_type(){
    $this->db->where("status", '1');    
    $this->db->order_by('sequence', 'ASC');
    $query = $this->db->get(TBL_CASHOUT_TYPE);
    return $query->result();
  }
  public function list_wallet(){
    $this->db->where("status", '1');    
    $this->db->order_by('sequence', 'ASC');
    $query = $this->db->get(TBL_WALLET);
    return $query->result();
  }

  public function wallet_detail($id){
    $this->db->where("id", $id);    
    $this->db->order_by('sequence', 'ASC');
    $query = $this->db->get(TBL_WALLET);
    return $query->row();
  }

  public function cashout($post){
    if($post!=NULL)
      {
          $cashout_type_detail = $this->cashout_type_detail($post['cashout_type_id']);
          $ins['cashout_type_id']   = $post['cashout_type_id'];
          $ins['user_id']   = $post['user_id'];
          $ins['cashout_type_detail']   = JSON_ENCODE($cashout_type_detail);
          $ins['amount']   = $post['amount'];
          if($cashout_type_detail->code == "BANK_DEPOSITE"){
            $ins['bank_id']   = $post['bank_id'];
            $ins['bank_detail']   = JSON_ENCODE($post['bank_detail']);
          }
          if($cashout_type_detail->code == "MOBILE_WALLET"){
            $ins['wallet_id']   = $post['wallet_id'];
            $ins['wallet_detail']   = JSON_ENCODE($this->wallet_detail($post['wallet_id']));
          }
          if($cashout_type_detail->code == "LOCAL_AGENT"){
            $ins['agent_mobile']   = $post['agent_mobile'];
            $ins['agent_code']   = $post['agent_code'];
          }
          $ins['withdrawl_to'] =
          $ins['status']   = 1;     
          if($id = $this->db->insert(TBL_CASHOUT,$ins))
          {
            $this->insert_fund_history($id,$post);
              return TRUE;
          }
          
      }
      return FALSE;
  }

  public function addcashout($post){
    $cashout_type_detail = $this->cashout_type_detail($post['cashout_type_id']);
    $ins['user_id']   = $post['user_id'];
    $ins['amount']   = $post['amount'];
    $ins['cashout_type_id'] = $post['cashout_type_id'];
    if($cashout_type_detail->code == "BANK_DEPOSITE"){      
      $ins['cashout_type_detail']   = JSON_ENCODE($cashout_type_detail);
      $ins['bank_id']   = $post['bank_id'];
      $ins['bank_detail']   = JSON_ENCODE($post['bank_detail']);
      $type='bank';
    }
    if($cashout_type_detail->code == "MOBILE_WALLET"){
      $ins['wallet_id']   = $post['wallet_id'];
      $ins['wallet_detail']   = JSON_ENCODE($this->wallet_detail($post['wallet_id']));
      $type='mobile wallet';
      
    }
    if($cashout_type_detail->code == "LOCAL_AGENT"){
      $ins['agent_mobile']   = $post['agent_mobile'];
      $ins['agent_code']   = $post['agent_code'];
      $type='agent';
    }
    $ins['withdrawl_to'] = $post['withdrawl_to'];
    $ins['status']   = 1;  
    if( $this->db->insert(TBL_CASHOUT,$ins))
    {
      $id = $this->db->insert_id();
      if($ins['withdrawl_to'] =="LOAN"){
        $ins['id'] = $id;
        $ins['type'] = $type;
        $this->insert_loan_history($ins,'OUT');
        send_transfer_notification($ins);
      }else{
        $this->insert_fund_history($id,$post);
        sendCashoutNotification($ins,'WEB');
      }
      
      if($cashout_type_detail->code == "LOCAL_AGENT"){
       $this->insert_agent_fund($id,$post);
      }
     // $line = $this->cashout_detail($id);
      
      return TRUE;
    }

  }

  function insert_loan_history($detail,$operation){
     $ins['amount'] = $detail['amount'];
     $ins['user_id'] = $detail['user_id'];
     $ins['cash_out_id'] = $detail['id'];
     $ins['operation'] = $operation;
     $ins['status'] = '1';
     $this->db->insert(TBL_LOAN_HISTORY,$ins);
  }

  public function insert_fund_history($id, $post){
    $line = $this->cashout_detail($id);
    $ins['cashout_id'] = $line->id;
		$ins['mode'] = 'Cashout';
		$ins['message'] = "Cashout Payment successfully";
		$ins['user_id'] = $line->user_id;
		$ins['amount'] = $line->amount;
		$ins['detail'] = JSON_ENCODE($line);
		$ins['status'] = 1;
		$ins['in_out'] = 'OUT';
		$data = $this->db->insert(TBL_FUND_HISTORY,$ins);
		return $data;
  }

  public function insert_agent_fund($id, $post){
    $line = $this->cashout_detail($id);
    $ins['agent_id'] = $post['agent_id'];
		$ins['cashout_type_id'] = $id;
		$ins['amount'] = $post['amount'];
		$ins['user_id'] = $line->user_id;
		//$ins['detail'] = JSON_ENCODE($line);
    $ins['operation_type'] = 'IN';
		$ins['status'] = 1;
    $data = $this->db->insert(TBL_AGENTFUND,$ins);
		return $data;
  }

  public function cashout_type_detail($id){
    $this->db->where("id", $id);    
    $this->db->order_by('sequence', 'ASC');
    $query = $this->db->get(TBL_CASHOUT_TYPE);
    return $query->row();
  }
  public function cashout_detail($id){
    $this->db->where("id", $id);
    $query = $this->db->get(TBL_CASHOUT);
    if($query->num_rows()>0){
      return $query->row();
    }
    return null;
  }

  function get_total_loan_transfer($user_id){
    $this->db->select_sum('amount');
    //$this->db->select('amount');
    $this->db->where('withdrawl_to', 'LOAN');
    $this->db->from(TBL_CASHOUT);
    $query = $this->db->get();
    if($query->num_rows()>0){
      return $query->row();
    }
  }

  function get_loan_balance($user_id){
   $in = $this->get_total_loan($user_id, 'IN');
  //echo "<br/>";
    $out = $this->get_total_loan($user_id, 'OUT'); 
   return $balance = $in-$out;
  }

  function get_total_loan($user_id ='',$op){
    
    $this->db->select_sum('amount');
    if($user_id){
    $this->db->where('user_id', $user_id);
    }
    $this->db->where('operation', $op);
    $this->db->from(TBL_LOAN_HISTORY);
    $query = $this->db->get();
    $amount =0;
    if($query->num_rows()>0){
      $row= $query->row();
      $amount = $row->amount;
    }
    //echo $amount;die;
    return $amount;
  }
  

}
?>
