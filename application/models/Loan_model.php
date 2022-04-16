<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Loan_model extends CI_Model {

  public function __construct() {
      parent::__construct();
      $this->load->library("session");
      $this->load->model('plan_model');
  }

  function get_count_record(){
    $this->db->where("status", '1');
    $this->db->where("deletedAt", '0');
    $query = $this->db->get(TBL_CASH);
    return $query->num_rows();
  }

  function get_total_cash(){
    $this->db->select_sum('amount');
    $query = $this->db->get(TBL_CASH);
    return $query->row();
  }

  function get_total_loan($user_id=''){
    $this->db->select_sum('amount');
    $this->db->where("status", '1');
    if($user_id){
      $this->db->where("user_id", $user_id);
    }
    $query = $this->db->get(TBL_LOAN);
    if($query->num_rows()){
      if($query->row()->amount ==null){
        $query->row()->amount = "0";
      }
      return $query->row();

    }
    $data = new Object();
    $data->amount ="0";
    return $data;
  }

   function addFund($post){
    if($post!=NULL)
      {
          $ins['fundtype_id']   = $post['fund_id'];
          $ins['amount']   = $post['amount'];
          if($post['fund_id']==3){
          if($post['agent_special_code']){
            $ins['agent_special_code']   = $post['agent_special_code'];
          }
		  }
          
          if($this->db->insert(TBL_CASH,$ins))
          {
              return TRUE;
          }
          
      }
      return FALSE;
  }
  
  function addLoan($post){
    $plan_rate =  $this->plan_model->getPlanPaymentDuration($this->security->xss_clean($_POST['plan_id']),$this->security->xss_clean($_POST['loan_duration']));
    $post['plan_rate'] =($plan_rate)?$plan_rate->rate:0;
    if($post!=NULL)
      {
          $ins['user_id']   = $post['user_id'];
          $ins['plan_id']   = $post['plan_id'];
          $ins['amount']   = $post['amount'];
          $ins['start_date']   = $post['start_date'];
          $ins['loan_duration_id']   = $post['loan_duration'];
          $ins['payment_type_id']   = $post['payment_duration'];
          $ins['interest_rate'] = ($plan_rate)?$plan_rate->rate:0;
          $ins['apply_status'] = 0;
          if(isset($post['apply_status'])){
            $ins['apply_status'] = 1;
          }
          $ins['status'] = 0;
          $post['interest_rate']  = $ins['interest_rate'];
          if($this->db->insert(TBL_LOAN,$ins))
          {
            
            $id = $this->db->insert_id();
            $this->manageLoanDetail($id, $post);
            
            
            return $id;
          }
          
      }
      return FALSE;
  }

  function manageLoanDetail($loanId, $post){
    $paymentType = getRecord($post['payment_duration'], TBL_PAYMENTTYPE);
    $paymentDuration = getRecord($post['loan_duration'], TBL_PAYMENTDURATION);
    $plan = getRecord($post['plan_id'], TBL_PLAN);
    
    $mInstallment = manageInstallmentLoan($post,$paymentType->days, $paymentDuration->month, insertFormateDate($post['start_date']), $post['amount']);
   
    // update TBL_INVESTMENTS
    $this->db->where('id', $loanId);
    $this->db->update(TBL_LOAN, array(
      'install_amount' => $mInstallment['installment_amount'],
      'days_between' => $mInstallment['days_between'],
      'end_date' => $mInstallment['endDate'],
      'installment_count' => $mInstallment['countInstallment'],
    ));

    //add investdetail
    $ins['loan_id'] = $loanId;
    $ins['payment_type_data'] = JSON_ENCODE($paymentType);
    $ins['payment_deuration_data'] = JSON_ENCODE($paymentDuration);
    $ins['plan_data'] = JSON_ENCODE($plan);
    $ins['plan_rate'] =  $post['plan_rate'];
    if($this->db->insert(TBL_LOANDETAIL,$ins))
    {
      $this->insert_payment_date($loanId);
      return true;
    }
    return false;
  }

  public function getPaymentType($id){
    $this->db->where('id', $id);
    $this->db->from(TBL_PAYMENTTYPE);
    return $this->db->get()->row();
    //echo $this->db->last_query();

  }

  public function insert_payment_date($loanId) {
    $loanDetail = $this->getRecord($loanId);
     $payment_detail = $this->getPaymentType($loanDetail->payment_type_id);
     $start_date =$loanDetail->start_date;
     $end_date =$loanDetail->end_date;
     //print_r( $end_date);die;
     $ins['payment_type'] = $payment_detail->label;
     $ins['loan_id'] = $loanId;
    
      $ins['payment_date'] =  $loanDetail->start_date;
      $ins['install_amount'] =  $loanDetail->install_amount;
      $ins['interest_rate'] =  $loanDetail->interest_rate;
      //$this->db->insert(TBL_LOAN_PAYMENT_DATE,$ins);
     
    //  if($payment_detail->days ==1){      
    //   while($start_date < $end_date) {        
    //     $start_date = date('Y-m-d', strtotime("+1 days", strtotime($start_date)));
    //     $ins['payment_date'] =  $start_date;
    //     if($start_date < $end_date){
    //       $this->db->insert(TBL_LOAN_PAYMENT_DATE,$ins);
    //      }
    //   }
    //  }

    //  if($payment_detail->days ==7){      
    //   while($start_date < $end_date) {        
    //     $start_date = date('Y-m-d', strtotime("+1 weeks", strtotime($start_date)));
    //     $ins['payment_date'] =  $start_date;
    //     if($start_date < $end_date){
    //       $this->db->insert(TBL_LOAN_PAYMENT_DATE,$ins);
    //      }
    //   }
    //  }

     if($payment_detail->days ==30){
      while($start_date <= $end_date) {
        $start_date = date('Y-m-d', strtotime("+1 months", strtotime($start_date)));        
       $ins['payment_date'] =  $start_date;
       if($start_date <= $end_date){
        $this->db->insert(TBL_LOAN_PAYMENT_DATE,$ins);
        //echo $this->db->last_query();
       }
        
      }
    }else{
      $ins['payment_date'] =  $end_date;
      $this->db->insert(TBL_LOAN_PAYMENT_DATE,$ins);
    }
    //die;
      // if($payment_detail->days ==365){
      //   while($start_date < $end_date) {        
      //     $start_date = date('Y-m-d', strtotime("+1 years", strtotime($start_date)));
      //     $ins['payment_date'] =  $start_date;
      //     if($start_date < $end_date){
      //       $this->db->insert(TBL_LOAN_PAYMENT_DATE,$ins);
      //      }
      //   }

      // }
  }

  function editFund($post, $id){
    if($post!=NULL)
      {
          $ins['name']   = $post['name'];
          $ins['description']   = $post['description'];
          $this->db->where('id', $id)->update(TBL_CASH, $ins);
          return TRUE;          
      }
      return FALSE;
  }

  function get_all_record(){
	//echo $query = $this->db->select('cash.*,fund.name')->from(TBL_CASH)->join(TBL_CASH_FUNDTYPE as 'fund', 'fund.id=cash.fundtype_id')->where('cash.status', '1')->where('cash.deletedAt', '0')->get();
    $query = $this->db->select(TBL_CASH.'.*,'.TBL_CASH_FUNDTYPE.'.name')
                  ->from(TBL_CASH)
                  ->where(TBL_CASH.'.deletedAt', 0)
                  ->join(TBL_CASH_FUNDTYPE, TBL_CASH_FUNDTYPE.'.id ='.TBL_CASH.'.fundtype_id')
                  ->get();
    //print_r($query); die;
    if($query->num_rows() > '0')
    {
        return $query->result();
    }
    return NULL;
  }

  

  function deleteRecord($id){
      $data   = array(
        'deletedAt'    => 1
      );
      if($this->db->where('id', $id)->update(TBL_CASH,$data)){
        return true;
      }
      return false;
  }
  
  function updateStatus($id, $status){
      $data   = array(
        'status'    => $status
      );
      if($this->db->where('id', $id)->update(TBL_CASH,$data)){
        return true;
      }
      return false;
  }
  
  function updateLoanStatus($id, $status){
      $data   = array(
        'status'    => $status
      );
      if($this->db->where('id', $id)->update(TBL_LOAN,$data)){
        return true;
      }
      return false;
  }
  
  
  
  function get_all_loan_single_record($id){
	//echo $query = $this->db->select('cash.*,fund.name')->from(TBL_CASH)->join(TBL_CASH_FUNDTYPE as 'fund', 'fund.id=cash.fundtype_id')->where('cash.status', '1')->where('cash.deletedAt', '0')->get();
    $query = $this->db->select(TBL_LOAN.'.*,'.TBL_PAYMENTDURATION.'.label,'.TBL_PAYMENTTYPE.'.label as payment_label')
                  ->from(TBL_LOAN)
                  ->where(TBL_LOAN.'.id', $id)
                  ->join(TBL_PAYMENTDURATION, TBL_PAYMENTDURATION.'.id ='.TBL_LOAN.'.loan_duration_id')
                  ->join(TBL_PAYMENTTYPE, TBL_PAYMENTTYPE.'.id ='.TBL_LOAN.'.payment_type_id')
                  ->get();
    //print_r($query); die;
    if($query->num_rows() > '0'){
        return $query->row();
    }
    return NULL;
  }

  function getRecord($id){
    $this->db->select('a.*,b.*, c.*, c.id as `cid`, b.id as `bid`, a.id as `id`, a.status as `status`,a.createdAt as `createdAt`'); 
    $this->db->from(TBL_LOAN.' a');
    $this->db->join(TBL_LOANDETAIL.' b', 'a.id = b.loan_id'); 
    $this->db->join(TBL_USER.' c', 'a.user_id = c.id');
    $this->db->where('a.id',$id);
    //$this->db->where("a.apply_status", 1);
    $query = $this->db->get(); 
    //echo $this->db->last_query();
    return $query->row();
  }

  function get_all_loan_record($user_id = ''){
    $this->db->select('a.*,b.*, c.*,c.id as `cid`, b.id as `bid`, a.id as `id`, a.status as `status`,  a.createdAt as `createdAt`'); 
    $this->db->from(TBL_LOAN.' a');
    $this->db->join(TBL_LOANDETAIL.' b', 'a.id = b.loan_id'); 
    $this->db->join(TBL_USER.' c', 'a.user_id = c.id');
    if($user_id){
      $this->db->where("a.user_id", $user_id);
    }
    $this->db->where("a.apply_status", 1);
    $this->db->order_by("a.id", "desc");
    $query = $this->db->get(); 
      //print_r($query); die;
      if($query->num_rows() > '0'){
          return $query->result();
      }
      return NULL;
    }

  function applyLoan($id){
    $data   = array(
      'apply_status'    => 1
    );
    if($this->db->where('id', $id)->update(TBL_LOAN,$data)){
      return true;
    }
    return false;
  }

  function get_loan_payment($loan_id) {
    $this->db->where('loan_id', $loan_id);
		$this->db->from(TBL_LOAN_PAYMENT);
		$query = $this->db->get();
    if($query->num_rows()>0){
      return $query->result();
    }
    return NULL;
  }

  function get_all_list_forapp($user_id){
    $this->db->select('a.*,b.*, b.id as `bid`, a.id as `id`, a.status as `status`,  a.createdAt as `createdAt`'); 
    $this->db->from(TBL_LOAN.' a');
    $this->db->join(TBL_LOANDETAIL.' b', 'a.id = b.loan_id'); 
    $this->db->join(TBL_USER.' c', 'a.user_id = c.id');
    if($user_id){
      $this->db->where("a.user_id", $user_id);
    }
    $this->db->where("a.apply_status", 1);
    //$this->db->where("a.status", 1);
    $this->db->order_by("a.id", "desc");
    $query = $this->db->get();
      if($query->num_rows() > '0'){
          return $query->result();
      }
      return NULL;
  }

  function get_one_list_forapp($loan_id, $user_id=''){
    $this->db->select('a.*,b.*, b.id as `bid`, a.id as `id`, a.status as `status`,  a.createdAt as `createdAt`'); 
    $this->db->from(TBL_LOAN.' a');
    $this->db->join(TBL_LOANDETAIL.' b', 'a.id = b.loan_id'); 
    $this->db->join(TBL_USER.' c', 'a.user_id = c.id');
    if($user_id){
      $this->db->where("a.user_id", $user_id);
    }
    $this->db->where("a.apply_status", 1);
    $this->db->where("a.id", $loan_id);
    //$this->db->where("a.status", 1);
    $this->db->order_by("a.id", "desc");
    $query = $this->db->get();
    //echo $this->db->last_query();
    if($query->num_rows() > '0'){
        return $query->row();
    }
    return NULL;
  }

  function change_status($id){
    $this->db->where('id', $id);
		$this->db->from(TBL_LOAN);
		$query = $this->db->get();
    if($query->num_rows()>0){
      $row =  $query->row();
      $status = 1;
      if($row->status ==1){
        $status =0;
      }
      $this->db->where('id', $id);
      $this->db->update(TBL_LOAN, array(
        'status' => $status     
      ));
      if($status){
        $loanDetail =  $this->getRecord($id);
        statusLoanNotification($loanDetail,'WEB');
        $this->insert_loan_history($row, 'IN');
        //$this->updateFundHistory($loanDetail);
        // if($loanDetail->start_date = date('Y-m-d')){
        //   if($loan_payment_date_id = $this->check_loan_payment($id)){
        //     $this->deduct_loan_install_ammount_with_interest($loanDetail,$loan_payment_date_id, date('Y-m-d'));
        
        //   }
        // }
       
      }
      return $status;
    }
    return 0;
   }

   function  insert_loan_history($row,$operation){
     $ins['amount'] = $row->amount;
     $ins['loan_id'] = $row->id;
     $ins['user_id'] = $row->user_id;
     $ins['operation'] = $operation;
     $ins['status'] = '1';
     $this->db->insert(TBL_LOAN_HISTORY,$ins);
   }

   function check_loan_payment($loan_id){
    $this->db->where('loan_id',$loan_id);
    $this->db->where('payment_date',date('Y-m-d'));
    $this->db->where('status',0);
    $query = $this->db->get(TBL_LOAN_PAYMENT_DATE);
    if($query->num_rows()){
      $row = $query->row();
      return $row->id;
    }
   }

   function deduct_loan_install_ammount_with_interest($pdetail,$loan_payment_date_id, $cpDdate=''){
    //Loan install_amount
    $ins['loan_id'] = $pdetail->loan_id;
		$ins['mode'] = 'Loan';
		$ins['message'] = "Loan install amount has been deducted successfully";
		$ins['user_id'] = $pdetail->user_id;
		$ins['amount'] = $pdetail->install_amount;
		$ins['detail'] = JSON_ENCODE($pdetail);
		$ins['status'] = 1;
		$ins['in_out'] = 'OUT';
		$data = $this->db->insert(TBL_FUND_HISTORY,$ins);
    sendLoanPaidNotification($ins);

    // $inl['loan_id'] = $pdetail->loan_id;
		// $inl['mode'] = 'Loan';
		// $inl['message'] = "Loan interest amount has been deducted successfully";
		// $inl['user_id'] = $pdetail->user_id;
		// $inl['amount'] = ($pdetail->install_amount*$pdetail->interest_rate)/100;
		// $inl['detail'] = JSON_ENCODE($pdetail);
		// $inl['status'] = 1;
		// $inl['in_out'] = 'OUT';
		// $data = $this->db->insert(TBL_FUND_HISTORY,$inl);
    // sendLoanInterestNotification($inl,'WEB');
    //insert loan_payment

    $inslp['loan_id'] = $pdetail->loan_id;
    $inslp['loan_payment_date_id'] = $loan_payment_date_id;
    $inslp['user_id'] = $pdetail->user_id;
    $inslp['amount'] = $pdetail->install_amount;
    $inslp['interest_rate'] = $pdetail->interest_rate;
    $inslp['interest_amount'] = $pdetail->install_amount -($pdetail->amount/$pdetail->installment_count);
    $data = $this->db->insert(TBL_LOAN_PAYMENT,$inslp);
    $inpd = $this->db->insert_id();

    if(!$cpDdate){
      $cpDdate = date('Y-m-d');
    }
    //update cash_payment_date
    $this->db->where('loan_id',$pdetail->loan_id);
    $this->db->where('payment_date',$cpDdate);
    $this->db->update(TBL_LOAN_PAYMENT_DATE, array(
      'status' => 1    
    ));

    //interest earned
    $er['loan_id'] = $pdetail->loan_id;
    $er['user_id'] = $pdetail->user_id;
    $er['loan_payment_id'] = $inpd;
    $er['amount'] = $pdetail->amount;
    $er['interest_rate'] = $pdetail->interest_rate;
    $er['interest_amount'] = $pdetail->install_amount -($pdetail->amount/$pdetail->installment_count);
    $er['module'] = 'LOAN';
    $data = $this->db->insert(TBL_EARNED_INTEREST,$er);
    return $inpd;

   }

   function updateFundHistory($pdetail){
     //loan add
    $ins['loan_id'] = $pdetail->loan_id;
		$ins['mode'] = 'Loan';
		$ins['message'] = "Loan Amount has been added successfully";
		$ins['user_id'] = $pdetail->user_id;
		$ins['amount'] = $pdetail->amount;
		$ins['detail'] = JSON_ENCODE($pdetail);
		$ins['status'] = 1;
		$ins['in_out'] = 'IN';
		$data = $this->db->insert(TBL_FUND_HISTORY,$ins);
   }

   function get_loan_payment_data($loan_id){
    $this->db->select('a.*,b.*, b.id as `bid`, a.id as `id`, a.status as `status`, a.payment_date as `cpdate`'); 
    $this->db->where('a.loan_id', $loan_id);
    $this->db->from(TBL_LOAN_PAYMENT_DATE.' a');
    $this->db->join(TBL_LOAN_PAYMENT.' b', 'a.id = b.loan_payment_date_id', 'LEFT');
    $query = $this->db->get();
   // echo $this->db->last_query(); 
    return $query->result();
   }

   function loan_payment_date_detail($id){
    $this->db->where('id', $id);
    $this->db->from(TBL_LOAN_PAYMENT_DATE);
    $query = $this->db->get();
    if($query->num_rows()>0){
      return $query->row();
    }else{
      return null;
    }
   }

   function loan_history($user_id=''){
    if($user_id){
     $this->db->where('user_id', $user_id);
    }
    $this->db->from(TBL_LOAN_HISTORY);
    $query = $this->db->get();
    if($query->num_rows()>0){
      return $query->result();
    }
    return null;
   }
   
}
?>
