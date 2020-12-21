<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller 
{ 
	function __construct()
	{
	  	parent::__construct(); 		
	  	$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");	
	  	date_default_timezone_set('Asia/Kolkata');
		$this->load->helper(array('common_helper', 'string', 'form', 'security','url'));
		$this->load->library(array('form_validation', 'email'));
		$this->load->model('home/Home_Model');
		$this->load->model('banner/banner_Model');
		$this->load->model('seller/Seller_Model');
		$this->load->model('user/User_Model');			
	} 
	
	
	public function index()
	{

		$this->data['page_title']='Bongbazaar | Dashboard';

		$this->data['menu_lebel'] = $this->Home_Model->get_categories();
		
		
		$this->data['banner']=$this->banner_Model->banner_getRows('tbl_banner');

        $shop=$this->Seller_Model->shop_getRows(100,'tbl_admin');
        $this->data['shop']=$this->Home_Model->shuffle_assoc($shop);

        $this->data['low_to_high']=$this->Home_Model->ProductLowToHigh(9);

        $cloth_discount=$this->Home_Model->ProductDiscountAllClothing(9,'Clothing');
        $this->data['clothing_discount']=$this->Home_Model->shuffle_assoc($cloth_discount);

		$cloth=$this->Home_Model->ClothingScroll_getRows(9,'Clothing');
        $this->data['clothing']=$this->Home_Model->shuffle_assoc($cloth);


        $access_discount=$this->Home_Model->ProductDiscountAllClothing(9,'Accessories');
        $this->data['accessories_discount']=$this->Home_Model->shuffle_assoc($access_discount);

		$access=$this->Home_Model->ClothingScroll_getRows(9,'Accessories');
        $this->data['accessories']=$this->Home_Model->shuffle_assoc($access);

        $shoes_discount=$this->Home_Model->ProductDiscountAllClothing(9,'Shoes');
        $this->data['shoes_discount']=$this->Home_Model->shuffle_assoc($shoes_discount);

        $shoes=$this->Home_Model->ClothingScroll_getRows(9,'Shoes');
        $this->data['shoes']=$this->Home_Model->shuffle_assoc($shoes);
        
        $special_care_discount=$this->Home_Model->ProductDiscountAllClothing(9,'Special Care');
        $this->data['special_care_discount']=$this->Home_Model->shuffle_assoc($special_care_discount);

        $special_care=$this->Home_Model->ClothingScroll_getRows(9,'Special Care');
        $this->data['special_care']=$this->Home_Model->shuffle_assoc($special_care);
       
		// pr($this->data);
		// die;
		
		$this->data['subview']='home/home';
		$this->load->view('user/layout/default', $this->data);
	}

}
    