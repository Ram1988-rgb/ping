<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Reports extends MY_Controller {
    
    function __construct() {
          parent::__construct();
          check_admin_login();    
          $this->header_data['headTitle'] = "Nuvest : Admin Sms Email";   
     }

     function index(){       
        $this->render('admin/reports/index'); 
     }
}

?>