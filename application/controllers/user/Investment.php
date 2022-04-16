<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 

class Investment extends MY_Controller {    
    function __construct() {
        parent::__construct();
        $this->load->model('investment_model');
        $this->load->model('plan_model');
        $this->header_data['headTitle'] = "Nuvest : Investment";
        $this->customerId = $this->session->userdata('CUSTOMERID');
        check_front_login();
    }

    public function index(){
        $this->header_data['headTitle'] = "Nuvest : Customer Investment";
        $this->data['all_investment_plan'] = $this->plan_model->get_plan_by_category('INVESTMENT');
        $this->data['total_investment'] = $this->investment_model->get_investment_saving($this->customerId);

        $this->render('front/investment/newplan.php');
    }
    public function createPlan(){
        
        $params = $this->uri->uri_to_assoc(4);
        if($this->input->post()){
            $_POST['user_id'] = $this->session->userdata('CUSTOMERID');
            $_POST['plan_id'] = $params['pid'];
            $plan_rate =  $this->plan_model->getPlanPaymentDuration($this->security->xss_clean($_POST['plan_id']),$this->security->xss_clean($_POST['payment_duration']));
            $_POST['plan_rate'] =  JSON_ENCODE($plan_rate);
            $_POST['interest_rate'] =  $plan_rate->rate;
            $addId = $this->investment_model->create_plan($this->security->xss_clean($this->input->post()));
            //$this->investment_model->insert_fund_history($addId);
            $this->investment_model->insert_payment_date($addId);
            $investmentDetail = $this->investment_model->getRecord($addId);
            saveInvestmentNotification($investmentDetail, 'WEB');
            if($addId){
              $this->session->set_flashdata('success', 'Information successfully added');
              redirect('user/investment/investment_detail/'.$addId);
            }
            $this->session->set_flashdata('errordata', 'Something went wrong try again');
            redirect("/user/investment");
        }       
        $this->data['planDetail'] = $this->plan_model->getrecord($params['pid']);
        $this->data['paymentType'] = $this->plan_model->getPaymentTypeByPlanId($params['pid']);
        $this->data['paymentDuration'] = $this->plan_model->getPaymentDurationByPlanId($params['pid']);
        $this->header_data['headTitle'] = "Nuvest : Customer Create Plan ".$this->data['planDetail']->name;
        $this->render('front/investment/createplan.php');
    }

    public function installment($day,$duration,$start_date){
      $amount = 10000;
      installment($day,$duration,$start_date, $amount);
    }

    public function myinvestment(){
        $_POST['user_id'] = $this->session->userdata('CUSTOMERID');
        $this->data['all_record'] = $this->investment_model->getAllRecord($this->security->xss_clean($_POST['user_id']));
        $this->render('front/investment/myinvestment.php');
    }

    public function investment_detail($id){
        $this->data['record'] = $this->investment_model->getRecord($id);
        $this->data['investment_charge'] = get_investment_brh_charge('BRH_UNMATURED_CHARGE');
        $this->data['sol_charge'] = get_investment_brh_charge('SOL_UNMATURED_CHARGE');
        $this->data['vip_charge'] = get_investment_brh_charge('VIP_UNMATURED_CHARGE');
        $this->data['cash_payment'] = $this->investment_model->get_investment_payment_data($id);
        $this->render('front/investment/detail');
    }

    function move_to_wallet(){
        if($_POST['invid']){
           $invid = $this->security->xss_clean($_POST['invid']);
           $pdetail = $this->investment_model->getRecord($invid);
           //sol move
           if($pdetail->plan_id ==3){
                 $amount_recieved = $this->investment_model->get_sol_total_recieved($pdetail->id);
                $this->investment_model->insertInterestinfundsol($amount_recieved,$pdetail);
                $this->investment_model->insertmaturefundsol($amount_recieved,$pdetail);
                $this->investment_model->update_investment_payment_sol($invid);
                $this->investment_model->invest_maturity_update($pdetail->id);
                echo JSON_ENCODE(array('status'=>true));
           }
           if($pdetail->plan_id ==4){
            $this->investment_model->insertmaturefundVIP($pdetail);
            $this->investment_model->invest_maturity_update($pdetail->id);
            echo JSON_ENCODE(array('status'=>true));
            }
        }else{
            $id = $this->security->xss_clean($_POST['id']);
            $pdetail = $this->investment_model->get_investment_payment_detail($id);
            $pdetail->investment_payment_id =$id;
            //brh move
            if($pdetail->plan_id =2 && $pdetail->payment_type_id ==6){            
                $this->investment_model->insertInterestinfundbrh($pdetail);
                $this->investment_model->insertmaturefund($pdetail);
                $this->investment_model->update_investment_payment($id);
                $this->investment_model->invest_maturity_update($pdetail->investment_id);
            }else{
                $this->investment_model->insertInterestinfund($pdetail);
                $this->investment_model->update_investment_payment($id);
            }
        
        echo JSON_ENCODE(array('status'=>true));
        }
    }

    function investment_payment(){
        $investment_date_id =  $this->security->xss_clean($this->input->post('investment_date_id'));
        $investment_payment_date_detail = $this->investment_model->investment_payment_date_detail($investment_date_id);
        if(!$investment_payment_date_detail){
          echo JSON_ENCODE(array('status'=>false));
        }
        $investment_detail = $this->investment_model->getRecord($investment_payment_date_detail->investment_id);
        $inpid= $this->investment_model->updateFundHistory($investment_detail, $investment_date_id,  $investment_payment_date_detail->payment_date);
        echo JSON_ENCODE(array(
            'status'=>true,
            'cpid'=>$inpid,
            'payment_date' => showDateFormateTime(date('Y-m-d H:i:s')),
            'cash_saving' => $this->investment_model->get_investment_saving($investment_detail->user_id)
      
          ));
    }
}