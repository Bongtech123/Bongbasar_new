<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductController extends CI_Controller   
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
		$this->load->model('cart/Cart_Model');
		$this->load->model('user/User_Model');	
	} 
	public function product()
	{
	    $product_id=$this->input->get('proid');
      $product_features_id=$this->input->get('feid');
      $color=$this->input->get('cid');
      $type=$this->input->get('type');
  
        if(!empty($product_id) && !empty($product_features_id) && !empty($color) && !empty($type))
        {
          if($type != 'Accessories')
          {
            $this->data['product_view']=$this->Product_Model->productView($product_id);
            $this->data['product_view_color']=$this->Product_Model->productViewColor($product_id);

            $this->data['product_view_price_image']=$this->Product_Model->productViewPriceImage($product_features_id);
            $this->data['product_view_size']=$this->Product_Model->productViewSize($product_id,$color);    
            //pr($this->data);
            if(!empty($this->data['product_view']) && !empty($this->data['product_view_color']) &&!empty($this->data['product_view_price_image']) && !empty($this->data['product_view_size']))
            {
              
              $this->data['page_title']='product view';  
              $this->data['subview']='product/product_view';
              $this->load->view('user/layout/default', $this->data);
            }
            else
            {
              $this->data['subview']='product/product_empty';
              $this->load->view('user/layout/default', $this->data);
            }
          }
          else
          {
            $this->data['product_view']=$this->Product_Model->productView($product_id);
            $this->data['product_view_color']=$this->Product_Model->productViewColor($product_id);
            $this->data['product_view_price_image']=$this->Product_Model->productViewPriceImage($product_features_id);
            if(!empty($this->data['product_view']) && !empty($this->data['product_view_color']) && !empty($this->data['product_view_price_image']))
            { 
              $this->data['page_title']='product view';      
              $this->data['subview']='product/product_view_without_size';
                // pr($this->data);
              $this->load->view('user/layout/default', $this->data);
            }
            else
            {
              $this->data['subview']='product/product_empty';
              $this->load->view('user/layout/default', $this->data);
            }
          }
        }
        else
        {
          $this->data['subview']='product/product_empty';
          $this->load->view('user/layout/default', $this->data);
        }
	}

    public function ClothingAll()
    {

      //$this->data['menu_lebel'] = $this->Home_Model->get_categories();
    	$this->data['category_all']=$this->Home_Model->ClothingAll_getRows('Clothing');
      $this->data['page_title']='clothin all';       
      $this->data['subview']='category/category';
      //pr($this->data);
		  $this->load->view('user/layout/default', $this->data);
    }

    public function AccessoriesAll()
    {
        //$this->data['menu_lebel'] = $this->Home_Model->get_categories();
        $this->data['category_all']=$this->Home_Model->ClothingAll_getRows('Accessories');
        $this->data['page_title']='accessories all';       
        $this->data['subview']='category/category';
        // pr($this->data);
        // die;
        $this->load->view('user/layout/default', $this->data);

    }

    public function ShoesAll()
    {
        //$this->data['menu_lebel'] = $this->Home_Model->get_categories();
        $this->data['category_all']=$this->Home_Model->ClothingAll_getRows('Shoes');
        $this->data['page_title']='shoes all';       
        $this->data['subview']='category/category';
        // pr($this->data);
        // die;
        $this->load->view('user/layout/default', $this->data);

    }
    public function SpecialCareAll()
    {
        //$this->data['menu_lebel'] = $this->Home_Model->get_categories();
        $this->data['category_all']=$this->Home_Model->ClothingAll_getRows('special_care');
        $this->data['page_title']='special care all';       
        $this->data['subview']='category/category';
        // pr($this->data);
        // die;
        $this->load->view('user/layout/default', $this->data);

    }

    public function ProductLowToHighAll()
    {
        //$this->data['menu_lebel'] = $this->Home_Model->get_categories();
        $this->data['prodct_all']=$this->Home_Model->ProductLowToHigh(30); 
        $this->data['page_title']='product low to high all';  
        $this->data['subview']='search/search';
        //pr($this->data);
        $this->load->view('user/layout/default', $this->data);
    }

    public function ClothingAllDiscount()
    {
      $this->data['prodct_all']=$this->Home_Model->ProductDiscountAllClothing(30,'Clothing');
      
    	$this->data['page_title']='clothing all discount';  
      $this->data['subview']='product/product';
        //pr($this->data);
		  $this->load->view('user/layout/default', $this->data);    
    }

    public function AccessoriesAllDiscount()
    {
    
      $this->data['prodct_all']=$this->Home_Model->ProductDiscountAllClothing(30,'Accessories');
    	$this->data['page_title']='clothing all discount'; 
      $this->data['subview']='product/product';
      pr($this->data);
		  $this->load->view('user/layout/default', $this->data);
      
    }

    public function ShoesAllDiscount()
    {
    	$this->data['prodct_all']=$this->Home_Model->ProductDiscountAllClothing(30,'Shoes');
      $this->data['page_title']='shoes all discount'; 
      $this->data['subview']='product/product';
      pr($this->data);
      $this->load->view('user/layout/default', $this->data);
    }

    public function SpecialCareAllDiscount()
    {
    	$this->data['prodct_all']=$this->Home_Model->ProductDiscountAllClothing(30,'special_care');
      $this->data['page_title']='special care all discount'; 
      $this->data['subview']='product/product';
      pr($this->data);
      $this->load->view('user/layout/default', $this->data);
    }

  	public function categoryAll($child_category_id)
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

    public function productColor()
    {
        $child_category_id=$this->input->post('child_category_id');
        $color=$this->input->post('color');
        $find_by_color=$this->Home_Model->find_by_child_category_color($child_category_id,$color);
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
        $child_category_id=$this->input->post('child_category_id');
        $size=$this->input->post('size');
        $find_by_size=$this->Home_Model->find_by_child_category_size($child_category_id,$size);
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
        $child_category_id=$this->input->post('child_category_id');
        $brand=$this->input->post('brand');
        $find_by_brand=$this->Home_Model->find_by_child_category_brand($child_category_id,$brand);
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

    public function productMinMax()
    {
        $child_category_id=$this->input->post('child_category_id');
        $find_by_min_max=$this->Home_Model->find_by_child_category_min_max($child_category_id);
        //pr($find_by_min_max);
        echo intval($find_by_min_max->min_price).'##'.intval($find_by_min_max->max_price);
    }
}
    