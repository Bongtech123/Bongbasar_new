<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SellerController extends CI_Controller 
{ 
	function __construct()
	{
	  	parent::__construct(); 
	  	$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");	
	  	date_default_timezone_set('Asia/Kolkata');		
		$this->load->helper(array('common_helper', 'string', 'form', 'security','url'));
		$this->load->library(array('form_validation', 'email'));
		$this->load->model('seller/Seller_Model');
		$this->load->model('home/Home_Model');
		$this->load->model('user/User_Model');			
	} 
	
	public function SellerAll()
	{
		$this->data['page_title']='Bongbazaar | seller';
		//$this->data['menu_lebel'] = $this->Home_Model->get_categories();
		$this->data['all_shop']=$this->Seller_Model->get_all_shop();
		$this->data['all_admin_city']=$this->Seller_Model->allAdminCity_getRows();


		//pr($this->data);

		$this->data['subview']='seller/all_seller';
		$this->load->view('user/layout/default', $this->data);
	}

	public function Seller($admin_id)
	{
		// echo $admin_id;
		// die;
	
		$this->data['page_title']='Bongbazaar | seller';
		//$this->data['menu_lebel'] = $this->Home_Model->get_categories();
		$this->data['seller_all_product'] = $this->Seller_Model->admin_all_product($admin_id);
		$this->data['shop_details']=$this->Seller_Model->shop_image($admin_id);
		//$this->data['shop_filter_data']=$this->Seller_Model->seller_filter_data($id);
		$this->data['subview']='seller/seller';
		//pr($this->data);
		$this->load->view('user/layout/default', $this->data);
	}

	public function shopSelectCity()
	{
		$city=$this->input->post('city');
		$data = $this->Seller_Model->get_shop_for_location($city);
		// pr($data);
		
		if(!empty($data))
		{
			foreach($data as $shop_row)
			{

	            echo '<div class="col-md-2">
	                <div class="item">
	                  <a href="'.base_url('shop/'.$shop_row->uniqcode).'">
	                    <div class="item-overlay">
	                      <div class="category-img">
	                        <img src="'.base_url('webroot/admin/shop_image/'.$shop_row->shop_image).'">
	                      </div>
	                    </div>
	                    <div class="item-content">
	                      <div class="item-top-content">
	                        <div class="item-top-content-inner">
	                          <div class="item-product">
	                            <div class="item-top-title">
	                              <h4>'.$shop_row->shop_name.'</h4>
	                            </div>
	                          </div>
	                        </div>
	                      </div>
	                      <div class="item-add-content">
	                        <div class="item-add-content-inner">
	                          <div class="section">
	                            <!-- <a href="#" class="btn buy expand">Buy now</a> -->

	                            <p class="shop-address">
	                            '.$shop_row->shop_address.'
	                            </p>
	                          </div>
	                        </div>
	                      </div>
	                    </div>
	                  </a>
	                </div>
	              </div>';
	        }
	    }
	    else
	    {
	    	echo '<h3 style="text-align:center">Data not available</h3 style="text-align:center">';
	    }
	}
	public function sellerSelectCityName()
	{
		$shop_input=$this->input->post('shop_input');
		$location=$this->input->post('location');
		
		$data = $this->Seller_Model->get_all_shop_city_name($shop_input,$location);
		
		if(!empty($data))
		{
			foreach($data as $shop_row)
			{

	            echo '<div class="col-md-2">
	                <div class="item">
	                  <a href="'.base_url('shop/'.$shop_row->uniqcode).'">
	                    <div class="item-overlay">
	                      <div class="category-img">
	                        <img src="'.base_url('webroot/admin/shop_image/'.$shop_row->shop_image).'">
	                      </div>
	                    </div>
	                    <div class="item-content">
	                      <div class="item-top-content">
	                        <div class="item-top-content-inner">
	                          <div class="item-product">
	                            <div class="item-top-title">
	                              <h4>'.$shop_row->shop_name.'</h4>
	                            </div>
	                          </div>
	                        </div>
	                      </div>
	                      <div class="item-add-content">
	                        <div class="item-add-content-inner">
	                          <div class="section">
	                            <!-- <a href="#" class="btn buy expand">Buy now</a> -->

	                            <p class="shop-address">
	                            '.$shop_row->shop_address.'
	                            </p>
	                          </div>
	                        </div>
	                      </div>
	                    </div>
	                  </a>
	                </div>
	              </div>';
	        }
	    }
	    else
	    {
	    	echo '<h3 style="text-align:center">Data not available</h3 style="text-align:center">';
	    }
	}

	public function sellerSelectProduct()
	{
	
		$shop_product=$this->input->post('shop_product');
		$shopid=$this->input->post('shopid');
		//echo $shopid;
		$prodct_all = $this->Seller_Model->get_all_shop_product($shop_product,$shopid);
		//pr($prodct_all);
		if(!empty($prodct_all))
		{
			foreach($prodct_all as $prodct_all_row)
			{
	            echo '<div class="col-md-3 col-xs-12">
	              <div class="dress-card">
	                  <div class="dress-card-head">
	                    <a class="dress-card-img" href="'.base_url('product').'">';
	                        $product_img=unserialize($prodct_all_row->image);
	                        if(!empty($product_img))
	                        {
	                            echo '<img class="dress-card-img-top" src="'.base_url('webroot/admin/product/web/').$product_img[0].'" alt="">';
	                        }
	                        else
	                        {
	                            echo '<img src="'.base_url('webroot/user/images/logo.png').'">';
	                        }       
	                    echo '</a>';
		               		if($this->session->userdata('loginDetail')!=''){ 
	                        $wishlist_row=$this->User_Model->check_wishlist($prodct_all_row->product_uniqcode,$prodct_all_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode);
	                      
	                      echo '<div class="surprise-bubble '.$wishlist_row == 1 ? 'active' : ''.'">
	                        <span class="dress-card-heart">
	                          <i class="fa fa-heart" aria-hidden="true"></i>
	                        </span>
	                        <p> <span onclick="wishlist('.$prodct_all_row->product_uniqcode.'_'.$prodct_all_row->uniqcode.')">Wishlist</span></p>
	                      </div>';
	                   	}else{
	                      echo '<div class="surprise-bubble">
	                        <span class="dress-card-heart">
	                          <i class="fa fa-heart" aria-hidden="true"></i>
	                        </span>
	                        <p> <span onclick="wishlist('.$prodct_all_row->product_uniqcode.'_'.$prodct_all_row->uniqcode.')">Wishlist</span></p>
	                      </div>';
	                    }
	                    echo '</div>
	                   	<div class="dress-card-body">
	                          <h4 class="dress-card-title">';
	                                  $name = strlen($prodct_all_row->product_name) > 13 ? substr($prodct_all_row->product_name,0,13)."..." : $prodct_all_row->product_name;
	                                  echo $name;
	                                  
	                          echo '</h4>
	                          <p class="seller-name"><a href="'.base_url('shop/'.$prodct_all_row->admin_id).'">By:'.$prodct_all_row->shop_name.'</a></p>';
	                      
	                        echo '<p class="">
                          		<span class="dress-card-price">Rs.'.intval($prodct_all_row->sell_price).' &ensp;</span>
							<span class="dress-card-crossed">Rs.'.intval($prodct_all_row->mrp_price).'</span>
							<span class="dress-card-off">&ensp;('.intval($prodct_all_row->discount).')% OFF)</span>
                        </p>
	                          
	                      </div>
	              </div>
	            </div>';
	    	}
	    }
	    else
	    {
	    	echo 'empty';
	    }
    }
	
}
    