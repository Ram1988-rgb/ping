<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Referapp extends MY_Controller {
    
    function __construct() {
          parent::__construct();
          $this->load->model('referapp_model');
          check_front_login();       
     }

     function index(){
        $this->header_data['headTitle'] = "Nuvest : Customer Refer Friend";
         if($this->input->post()){
             $_POST['user_id'] = $this->session->userdata('CUSTOMERID');
             $add = $this->referapp_model->add($this->security->xss_clean($this->input->post()));
             if($add){
                $this->session->set_flashdata('success', 'Information successfully added');
                redirect('user/referapp');
             }
            $this->session->set_flashdata('errordata', 'Something went wrong try again');
            redirect("/user/referapp");
         }
        $this->render('front/referapp/add'); 
     }
}