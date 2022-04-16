<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Dashboard extends MY_Controller {
    
    function __construct() {
          parent::__construct();
          check_agent_login();
          $this->load->model('agentfund_model');
          $this->load->model('user_model');
          $this->load->model('agent_model');
          $this->header_data['headTitle'] = "Nuvest : Manage Agent Dashboard";
       }
    
    function index(){

        $this->render('agent/dashboard');
    }

    public function changepassword(){
        if($_POST){
            $_POST['agentId']= $this->session->userdata('AGENTID');
           $res =  $this->agent_model->changePassword($this->security->xss_clean($this->input->post()));
           if($res){
                $this->session->set_flashdata('success', 'Password has been changed successfully.');
            }else{
                $this->session->set_flashdata('error', 'Something went wrong');
            }
            redirect('/agent/dashboard/changepassword');
        }
        $this->header_data['headTitle'] = "Nuvest : Agent | Change Password";
        $this->render('agent/changepassword');
    }

    public function checkPassword(){
        $_POST['agentId'] = $this->session->userdata('AGENTID');
        $result = $this->agent_model->checkPassword($this->security->xss_clean($this->input->post()));
        if(!$result){
            $response = array(
                'valid' => false,
                'message' => 'Current password is not correct. Please enter valid password'
            );
        }else{
            $response = array('valid' => true);
        }    
        echo json_encode($response);
    }
    public function logout(){
        $this->session->unset_userdata('AGENTID');
        $this->session->unset_userdata('AGENTNAME');
        redirect('/agent');
    }
}