<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Agent_model extends CI_Model {

  public function __construct() {
      parent::__construct();
      $this->load->library("session");
  }

  function get_all_record(){
    $this->db->where("deletedAt", '0');
    $this->db->order_by("id", "DESC");
    $query = $this->db->get(TBL_AGENT);
    if($query->num_rows() > '0')
    {
        return $query->result();
    }
    return NULL;
  }

  function checkUser($post, $id=null) {
    $email = $post['email'];
    if($id){
      $this->db->where('id !=', $id);
    }    
    $this->db->where("email", $email);
    $this->db->where("deletedAt", '0');
    $query = $this->db->get(TBL_AGENT);
    return $query->num_rows();
  }
  function checkAgentCode($post, $id=null) {
    $agent_code = $post['agent_code'];
    if($id){
      $this->db->where('id !=', $id);
    }    
    $this->db->where("code", $agent_code);
    $this->db->where("deletedAt", '0');
    $query = $this->db->get(TBL_AGENT);
    if($query->num_rows()){
      $row = $query->row();
      return $row->id;
    }
    return false;
  }

  function addUser($post){
    if($post!=NULL)
      {
          $ins['name']   = $post['name'];
          $ins['email']   = $post['email'];
          $ins['phone']   = $post['phone'];
          $ins['dob']   = insertFormateDate($post['dob']);
          $ins['address']   = $post['address'];
          $ins['gender']   = $post['gender'];
          $ins['code']   = mt_rand(100000,999999);
          $ins['password']   = md5($post['password']);
          $ins['status']   = 1;
          $ins['deletedAt']   = 0;
          
          if($this->db->insert(TBL_AGENT,$ins))
          {
              return TRUE;
          }
          
      }
      return FALSE;
  }

  function UpdateUser($post,$id){
    if($post!=NULL)
      {
            $ins['name']   = $post['name'];
            $ins['email']   = $post['email'];
            $ins['phone']   = $post['phone'];
            $ins['dob']   = insertFormateDate($post['dob']);
            $ins['address']   = $post['address'];
            $ins['gender']   = $post['gender'];
            if($post['password']){
                $ins['password']   = md5($post['password']);
            }
          
          if($this->db->where('id', $id)->update(TBL_AGENT,$ins))
          {
              return TRUE;
          }
          
      }
      return FALSE;
  }
  function getrecord($id){
    $this->db->where("id", $id);
    $this->db->where("deletedAt", '0');
    $query = $this->db->get(TBL_AGENT);
    if($query->num_rows() > '0')
    {
        return $query->row();
    }
    return NULL;
  }

  function login($post){
    $email = $post['userName'];
    $userPassword = $post['userPassword'];
    $this->db->where("email", $email);
   // $this->db->or_where("phone", $email);
    $this->db->where("status", '1');
    $this->db->where("deletedAt", '0');
    $query = $this->db->get(TBL_AGENT);
   // echo $this->db->last_query();die;
    if($query->num_rows() > '0')
    {   
      //print_r($query->result());  die;
      foreach ($query->result() as $rows) {
        if($rows->password == md5($userPassword)){
         // echo "done";die;
          $newdata = array(
            'AGENTID' => $rows->id,
            'AGENTNAME' => $rows->name,                        
            'AGENTPHONE' => $rows->phone, 
            'AGENTEMAIL' => $rows->email,                       
            'AGENTIMAGE' => $rows->image,                        
           );
           $this->session->set_userdata($newdata);
           $this->update_last_login($rows->id);
           return true;
        }else {
          $this->session->set_flashdata('errordata', 'Login Authentication Failed: Enter Valid Password');
          return false;
        }
      }

    }else {
      $this->session->set_flashdata('errordata', 'Login Authentication Failed: Enter Valid Email');
      return false;
    }
  }
  function update_last_login($user_id){
    if($this->db->where('id',$user_id)->update(TBL_AGENT,array('last_login'=>date('Y-m-d H:i:s'))))
    {
     return true;
    }
  }

  function checkPassword($post){
    $this->db->where("id", $post['agentId']);
    $this->db->where("status", '1');
    $this->db->where("deletedAt", '0');
    $query = $this->db->get(TBL_AGENT);
    $result = $query->row();
    if($result){
      if($result->password == md5($post['oldpassword'])){
        return true;
      }
    }
    return FALSE;
  }
  function changePassword($post){
    $uid = $post['agentId'];
    $newPassword = $post['pass_confirmation'];  
    $Password = md5($newPassword);     
    $updatedata = array(
        'password' => $Password,
    );
    $this->db->where('id', $uid);
    $this->db->update(TBL_AGENT, $updatedata);      
    return true;
  }

  
}
?>