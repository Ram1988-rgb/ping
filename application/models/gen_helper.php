<?php    
    function check_admin_login()
    {
        $ci=& get_instance();
        if (!$ci->login_model->checkSession()) {
                redirect('admin');
            }
    }
    function load_alert()
    {
     $ci=& get_instance();
     $ci->load->view('Layout/alert');
    }

    function check_front_login()
    {
        $ci=& get_instance();
        if (!$ci->login_model->checkFrontSession()) {
                redirect('/');
        }
    }

    function check_agent_login()
    {
        $ci=& get_instance();
        if (!$ci->login_model->checkAgentSession()) {
                redirect('/agent');
        }
    }

    function pr($data, $di){
        echo "<pre>";
        print_r($data);
        if($di){
            die;
        }
    }

    function manageInstallment($day,$duration,$start_date, $amount){
        if($day){
        // echo $day."========".$duration."=============".$start_date;
            $endDate = date('Y-m-d', strtotime("+".$duration." months", strtotime($start_date)));
            //echo "<br/> end date==".$endDate;
            $days_between = ceil((strtotime($endDate)- strtotime($start_date))/24/3600);
            //$days_between = ceil(abs($endDate - $start_date) / 86400);
        // echo "<br/>days_between==".$days_between;
            $installment =ceil($days_between/$day);
            //echo "<br/>installment_count==".$installment;
            $installment_amount =ceil($amount/$installment);
            //echo "<br/>installment_amount==".$installment_amount;
            return array(
                'endDate' => $endDate,
                'days_between' => $days_between,
                'countInstallment' => $installment,
                'installment_amount' => $installment_amount,
            );
        }else{
            return array(
                'endDate' => $start_date,
                'days_between' => 0,
                'countInstallment' => 1,
                'installment_amount' => $amount,
            );

        }
      }
    

    function insertFormateDate($date){
       return $your_date = date("Y-m-d", strtotime($date));
    }
    function showDateFormate($date){
        return $your_date = date("d-m-Y", strtotime($date));
     }
     function showDateFormateTime($date){
        return $your_date = date("d-m-Y h:i:s", strtotime($date));
     }

    function nextPaymentdate($date, $days){
        return date('d M Y', strtotime($date. ' + '.$days.' days'));
    }

    function getRecord($id, $table){
        $ci=& get_instance();
        $ci->db->where("id", $id);
        $query = $ci->db->get($table);
        return $query->row(); 
    }

    function update_table_data($id,$data,$table){
        $ci=& get_instance();
        $ci->db->where("id", $id);
        $query = $ci->db->update($table,$data);
        //echo $ci->db->last_query();
        return true;
    }

  function uploadImage($field_name, $FILES, $originalpath, $thumb_path, $thumb_width, $thumb_height){        
    $ci=& get_instance();
    if(isset($FILES[$field_name]['name'])){
      $filename                   = $FILES[$field_name]['name'];
      $config['upload_path']      = $originalpath;;
      $config['file_name']        = $filename;
      $config['allowed_types']    = ALLOWED_IMAGE_EXTENSION;
      $config['max_size']         = USER_IMAGE_MAX_SIZE;
      $config['max_width']        = DEFAULT_IMAGE_MAX_WIDTH;
      $config['max_height']       = DEFAULT_IMAGE_MAX_HEIGHT;
      $config['encrypt_name']     = TRUE; 
      $ci->load->library('upload');
      $ci->upload->initialize($config);
        
      if($ci->upload->do_upload($field_name)){
        $filename1                          = $ci->upload->data('file_name');
       
        $upload_arr                         = array();
        $upload_arr['file_name']            = $filename1;
        $upload_arr['image_height']         = $thumb_width;
        $upload_arr['image_width']          = $thumb_height;
        //print_r($upload_arr); exit;
        image_resize($thumb_width, $thumb_height, $upload_arr, $originalpath, $thumb_path);
        return $filename1;
      }
     echo $ci->image_lib->display_errors();die;
    }   

  }


 function image_resize($max_height, $max_width, $upload_arr, $source_dir, $upload_dir) {
  // pr($upload_arr); exit;
  $ci=& get_instance();
  $filename   = $upload_arr['file_name'];
  $up_height  = $upload_arr['image_height'];
  $up_width   = $upload_arr['image_width'];
  $height     = $max_height;
  $width      = $max_width;
  if ($max_height >= $up_height && $max_width >= $up_width) {
      $height     = $up_height;
      $width      = $up_width;
  }
  if ($up_height > $max_height || $up_width > $max_width) {
      if ($up_height > $max_height && $up_width > $max_width && $up_height == $up_width) {
          $height  = $max_height;
          $width   = $max_width;
      } else {

          if ($up_height > $max_height && $up_width > $max_width) {
              if ($up_height > $up_width) {
                  $height             = $max_height;
                  $differentiate      = $up_height / $max_height;
                  $width              = $up_width / $differentiate;
              }
              if ($up_height < $up_width) {
                  $width = $max_width;
                  $differentiate      = $up_width / $max_width;
                  $height             = $up_height / $differentiate;
              }
          } else {
              if ($up_height > $max_height && $up_width <= $max_width) {
                  if ($up_height > $up_width) {
                      $height         = $max_height;
                      $differentiate  = $up_height / $max_height;
                      $width          = $up_width / $differentiate;
                  }
              } else {
                  if ($up_height <= $max_height && $up_width > $max_width) {

                      $width          = $max_width;
                      $differentiate  = $up_width / $max_width;
                      $height         = $up_height / $differentiate;
                  }
              }
          }
      }
  }

  $config1['image_library']   = 'gd2';
  $config1['new_image']       = $upload_dir . $filename;
  $config1['source_image']    = $source_dir . $filename;
  $config1['create'] = TRUE;
  $config1['maintain_ratio']  = TRUE;
  $config1['width']           = $width;
  $config1['height']          = $height;
  //print_r($config1); exit;
  $ci->image_lib->initialize($config1);
  $ci->image_lib->resize();
  //echo $ci->image_lib->display_errors();
} 

function get_user_detail($id){
    $ci=& get_instance();
    $ci->db->where("id", $id);
    $query = $ci->db->get(TBL_USER);
    return $query->row(); 
}

function createJWTToken($data){
   return $token = JWT::encode($data, JWTSECRETKEY);
}

function validateJWTToken($token){
    return $data = JWT::decode($token, JWTSECRETKEY, true);
}

function getCurrentBalence(){
    return "85,625";
}

function time_diff_hours($startdate, $enddate) {
    $date1 = new DateTime($startdate);
    $date2 = new DateTime($enddate);
    
     $diff = $date2->diff($date1);
     //return $your_date = date("d, M Y", strtotime($startdate));
     if($diff->d>0){
        return $your_date = date("d,M Y", strtotime($startdate));
     }else if($diff->h>0){
        return $hours = $diff->h." Hours ago";
     }else{
        return $hours = $diff->i." Minute ago";
     }
     
}

function saveFundHistory($data){
    $ci=& get_instance();
    $ci->db->insert(TBL_FUND_HISTORY,$data);
    return true;    
}

function file_extention($s){
    $n = strrpos($s,".");
    return ($n===false) ? "" : substr($s,$n+1);
}
function getModulePermission($page,$adminId){
    $ci=& get_instance();
    $ci->db->where('admin_module_id',$page);
    $ci->db->where('permission',1);
    $ci->db->where('admin_id',$adminId);
    $query = $ci->db->get();
    $query->num_rows();  
}


?>
