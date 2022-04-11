<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Cms extends MY_Controller {
    
    function __construct() {
        parent::__construct();
        check_admin_login();    
        $this->load->model('cms_model');
        $this->header_data['headTitle'] = "Nuvest : Admin Cms";   
     }

     function index($id=''){ 
         if($_POST){
            $this->cms_model->update_page($id);
         }
        $this->data['record'] = $this->cms_model->get_page($id);
        $this->data['allPages'] = $this->cms_model->get_all_pages();    
        $this->render('admin/cms/index'); 
     }
}

?>