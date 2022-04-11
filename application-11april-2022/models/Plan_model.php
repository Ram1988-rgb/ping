<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Plan_model extends CI_Model {

  public function __construct() {
      parent::__construct();
      $this->load->library("session");
  }

  function get_count_record(){
    $this->db->where("status", '1');
    $this->db->where("deletedAt", '0');
    $query = $this->db->get(TBL_PLAN);
    return $query->num_rows();
  }
  
   function get_plan_type_duration($id){
	$query = $this->db->select(TBL_PLANPAYMENTDURATION.'.*,'.TBL_PAYMENTDURATION.'.label,'.TBL_PAYMENTDURATION.'.month')
                  ->from(TBL_PLANPAYMENTDURATION)
                  ->where(TBL_PLANPAYMENTDURATION.'.plan_id', $id)
                  ->join(TBL_PAYMENTDURATION, TBL_PAYMENTDURATION.'.id ='.TBL_PLANPAYMENTDURATION.'.paymentduration_id')
                  ->get();
    //print_r($query); die;
    if($query->num_rows() > '0'){
        return $query->result();
    }
    return NULL;
  }
  
  function get_singleplan_type_duration($id){
	$query = $this->db->select(TBL_PLANPAYMENTDURATION.'.*,'.TBL_PAYMENTDURATION.'.label,'.TBL_PAYMENTDURATION.'.month')
                  ->from(TBL_PLANPAYMENTDURATION)
                  ->where(TBL_PLANPAYMENTDURATION.'.id', $id)
                  ->join(TBL_PAYMENTDURATION, TBL_PAYMENTDURATION.'.id ='.TBL_PLANPAYMENTDURATION.'.paymentduration_id')
                  ->get();
    //print_r($query); die;
    if($query->num_rows() > '0'){
        return $query->first_row();
    }
    return NULL;
  }
  
  function get_singleplan_payment_duration($id){
	$query = $this->db->select(TBL_PLANPAYMENTTYPE.'.*,'.TBL_PAYMENTTYPE.'.label,'.TBL_PAYMENTTYPE.'.days')
                  ->from(TBL_PLANPAYMENTTYPE)
                  ->where(TBL_PLANPAYMENTTYPE.'.id', $id)
                  ->join(TBL_PAYMENTTYPE, TBL_PAYMENTTYPE.'.id ='.TBL_PLANPAYMENTTYPE.'.paymenttype_id')
                  ->get();
    //print_r($query); die;
    if($query->num_rows() > '0'){
        return $query->first_row();
    }
    return NULL;
  }
  
   function get_plan_payment_duration($id){
	$query = $this->db->select(TBL_PLANPAYMENTTYPE.'.*,'.TBL_PAYMENTTYPE.'.label,'.TBL_PAYMENTTYPE.'.days')
                  ->from(TBL_PLANPAYMENTTYPE)
                  ->where(TBL_PLANPAYMENTTYPE.'.plan_id', $id)
                  ->join(TBL_PAYMENTTYPE, TBL_PAYMENTTYPE.'.id ='.TBL_PLANPAYMENTTYPE.'.paymenttype_id')
                  ->get();
    //echo $this->db->last_query();die;
    if($query->num_rows() > '0'){
        return $query->result();
    }
    return NULL;
  }

  function checkPlan($post, $id=null) {
    $name = $post['name'];
    if($id){
      $this->db->where('id !=', $id);
    }    
    $this->db->where("name", $name);
    $this->db->where("status", '1');
    $this->db->where("deletedAt", '0');
    $this->db->order_by("id", "DESC");
    $query = $this->db->get(TBL_PLAN);
     return $query->num_rows();
  }

  function checkedDuration($plan_id, $duration_id){
    $this->db->where("paymentduration_id", $duration_id);
    $this->db->where("plan_id", $plan_id);
    $query = $this->db->get(TBL_PLANPAYMENTDURATION);
    return $query->num_rows();
  }

  function checkedPaymentType($plan_id, $paymenttype_id){
    $this->db->where("paymenttype_id", $paymenttype_id);
    $this->db->where("plan_id", $plan_id);
    $query = $this->db->get(TBL_PLANPAYMENTTYPE);
    return $query->num_rows();
  }

  function addPlan($post){
    if($post!=NULL)
      {
          $ins['name']   = $post['name'];
          $ins['plan_cat']   = $post['plan_cat'];
          $ins['description']   = $post['description'];
          $ins['status']   = 1;
          $ins['deletedAt']   = 0;
          
          if($this->db->insert(TBL_PLAN,$ins))
          {
              $id = $this->db->insert_id();
              $this->addPaymentType($id, $post['paymenttype']);
              $this->addPaymentDuration($id, $post);
              return TRUE;
          }
          
      }
      return FALSE;
  }

  function addPaymentType($id, $paymentType){
    if($paymentType ){
      foreach($paymentType as $value){
        $ins['plan_id'] = $id;
        $ins['paymenttype_id'] = $value;        
        $this->db->insert(TBL_PLANPAYMENTTYPE,$ins);
      }
    }
  }

  function addPaymentDuration($id, $post){
    $paymentDuration = $post['paymentduration'];
    $rate = $post['rate'];
    if($paymentDuration){
      $i=0;
      foreach($paymentDuration as $value){

        $ins['plan_id'] = $id;
        $ins['paymentduration_id'] = $value;
        //$ins['rate'] = isset($rate[$value][0])? $rate[$value][0]: 0; 
        
        $ins['rate'] =isset($rate[$value])? $rate[$value]: 0;
        $this->db->insert(TBL_PLANPAYMENTDURATION,$ins);
        $i++;
      }
    }
  }

  function editPlan($post, $id){
    if($post!=NULL)
      {
          $ins['name']   = $post['name'];
          $ins['plan_cat']   = $post['plan_cat'];
          $ins['description']   = $post['description'];
          $this->db->where('id', $id)->update(TBL_PLAN, $ins);
          $this->deletePaymentType($id);
          $this->deletePaymentDuration($id);
          $this->addPaymentType($id, $post['paymenttype']);
          $this->addPaymentDuration($id, $post);
          return TRUE;          
      }
      return FALSE;
  }

  function get_all_record(){
    $this->db->where("status", '1');
    $this->db->where("deletedAt", '0');
    $query = $this->db->get(TBL_PLAN);
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
    $query = $this->db->get(TBL_PLAN);
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
      if($this->db->where('id', $id)->update(TBL_PLAN,$data)){
        return true;
      }
      return false;
  }

  function deletePaymentType($id){
    $this -> db -> where('plan_id', $id);
    $this -> db -> delete(TBL_PLANPAYMENTTYPE);
    return true;
  }

  function deletePaymentDuration($id){
    $this -> db -> where('plan_id', $id);
    $this -> db -> delete(TBL_PLANPAYMENTDURATION);
    return true;
  }

  function get_plan_by_category($plan_cat){
    $this->db->where("plan_cat", $plan_cat);
    $this->db->where("status", '1');
    $this->db->where("deletedAt", '0');
    $query = $this->db->get(TBL_PLAN);
    if($query->num_rows() > '0')
    {
        return $query->result();
    }
    return NULL;
  }

  function getPaymentTypeByPlanId($planId){
    $this->db->select('a.*,b.*'); 
    $this->db->from(TBL_PLANPAYMENTTYPE.' a');
    $this->db->where('a.plan_id',$planId);
    $this->db->join(TBL_PAYMENTTYPE.' b', 'b.id = a.paymenttype_id'); 
    $query = $this->db->get();
    //echo $this->db->last_query();die;
    return $query->result();
  }

  function getPaymentDurationByPlanId($planId){
    $this->db->select('a.*,b.*'); 
    $this->db->from(TBL_PLANPAYMENTDURATION.' a');
    $this->db->where('a.plan_id',$planId);
    $this->db->join(TBL_PAYMENTDURATION.' b', 'b.id = a.paymentduration_id'); 
    $query = $this->db->get();
     //echo $this->db->last_query();die;
    return $query->result();
  }

  function get_category(){   
    $this->db->from(TBL_PLAN_CATEGORY);
    $query = $this->db->get();
    return $query->result();
  }

  function getPlanPaymentDuration($plan_id,$paymentduration_id){
    $this->db->where('plan_id',$plan_id);
    $this->db->where('paymentduration_id',$paymentduration_id);
    $this->db->from(TBL_PLANPAYMENTDURATION);
    $query = $this->db->get();
   // echo $this->db->last_query();
    return $query->row();
  }
  function getPaymentType($paymenttype_id){
    $this->db->where('id',$paymenttype_id);
    $this->db->from(TBL_PAYMENTTYPE);
    $query = $this->db->get();
    return $query->row();
  }

  function getPaymentDuration($duration_id){
    $this->db->where('id',$duration_id);
    $this->db->from(TBL_PAYMENTDURATION);
    $query = $this->db->get();
    return $query->row();
  }
}
?>
