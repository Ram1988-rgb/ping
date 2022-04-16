<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bank_model extends CI_Model {

  public function __construct() {
      parent::__construct();
      $this->load->library("session");
  }

  function get_count_record(){
    $this->db->where("status", '1');
    $this->db->where("deletedAt", '0');
    $query = $this->db->get(TBL_BANK);
    return $query->num_rows();
  }
  
  function get_all_record($user_id=''){
    $this->db->where("status", '1');
    $this->db->where("deletedAt", '0');
    if($user_id){
      $this->db->where("user_id", $user_id);
    }
    $this->db->order_by('id','DESC');
    $query = $this->db->get(TBL_BANK);
    
    if($query->num_rows() > '0')
    {
        return $query->result();
    }
    return NULL;
  }
 
   function addBank($post){
    if($post!=NULL)
      {
          $ins['name']   = $post['name'];
          $ins['user_id']   = $post['user_id'];
          $ins['account_number']   = $post['account_number'];
          $ins['account_holder_name']   = $post['account_holder_name'];
          $ins['swift_code']   = $post['swift_code'];
                    
          if($this->db->insert(TBL_BANK,$ins))
          {
              return TRUE;
          }
          
      }
      return FALSE;
  }
  
   
   
  function updateStatus($id, $status){
      $data   = array(
        'status'    => $status
      );
      if($this->db->where('id', $id)->update(TBL_BANK,$data)){
        return true;
      }
      return false;
  }

  function bank_detail($id){
    $this->db->where('id', $id);
    $this->db->from(TBL_BANK);
    $query = $this->db->get();
    return $query->row();
  }

  function editBank($post, $bank_id){
    if($post!=NULL)
      {
          $ins['name']   = $post['name'];
          $ins['user_id']   = $post['user_id'];
          $ins['account_number']   = $post['account_number'];
          $ins['account_holder_name']   = $post['account_holder_name'];
          $ins['swift_code']   = $post['swift_code'];
          if($this->db->where('id', $bank_id)->update(TBL_BANK,$ins)){
            return true;
          }           
      }
      return FALSE;
  }

  function deleteBank($id) {
    $data   = array(
      'deletedAt'    => 1
    );
    if($this->db->where('id', $id)->update(TBL_BANK,$data)){
      return true;
    }
    return false;
  }

}
?>
