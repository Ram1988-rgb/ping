<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Agent extends MY_Controller {
    
    function __construct() {
        parent::__construct();
        check_admin_login();   
        $this->load->model('agent_model');
        $this->header_data['headTitle'] = "Nuvest : Manage Agent ";   
     }

     function index(){
        $this->data['all_record'] = $this->agent_model->get_all_record();    
        $this->render('admin/agent/view');
     }
     public function add(){   
        if($this->input->post())
            {
        if($this->agent_model->checkUser($this->input->post())){
            $this->session->set_flashdata('errordata', 'User Already exist.Please choose another email');
            redirect('/admin/agent/add');
        }
        $addUser = $this->agent_model->addUser($this->input->post());
        if($addUser){
            $this->session->set_flashdata('success', 'Agent successfully added');
            redirect("/admin/agent/index");
        }
        $this->session->set_flashdata('errordata', 'Something went wrong try again');
        redirect("/admin/agent/add");
        }
        $this->data['post_data'] = $this->input->post()?$this->input->post():[];
        $this->render('admin/agent/add');
    }
    public function edit($id)
  {   
    if($this->input->post())
		{
      if($this->agent_model->checkUser($this->input->post(), $id)){
        $this->session->set_flashdata('errordata', 'Agent Already exist.Please choose another email');
        redirect('/admin/agent/edit/'.$id);
      }
      $addUser = $this->agent_model->UpdateUser($this->input->post(), $id);
      if($addUser){
        $this->session->set_flashdata('success', 'Agent successfully Updated');
        redirect("/admin/agent/index");
      }
      $this->session->set_flashdata('errordata', 'Something went wrong try again');
      redirect("/admin/agent/edit");
    }
    $userDetail = $this->agent_model->getrecord($id);
    if(!$userDetail){
      $this->session->set_flashdata('error', 'No record found!');
      redirect('/admin/agent/index');  
    }
    $this->data['userDetail'] = $userDetail;
    $this->render('admin/agent/edit');
  }
}