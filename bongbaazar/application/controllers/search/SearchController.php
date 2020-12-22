<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SearchController extends CI_Controller   
{ 
	function __construct()
	{
	  parent::__construct(); 	
	  $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");	
	  date_default_timezone_set('Asia/Kolkata');	
		$this->load->helper(array('common_helper', 'string', 'form', 'security','url'));
		$this->load->library(array('form_validation', 'email'));
		$this->load->model('product/Product_Model');
		$this->load->model('home/Home_Model');
		$this->load->model('size/Size_Model');
		$this->load->model('search/Search_Model');
    $this->load->model('order/Order_Model'); 
		$this->load->model('user/User_Model');		
	} 
	public function searchEngine()
	{
		$search_item=$this->input->post('autocomplete1');
		if(!empty($search_item))
		{
			$this->session->set_flashdata('searchItem',$search_item);
			$this->data['prodct_all']=$this->Search_Model->search($search_item);
			$this->data['menu_lebel'] = $this->Home_Model->get_categories();
	        $this->data['page_title']='product';       
	        $this->data['subview']='search/search';
	    	//pr($this->data);
			$this->load->view('user/layout/default', $this->data);
		}
		else
		{
			$this->session->set_flashdata('error', 'Provide complete search information to serch item.');
			redirect('/');
		}

		 
	}


  public function searchAllProductName()
  {
  	
    $fdata=array();

    $data=$this->Search_Model->search_all_product_name();

    foreach ($data as $key => $data_row) 
    {
      $fdata[$key]['value']=$data_row->product_name;
    }
    echo json_encode($fdata);
  }
}

    