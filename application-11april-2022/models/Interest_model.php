<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Interest_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->library("session");
		$this->load->model('interest_model');
		$this->load->model('cash_model');
		$this->load->model('loan_model');
	}
	
	function get_interest_earned_data($user_id=''){
		if($user_id){
			$this->db->where('user_id', $user_id);
		}
		$this->db->from(TBL_EARNED_INTEREST);
		$this->db->order_by('id','DESC');
		$query = $this->db->get();
		if($query->num_rows()>0){
			$rows = $query->result();
			return asiatimezone($rows);
		}
		return null;
	}
	function get_plan($record){
		if($record->investment_id){
			$invDetail = $this->investment_detail($record->investment_id);
			$plan_id = $invDetail->plan_id;
			$plan = $this->get_plan_data($plan_id);
			return $plan->name;
		}
		if($record->cash_id){
			$cashDetail = $this->cash_detail($record->cash_id);
			$plan_id = $cashDetail->plan_id;
			$plan = $this->get_plan_data($plan_id);
			return $plan->name;
		}
		if($record->loan_id){
			$loanDetail = $this->loan_detail($record->loan_id);
			if($loanDetail){
				$plan_id = $loanDetail->plan_id;
				$plan = $this->get_plan_data($plan_id);
				return $plan->name;
			}else{
				return '-';
			}
		}
	}

	function investment_detail($id){
		$this->db->where('id', $id);
		$this->db->from(TBL_INVESTMENTS);
		$query = $this->db->get();
		if($query->num_rows()>0){
			return $rows = $query->row();
			
		}
		return null;
	}
	function cash_detail($id){
		$this->db->where('id', $id);
		$this->db->from(TBL_CASH);
		$query = $this->db->get();
		if($query->num_rows()>0){
			return $rows = $query->row();
			
		}
		return null;
	}
	function loan_detail($id){
		$this->db->where('id', $id);
		$this->db->from(TBL_LOAN);
		$query = $this->db->get();
		if($query->num_rows()>0){
			return $rows = $query->row();
			
		}
		return null;
	}

	function get_plan_data($plan_id){
		$this->db->where('id', $plan_id);
		$this->db->from(TBL_PLAN);
		$query = $this->db->get();
		if($query->num_rows()>0){
			return $rows = $query->row();
			
		}
		return null;
	}
}