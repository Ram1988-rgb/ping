<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notification_model extends CI_Model {
  public function __construct() {
    parent::__construct();
    $this->load->library("session");
  }

  public function saveData($ins){
    if($this->db->insert(TBL_NOTIFICATION,$ins))
    {  
        return TRUE;
    }else{
      return FALSE;
    }
  }

  public function allRecord($user_id =''){
    if($user_id){
      $this->db->where('user_id',$user_id);
    }
    $this->db->order_by('id', 'DESC');
    $this->db->from(TBL_NOTIFICATION);
    $query = $this->db->get();
    if($query->num_rows() > 0){
      if($user_id){
        $this->seen_by_user($user_id);
      }
      return $query->result();
    }
    return NULL;
  }

  public function get_notification($user_id =''){
    $this->db->select("id, title, message, createdAt");
    if($user_id){
      $this->db->where('user_id',$user_id);
    }
    $this->db->where('seen_by_user',0);
    $this->db->order_by('id', 'DESC');
    $this->db->from(TBL_NOTIFICATION);
    $query = $this->db->get();
    if($query->num_rows() > 0){
      $detail= $query->result();
      $data = array();
      foreach($detail as $line){
        $line->createdAt = time_diff_hours($line->createdAt, date('Y-m-d H:i:s'),true);
        $data[] = $line;
      }
      return $data;
    }
    return array();
  }

  public function seen_by_user($user_id){
    $upd=array(
      'seen_by_user'=>1,
      'seen_user_date'=> date("Y-m-d")
    );
    $this->db->where('user_id', $user_id);
    $this->db->update(TBL_NOTIFICATION, $upd);
  }
  
}
?>
