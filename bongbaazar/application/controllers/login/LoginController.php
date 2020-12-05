<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {
	
	 
	function __construct()
	{
	  	parent::__construct(); 	
	  	$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");	
	  	date_default_timezone_set('Asia/Kolkata');	
		$this->load->helper(array('common_helper', 'string', 'form', 'security'));
		$this->load->library(array('form_validation', 'email'));
		$this->load->model('login/Login_Model');		
	} 

	public function index()
	{
		
			
		if(($this->session->userdata('loginDetail')!==NULL)){
		   redirect('');
		}
		else {
			$this->load->view('login');
		}
	}

	public function forgotpass()
	{
		$this->load->view('forgot_password');

	}	
	public function verify()
	{
		$userId =$this->input->post('userId');
		$password = MD5($this->security->xss_clean($this->input->post('password')));	

		if(!empty($userId) && !empty($password))
		{
			$result =$this->Login_Model->selectrow(['email'=>$userId,'password'=>$password ],'tbl_users');	
				
			if(!empty($result))
			{
				if($result->status=='Active')   
				{
					$this->session->set_userdata('loginDetail',$result);					
					$this->session->set_flashdata('success', 'You have logged in successfully.');	
					echo json_encode(['result'=>1]);
	        		return false;
					
				}
			}
			else
			{
				$result =$this->Login_Model->selectrow(['mobile_no'=>$userId,'password'=>$password ],'tbl_users');
				if(!empty($result))
				{
					if($result->status=='Active')
					{
						$this->session->set_userdata('loginDetail',$result);					
	        			echo json_encode(['result'=>1]);
	        			return false;

					}
				}
				else
				{
					//$this->session->set_flashdata('error', 'Please enter your registered E-mail|mobile no. and valid password.');	
					echo json_encode(['result'=>0]);
	        		return false;
				}
			}
		}  
		
	}
	public function forgotpassword()
	{
		if($this->input->post('email')!='')
		{

			$email=$this->input->post('email');
			$this->db->where('email', $email);
			$row=$this->db->get('tbl_master_login')->row();
			if(!empty($row)){

				$password=randomPassword();

				$data=array(
					'password'=>md5($password)
				);
				$this->db->where('id', $row->id);
				$update=$this->db->update('tbl_master_login', $data);
				$config = Array(
		          'protocol' => 'smtp',
		          'mailtype' => 'html', 
		          'charset' => 'utf-8',
		          'wordwrap' => TRUE

		      );
				$this->load->library('email', $config);				
				$from='pradipta.bongtechsolutions@gmail.com';		
				$from_name='Bongtech';
				$to_email=$email;
				$subject='Bongtech : Reset password';
				$message='<p>Dear '.$row->first_name.' '.$row->last_name.'</p><p> You have successfully changed your password. <br> Your new password is: '.$password.' </p><p>Warm Regards <br>Team Bongtech</p> <p><span style="color:red">This is an automated response. Please do not directly reply to this email.</span></p>';
				
				email_send();
				$this->email->from($from, $from_name);
				$this->email->to($to_email);
				$this->email->subject($subject);
				$this->email->message($message);
				$this->email->send();
								
				$this->session->set_flashdata('success', 'We have sent you a new password to your registered email.');
					redirect('/');

			}else{
				$this->session->set_flashdata('error', 'Email is not registered with us');
					redirect('forgotpassword');
			}
		}
	}
	
	public function resetpassword()
	{
		$transid=$this->session->userdata('loginDetail')->id;
		if(!empty($_POST))
		{

			$old_pass=MD5($this->input->post('current_password'));
			$this->db->where('email', $this->session->userdata('loginDetail')->email);
			$this->db->where('password', $old_pass);
			$old_data=$this->db->get('tbl_master_login')->row();
			if(!empty($old_data))
			{

				$check_pass=MD5($this->input->post('password'));

				if($check_pass!=$old_data->password){

				if($this->input->post('password')!='')
				{
					$password=md5($this->input->post('password'));
					$data=array('password'=>$password);
					$this->db->where('id', $transid);				
					$update=$this->db->update('tbl_master_login', $data);
					if($update)
					{
						$this->session->set_flashdata('success', 'Your password has been changed successfully!');
						$this->session->unset_userdata('loginDetail');
						redirect('/');
					}

				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Can not use old password!');
			}
			}
			else
			{
				$this->session->set_flashdata('error', 'Your current password are not correct!');
			}
		}

		$current_pass=$this->session->userdata('view_password');		

		$this->data['page_title']='Bongtech | Change Password';
		$this->data['subview']='change_pass/index';
		$this->data['current_pass']=$current_pass;
		$this->load->view('admin/layout/default', $this->data);
	}

	public function foorgot_pass_email()
	{
		$email=$this->input->post('email');

		$this->db->where('email', $email);
		$row=$this->db->get('tbl_master_login')->row();

		if(!empty($row))
		{
		 
		 $email=false;
        }
        else
        {
           $email=true; 
        }
        echo $email;
	}

	function logout()
	{ 				
		$this->session->unset_userdata('loginDetail');				
	    redirect('/', 'refresh');
	}	
	
}
