<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Loan_crone_model extends CI_Model {
	public function __construct() {
			parent::__construct();
			$this->load->library("session");
	}

	function allLoanRecord($user_id = ''){
    $this->db->select('a.*,b.*, c.*,c.id as `cid`, b.id as `bid`, a.id as `id`, a.status as `status`,  a.createdAt as `createdAt`'); 
    $this->db->from(TBL_LOAN.' a');
    $this->db->join(TBL_LOANDETAIL.' b', 'a.id = b.loan_id'); 
    $this->db->join(TBL_USER.' c', 'a.user_id = c.id');
    if($user_id){
      $this->db->where("a.user_id", $user_id);
    }
		$this->db->where("a.status", 1);
    $this->db->where("a.apply_status", 1);
    $this->db->order_by("a.id", "desc");
    $query = $this->db->get(); 
		if($query->num_rows() > '0'){
				return $query->result();
		}
		return NULL;
  }

	function check_payment_date($loan_id){
		$this->db->where('loan_id', $loan_id);
		$this->db->where('payment_date',date('Y-m-d'));
		$this->db->where('status',0);
		$this->db->from(TBL_LOAN_PAYMENT_DATE);
		$query = $this->db->get();
		if($query->num_rows()>0){
			return true;
		}
		return false;
	}

	function insert_loan_payment($line){
		$loan_id = $line->id;
		$ins['loan_id'] = $loan_id;
		$ins['user_id'] = $line->user_id;
		$ins['amount'] = $line->install_amount;
		$ins['interest_rate'] = $line->interest_rate;
		$ins['interest_amount'] = ($line->install_amount*$line->interest_rate)/100;
		$this->db->insert(TBL_LOAN_PAYMENT,$ins);
		$loan_payment_id = $this->db->insert_id();

		//update loan payment date
		$data   = array(
			'status'    => 1
		);
		$this->db->where('loan_id', $loan_id);
		$this->db->where('payment_date',date('Y-m-d'));
		$this->db->update(TBL_LOAN_PAYMENT_DATE,$data);

		$this->insert_fund_history($line);
	}

	function insert_earned_interest($ins,$inpid){
		$ins['loan_payment_id'] = $inpid;
		$this->db->insert(TBL_EARNED_INTEREST,$ins);
		return true;
	}

	function insert_fund_history($line){
		$ins['loan_id'] = $line->id;
		$ins['mode'] = 'Loan';
		$ins['message'] = "Loan Payment successfully";
		$ins['user_id'] = $line->user_id;
		$ins['amount'] = $line->install_amount;
		$ins['detail'] = JSON_ENCODE($line);
		$ins['status'] = 1;
		$ins['in_out'] = 'OUT';
		$data = $this->db->insert(TBL_FUND_HISTORY,$ins);
		$this->insertInterestinfund($line);
		return $data;
	}

	function insertInterestinfund($line){
		$ins['loan_id'] = $line->id;
		$ins['mode'] = 'Loan';
		$ins['message'] = "Loan Interest amount deducted successfully";
		$ins['user_id'] = $line->user_id;
		$ins['amount'] = ($line->install_amount*$line->interest_rate)/100;
		$ins['detail'] = JSON_ENCODE($line);
		$ins['status'] = 1;
		$ins['in_out'] = 'OUT';
		$data = $this->db->insert(TBL_FUND_HISTORY,$ins);
	}
}

?>