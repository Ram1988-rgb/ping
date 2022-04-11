<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Smsemail extends MY_Controller {
    
    function __construct() {
          parent::__construct();
          check_front_login();    
          $this->header_data['headTitle'] = "Nuvest : Customer Sms Email";   
     }

     function index(){       
        $this->render('front/smsemail/index'); 
     }
}

?>