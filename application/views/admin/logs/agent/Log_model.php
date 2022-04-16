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
        $this->db->where('deletedAt',0);
        $query = $this->db->get(TBL_USER);
        if($query->num_rows()>0){
            $result = $query->result();
            $data = array();
            foreach($result as $line){
                $detail = $this->log_other_detail($line->id);
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

    public function log_other_detail($user_id){
        $last_transaction_date = $this->get_last_transaction_date($user_id);
       return array(
            'last_transaction_date'=>$last_transaction_date,
            'total_debit'=>$this->get_total_debit($user_id),
            'total_credit'=>$this->get_total_credit($user_id),
            'total_transaction'=>$this->get_total_transaction($user_id),
        );
    }

    public function get_total_transaction($user_id){
        $this->db->where('user_id',$user_id);
        $this->db->from(TBL_FUND_HISTORY);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_total_debit($user_id){
        $this->db->select_sum('amount');
        $this->db->where('user_id',$user_id);
        $this->db->where('in_out','OUT');
        $this->db->from(TBL_FUND_HISTORY);
       $query = $this->db->get();
       if($query->num_rows()>0){
           return $query->row()->amount;
       }
    }

    public function get_total_credit($user_id){
        $this->db->select_sum('amount');
        $this->db->where('user_id',$user_id);
        $this->db->where('in_out','IN');
        $this->db->from(TBL_FUND_HISTORY);
       $query = $this->db->get();
       if($query->num_rows()>0){
           return $query->row()->amount;
       }
    }

    public function get_last_transaction_date($user_id){
        $this->db->where('user_id',$user_id);
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
        $this->db->where('user_id',$user_id);
        $this->db->order_by('id','DESC');
        $query = $this->db->get(TBL_FUND_HISTORY);
        if($query->num_rows()>0){
            return $result = $query->result();
        }
        return null;
    }

    public function get_all_agent(){
        $this->db->where('deletedAt',0);
        $query = $this->db->get(TBL_AGENT);
        if($query->num_rows()>0){
            $result = $query->result();
            $data = array();
            foreach($result as $line){
                $detail = $this->agent_log_other_detail($line->id);
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

    public function agent_log_other_detail($user_id){
        $last_transaction_date = $this->get_last_transaction_date($user_id);
       return array(
            'last_transaction_date'=>$last_transaction_date,
            'total_debit'=>$this->get_agent_total_debit($user_id),
            'total_credit'=>$this->get_agent_total_credit($user_id),
            'total_transaction'=>$this->get_agent_total_transaction($user_id),
        );
    }

    public function get_agent_total_transaction($user_id){
        $this->db->where('agent_id',$user_id);
        $this->db->from(TBL_AGENTFUND);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_agent_total_debit($user_id){
        $this->db->select_sum('amount');
        $this->db->where('agent_id',$user_id);
        $this->db->where('in_out','OUT');
        $this->db->from(TBL_AGENTFUND);
       $query = $this->db->get();
       if($query->num_rows()>0){
           return $query->row()->amount;
       }
    }

    public function get_agent_total_credit($user_id){
        $this->db->select_sum('amount');
        $this->db->where('agent_id',$user_id);
        $this->db->where('in_out','IN');
        $this->db->from(TBL_AGENTFUND);
       $query = $this->db->get();
       if($query->num_rows()>0){
           return $query->row()->amount;
       }
    }

    public function get_agent_last_transaction_date($user_id){
        $this->db->where('agent_id',$user_id);
        $this->db->order_by('id','DESC');
        $this->db->limit(1);
        $query = $this->db->get(TBL_AGENTFUND);
        if($query->num_rows()>0){
            $result = $query->row();
            return $result->createdAt;
        }
        return null;
    }
}
?>