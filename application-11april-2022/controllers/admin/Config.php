<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Config extends MY_Controller {
    function __construct() {
        parent::__construct();
        check_admin_login();   
        $this->load->model('config_model');
        $this->header_data['headTitle'] = "Nuvest : Configuration setting ";   
     }

     function index(){
         if($_POST){
             foreach($_POST['config'] as $key=>$value){
                $this->config_model->update($key,$value);
             }             
            $this->session->set_flashdata('success', 'Data has been updated successfully');
            redirect("admin/config/index");
            
         }
        $this->data['all_record'] = $this->config_model->get_all_record();    
        $this->render('admin/configuration/index');
     }
}