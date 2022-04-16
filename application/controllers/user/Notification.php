<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Notification extends MY_Controller {
    
    function __construct() {
          parent::__construct();
          $this->load->model('notification_model');
          check_front_login();
          $this->customerId = $this->session->userdata('CUSTOMERID');
       }
       
    public function index(){
      $this->header_data['headTitle'] = "Nuvest : Customer Notification"; 
      $this->data['all_record'] = $this->notification_model->allRecord($this->customerId);
      $this->render('front/notification/notification');
    }
}