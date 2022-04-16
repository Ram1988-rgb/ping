<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Crone extends MY_Controller {    
	function __construct() {
			parent::__construct();   
			$this->load->model('cashcrone_model');
			$this->load->model('investment_crone_model');
			$this->load->model('loan_crone_model');
			$this->header_data['headTitle'] = "Nuvest : Create Subadmin ";   
		}
	//cash pauyment daily /weekly/ monthly yearly
	function cashpayment(){
		$data = $this->cashcrone_model->allRecord();	
		foreach($data as $line){
			if($cash_payment_date_id = $this->cashcrone_model->check_payment_date($line->cash_id)){
				$this->cashcrone_model->insert_cash_payment($line, $cash_payment_date_id);
			}
		}		
	}	

	function investment_payment(){
		$data = $this->investment_crone_model->allInvestmentRecord();
		if(sizeof($data)){
			foreach($data as $line){
				if($this->investment_crone_model->check_payment_date($line->investment_id)){
					$this->investment_crone_model->insert_investment_payment($line);
				}
			}
		}
	}

	function loan_payment(){
		$data = $this->loan_crone_model->allLoanRecord();
		if(sizeof($data)){
			foreach($data as $line){
				if($this->loan_crone_model->check_payment_date($line->loan_id)){
					$this->loan_crone_model->insert_loan_payment($line);
				}
			}
		}
	}

	
}

?>