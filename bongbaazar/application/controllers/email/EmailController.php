<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailController extends CI_Controller 
{ 
	function __construct()
	{
	  	parent::__construct(); 
	  	$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");	
	  	date_default_timezone_set('Asia/Kolkata');		
		$this->load->helper(array('common_helper', 'string', 'form', 'security','url'));
		$this->load->library(array('form_validation', 'email'));
		$this->load->model('user/User_Model');	

    } 
    public function verify_email()
    {
		$email1=$this->input->post('email');
		$check=$this->User_Model->entty_check(['email'=>$email1],'tbl_users');
		if(!$check)
		{
		
			$otp=random_string('numeric',4);
			$config = Array(
				'protocol' => 'smtp',
				'mailtype' => 'html',
				'charset' => 'utf-8',
				'wordwrap' => TRUE
			);
			$this->load->library('email', $config);
			$from='developer.bongtechsolution@gmail.com';
			$from_name='Bongbasar';
			$to_email= $email1;
			$subject='Verify Email From Bongbasar';
			$message=$otp." is your Bongbasar OTP. Don't share this with anyone. Thank you.- Bongbasar";
			email_send();
			$this->email->from($from, $from_name);
			$this->email->to($to_email);
			$this->email->subject($subject);
			$this->email->message($message);
			$send=$this->email->send();
			$this->session->set_userdata('otp',$otp);
			echo json_encode(['message'=>"success"]);
		}
		else
		{
			echo json_encode(['message'=>"email"]);
		}
    }
    
}