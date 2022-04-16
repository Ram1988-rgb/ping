<?php 
class Config_model extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->library("session");
  }

  function getConfig_value($key){
    $this->db->where('label_key',$key);
    $this->db->from(TBL_CONFIG);
    $query = $this->db->get();
    if($query->num_rows()>0){
        return $query->row();
    }
    return null;
  }

  function get_all_record(){
    $this->db->order_by('sequence','ASC');
    $this->db->from(TBL_CONFIG);
    $query = $this->db->get();
    if($query->num_rows()>0){
        return $query->result();
    }
    return null;
  }

  function update($id,$value){
    $this->db->where('id', $id);
    $this->db->update(TBL_CONFIG, array(
        'value'=>$value,        
    ));
    return true;
  }

}