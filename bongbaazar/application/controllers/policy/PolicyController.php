<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PolicyController extends CI_Controller 
{ 
	function __construct()
	{
	  	parent::__construct();
	  	$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");	
	  	date_default_timezone_set('Asia/Kolkata'); 		
		$this->load->helper(array('common_helper', 'string', 'form', 'security','url'));
		$this->load->library(array('form_validation', 'email'));
		$this->load->model('policy/Policy_Model');
		$this->load->model('home/Home_Model');		
	} 
	
	public function privacyPolicy()
	{
		$this->data['page_title']='Bongbazaar | Privacy';
		$this->data['subview']='policy/policy';
		$this->data['policyTitle']='Privacy Policy';
		$arr=array(
			'ideal_for'=>'user',
			'status'=>'Active'
		);
		$this->data['menu_lebel'] = $this->Home_Model->get_categories();
		$this->data['policyData']=$this->Policy_Model->policy_get_row($arr,'tbl_privacy_policy');
		$this->load->view('user/layout/default', $this->data);
	}
	public function paymentPolicy()
	{
		
		$this->data['page_title']='Bongbazaar | Payment'; 
		$this->data['subview']='policy/policy';
		$this->data['policyTitle']='Payment Policy';

		$arr=array(
			'ideal_for'=>'user',
			'status'=>'Active'
		);
		$this->data['menu_lebel'] = $this->Home_Model->get_categories();
		$this->data['policyData']=$this->Policy_Model->policy_get_row($arr,'tbl_payment_policy');
		$this->load->view('user/layout/default', $this->data);
	}

	public function shippingPolicy()
	{
		$this->data['page_title']='Bongbazaar | Shipping';
		$this->data['subview']='policy/policy';
		$this->data['policyTitle']='Shipping Policy';

		$arr=array(
			'ideal_for'=>'user',
			'status'=>'Active'
		);
		$this->data['menu_lebel'] = $this->Home_Model->get_categories();
		$this->data['policyData']=$this->Policy_Model->policy_get_row($arr,'tbl_shipping_policy');
		$this->load->view('user/layout/default', $this->data);
	}

	public function termConditions()
	{
		$this->data['page_title']='Bongbazaar | TermConditions';
		$this->data['subview']='policy/policy';
		$this->data['policyTitle']='Term and Conditions ';

		$arr=array(
			'ideal_for'=>'user',
			'status'=>'Active'
		);
		$this->data['menu_lebel'] = $this->Home_Model->get_categories();
		$this->data['policyData']=$this->Policy_Model->policy_get_row($arr,'tbl_terms_condition');
		$this->load->view('user/layout/default', $this->data);
	}

	public function replacement()
	{
		
		$this->data['page_title']='Bongbazaar | Replacement';
		$this->data['subview']='policy/policy';
		$this->data['policyTitle']='Replacement ';

		$arr=array(
			'ideal_for'=>'user',
			'status'=>'Active'
		);
		$this->data['menu_lebel'] = $this->Home_Model->get_categories();
		$this->data['policyData']=$this->Policy_Model->policy_get_row($arr,'tbl_return_policy');
		$this->load->view('user/layout/default', $this->data);
	}

	public function security()
	{
		$this->data['page_title']='Bongbazaar | Security';
		$this->data['subview']='policy/policy';
		$this->data['policyTitle']='Security ';

		$arr=array(
			'ideal_for'=>'user',
			'status'=>'Active'
		);
		$this->data['menu_lebel'] = $this->Home_Model->get_categories();
		$this->data['policyData']=$this->Policy_Model->policy_get_row($arr,'tbl_security');
		$this->load->view('user/layout/default', $this->data);
	}

	public function reportInfirngement()
	{
		$this->data['page_title']='Bongbazaar | Report';
		$this->data['subview']='policy/policy';
		$this->data['policyTitle']='Report Infirngement';

		$arr=array(
			'ideal_for'=>'user',
			'status'=>'Active'
		);
		$this->data['menu_lebel'] = $this->Home_Model->get_categories();
		$this->data['policyData']=$this->Policy_Model->policy_get_row($arr,'tbl_report_infringement');
		$this->load->view('user/layout/default', $this->data);
	}
}
    