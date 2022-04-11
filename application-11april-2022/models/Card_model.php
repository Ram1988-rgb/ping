<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Card_model extends CI_Model {

  public function __construct() {
      parent::__construct();
      $this->load->library("session");
  }

  function add_card($post){
    if($post!=NULL)
    {
        $ins['account_no'] = $post['account_no'];
        $ins['month']   = $post['month'];
        $ins['year']   = $post['year'];
        $ins['cvv'] = $post['cvv'];
        $ins['user_id'] = $post['user_id'];
        $ins['status'] = 1;
        $ins['deletedAt'] = 0;

        $ins['card_owner_name'] = $post['card_owner_name'];
        if($this->db->insert(TBL_CARD,$ins))
        {
          return $id = $this->db->insert_id();
         
        }        
    }
    return FALSE;
  }

  function delete_card($id){
    $this->db->where("id", $id);
    $this->db->update(TBL_CARD, array('deletedAt'=>1)); 
    //echo $this->db->last_query();
    return true;
  }

  function list_card($user_id=''){
    $this->db->where("status", '1');
    $this->db->where("deletedAt", '0');
    if($user_id){
        $this->db->where("user_id", $user_id); 
    }
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get(TBL_CARD);
    if($query->num_rows() > '0'){
        return $query->result();
    }else{
        return array();
    }
  }

 

 
}
?>
