<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cashcrone_model extends CI_Model {

  public function __construct() {
      parent::__construct();
      $this->load->library("session");
  }
  public function allRecord($user_id=''){
		$this->db->select('a.*,b.*, b.id as `bid`, a.id as `id`, a.status as `status`'); 
		$this->db->from(TBL_CASH.' a');  
		$this->db->where('a.status',1);  
		$this->db->join(TBL_CASHDETAIL.' b', 'a.id = b.cash_id'); 
		$this->db->order_by('a.id', 'DESC');
		$query = $this->db->get(); 
		return $query->result();
  }

	public function check_payment_date($cash_id){
		$this->db->where('cash_id', $cash_id);
		$this->db->where('payment_date',date('Y-m-d'));
		$this->db->where('status',0);
		$this->db->from(TBL_CASH_PAYMENT_DATE);
		$query = $this->db->get();

		if($query->num_rows()>0){
			$row = $query->row();
			return $row->id;
		}
		return false;
	}

	public function insert_cash_payment($line, $cash_payment_date_id){
		$cash_id = $line->id;
		$ins['cash_id'] = $cash_id;
		$ins['user_id'] = $line->user_id;
		$ins['amount'] = $line->amount;
		$ins['interest_rate'] = $line->interest_rate;
		$ins['cash_payment_date_id'] = $line->cash_payment_id;
		$ins['interest_amount'] = ($line->amount*$line->interest_rate)/100;
		$this->db->insert(TBL_CASH_PAYMENT,$ins);
		$cash_payment_id = $this->db->insert_id();

		//update cash payment date
		$data   = array(
			'status'    => 1
		);
		$this->db->where('cash_id', $cash_id);
		$this->db->where('payment_date',date('Y-m-d'));
		$this->db->update(TBL_CASH_PAYMENT_DATE,$data);

		//insert  fund history
		$this->insert_fund_history($line);
		
	}
	function insert_earned_interest($ins,$inpid){
		$ins['cash_payment_id'] = $inpid;
		$this->db->insert(TBL_EARNED_INTEREST,$ins);
		return true;
	}

	function insert_fund_history($line){
		$ins['cash_id'] = $line->id;
		$ins['mode'] = 'Cash';
		$ins['message'] = "Cash Payment successfully";
		$ins['user_id'] = $line->user_id;
		$ins['user_id'] = $line->user_id;
		$ins['amount'] = $line->amount;
		$ins['detail'] = JSON_ENCODE($line);
		$ins['status'] = 1;
		$ins['in_out'] = 'OUT';
		$data = $this->db->insert(TBL_FUND_HISTORY,$ins);
		$this->insertInterestinfund($line);
		return $data;
	}

	function insertInterestinfund($line){
		return true;
		$ins['cash_id_id'] = $line->id;
		$ins['mode'] = 'Cash';
		$ins['message'] = "Cash Interest amount added successfully";
		$ins['user_id'] = $line->user_id;
		$ins['amount'] = ($line->amount*$line->interest_rate)/100;
		$ins['detail'] = JSON_ENCODE($line);
		$ins['status'] = 1;
		$ins['in_out'] = 'IN';
		$data = $this->db->insert(TBL_FUND_HISTORY,$ins);
	}

}