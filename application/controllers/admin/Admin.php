<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Admin extends MY_Controller {
    
    function __construct() {
        parent::__construct();
        check_admin_login();   
        $this->load->model('admin_model');
        $this->header_data['headTitle'] = "Nuvest : Create Subadmin ";   
     }

     function index(){  
        $this->data['all_record'] = $this->admin_model->get_all_record();     
        $this->render('admin/subadmin/view'); 
     }
     function add(){
         if($_POST){
             $this->admin_model->create_subadmin($this->security->xss_clean($_POST));
             $this->session->set_flashdata('success', 'Subadmin has been created successfully!!!');
             redirect('/admin/admin/index');
         }  
        $this->data['all_module'] = $this->admin_model->get_all_module();     
        $this->render('admin/subadmin/add'); 
     }

     function edit($id){
         if($_POST){
            $this->admin_model->edit_subadmin($id,$this->security->xss_clean($_POST));
             $this->session->set_flashdata('success', 'Subadmin has been updated successfully!!!');
             redirect('/admin/admin/index');  
         }
        $this->data['all_module'] = $this->admin_model->get_all_module();
        $this->data['record'] = $this->admin_model->get_record($id);     
        $this->render('admin/subadmin/edit'); 
     }
    function delete($id){
        $this->admin_model->delete_admin($id);
        $this->session->set_flashdata('success', 'Subadmin has been deleted successfully!!!');
        redirect('/admin/admin/index');
    }
}
