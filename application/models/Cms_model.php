<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cms_model extends CI_Model {

  public function __construct() {
      parent::__construct();
      $this->load->library("session");
  }
  function get_all_pages(){
      $this->db->from(TBL_CMS);
      $query = $this->db->get();
      if($query->num_rows()>0){
          return $query->result();
      }
      return null;
  }
  function get_page($id){
    $this->db->where('id', $id);
    $this->db->from(TBL_CMS);
    $query = $this->db->get();
    if($query->num_rows()>0){
        return $query->row();
    }
    return null;
  }

  function get_page_by_page($page){
    $this->db->where('page', $page);
    $this->db->from(TBL_CMS);
    $query = $this->db->get();
    if($query->num_rows()>0){
        return $query->row();
    }
    return null; 
  }

  function update_page($id){
    $this->db->where('id', $id);
    $this->db->update(TBL_CMS, array(
        'title'=>$this->security->xss_clean($_POST['title']),
        'content'=>$this->security->xss_clean($_POST['content']),
        'meta_title'=>$this->security->xss_clean($_POST['meta_title']),
        'meta_key'=>$this->security->xss_clean($_POST['meta_key']),
        'meta_desc'=>$this->security->xss_clean($_POST['meta_desc']),
    ));
    return true;
  }
}