<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Comman extends MY_Controller {
    
function __construct() {
      parent::__construct();
      //check_admin_login();
      $this->load->model('user_model');
      $this->load->model('plan_model');
  }

  public function change_status(){
    //print_r($_POST);
    $this->db->where('id', $this->security->xss_clean($_POST['id']));
    $this->db->from($this->security->xss_clean($_POST['tbl']));
   $query = $this->db->get();
    $row = $query->row();
    //echo $this->db->last_query();
    if($row){
      $status = 1;
      if($row->status ==1){
        $status = 0;
      }
      $this->db->where('id',$this->security->xss_clean($_POST['id']));
      $this->db->update($this->security->xss_clean($_POST['tbl']), array('status'=>$status));
      if($_POST['tbl'] == TBL_FUND){
        $this->updateStatusFundHistory($this->security->xss_clean($_POST['id']), $status);
      }
    }
    echo  JSON_ENCODE(array('status' => $status));
  }

  function changefundstatus(){
    $this->db->where('id', $this->security->xss_clean($_POST['id']));
    $this->db->from(TBL_AGENTFUND);
    $query = $this->db->get();
    $row = $query->row();
    //echo $this->db->last_query();
    $_POST['tbl'] = TBL_FUND;
    $_POST['id'] = $row->fund_id;

    $this->db->where('id', $this->security->xss_clean($_POST['id']));
    $this->db->from($this->security->xss_clean($_POST['tbl']));
   $query = $this->db->get();
    $row = $query->row();
   
    if($row){
      $status = 1;
      if($row->status ==1){
        $status = 0;
      }
      $this->db->where('id',$this->security->xss_clean($_POST['id']));
      $this->db->update($this->security->xss_clean($_POST['tbl']), array('status'=>$status));
      //echo $this->db->last_query();
      if($_POST['tbl'] == TBL_FUND){
        $this->updateStatusFundHistory($this->security->xss_clean($_POST['id']), $status);
      }

    }
  }

  function updateStatusFundHistory($id, $status){
    $this->db->where('fund_id',$id);
    $this->db->update(TBL_FUND_HISTORY, array('status'=>$status));
  }
  
}
?>