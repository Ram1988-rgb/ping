<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fund_model extends CI_Model {

  public function __construct() {
      parent::__construct();
      $this->load->library("session");
  }

  function get_count_record(){
    $this->db->where("status", '1');
    $this->db->where("deletedAt", '0');
    $query = $this->db->get(TBL_FUND);
    return $query->num_rows();
  }

  function get_total_fund($user_id = ''){
    $this->db->select_sum('amount');
    if($user_id){
      $this->db->where('user_id',$user_id);
    }
    $this->db->where('status',1);
    $query = $this->db->get(TBL_FUND);
    return $query->row();
  }
  
  function get_total_loan(){
    $this->db->select_sum('amount');
    $query = $this->db->get(TBL_LOAN);
    return $query->row();
  }

   function addFund($post){
    if($post!=NULL)
      {
          $ins['user_id'] = $post['user_id'];
          $ins['fundtype_id']   = $post['fund_id'];
          $ins['amount']   = $post['amount'];
          $ins['bankdeposite_upload'] = $post['bankdeposite_upload'];
          $ins['check_front_upload'] = $post['check_front_upload'];
          $ins['check_back_upload'] = $post['check_back_upload'];
          $ins['agent_special_code']   = isset($post['agent_special_code'])?$post['agent_special_code']:'';          
          if($this->db->insert(TBL_FUND,$ins))
          {
            $id = $this->db->insert_id();
           // $this->addFundHistory($id);
            if($ins['agent_special_code']){
              $this->add_agent_fund($post, $id);
            }
            return $id;
          }
          
      }
      return FALSE;
  }

  function add_agent_fund($post, $fund_id){
     $agent_id = $this->getagent_id($post['agent_special_code']);
    $ins['user_id'] = $post['user_id'];
    $ins['fund_id'] = $fund_id;
    $ins['amount']   = $post['amount'];
    $ins['agent_id']   = $agent_id;
    $ins['operation_type']   = 'OUT';
    $ins['status']   = 0;
    $this->db->insert(TBL_AGENTFUND,$ins);
    return true;

  }
  function getagent_id($scode){
    $this->db->where('code', $scode);
    $this->db->from(TBL_AGENT);
    $query = $this->db->get();
   // echo $this->db->last_query();
   if($query->num_rows()){
    $res = $query->row();

    return $res->id;
   }
   return '';
    
  }

  function addFundHistory($id){
    $detail = $this->getrecord($id);
    $data = array(
      'in_out'=>'IN',
      'mode' => 'FUND',
      'message' => 'Fund Added successfully',
      'user_id' => $detail->user_id,
      'amount'=>$detail->amount,
      'detail'=> JSON_ENCODE($detail),
      'fund_id'=> $id,
      'status' => 0
    );
    saveFundHistory($data);
    return true;
  }


  function editFund($post, $id){
    if($post!=NULL)
      {
          $ins['name']   = $post['name'];
          $ins['description']   = $post['description'];
          $this->db->where('id', $id)->update(TBL_FUND, $ins);
          return TRUE;          
      }
      return FALSE;
  }

  function get_all_record($user_id = ''){
	//echo $query = $this->db->select('cash.*,fund.name')->from(TBL_FUND)->join(TBL_FUNDTYPE as 'fund', 'fund.id=cash.fundtype_id')->where('cash.status', '1')->where('cash.deletedAt', '0')->get();
      $this->db->select(TBL_FUND.'.*,'.TBL_FUNDTYPE.'.name');
      $this->db->from(TBL_FUND);
      $this->db->where(TBL_FUND.'.deletedAt', 0);
      if($user_id){
        $this->db->where(TBL_FUND.'.user_id',$user_id);
      }
      $this->db->join(TBL_FUNDTYPE, TBL_FUNDTYPE.'.id ='.TBL_FUND.'.fundtype_id');
      $this->db->order_by(TBL_FUND.'.id','DESC');
      $query =  $this->db->get();
    //print_r($query); die;
    if($query->num_rows() > '0')
    {
        return $query->result();
    }
    return NULL;
  }

  function get_fund_recent_activity($user_id = ''){
    $this->db->select(TBL_FUND.'.*,'.TBL_FUNDTYPE.'.name');
      $this->db->from(TBL_FUND);
      $this->db->where(TBL_FUND.'.deletedAt', 0);
      if($user_id){
        $this->db->where(TBL_FUND.'.user_id',$user_id);
      }
      $this->db->join(TBL_FUNDTYPE, TBL_FUNDTYPE.'.id ='.TBL_FUND.'.fundtype_id');
      $this->db->order_by(TBL_FUND.'.id','DESC');
      $this->db->limit(5);
      $query =  $this->db->get();
      if($query->num_rows() > '0')
      {
          return $query->result();
      }
      return NULL;
  }

  function getrecord($id){
    //~ $this->db->where("id", $id);
    //~ $this->db->where("status", '1');
    //~ $this->db->where("deletedAt", '0');
    $query = $this->db->get(TBL_FUND);
    $query = $this->db->select(TBL_FUND.'.*,'.TBL_FUNDTYPE.'.name')
                  ->from(TBL_FUND)
                  ->where(TBL_FUND.'.id', $id)
                  ->where(TBL_FUND.'.deletedAt', 0)                  
                  ->join(TBL_FUNDTYPE, TBL_FUNDTYPE.'.id ='.TBL_FUND.'.fundtype_id')
                  ->get();
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
      if($this->db->where('id', $id)->update(TBL_FUND,$data)){
        return true;
      }
      return false;
  }
  
  function updateStatus($id, $status){
      $data   = array(
        'status'    => $status
      );
      if($this->db->where('id', $id)->update(TBL_FUND,$data)){
        if($status){          
          $this->insert_fund_history($id);
          $this->insert_notification($id);
        }
        return true;
      }
      return false;
  }

  function get_fund_history($user_id =''){
    $fromDate = $this->input->get_post('fromdate');
    $toDate = $this->input->get_post('todate');
    $plan = $this->input->get_post('plan');
    $this->db->select('DATE(createdAt) AS date');
    if($user_id){
      $this->db->where('user_id', $user_id);
    }
    if($fromDate & $toDate){
      $this->db->where('createdAt BETWEEN "'. date('Y-m-d', strtotime($fromDate)). '" and "'. date('Y-m-d', strtotime($toDate)).'"');

    }
    if($plan){
      $this->db->where('mode',$plan);
    }
    $this->db->where('status',1);
    $this->db->group_by('DATE(createdAt)');
    $this->db->from(TBL_FUND_HISTORY);
    $this->db->order_by('id','desc');
    $query = $this->db->get();
    
    $data = array();
    if($query->num_rows()>0){
      foreach($query->result()  as $line){
        $data[] = array(
          'date'=>$line->date,
          'detail'=> $this->get_history_detail($line->date, $user_id)
        );
      }
    }
    return $data;
  }

  function get_history_detail($date, $user_id = ''){   
    $fromDate = $this->input->get_post('fromdate');
    $toDate = $this->input->get_post('todate');
    $plan = $this->input->get_post('plan'); 
    $this->db->where('DATE(createdAt)', $date);
    if($user_id){
      $this->db->where('user_id', $user_id);
    }
    if($fromDate & $toDate){
      $this->db->where('createdAt BETWEEN "'. date('Y-m-d', strtotime($fromDate)). '" and "'. date('Y-m-d', strtotime($toDate)).'"');
    }
    if($plan){
      $this->db->where('mode',$plan);
    }
    $this->db->where('status',1);
    $this->db->order_by('id','desc');
    $this->db->from(TBL_FUND_HISTORY);    
    $query = $this->db->get();
    $data =   $query->result();
   return $this->manage_history_data($data);
  }

  function manage_history_data($detail){
    //print_r($detail);
    $data = array();
    foreach($detail as $line){
      $data[] = array(
        'title'=> $line->mode,
        'message' => $line->message,
        'sign'=>($line->in_out == "IN")?'+':'-',
        'amount'=> "".$line->amount
      );
    }
    return $data;
  }

  public function check_agent_code($agent_special_code){
    $this->db->where('code', $agent_special_code);
    $this->db->from(TBL_AGENT);    
    $query = $this->db->get();
    $num =   $query->num_rows();
    if($num){
      return true;
    }else{
      return false;
    }
  }

 public function get_fund_history_user($user_id){
  $this->db->where('code', $agent_special_code);
  $this->db->from(TBL_AGENT);    
  $query = $this->db->get();
 }

 function get_total_interest($user_id=''){
  $this->db->select_sum('amount');
  $this->db->select('amount');
  $this->db->from(TBL_EARNED_INTEREST);  
  $query = $this->db->get();
  if($query->num_rows()>0){
    return $query->row();
  }
  return null;
 }

 public function insert_fund_history($fund_id){
   $detail = $this->getrecord($fund_id);
   $data = array(
    'in_out'=>'IN',
    'mode' => 'FUND',
    'message' => 'Fund Added successfully',
    'user_id' => $detail->user_id,
    'amount'=>$detail->amount,
    'detail'=> JSON_ENCODE($detail),
    'fund_id'=> $fund_id,
    'status' => 1
  );
  saveFundHistory($data);
 }

 function insert_notification($fund_id){
  $fund_detail = $this->getrecord($fund_id);
  statusfundNotification($fund_detail, 'WEB');
 }

}
?>
