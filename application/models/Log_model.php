<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Log_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->library("session");  
        $this->load->model('plan_model');      
    }

    public function get_all_user(){
        $fromDate = $this->input->get_post('fromdate');
        $toDate = $this->input->get_post('todate');
        $this->db->where('deletedAt',0);
        $query = $this->db->get(TBL_USER);
        if($query->num_rows()>0){
            $result = $query->result();
            $data = array();
            foreach($result as $line){
                $detail = $this->log_other_detail($line->id, $fromDate, $toDate);
                $line->last_transaction_date = $detail['last_transaction_date'];
                $line->total_debit = $detail['total_debit'];
                $line->total_credit = $detail['total_credit'];
                $line->total_transaction = $detail['total_transaction'];
                $data[] = $line;
            }
            return $data;
        }
        return null;
    }

    public function log_other_detail($user_id, $fromDate, $toDate){
        $last_transaction_date = $this->get_last_transaction_date($user_id, $fromDate, $toDate);
       return array(
            'last_transaction_date'=>$last_transaction_date,
            'total_debit'=>$this->get_total_debit($user_id, $fromDate, $toDate),
            'total_credit'=>$this->get_total_credit($user_id, $fromDate, $toDate),
            'total_transaction'=>$this->get_total_transaction($user_id, $fromDate, $toDate),
        );
    }

    public function get_total_transaction($user_id, $fromDate, $toDate){
        $this->db->where('user_id',$user_id);
        $this->db->from(TBL_FUND_HISTORY);
        if($fromDate & $toDate){
            $this->db->where('createdAt BETWEEN "'. date('Y-m-d', strtotime($fromDate)). '" and "'. date('Y-m-d', strtotime($toDate)).'"');
      
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_total_debit($user_id, $fromDate, $toDate){
        $this->db->select_sum('amount');
        $this->db->where('user_id',$user_id);
        $this->db->where('in_out','OUT');
        if($fromDate & $toDate){
            $this->db->where('createdAt BETWEEN "'. date('Y-m-d', strtotime($fromDate)). '" and "'. date('Y-m-d', strtotime($toDate)).'"');
      
        }
        $this->db->from(TBL_FUND_HISTORY);
       $query = $this->db->get();
       if($query->num_rows()>0){
           return $query->row()->amount;
       }
    }

    public function get_total_credit($user_id, $fromDate, $toDate){
        $this->db->select_sum('amount');
        $this->db->where('user_id',$user_id);
        $this->db->where('in_out','IN');
        if($fromDate & $toDate){
            $this->db->where('createdAt BETWEEN "'. date('Y-m-d', strtotime($fromDate)). '" and "'. date('Y-m-d', strtotime($toDate)).'"');
      
        }
        $this->db->from(TBL_FUND_HISTORY);
       $query = $this->db->get();
       if($query->num_rows()>0){
           return $query->row()->amount;
       }
    }

    public function get_last_transaction_date($user_id, $fromDate, $toDate){
        $this->db->where('user_id',$user_id);
        if($fromDate & $toDate){
            $this->db->where('createdAt BETWEEN "'. date('Y-m-d', strtotime($fromDate)). '" and "'. date('Y-m-d', strtotime($toDate)).'"');
      
        }
        $this->db->order_by('id','DESC');
        $this->db->limit(1);
        $query = $this->db->get(TBL_FUND_HISTORY);        
        if($query->num_rows()>0){           
            $result = $query->row();
            return $result->createdAt;
        }
        return null;
    }

    public function get_log_detail($user_id){
        $fromDate = $this->input->get_post('fromdate');
        $toDate = $this->input->get_post('todate');
        $this->db->where('user_id',$user_id);
        if($fromDate & $toDate){
            $this->db->where('createdAt BETWEEN "'. date('Y-m-d', strtotime($fromDate)). '" and "'. date('Y-m-d', strtotime($toDate)).'"');
      
        }
        $this->db->order_by('id','DESC');
        $query = $this->db->get(TBL_FUND_HISTORY);
        if($query->num_rows()>0){
            return $result = $query->result();
        }
        return null;
    }
    public function get_agent_log_detail($user_id){
        $fromDate = $this->input->get_post('fromdate');
        $toDate = $this->input->get_post('todate');
        $this->db->where('agent_id',$user_id);
        if($fromDate & $toDate){
            $this->db->where('createdAt BETWEEN "'. date('Y-m-d', strtotime($fromDate)). '" and "'. date('Y-m-d', strtotime($toDate)).'"');
      
        }
        $this->db->order_by('id','DESC');
        $query = $this->db->get(TBL_AGENTFUND);
        if($query->num_rows()>0){
            return $result = $query->result();
        }
        return null;
    }

    public function get_all_agent(){
        $fromDate = $this->input->get_post('fromdate');
        $toDate = $this->input->get_post('todate');
        $this->db->where('deletedAt',0);
        $query = $this->db->get(TBL_AGENT);
        if($query->num_rows()>0){
            $result = $query->result();
            $data = array();
            foreach($result as $line){
                $detail = $this->agent_log_other_detail($line->id, $fromDate, $toDate);
                $line->last_transaction_date = $detail['last_transaction_date'];
                $line->total_debit = $detail['total_debit'];
                $line->total_credit = $detail['total_credit'];
                $line->total_transaction = $detail['total_transaction'];
                $data[] = $line;
            }
            return $data;
        }
        return null;
    }

    public function agent_detail($user_id){
        $this->db->where('deletedAt',0);
        $this->db->where('id',$user_id);
        $query = $this->db->get(TBL_AGENT);
        if($query->num_rows()>0){
            return $query->row();
        }
    }

    public function user_detail($user_id){
        $this->db->where('deletedAt',0);
        $this->db->where('id',$user_id);
        $query = $this->db->get(TBL_USER);
        if($query->num_rows()>0){
            return $query->row();
        }
    }

    public function agent_log_other_detail($user_id, $fromDate, $toDate){
        $last_transaction_date = $this->get_agent_last_transaction_date($user_id, $fromDate, $toDate);
       return array(
            'last_transaction_date'=>$last_transaction_date,
            'total_debit'=>$this->get_agent_total_debit($user_id, $fromDate, $toDate),
            'total_credit'=>$this->get_agent_total_credit($user_id, $fromDate, $toDate),
            'total_transaction'=>$this->get_agent_total_transaction($user_id, $fromDate, $toDate),
        );
    }

    public function get_agent_total_transaction($user_id, $fromDate, $toDate){
        $this->db->where('agent_id',$user_id);
        if($fromDate & $toDate){
            $this->db->where('createdAt BETWEEN "'. date('Y-m-d', strtotime($fromDate)). '" and "'. date('Y-m-d', strtotime($toDate)).'"');
      
        }
        $this->db->from(TBL_AGENTFUND);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_agent_total_debit($user_id, $fromDate, $toDate){
        $this->db->select_sum('amount');
        $this->db->where('agent_id',$user_id);
        $this->db->where('operation_type','OUT');
        if($fromDate & $toDate){
            $this->db->where('createdAt BETWEEN "'. date('Y-m-d', strtotime($fromDate)). '" and "'. date('Y-m-d', strtotime($toDate)).'"');
      
        }
        $this->db->from(TBL_AGENTFUND);
       $query = $this->db->get();
       if($query->num_rows()>0){
           return $query->row()->amount;
       }
    }

    public function get_agent_total_credit($user_id, $fromDate, $toDate){
        $this->db->select_sum('amount');
        $this->db->where('agent_id',$user_id);
        $this->db->where('operation_type','IN');
        if($fromDate & $toDate){
            $this->db->where('createdAt BETWEEN "'. date('Y-m-d', strtotime($fromDate)). '" and "'. date('Y-m-d', strtotime($toDate)).'"');
      
        }
        $this->db->from(TBL_AGENTFUND);
       $query = $this->db->get();
       if($query->num_rows()>0){
           return $query->row()->amount;
       }
    }

    public function get_agent_last_transaction_date($user_id, $fromDate, $toDate){
        $this->db->where('agent_id',$user_id);
        $this->db->order_by('id','DESC');
        if($fromDate & $toDate){
            $this->db->where('createdAt BETWEEN "'. date('Y-m-d', strtotime($fromDate)). '" and "'. date('Y-m-d', strtotime($toDate)).'"');
      
        }
        $this->db->limit(1);
        $query = $this->db->get(TBL_AGENTFUND);
        if($query->num_rows()>0){
           // echo $this->db->last_query();
            $result = $query->row();
            return $result->createdAt;
        }
        return null;
    }
}
?>