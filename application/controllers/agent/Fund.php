<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Fund extends MY_Controller {
    
    function __construct() {
          parent::__construct();
          //check_agent_login();
          $this->load->model('agentfund_model');
          $this->load->model('user_model');
          $this->header_data['headTitle'] = "Nuvest : Manage Agent Fund";
          $this->agentId = $this->session->userdata('AGENTID');
       }
    
    function request(){
        $this->header_data['headTitle'] = "Nuvest : Agent Fund Request";
        $this->data['total_fund'] = $this->agentfund_model->get_total_fund($this->agentId);
        $this->data['all_record'] = $this->agentfund_model->fund_request($this->agentId);
        $this->render('agent/fund/fund_request');
    }

    function history(){
        $this->header_data['headTitle'] = "Nuvest : Agent Fund History";
        $this->data['total_fund'] = $this->agentfund_model->get_total_fund($this->agentId);
        $this->data['all_record'] = $this->agentfund_model->fund_history($this->agentId);
        $this->render('agent/fund/fund_history');
    }

    function addfund(){
        if($this->input->post()){
            $res = $this->agentfund_model->check_user($this->security->xss_clean($_POST));
            if(!$res){
                $this->session->set_flashdata('errordata', 'User is not valid. Please try another.');
                redirect("/agent/fund/addfund");
            }
            $_POST['user_id'] = $res->id;
            $_POST['agent_id'] = $this->agentId;
            if($this->agentfund_model->addfund($this->security->xss_clean($_POST))){
                $this->session->set_flashdata('success', 'Fund added Successfully');
                redirect("agent/fund/history");
            }
        }
        $this->render('agent/fund/add_fund');
    }

    function check_customer(){
        $res = $this->agentfund_model->check_user($this->security->xss_clean($_POST));
        $array = array(
            'valid'=>true
        );
        if(!$res){
            $array['valid'] = false;
            $array['message'] ="Please enter valid email or phone no"; 
        }
        echo JSON_ENCODE($array);
    }
}