<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library("session");
    }

    function send_otp($module,$user_id){
        $otp = random_int(100000, 999999);
        $ins['otp']   = $otp;
        $ins['module']   = $module;          
        $ins['user_id']   = $user_id;          
        if($this->db->insert(TBL_OTP,$ins))
        {
            return  $otp;
        }
        return false;
    }
    function delete_otp($module,$user_id){
        $this -> db -> where('user_id', $user_id);
        $this -> db -> delete(TBL_OTP);
        return TRUE;
    }

    function get_otp($module,$user_id){
        $this->db->where("user_id", $user_id);
        $this->db->order_by('id','desc');
        $query = $this->db->get(TBL_OTP);
        if($query->num_rows() > '0')
        {
            return $query->row();
        }
        return NULL;
    }

    function verify_mobile($user_id){        
        $ins['verify_phone']   = 1;       
        $ins['verify_phone_date']   = date('Y-m-d');
        
        if($this->db->where('id', $user_id)->update(TBL_USER,$ins))
        {
            sendNotificationVerifyContactNumber(array('user_id'=>$user_id),'APP');
            return TRUE;
        }
    }

    function verify_email($user_id){        
        $ins['verify_email']   = 1;       
        $ins['verify_email_date']   = date('Y-m-d');
        sendNotificationVerifyContactEmail(array('user_id'=>$user_id),'APP');
        if($this->db->where('id', $user_id)->update(TBL_USER,$ins))
        {
            return TRUE;
        }
    }

    function addNIF($post,$user_id){
        if($post!=NULL)
          {
            $ins['name']   = $post['name'];
            $ins['nif_number']   = $post['nif_number'];
            $ins['image']   = $post['nif_image'];    
            $ins['user_id'] = $post['user_id'];           
            if($this->db->insert(TBL_NIF,$ins))
            {
                update_table_data($user_id, array('verify_nif'=>3),TBL_USER);
                return TRUE;
            }              
          }
          return FALSE;
      }
    
    function verify_dermalog($post){
        if($post!=NULL)
        {
            if($this->check_dermolog($post['user_id'])){
               // return false;
            }
            $ins['proof_image']   = $post['proof_image'];
            $ins['selfie_image']   = $post['selfie_image'];
            $ins['user_id']   = $post['user_id'];               
            if($this->db->insert(TBL_USER_DERMALOG,$ins))
            {
                update_table_data($post['user_id'], array('verify_dermalog'=>3),TBL_USER);
                return TRUE;
            }

        }
        return FALSE;
    }

    function check_dermolog($user_id){
        $this->db->where("user_id", $user_id);
        $query = $this->db->get(TBL_USER_DERMALOG);
        return $query->num_rows();
    }

    function get_dermolog($user_id){
        $this->db->where("user_id", $user_id);
        $this->db->order_by('id','DESC');
        $query = $this->db->get(TBL_USER_DERMALOG);
        return $query->row();
    }

    function get_nif($user_id){
        $this->db->where("user_id", $user_id);
        $this->db->order_by('id','DESC');
        $query = $this->db->get(TBL_NIF);
        return $query->row();
    }

    function update_tofa($post){
        $ins['tofa']   = $this->security->xss_clean($_POST['tofa']);       
        sendNotificationtofa($this->security->xss_clean($_POST),'WEB');
        
        if($this->db->where('id', $post['user_id'])->update(TBL_USER,$ins))
        {
            return TRUE;
        }
    }



}