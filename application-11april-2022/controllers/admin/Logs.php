<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Logs extends MY_Controller {
    
    function __construct() {
          parent::__construct();
          check_admin_login();    
          $this->header_data['headTitle'] = "Nuvest : Admin Customer Log";  
          $this->load->model('log_model'); 
     }

     function index(){  
        if($this->input->post()){
            $fromDate = $this->input->post('fromdate');
             $toDate = $this->input->post('todate');
            $query = '?1=1';
            if(isset($fromDate) & isset($toDate)){
              $query = $query."&fromdate=".$fromDate."&todate=".$toDate;
            }
            
            redirect(base_url('admin/logs/index'.$query));
        }
        $this->data['users'] = $this->log_model->get_all_user();
        $this->render('admin/logs/index'); 
     }

     function detail($user_id){
        $this->data['userdeail'] = $this->log_model->user_detail($user_id);
        $this->data['logdetail'] = $this->log_model->get_log_detail($user_id);
         $this->render('admin/logs/detail');
     }

     function agent(){  
      $this->header_data['headTitle'] = "Nuvest : Admin Agent Log"; 
        if($this->input->post()){
            $fromDate = $this->input->post('fromdate');
             $toDate = $this->input->post('todate');
            $query = '?1=1';
            if(isset($fromDate) & isset($toDate)){
              $query = $query."&fromdate=".$fromDate."&todate=".$toDate;
            }
            
            redirect(base_url('admin/logs/agent'.$query));
        }
        $this->data['users'] = $this->log_model->get_all_agent();
        $this->render('admin/logs/agent/index'); 
     }

     function agent_detail($user_id){
      $this->header_data['headTitle'] = "Nuvest : Admin Agent Log"; 
      $this->data['userdeail'] = $this->log_model->agent_detail($user_id);
        $this->data['logdetail'] = $this->log_model->get_agent_log_detail($user_id);
         $this->render('admin/logs//agent/detail');
     }
}

?>