<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Interest extends MY_Controller {
    
	function __construct() {
		parent::__construct();
		$this->load->model('interest_model');
		check_front_login();
	}

	public function earned()
	{   
			$this->header_data['headTitle'] = "Nuvest : Customer Interest Earned";
			$this->data['all_record'] = $this->interest_model->get_interest_earned_data($this->session->userdata('CUSTOMERID'));
			$this->render('front/interest/view');
	}
}