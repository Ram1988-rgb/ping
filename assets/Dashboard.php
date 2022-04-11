<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Dashboard extends MY_Controller {
    
    function __construct() {
          parent::__construct();
          //check_front_login();
       }
    
 /**
  * @access public
  * 
  */   
public function index()
{   
    $this->render('front/dashboard');
}

public function logout(){
    $this->session->unset_userdata('CUSTOMERID');
    $this->session->unset_userdata('CUSTOMERNAME');
    redirect('/');
}
 //End of class    
}

