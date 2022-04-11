<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
		$this->load->model('user_model');
		$this->load->model('fund_model');
    }
	public function login()
	{
		echo "hello";
	}
	
	public function forgotpassword(){
		if($this->input->post())
		{
			$emailData = $this->user_model->checkUser($this->input->post());
			if(!$emailData){
				redirect('user/index/forgotpassword');
			}
			$this->user_model->ResendPassword($_POST);
		}
		$this->load->view('front/forgot');
	}

	function makefundhistoryPdf($user_id){ 	
	   
		$fund_history = $this->fund_model->get_fund_history($user_id);
		
		$html=$this->load->view('front/fund/history_pdf',array('details'=>$fund_history), true); 
	//	generate_pdf($html, $user_id);die;
		$this->load->library('pdf');
		$dompdf = new Dompdf\Dompdf();
		// Set Font Style
		$dompdf->set_option('defaultFont', 'Courier');
		//$html = "<p style='text-align: center'>My First Dom Pdf Example</p>";
		$dompdf->loadHtml($html);
		// To Setup the paper size and orientation
		$dompdf->setPaper('A4', 'landscape');
		// Render the HTML as PDF
		$dompdf->render();
		// Get the generated PDF file contents
		$pdf = $dompdf->output();
		// Output the generated PDF to Browser
		$dompdf->stream($user_id."-".time().".pdf");
		
	  }
}
