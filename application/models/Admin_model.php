<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model extends CI_Model {

  public function __construct() {
      parent::__construct();
      $this->load->library("session");
  }

  public function get_all_module(){    
    $this->db->order_by('id','ASC');
    $query = $this->db->get(TBL_ADMIN_MODULE);
    
    if($query->num_rows() > '0')
    {
        return $query->result();
    }
    return NULL;
  }

  function get_all_record(){
    $this->db->where('adminLevelId','0');
    $this->db->where('deleted_at is NULL');
    $this->db->order_by('id','ASC');
    $query = $this->db->get(TBL_ADMINLOGIN);
    //echo $this->db->last_query();
    if($query->num_rows() > '0')
    {
        return $query->result();
    }
    return NULL;
  }

  function create_subadmin($post){
    $ins['username'] = $post['email'];
    $ins['emailId'] = $post['email'];
    $ins['first_name'] = $post['name'];
    $ins['mobile'] = $post['mobile'];
    $ins['password'] = $this->createPassword($post['password']);
    $ins['adminLevelId']=0;
    $ins['addDate'] = date('Y-m-d h:i:s');
    if($this->db->insert(TBL_ADMINLOGIN,$ins))
    {
       $id = $this->db->insert_id();
       $this->manage_permission($id,$post);
    }    
  }
  function manage_permission($admin_id, $post){
    foreach($post['permission'] as $module_id=>$val){
      $ins['admin_module_id'] = $module_id;
      $ins['admin_id'] = $admin_id;
      $ins['permission'] = $val;
      $this->db->insert(TBL_ADMIN_PERMISSION,$ins);
    }
    return true;
  }

  function edit_subadmin($admin_id,$post){
    $ins['username'] = $post['email'];
    $ins['emailId'] = $post['email'];
    $ins['first_name'] = $post['name'];
    $ins['mobile'] = $post['mobile'];
    if($post['password']){
      $ins['password'] = $this->createPassword($post['password']);
    }
    $this->db->where('id', $admin_id)->update(TBL_ADMINLOGIN, $ins);
    $this->delete_permission_by_admin_id($admin_id);
    $this->manage_permission($admin_id, $post);
  }
  function delete_permission_by_admin_id($admin_id){
    $this->db->where('admin_id', $admin_id);
    $this->db->delete(TBL_ADMIN_PERMISSION);
    return true;
  }

  function createPassword($password){
    $possible = '012dfds3456789bcdfghjkmnpq454rstvwx54yzABCDEFG5HIJ5L45MNOP352QRSTU5VW5Y5Z';
    $newPassword = $password;
    return $Password = $this->encrypt_password($newPassword);
  }

  function encrypt_password($plain) {
    $password = '';
    for ($i = 0; $i < 10; $i++) {
        $password .= $this->tep_rand();
    }
    $salt = substr(md5($password), 0, 2);
    $password = md5($salt . $plain) . ':' . $salt;
    return $password;
  }

  function tep_rand($min = null, $max = null) {
    static $seeded;
    if (!$seeded) {
        mt_srand((double) microtime() * 1000000);
        $seeded = true;
    }
  }

  function get_record($id){
    $this->db->where('id',$id);
    $this->db->order_by('id','ASC');
    $query = $this->db->get(TBL_ADMINLOGIN);
    //echo $this->db->last_query();
    if($query->num_rows() > '0')
    {
        return $query->row();
    }
    return NULL;
  }

  function check_module_permission($admin_id,$module_id){
    
    $this->db->where('admin_id',$admin_id);
    $this->db->where('admin_module_id',$module_id);
    $this->db->order_by('id','ASC');
    $query = $this->db->get(TBL_ADMIN_PERMISSION);
    //echo $this->db->last_query();
    if($query->num_rows() > '0')
    {
        return true;
    }
    return false;
  }

  function delete_admin($id){
    $this->db->where('id', $id);
    $this->db->update(TBL_ADMINLOGIN,array('deleted_at'=>date('Y-m-d')));
    return true;
  }
}
  ?>