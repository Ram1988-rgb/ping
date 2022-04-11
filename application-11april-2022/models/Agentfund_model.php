<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Agentfund_model extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->library("session");
  }

  function get_all_record(){

    $this->db->select('a.*,b.*,  b.id as `bid`, a.id as `id`, a.createdAt as createdAt,b.createdAt as bcreatedAt '); 
    $this->db->from(TBL_AGENTFUND.' a');    
    $this->db->join(TBL_AGENT.' b', 'a.agent_id = b.id');   
    $this->db->order_by('a.id', 'DESC');
    $query = $this->db->get(); 
    return $query->result();
  }

  function get_record($id){
   
    $this->db->select('a.*,b.*,  b.id as `bid`, a.id as `id`, a.createdAt as createdAt,b.createdAt as bcreatedAt '); 
    $this->db->where('a.id',$id);
    $this->db->from(TBL_AGENTFUND.' a');    
    $this->db->join(TBL_AGENT.' b', 'a.agent_id = b.id');   
    $this->db->order_by('a.id', 'DESC');
    $query = $this->db->get(); 
    return $query->row();
  }

  function get_all_agent(){
    $this->db->where("status", '1');
    $this->db->where("deletedAt", '0');
    $this->db->order_by("name", "ASC");
    $query = $this->db->get(TBL_AGENT);
    if($query->num_rows() > '0')
    {
        return $query->result();
    }
    return NULL;
  }

  function add_fund($post){
    if($post!=NULL)
    {
        $ins['amount']   = $post['amount'];
        $ins['document_name']   = $post['document_name'];
        $ins['document_type']   = $post['document_type'];
        $ins['remark']   = $post['remark'];
        $ins['fund_date']   = isset($post['fund_date'])?insertFormateDate($post['fund_date']):'';
        $ins['agent_id']   = $post['agent_id'];
        $ins['status']   = 1;
        $ins['createdBy']   = $this->session->userdata('ADMINID');
        if($this->db->insert(TBL_AGENTFUND,$ins))
        {
            return TRUE;
        }
        
    }
    return FALSE;
  }

  function get_total_fund($agent_id =''){
   $infund = $this->infund($agent_id);
    $outfund = $this->outfund($agent_id);
    
    if($infund && $outfund){
      return $infund->amount - $outfund->amount;
    }
    return 0;
    
  }

  function infund($agent_id = ''){
    $this->db->select_sum('amount');
    $this->db->where('status',1);
    $this->db->where('operation_type',"IN");
    if($agent_id){
      $this->db->where('agent_id',$agent_id);
    }    
    $this->db->from(TBL_AGENTFUND);
    $query = $this->db->get();
    //echo $this->db->last_query();
    if($query->num_rows()){
      return $query->row();
    }
    return null;
  }

  function outfund($agent_id = ''){
    $this->db->select_sum('amount');
    $this->db->where('status',1);
    $this->db->where('operation_type',"OUT");
    if($agent_id){
      $this->db->where('agent_id',$agent_id);
    }    
    $this->db->from(TBL_AGENTFUND);
    $query = $this->db->get();
    if($query->num_rows()){
      return $query->row();
    }
    return null;
  }

  function fund_request($agent_id=''){
    $this->db->select('a.*,b.*,  b.id as `bid`, a.id as `id`, a.createdAt as createdAt,b.createdAt as bcreatedAt,a.status as status,b.status as bstatus  '); 
    $this->db->where('a.agent_id',$agent_id);
    $this->db->where('a.operation_type',"OUT");
    $this->db->from(TBL_AGENTFUND.' a');    
    $this->db->join(TBL_USER.' b', 'a.user_id = b.id');   
    $this->db->order_by('a.id', 'DESC');
    
    $query = $this->db->get(); 
    return $query->result();
  }

  function fund_history($agent_id=''){
    $this->db->select('a.*,b.*,  b.id as `bid`, a.id as `id`, a.createdAt as createdAt,b.createdAt as bcreatedAt,a.status as status,b.status as bstatus '); 
    $this->db->where('a.agent_id',$agent_id);
    $this->db->from(TBL_AGENTFUND.' a');    
    $this->db->join(TBL_USER.' b', 'a.user_id = b.id', 'left');   
    $this->db->order_by('a.id', 'DESC');
    
    $query = $this->db->get(); 
   // echo $this->db->last_query();
    return $query->result();
  }

  function check_user($post){
    $this->db->where('email',$post['email']);
    $this->db->where('status',1);
    $this->db->or_where('phone',$post['email']);
    $this->db->from(TBL_USER);
    $query = $this->db->get(); 
    if($query->num_rows()>0){
      return $query->row();
    }
  }

  function addfund($post){
    if($post){
      $ins['agent_id'] = $post['agent_id'];
      $ins['amount'] = $post['amount'];
      $ins['remark'] = $post['description'];
      $ins['user_id'] = $post['user_id'];
      $ins['operation_type'] = 'IN';
      $ins['status'] = 1;
      if($this->db->insert(TBL_AGENTFUND,$ins))
      {
        $this->add_fund_touser($post);  
          return TRUE;
      }
    }
    return FALSE;
  }

  function add_fund_touser($post){
    $ins['user_id'] = $post['user_id'];
    $ins['fundtype_id']   = 3;
    $ins['amount']   = $post['amount'];
    $ins['agent_special_code']   = '';
    $ins['status'] = 1;         
    if($this->db->insert(TBL_FUND,$ins))
    {
      $id = $this->db->insert_id();
      $detail = $this->get_fund_record($id);
      $data = array(
        'in_out'=>'IN',
        'mode' => 'FUND',
        'message' => 'Fund Added successfully',
        'user_id' => $post['user_id'],
        'amount'=>$post['amount'],
        'detail'=> JSON_ENCODE($detail),
        'fund_id'=> $id,
        'status' => 1
      );
      saveFundHistory($data);
      return true;
    }
  }

  function get_fund_record($id){
    $this->db->where('id',$id);
    $this->db->from(TBL_FUND);
    $query = $this->db->get();
    if($query->num_rows()>0){
      return $query->row();
    }
  }
}
?>