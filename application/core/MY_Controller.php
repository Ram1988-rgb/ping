<?php
    ob_start();
     class MY_Controller extends CI_Controller  {
       
         protected $header_data = array();
         protected $data        = array(); // data for content data
         protected $footer_data = array();
                 
         
       function __construct() {
          parent::__construct();
         //  $this->header_data['current_controller'] = strtolower($this->router->fetch_class());
         //  $this->header_data['menu'] = $this->menu_model->main_menu();
          $this->header_data['headTitle'] = "Nuvest";
          
       }
       /**
        * @access  protected
        * @param string $view_name 
        * @return NULL
        */
       protected function render($view_name=NULL)
       {
            
            $this->load->view('Layout/header',  $this->header_data);
            $this->load->view($view_name,  $this->data);
            $this->load->view('Layout/footer',  $this->footer_data);
       }
       //End of class
    }

