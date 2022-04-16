<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Referapp extends MY_Controller {
    
    function __construct() {
          parent::__construct();
          $this->load->model('referapp_model');
          check_admin_login();    
          $this->header_data['headTitle'] = "Nuvest : Admin Refer Friend";   
     }

     function index(){
        $this->data['all_record'] = $this->referapp_model->get_all_record(); 
        $this->render('admin/referapp/view'); 
     }
}