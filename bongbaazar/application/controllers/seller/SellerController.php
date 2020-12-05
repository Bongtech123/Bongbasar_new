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
		$where           = '';
        $where_clause    = '';
        //$data            = array();
        $shortBy = $this->input->get("shortBy");
        $color = $this->input->get("color");
        $size = $this->input->get("size");
        $brand = $this->input->get("brand");
        $text1= explode(',', $color);
        $text2= explode(',', $size);
        $text3= explode(',', $brand);
        

        if($color != '')
        {
          $color2="";
          foreach ($text1 as $col) 
          {
            $color2.="'".$col."',";
          }
          $color3=rtrim($color2, ",");
          $this->data['color']=$text1;
          $this->data1['color']=$color;
          $where .= "color IN (".$color3.") AND ";
        }

        if($size != '')
        {
          $size2="";
          foreach ($text2 as $col) 
          {
            $size2.="'".$col."',";
          }
          $size3=rtrim($size2, ",");
		  $this->data['size']=$text2;
		  $this->data1['size']=$size;
          $where .= "size IN (".$size3.") AND ";
        }

        if($brand != '')
        {
          $brand2="";
          foreach ($text3 as $col) 
          {
            $brand2.="'".$col."',";
          }
          $brand3=rtrim($brand2, ",");
		  $this->data['brand']=$text3;
		  $this->data1['brand']=$brand;
		  
          $where .= "brand_name IN (".$brand3.") AND ";
        }


       $where.= "status= 'Active' AND ";
       $where.= "super_admin_status= 'Active' AND ";
       $where.= "admin_status= 'Active' AND ";
       $where.= "super_admin_product_status= 'Active' AND ";
       $where.= "admin_product_status= 'Active' AND ";
       $where.= "admin_id= '".$admin_id."' ";
     
       $where.= "GROUP BY product_uniqcode ";

    
        $where_clause = $where;
        

        $offset = $this->input->get("per_page");

        $limit  = 2;

        $query= $this->db->select('*')->where($where_clause)->get('view_products'); 

        $total_rows = $query->num_rows();

        //echo $total_rows;

        $this->load->library('pagination');
		
    	$config=[
        'base_url'=>base_url('shop/') .$admin_id."?".http_build_query($this->data1),
        'per_page'=>$limit,
        'total_rows'=>$total_rows,
       
        'last_link'=>'>>',
        'first_link'=>'<<',
        'full_tag_open'=>"<ul class='pagination'>",
        'full_tag_close'=>"</ul>",
        'first_tag_open'=>'<li>',
        'first_tag_close'=>'</li>',
        'last_tag_open'=>'<li>',
        'last_tag_close'=>'</li>',
        'next_tag_open'=>"<li>",
        'next_tag_close'=>"</li>",
        'prev_tag_open'=>"<li>",
        'prev_tag_close'=>"</li>",
        'num_tag_open'=>"<li>",
        'num_tag_close'=>"</li>",
        'cur_tag_open'=>"<li class='active'><a>",
        'cur_tag_close'=>"</a></li>"
      ];

      $config['page_query_string'] = TRUE;

    	$this->pagination->initialize($config);

    	$page = $offset;
 
    	$this->data["links"] = $this->pagination->create_links();
      
    	
		
		$this->data['page_title']='Bongbazaar | seller';
		//$this->data['menu_lebel'] = $this->Home_Model->get_categories();
		$this->data['seller_all_product'] = $this->Seller_Model->admin_all_product($where_clause,$limit,$offset);
		$this->data['shop_details']=$this->Seller_Model->shop_image($admin_id);
		//$this->data['shop_filter_data']=$this->Seller_Model->seller_filter_data($id);
		$this->data['find_by_color']=$this->Seller_Model->find_by_color($admin_id);
		$this->data['find_by_size']=$this->Seller_Model->find_by_size($admin_id);
		$this->data['find_by_brand']=$this->Seller_Model->find_by_brand($admin_id);
		 $this->data['admin_id']=$admin_id;
		$this->data['subview']='seller/seller';
		if(empty($page))
		{
		$this->data['page']=1;
		}
		else
		{
		$this->data['page']=$page+1;

		}
		
		$totalpage=intval($config['total_rows'])/intval($config['per_page']);
		$pageDataType=gettype($totalpage);
		if($pageDataType=='double')
		{
		$totalpage=intval($totalpage)+1;
		}
		$this->data['totalpage']=$totalpage;
		
		$this->load->view('user/layout/default', $this->data);
	}
	public function categoryAll($admin_id)
  	{
      

        $where           = '';
        $where_clause    = '';
        //$data            = array();
        $shortBy = $this->input->get("shortBy");
        $color = $this->input->get("color");
        $size = $this->input->get("size");
        $brand = $this->input->get("brand");
        $text1= explode(',', $color);
        $text2= explode(',', $size);
        $text3= explode(',', $brand);
        

        if($color != '')
        {
          $color2="";
          foreach ($text1 as $col) 
          {
            $color2.="'".$col."',";
          }
          $color3=rtrim($color2, ",");
          $this->data['color']=$text1;
          $where .= "color IN (".$color3.") AND ";
        }

        if($size != '')
        {
          $size2="";
          foreach ($text2 as $col) 
          {
            $size2.="'".$col."',";
          }
          $size3=rtrim($size2, ",");
          $this->data['size']=$text2;
          $where .= "size IN (".$size3.") AND ";
        }

        if($brand != '')
        {
          $brand2="";
          foreach ($text3 as $col) 
          {
            $brand2.="'".$col."',";
          }
          $brand3=rtrim($brand2, ",");
          $this->data['brand']=$text3;
          $where .= "brand_name IN (".$brand3.") AND ";
        }


       $where.= "status= 'Active' AND ";
       $where.= "super_admin_status= 'Active' AND ";
       $where.= "admin_status= 'Active' AND ";
       $where.= "super_admin_product_status= 'Active' AND ";
       $where.= "admin_product_status= 'Active' AND ";
       $where.= "child_category_id= '".$child_category_id."' ";
     
       $where.= "GROUP BY product_uniqcode ";

       if($shortBy != '')
       {
            $this->data['shortBy']=$shortBy;
            if ($shortBy == 'LH') 
            {
              $where .= "ORDER BY sell_price ASC ";
            }else if($shortBy == 'HL')
            {
              $where .= "ORDER BY sell_price DESC ";
            }else if($shortBy == 'AZ')
            {
              $where .= "ORDER BY product_name ASC ";
            }else if($shortBy == 'ZA')
            {
              $where .= "ORDER BY product_name DESC ";
            }
            
        }


        /*if($where != ''){
            $where_clause = substr($where, 0, -4);
        }*/

    
        $where_clause = $where;
        

        $offset = $this->input->get("per_page");

        $limit  = 1;

        $query= $this->db->select('*')->where($where_clause)->get('view_products'); 

        $total_rows = $query->num_rows();

        //echo $total_rows;

        $this->load->library('pagination');

    	$config=[
        'base_url'=>base_url('category-all-product/') .$child_category_id."?".http_build_query($this->data),
        'per_page'=>$limit,
        'total_rows'=>$total_rows,
       
        'last_link'=>'>>',
        'first_link'=>'<<',
        'full_tag_open'=>"<ul class='pagination'>",
        'full_tag_close'=>"</ul>",
        'first_tag_open'=>'<li>',
        'first_tag_close'=>'</li>',
        'last_tag_open'=>'<li>',
        'last_tag_close'=>'</li>',
        'next_tag_open'=>"<li>",
        'next_tag_close'=>"</li>",
        'prev_tag_open'=>"<li>",
        'prev_tag_close'=>"</li>",
        'num_tag_open'=>"<li>",
        'num_tag_close'=>"</li>",
        'cur_tag_open'=>"<li class='active'><a>",
        'cur_tag_close'=>"</a></li>"
      ];

      $config['page_query_string'] = TRUE;

    	$this->pagination->initialize($config);

    	$page = $offset;
 
    	$this->data["links"] = $this->pagination->create_links();
      //pr($this->data);

      	
              //$this->data['menu_lebel'] = $this->Home_Model->get_categories();
              $this->data['prodct_all']=$this->Home_Model->ChildAllProduct_getRows($where_clause,$limit,$offset);
               //$query=$this->CommonModel->RetriveRecordByWhereOrderbyLimit('view_products',$where_clause,$limit,$offset,'product_id','DESC');
               // $this->data['prodct_all']=

              //pr($this->data['prodct_all']);


              $this->data['find_by_color']=$this->Home_Model->find_by_color($child_category_id);
              $this->data['find_by_size']=$this->Home_Model->find_by_size($child_category_id);
              $this->data['find_by_brand']=$this->Home_Model->find_by_brand($child_category_id);
              $this->data['child_category_id']=$child_category_id;

          		//$this->data['filter_id']=$filter;
          		$this->data['page_title']='product all';       
              $this->data['subview']='product/product'; 
              if(empty($page))
              {
                $this->data['page']=1;
              }
              else
              {
                $this->data['page']=$page+1;

              }
              
              $totalpage=intval($config['total_rows'])/intval($config['per_page']);
              $pageDataType=gettype($totalpage);
              if($pageDataType=='double')
              {
                $totalpage=intval($totalpage)+1;
              }
              $this->data['totalpage']=$totalpage;

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
	public function productColor()
    {
        $admin_id=$this->input->post('admin_id');
        $color=$this->input->post('color');
        $find_by_color=$this->Seller_Model->find_by_admin_id_color($admin_id,$color);
        //pr($find_by_color);

        foreach ($find_by_color as $key => $find_by_color_row) 
        {
            echo '<li>
                  <div class="aks-input-wrap">
                    <input class="aks-input comon_selector color" type="checkbox" id="checkbox" name="checkbox" value="'.$find_by_color_row->uniqcode.'">
                    <label class="aks-input-label" for="checkbox">'.$find_by_color_row->color_name.'</label>
                  </div>
                </li>';
        }   
    }

    public function productSize()
    {
        $admin_id=$this->input->post('admin_id');
        $size=$this->input->post('size');
        $find_by_size=$this->Seller_Model->find_by_admin_id_size($admin_id,$size);
        //pr($find_by_size);

        foreach ($find_by_size as $key => $find_by_size_row) 
        {
            echo '<li>
                  <div class="aks-input-wrap">
                    <input class="aks-input comon_selector size" type="checkbox" id="checkbox" name="checkbox" value="'.$find_by_size_row->uniqcode.'">
                    <label class="aks-input-label" for="checkbox">'.$find_by_size_row->size_name.'</label>
                  </div>
                </li>';
        }
    }
    public function productBrand()
    {
        $admin_id=$this->input->post('admin_id');
        $brand=$this->input->post('brand');
        $find_by_brand=$this->Seller_Model->find_by_admin_id_brand($admin_id,$brand);
        // pr($find_by_brand);

        foreach ($find_by_brand as $key => $find_by_brand_row) 
        {
            echo '<li>
                  <div class="aks-input-wrap">
                    <input class="aks-input comon_selector brand" type="checkbox" id="checkbox" name="checkbox" value="'.$find_by_brand_row->brand_name.'">
                    <label class="aks-input-label" for="checkbox">'.$find_by_brand_row->brand_name.'</label>
                  </div>
                </li>';
        }
    }
	
}
    