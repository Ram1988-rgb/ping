<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Investment_crone_model extends CI_Model {

	public function __construct() {
			parent::__construct();
			$this->load->library("session");
	}

	function allInvestmentRecord($user_id = null){
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

	public function check_payment_date($cash_id){
		$this->db->where('investment_id', $cash_id);
		$this->db->where('payment_date',date('Y-m-d'));
		$this->db->where('status',0);
		$this->db->from(TBL_INVESTMENT_PAYMENT_DATE);
		$query = $this->db->get();
		if($query->num_rows()>0){
			return true;
		}
		return false;
	}

	public function insert_investment_payment($line){
		$investment_id = $line->id;
		$ins['investment_id'] = $investment_id;
		$ins['user_id'] = $line->user_id;
		$ins['amount'] = $line->amount;
		$ins['interest_rate'] = $line->interest_rate;
		$ins['interest_amount'] = ($line->amount*$line->interest_rate)/100;
		$this->db->insert(TBL_INVESTMENT_PAYMENT,$ins);
		$investment_payment_id = $this->db->insert_id();

		//update cash payment date
		$data   = array(
			'status'    => 1
		);
		$this->db->where('investment_id', $investment_id);
		$this->db->where('payment_date',date('Y-m-d'));
		$this->db->update(TBL_INVESTMENT_PAYMENT_DATE,$data);

		//earned interest
		$this->insert_earned_interest($ins,investment_payment_id);

		//insert  fund history
		$this->insert_fund_history($line);
		
	}

		
	function insert_earned_interest($ins,$inpid){
		$ins['investment_payment_id'] = $inpid;
		$this->db->insert(TBL_EARNED_INTEREST,$ins);
		return true;
	}

	function insert_fund_history($line){
		$ins['investment_id'] = $line->id;
		$ins['mode'] = 'Investment';
		$ins['message'] = "Invest Payment successfully";
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
		$ins['investment_id'] = $line->id;
		$ins['mode'] = 'Investment';
		$ins['message'] = "Invest Interest amount added successfully";
		$ins['user_id'] = $line->user_id;
		$ins['amount'] = ($line->amount*$line->interest_rate)/100;
		$ins['detail'] = JSON_ENCODE($line);
		$ins['status'] = 1;
		$ins['in_out'] = 'IN';
		$data = $this->db->insert(TBL_FUND_HISTORY,$ins);
	}


}
?>