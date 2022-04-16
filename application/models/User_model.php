<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model {

  public function __construct() {
      parent::__construct();
      $this->load->library("session");
  }

  function get_count_record(){
    $this->db->where("status", '1');
    $this->db->where("deletedAt", '0');
    $query = $this->db->get(TBL_USER);
    return $query->num_rows();
  }

  function checkUser($post, $id=null) {
    $email = $post['email'];
    if($id){
      $this->db->where('id !=', $id);
    }    
    $this->db->where("email", $email);
    $this->db->where("status", '1');
    $this->db->where("deletedAt", '0');
    $query = $this->db->get(TBL_USER);
    return $query->num_rows();
  }

  function checkPhone($post, $id=null) {
    $phone = $post['phone'];
    if($id){
      $this->db->where('id !=', $id);
    }    
    $this->db->where("phone", $phone);
    $this->db->where("status", '1');
    $this->db->where("deletedAt", '0');
    $query = $this->db->get(TBL_USER);
    return $query->num_rows();
  }
  
  function checkUserEdit($post) {
    $email = $post['email'];
    $this->db->where("email", $email);
    $this->db->where("id !=", $post['id']);
    $this->db->where("status", '1');
    $query = $this->db->get(TBL_USER);
     return $query->num_rows();
  }

  function addUser($post){
    if($post!=NULL)
      {
          $ins['name']   = $post['name'];
          $ins['email']   = $post['email'];
          $ins['phone']   = $post['phone'];
          $ins['password']   = md5($post['password']);
          $ins['refer_friend']   = $post['refer_friend'] ? $post['refer_friend'] : '';
          $ins['hear_about_us']   = $post['hear_about_us'] ? $post['hear_about_us'] : '';
          $ins['status']   = 1;
          $ins['deletedAt']   = 0;
          
          if($this->db->insert(TBL_USER,$ins))
          {
              return TRUE;
          }
          
      }
      return FALSE;
  }
  
  function UpdateUser($post){
    if($post!=NULL)
      {
          $ins['name']   = $post['name'];
          $ins['email']   = $post['email'];
          $ins['phone']   = $post['phone'];
          //$ins['password']   = md5($post['password']);
          $ins['refer_friend']   = $post['refer_friend'] ? $post['refer_friend'] : '';
          $ins['hear_about_us']   = $post['hear_about_us'] ? $post['hear_about_us'] : '';
          $ins['status']   = 1;
          
          if($this->db->where('id', $post['id'])->update(TBL_USER,$ins))
          {
              return TRUE;
          }
          
      }
      return FALSE;
  }

  function editUser($post, $id){
    if($post!=NULL)
      {
          $ins['name']   = $post['name'];
          if(isset($post['email'])){
            $ins['email']   = $post['email'];
          }
          if(isset($post['phone'])){
            $ins['phone']   = $post['phone'];
          }
          if(isset($post['password'])){
            $ins['password']   = md5($post['password']);
          }
          if(isset($post['gender'])){
            $ins['gender']   = $post['gender'];
          }
          $ins['refer_friend']   = isset($post['refer_friend'])?$post['refer_friend']:'';
          $ins['hear_about_us']   = isset($post['hear_about_us'])?$post['hear_about_us']:'';
          if($post['image']){
            $ins['image']   = $post['image'];
          }
          if($post['type'] == 'home'){
            $ins['dob']   = $post['dob'];
            $ins['address']   = $post['address'];
          }
          $this->db->where('id', $id)->update(TBL_USER, $ins);
          return TRUE;          
      }
      return FALSE;
  }

  function get_all_record(){
    $this->db->where("deletedAt", '0');
    $this->db->order_by("id", "DESC");
    $query = $this->db->get(TBL_USER);
    if($query->num_rows() > '0')
    {
        return $query->result();
    }
    return NULL;
  }

  function getrecord($id){
    $this->db->where("id", $id);
    $this->db->where("deletedAt", '0');
    $query = $this->db->get(TBL_USER);
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
      if($this->db->where('id', $id)->update(TBL_USER,$data)){
        return true;
      }
      return false;
  }
  function login($post){
    $email = $post['email'];
    $userPassword = $post['userPassword'];
    $this->db->where("email", $email);
    $this->db->or_where("phone", $email);
    $this->db->where("status", '1');
    $this->db->where("deletedAt", '0');
    $query = $this->db->get(TBL_USER);
   // echo $this->db->last_query();die;
    if($query->num_rows() > '0')
    {   
      //print_r($query->result());  die;
      foreach ($query->result() as $rows) {
        if($rows->password == md5($userPassword)){
         // echo "done";die;
          $newdata = array(
            'CUSTOMERID' => $rows->id,
            'CUSTOMERNAME' => $rows->name,                        
            'CUSTOMERPHONE' => $rows->phone, 
            'CUSTOMEREMAIL' => $rows->email,                       
            'CUSTOMERIMAGE' => $rows->image,                        
           );
           $this->session->set_userdata($newdata);
           if($rows->tofa){
            $pass= rand(100000, 999999);
            $rows->tofaotp = $pass;
            $this->user_model->generate_to_fa_password($rows, $pass);
            redirect('/index/tofaotp');
           }
           $this->user_model->update_last_login($rows->id);
          
           return true;
        }else {
          $this->session->set_flashdata('flashdata', 'Login Authentication Failed');
          return false;
        }
      }

    }else {
      $this->session->set_flashdata('flashdata', 'Login Authentication Failed');
      return false;
    }
  }

  function update_last_login($user_id){
    if($this->db->where('id',$user_id)->update(TBL_USER,array('last_login'=>date('Y-m-d H:i:s'))))
    {
     // echo $this->db->last_query();die;
     return true;
    }
  }

  function checkPassword($post){
    $this->db->where("id", $post['customerId']);
    $this->db->where("status", '1');
    $this->db->where("deletedAt", '0');
    $query = $this->db->get(TBL_USER);
    $result = $query->row();
    if($result){
      if($result->password == md5($post['oldpassword'])){
        return true;
      }
    }
    return FALSE;
  }

  function changePassword($post){
    $uid = $post['customerId'];
    $newPassword = $post['pass_confirmation'];  
    $Password = md5($newPassword);     
    $updatedata = array(
        'password' => $Password,
    );
    $this->db->where('id', $uid);
    $this->db->update(TBL_USER, $updatedata);      
    return true;
  }

  function update_status_dermalog($id, $status){
    update_table_data($id,array(
      "verify_dermalog" =>$status,
      "verify_dermalog_date" => date('Y-m-d')
    ),TBL_USER);
  }

  function update_status_nif($id, $status){
    update_table_data($id,array(
      "verify_nif" =>$status,
      "verify_nif_date" => date('Y-m-d')
    ),TBL_USER);
  }

  function ResendPassword($post) {
    $this->db->where("email", $post['email']);
    $query = $this->db->get(TBL_USER);
    if ($query->num_rows() > 0) {
        foreach ($query->result() as $line) {
            $uid = $line->id;
            $possible = '012dfds3456789bcdfghjkmnpq454rstvwx54yzABCDEFG5HIJ5L45MNOP352QRSTU5VW5Y5Z';
            $newPassword = '1234567';//substr($possible, mt_rand(0, strlen($possible) - 10), 6);
            $Password = md5($newPassword);
            // echo $newPassword;
            // echo "<br/>".$Password;
            // die;
            $updatedata = array(
                'password' => $Password,
            );
            $this->db->where('id', $uid);
            $this->db->update(TBL_USER, $updatedata);
            $this->session->set_flashdata('success', 'Your Password has been send successfully to your email Id.');
            $to = $line->email;
            $subject = "Forget Password";
            $from = $line->email;
            $message = '<table cellspacing="0" cellpadding="0" align="center" width="100%">
                            <tbody>
                                <tr>
                                    <td valign="top" height="81" colspan="3">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td height="10">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td height="30" style="font-family: tahoma; text-decoration: none; font-weight: bold; font-size: 11px; color: rgb(55, 64, 73);" colspan="3">&nbsp;Hello ' . $line->name . ',</td>
                                </tr>
                                <tr>
                                    <td height="30" width="76%" style="font-family: Tahoma; font-size: 12px; font-weight: bold; text-decoration: none; color: rgb(83, 91, 97);" colspan="3">&nbsp;Your Password is given bellow.</td>
                                </tr>
                                <tr>
                                    <td height="30" style="font-family: Tahoma; font-size: 12px; font-weight: normal; text-decoration: none; color: rgb(83, 91, 97);" colspan="4">&nbsp;' . $newPassword . '</td>
                                </tr>

                                <tr>
                                </tr>
                                <tr>
                                </tr>
                                <tr>
                                    <td height="30" colspan="4">&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>';
            @mail($to, $subject, "$message\r\n", "From: $from\n" . "MIME-Version: 1.0\n" . "Content-type:text/html;charset=iso-8859-1" . "\r\n" . 'X-Mailer: PHP/' . phpversion());
            return true;
        }
    }
}

function logout($post){
  $this -> db -> where('user_id', $post['user_id']);
  $this -> db -> where('device_id', $post['device_id']);
  $this -> db -> where('device_type', $post['device_type']);
  $this -> db -> delete(TBL_USER_DEVICE);
  return true;
}

function addFriend($post){
  if($post!=NULL)
      {
          $ins['email']   = $post['email'];
          $ins['user_id']   = $post['user_id'];
          $ins['status']   = 1;
          
          if($this->db->insert(TBL_FRIENDS,$ins))
          {
              return TRUE;
          }
          
      }
      return FALSE;
  }

  function checkFriends($post){
    $this->db->where("user_id", $post['user_id']);
    $this->db->where("status", '1');
    $this->db->where("email", $post['email']);
    $query = $this->db->get(TBL_FRIENDS);
    if($query->num_rows()){
      return true;
    }
    return FALSE;
  }

  function generate_to_fa_password($rows, $pass){
    
    if($this->db->where('id',$rows->id)->update(TBL_USER,array('tofaotp'=>$pass)))
    {
      $this->sendtofapasswordtoemail($rows->email, $pass);
        return TRUE;
    }
  }

  function sendtofapasswordtoemail($email, $pass){
    $data = "Hi,<br/><br/>
    Your otp : ".$pass;
    send_email($data, $email);
  }

  function insert_verify_docs($data){
    if($this->db->insert(TBL_VERIFY_DOCS,$data))
    {
      if($data['doc_type'] == 'Dermalog'){
        $this->save_dermalog_notification($data);
      }else{
        $this->save_nif_notification($data);
      }
      return TRUE;
    }
    return false;
  }

  function get_dermolog_detail($user_id){
    $this->db->where("user_id", $user_id);
    $this->db->where("doc_type", 'Dermalog');
    $query = $this->db->get(TBL_VERIFY_DOCS);
    if($query->num_rows()){
      return $query->result();
    }
    return [];
  }

  function get_nif_detail($user_id)
  {
    $this->db->where("user_id", $user_id);
    $this->db->where("doc_type", 'Nif');
    $query = $this->db->get(TBL_VERIFY_DOCS);
    if($query->num_rows()){
      return $query->result();
    }
    return [];
  }

  function save_dermalog_notification($data){
    if($data['status'] == 3){
      $message = NOTIFICATION['customer']['dermalogUpload'];
      $title = NOTIFICATION['customer']['dermalogUploadTitle'];
    }else{
      $message = NOTIFICATION['customer']['dermalogStatus'];
      $title = NOTIFICATION['customer']['dermalogStatusTitle'];
    }
   $msg = str_replace('{STATUS}', DERMALOG[$data['status']], $message);
    $ins['type_of_user'] = 'Web'; 
    $ins['user_id'] = $data['user_id']; 
    $ins['module'] = 'Customer Document';  
    $ins['title'] = $title; 
    $ins['message'] = $msg; 
    $ins['data'] = JSON_ENCODE($data);
    if($this->db->insert(TBL_NOTIFICATION,$ins))
    {  
      send_notification($ins['user_id'],$ins);
        return TRUE;
    }else{
      return FALSE;
    }
  }

  function save_nif_notification($data){
    if($data['status'] == 3){
      $message = NOTIFICATION['customer']['nifUpload'];
      $title = NOTIFICATION['customer']['nifUploadTitle'];
    }else{
      $message = NOTIFICATION['customer']['nifStatus'];
      $title = NOTIFICATION['customer']['nifStatusTitle'];
    }
   $msg = str_replace('{STATUS}', NIFDOC[$data['status']], $message);
    $ins['type_of_user'] = 'Web'; 
    $ins['user_id'] = $data['user_id']; 
    $ins['module'] = 'Customer Document';  
    $ins['title'] = $title; 
    $ins['message'] = $msg; 
    $ins['data'] = JSON_ENCODE($data);
    if($this->db->insert(TBL_NOTIFICATION,$ins))
    {  
      send_notification($ins['user_id'],$ins);
      return TRUE;
    }else{
      return FALSE;
    }
  }

  public function checkUserForLoan($user_id){
    $user_detail = $this->getrecord($user_id);
    $todate = date('Y-m-d');
    $days = get_days($user_detail->createdAt, $todate);
    $old = 0;
    $kyc = 0;
    if($days>180){
      $old = 1;
    }
    if(
       $user_detail->verify_phone ==1 &&
       $user_detail->verify_email == 1 &&
       $user_detail->verify_nif == 2 &&
       $user_detail->verify_dermalog == 2
    ){
      $kyc = 1;      
    }
     $arr =array('kyc'=>$kyc, 'old'=>$old);
    return $arr;

  }


}
?>
