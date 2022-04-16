<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Userpin_model extends CI_Model {

  public function __construct() {
      parent::__construct();
  }

  function checkUserPIN($post) {
    $code = $post['code'];
    $this->db->where("code", $code);
    $this->db->where("used", '1');
    $query = $this->db->get(TBL_USERPIN);
     return $query->num_rows();
  }

  function addUserpin($data){
    if($data!=NULL)
      {
          if($this->db->insert(TBL_USERPIN,$data))
          {
              return TRUE;
          }
          
      }
      return FALSE;
  }

}
?>
