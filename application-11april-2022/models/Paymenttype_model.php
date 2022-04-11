<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Paymenttype_model extends CI_Model {

  public function __construct() {
      parent::__construct();
      $this->load->library("session");
  }

  function get_count_record(){
    $this->db->where("status", '1');
    $this->db->where("deletedAt", '0');
    $query = $this->db->get(TBL_PAYMENTTYPE);
    return $query->num_rows();
  }

  function checkRecord($post, $id=null) {
    $label = $post['label'];
    if($id){
      $this->db->where('id !=', $id);
    }    
    $this->db->where("label", $label);
    $this->db->where("status", '1');
    $this->db->where("deletedAt", '0');
    $this->db->order_by("id", "DESC");
    $query = $this->db->get(TBL_PAYMENTTYPE);
     return $query->num_rows();
  }

  function add($post){
    if($post!=NULL)
      {
          $ins['label']   = $post['label'];
          $ins['days']   = $post['days'];
          $ins['description']   = $post['description'];
          $ins['status']   = 1;
          $ins['deletedAt']   = 0;
          
          if($this->db->insert(TBL_PAYMENTTYPE,$ins))
          {
              return TRUE;
          }
          
      }
      return FALSE;
  }

  function edit($post, $id){
    if($post!=NULL)
      {
          $ins['label']   = $post['label'];
          $ins['days']   = $post['days'];
          $ins['description']   = $post['description'];
          $this->db->where('id', $id)->update(TBL_PAYMENTTYPE, $ins);
          return TRUE;          
      }
      return FALSE;
  }

  function get_all_record(){
    $this->db->where("status", '1');
    $this->db->where("deletedAt", '0');
    $query = $this->db->get(TBL_PAYMENTTYPE);
    if($query->num_rows() > '0')
    {
        return $query->result();
    }
    return NULL;
  }

  function getrecord($id){
    $this->db->where("id", $id);
    $this->db->where("status", '1');
    $this->db->where("deletedAt", '0');
    $query = $this->db->get(TBL_PAYMENTTYPE);
    if($query->num_rows() > '0')
    {
        return $query->row();
    }
    return NULL;
  }

  function deleteRecord($id){
      $data   = array(
        'deletedAt'    => 1
      );
      if($this->db->where('id', $id)->update(TBL_PAYMENTTYPE,$data)){
        return true;
      }
      return false;
  }

}
?>
