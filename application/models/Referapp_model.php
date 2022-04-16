<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Referapp_model extends CI_Model {

  public function __construct() {
      parent::__construct();
      $this->load->library("session");
  }

  function add($post){
    if($post != null){
        $ins['fname'] = $post['fname'];
        $ins['lname'] = $post['lname'];
        $ins['email'] = $post['email'];
        $ins['phone'] = $post['phone'];
        $ins['user_id'] = $post['user_id'];
        $ins['status'] = 1;
        if($this->db->insert(TBL_REFERFRIEND,$ins)){
            return TRUE;
        }
        return false;
    }
  }

  function get_all_record(){
    $this->db->select('a.*,b.*, b.id as `bid`,a.email as `bemail`,a.phone as `bphone`, a.id as `id`, a.status as `status`'); 
    $this->db->from(TBL_REFERFRIEND.' a');
    $this->db->join(TBL_USER.' b', 'a.user_id = b.id');
    $query = $this->db->get(); 
    return $query->result();
  }

}
?>