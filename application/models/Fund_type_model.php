<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fund_type_model extends CI_Model {

  public function __construct() {
      parent::__construct();
      $this->load->library("session");
  }

  function get_count_record(){
    $this->db->where("status", '1');
    $this->db->where("deletedAt", '0');
    $query = $this->db->get(TBL_FUNDTYPE);
    return $query->num_rows();
  }

  function get_all_record(){
    $this->db->where("status", '1');
    $this->db->where("deletedAt", '0');
    $query = $this->db->get(TBL_FUNDTYPE);
    if($query->num_rows() > '0')
    {
        return $query->result();
    }
    return NULL;
  }

 

 
}
?>
