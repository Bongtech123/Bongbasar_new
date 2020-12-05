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
		// echo $search_item;
		// die;
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
    // pr($data);

    foreach ($data as $key => $data_row) 
    {
      $fdata[$key]['value']=$data_row->product_name;
      //$fdata[$key]['data']='swapan';
     
    }
    echo json_encode($fdata);
  }

	public function lowToHigh()
	{		
    echo "+++";
    $child_category_id=$this->input->post('child_category_id');
      $this->load->library('pagination');
      $config=[
        'base_url'=>base_url('filter-low-high/'.$child_category_id),
        'per_page'=>8,
        'total_rows'=>$this->Product_Model->category_all_num_rows($child_category_id),
        'uri_segment'=>3,
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

      $this->pagination->initialize($config);
      $page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
      $this->data["links"] = $this->pagination->create_links();
      //$this->data['menu_lebel'] = $this->Home_Model->get_categories();
      $prodct_all=$this->Search_Model->low_and_high($child_category_id,'ASC',$config["per_page"],$page);
      pr($prodct_all);
	}

 //  public function pageLowToHigh()
 //  {
 //      $scid=$this->uri->segment(2);
 //      $filter=explode("_",$scid);
 //      $this->load->library('pagination');
 //      $config=[
 //        'base_url'=>base_url('filter-low-high-data/'.$scid),
 //        'per_page'=>2,
 //        'total_rows'=>$this->Search_Model->category_all_num_rows($filter[0],$filter[1]),
 //        'uri_segment'=>3,
 //        'full_tag_open'=>"<ul class='pagination'>",
 //        'full_tag_close'=>"</ul>",
 //        'next_tag_open'=>"<li>",
 //        'next_tag_close'=>"</li>",
 //        'prev_tag_open'=>"<li>",
 //        'prev_tag_close'=>"</li>",
 //        'num_tag_open'=>"<li>",
 //        'num_tag_close'=>"</li>",
 //        'cur_tag_open'=>"<li class='active'><a>",
 //        'cur_tag_close'=>"</a></li>"
 //      ];
 //      //pr($config);
 //      $this->pagination->initialize($config);
 //      $page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
 //      $this->data["links"] = $this->pagination->create_links();
 //        // echo $this->pagination->create_links();
 //        // die;
 //      //pr($filter);
 //          //$this->data['menu_lebel'] = $this->Home_Model->get_categories();
 //      $this->data['prodct_all']=$this->Search_Model->low_and_high($filter[0],$filter[1],'asc',$config["per_page"], $page);
 //      $this->data['filter_id']=$filter;
 //      $this->data['page_title']='product all';       
 //      $this->data['subview']='product/product'; 
 //        if($page==0)
 //        {
 //          $page=1;
 //        }
 //      $this->data['page']=$page;
 //      $this->data['totalpage']=intval($config['total_rows'])/intval($config['per_page']);
 //      $this->load->view('user/layout/default', $this->data);
 //  }


	// public function highToLow()
	// {
	// 	$sub_category_id=$this->input->post('sub_category_id');
	// 	$child_category_id=$this->input->post('child_category_id'); 
 //    $this->load->library('pagination');
 //    $config=[
 //        'base_url'=>base_url('filter-high-low-data/'.$sub_category_id.'_'.$child_category_id),
 //        'per_page'=>2,
 //        'total_rows'=>$this->Search_Model->category_all_num_rows($sub_category_id,$child_category_id),
 //        'uri_segment'=>2,
 //        'full_tag_open'=>"<ul class='pagination'>",
 //        'full_tag_close'=>"</ul>",
 //        'next_tag_open'=>"<li>",
 //        'next_tag_close'=>"</li>",
 //        'prev_tag_open'=>"<li>",
 //        'prev_tag_close'=>"</li>",
 //        'num_tag_open'=>"<li>",
 //        'num_tag_close'=>"</li>",
 //        'cur_tag_open'=>"<li class='active'><a>",
 //        'cur_tag_close'=>"</a></li>"
 //      ];
 //      $this->pagination->initialize($config);
 //      $page = ($this->uri->segment(2))? $this->uri->segment(2) : 0;
 //      $this->data["links"] = $this->pagination->create_links();
	// 	$prodct_all=$this->Search_Model->low_and_high($sub_category_id,$child_category_id,'desc',$config["per_page"], $page);
	// 	foreach($prodct_all as $prodct_all_row)
	// 	{
 //            echo '<div class="col-md-3 col-xs-12">
 //              <div class="dress-card">
 //                  <div class="dress-card-head">
 //                    <a class="dress-card-img" href="'.base_url('product/'.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode).'">';
 //                        $product_img=unserialize($prodct_all_row->images); 
 //                        if(!empty($product_img))
 //                        {
 //                            $path=explode("##",$prodct_all_row->image_link);
 //                            echo '<img class="dress-card-img-top" src="'.base_url('webroot/upload/product/').$path[0].'/'.$product_img[0].'" alt="">';
                       
 //                        }
 //                        else
 //                        {
 //                            echo '<img src="'.base_url('webroot/user/images/logo.png').'">';
 //                        }       
 //                    echo '</a>';
	//                		if($this->session->userdata('loginDetail')!=''){
 //                        $wishlist_row=$this->User_Model->check_wishlist($prodct_all_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode);
                      
 //                      echo '<div class="surprise-bubble '.$wishlist_row == 1 ? 'active' : ''.'">
 //                        <span class="dress-card-heart">
 //                          <i class="fa fa-heart" aria-hidden="true"></i>
 //                        </span>
 //                        <p> <span onclick="wishlist('.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode.')">Wishlist</span></p>
 //                      </div>';
 //                   	}else{
 //                      echo '<div class="surprise-bubble">
 //                        <span class="dress-card-heart">
 //                          <i class="fa fa-heart" aria-hidden="true"></i>
 //                        </span>
 //                        <p> <span onclick="wishlist('.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode.')">Wishlist</span></p>
 //                      </div>';
 //                    }
 //                    echo '</div>
 //                   	<div class="dress-card-body">
 //                          <h4 class="dress-card-title">';
 //                                  $name = strlen($prodct_all_row->name) > 13 ? substr($prodct_all_row->name,0,13)."..." : $prodct_all_row->name;
 //                                  echo $name;
                                  
 //                          echo '</h4>
 //                          <p class="seller-name"><a href="'.base_url('shop/'.$prodct_all_row->admin_id).'">By:'.$prodct_all_row->shop_name.'</a></p>
 //                          <p><span class="dress-card-price">Rs.'.$prodct_all_row->sell_price.' &ensp;</span><span class="dress-card-crossed">Rs.'.$prodct_all_row->mrp_price.'</span><span class="dress-card-off">&ensp;('.intval((($prodct_all_row->mrp_price-$prodct_all_row->sell_price)/$prodct_all_row->mrp_price)*100).'% OFF)</span></p>
                          
 //                      </div>
 //              </div>
 //            </div>';
 //    }
 //    echo "##";
 //    echo '<span>Page 1 of 10</span>';
 //    echo $this->pagination->create_links();

	// }

 //  public function pageHighToLow()
 //  {
 //      $scid=$this->uri->segment(2);
 //      $filter=explode("_",$scid);

 //      $this->load->library('pagination');
 //      $config=[
 //        'base_url'=>base_url('filter-high-low-data/'.$scid),
 //        'per_page'=>2,
 //        'total_rows'=>$this->Search_Model->category_all_num_rows($filter[0],$filter[1]),
 //        'uri_segment'=>3,
 //        'full_tag_open'=>"<ul class='pagination'>",
 //        'full_tag_close'=>"</ul>",
 //        'next_tag_open'=>"<li>",
 //        'next_tag_close'=>"</li>",
 //        'prev_tag_open'=>"<li>",
 //        'prev_tag_close'=>"</li>",
 //        'num_tag_open'=>"<li>",
 //        'num_tag_close'=>"</li>",
 //        'cur_tag_open'=>"<li class='active'><a>",
 //        'cur_tag_close'=>"</a></li>"
 //      ];
 //      //pr($config);
 //      $this->pagination->initialize($config);
 //      $page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
 //      $this->data["links"] = $this->pagination->create_links();
 //      // echo $this->pagination->create_links();

 //      //$this->data['menu_lebel'] = $this->Home_Model->get_categories();
 //      $this->data['prodct_all']=$this->Search_Model->low_and_high($filter[0],$filter[1],'desc',$config["per_page"], $page);
 //      $this->data['filter_id']=$filter;
 //      $this->data['page_title']='product all';       
 //      $this->data['subview']='product/product'; 
 //        if($page==0)
 //        {
 //          $page=1;
 //        }
 //      $this->data['page']=$page;
 //      $this->data['totalpage']=intval($config['total_rows'])/intval($config['per_page']);
 //      $this->load->view('user/layout/default', $this->data);
 //  }

 //  public function aToZ()
 //  {

 //    $sub_category_id=$this->input->post('sub_category_id');
 //    $child_category_id=$this->input->post('child_category_id'); 
 //    $this->load->library('pagination');
 //    $config=[
 //        'base_url'=>base_url('a-to-z-data/'.$sub_category_id.'_'.$child_category_id),
 //        'per_page'=>2,
 //        'total_rows'=>$this->Search_Model->category_all_num_rows($sub_category_id,$child_category_id),
 //        'uri_segment'=>2,
 //        'full_tag_open'=>"<ul class='pagination'>",
 //        'full_tag_close'=>"</ul>",
 //        'next_tag_open'=>"<li>",
 //        'next_tag_close'=>"</li>",
 //        'prev_tag_open'=>"<li>",
 //        'prev_tag_close'=>"</li>",
 //        'num_tag_open'=>"<li>",
 //        'num_tag_close'=>"</li>",
 //        'cur_tag_open'=>"<li class='active'><a>",
 //        'cur_tag_close'=>"</a></li>"
 //      ];
 //      $this->pagination->initialize($config);
 //      $page = ($this->uri->segment(2))? $this->uri->segment(2) : 0;
 //      $this->data["links"] = $this->pagination->create_links();
 //    $prodct_all=$this->Search_Model->az_to_za($sub_category_id,$child_category_id,'asc',$config["per_page"], $page);
 
 //    foreach($prodct_all as $prodct_all_row)
 //    {
 //            echo '<div class="col-md-3 col-xs-12">
 //              <div class="dress-card">
 //                  <div class="dress-card-head">
 //                    <a class="dress-card-img" target="_blank" href="'.base_url('product/'.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode).'">';
 //                       $product_img=unserialize($prodct_all_row->images); 
 //                        if(!empty($product_img))
 //                        {
 //                            $path=explode("##",$prodct_all_row->image_link);
                            
 //                            echo '<img class="dress-card-img-top" src="'.base_url('webroot/upload/product/').$path[0].'/'.$product_img[0].'" alt="">';
                            
 //                        }
 //                        else
 //                        {
 //                            echo '<img src="'.base_url('webroot/user/images/no_image.jpg').'">';
 //                        }
        
 //                    echo '</a>';
 //                     if($this->session->userdata('loginDetail')!=''){
 //                        $wishlist_row=$this->User_Model->check_wishlist($prodct_all_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode)
 //                      echo '
 //                      <div class="surprise-bubble '.$wishlist_row == 1 ? 'active' : ''.'">
 //                        <span class="dress-card-heart">
 //                          <i class="fa fa-heart" aria-hidden="true"></i>
 //                        </span>
 //                        <p> <span onclick="wishlist('.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode.')">Wishlist</span></p>
 //                      </div>';
 //                    }else{
 //                      echo '<div class="surprise-bubble">
 //                        <span class="dress-card-heart">
 //                          <i class="fa fa-heart" aria-hidden="true"></i>
 //                        </span>
 //                        <p> <span onclick="wishlist('.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode.')">Wishlist</span></p>
 //                      </div>';
 //                     }
                      
      
 //                  echo '</div>
 //                   <div class="dress-card-body">
 //                          <h4 class="dress-card-title">';
 //                                  $name = strlen($prodct_all_row->name) > 13 ? substr($prodct_all_row->name,0,13)."..." : $prodct_all_row->name;
 //                                  echo $name ;
 //                           echo '</h4>
 //                          <p class="seller-name"><a href="'.base_url('shop/'.$prodct_all_row->admin_id).'">By:'.$prodct_all_row->shop_name.'</a></p>';
                          
 //                            $sell_price=unserialize($prodct_all_row->sell_price); 
 //                            $mrp_price=unserialize($prodct_all_row->mrp_price); 
                          
 //                          echo '<p><span class="dress-card-price">Rs.'.$sell_price[0].' &ensp;</span><span class="dress-card-crossed">Rs.'.$mrp_price[0].'</span><span class="dress-card-off">&ensp;('.intval((($mrp_price[0]-$sell_price[0])/$mrp_price[0])*100).'% OFF)</span></p>
                          
 //                      </div>
 //              </div>
 //            </div>';
 //    }
 //    echo "##";
 //    echo '<span>Page 1 of 10</span>';
 //    echo $this->pagination->create_links();
 //  }

 //  public function pageaToZ()
 //  {

 //      $scid=$this->uri->segment(2);
 //      $filter=explode("_",$scid);

 //      $this->load->library('pagination');
 //      $config=[
 //        'base_url'=>base_url('a-to-z-data/'.$scid),
 //        'per_page'=>2,
 //        'total_rows'=>$this->Search_Model->category_all_num_rows($filter[0],$filter[1]),
 //        'uri_segment'=>3,
 //        'full_tag_open'=>"<ul class='pagination'>",
 //        'full_tag_close'=>"</ul>",
 //        'next_tag_open'=>"<li>",
 //        'next_tag_close'=>"</li>",
 //        'prev_tag_open'=>"<li>",
 //        'prev_tag_close'=>"</li>",
 //        'num_tag_open'=>"<li>",
 //        'num_tag_close'=>"</li>",
 //        'cur_tag_open'=>"<li class='active'><a>",
 //        'cur_tag_close'=>"</a></li>"
 //      ];
 //      //pr($config);
 //      $this->pagination->initialize($config);
 //      $page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
 //      $this->data["links"] = $this->pagination->create_links();
 //      // echo $this->pagination->create_links();

 //      //$this->data['menu_lebel'] = $this->Home_Model->get_categories();
 //      $this->data['prodct_all']=$this->Search_Model->az_to_za($filter[0],$filter[1],'asc',$config["per_page"], $page);
 //      $this->data['filter_id']=$filter;
 //      $this->data['page_title']='product all';       
 //      $this->data['subview']='product/product'; 
 //        if($page==0)
 //        {
 //          $page=1;
 //        }
 //      $this->data['page']=$page;
 //      $this->data['totalpage']=intval($config['total_rows'])/intval($config['per_page']);
 //      $this->load->view('user/layout/default', $this->data);
 //  }

 //  public function zToA()
 //  {
 //    $sub_category_id=$this->input->post('sub_category_id');
 //    $child_category_id=$this->input->post('child_category_id'); 
 //    $this->load->library('pagination');
 //    $config=[
 //        'base_url'=>base_url('z-to-a-data/'.$sub_category_id.'_'.$child_category_id),
 //        'per_page'=>2,
 //        'total_rows'=>$this->Search_Model->category_all_num_rows($sub_category_id,$child_category_id),
 //        'uri_segment'=>2,
 //        'full_tag_open'=>"<ul class='pagination'>",
 //        'full_tag_close'=>"</ul>",
 //        'next_tag_open'=>"<li>",
 //        'next_tag_close'=>"</li>",
 //        'prev_tag_open'=>"<li>",
 //        'prev_tag_close'=>"</li>",
 //        'num_tag_open'=>"<li>",
 //        'num_tag_close'=>"</li>",
 //        'cur_tag_open'=>"<li class='active'><a>",
 //        'cur_tag_close'=>"</a></li>"
 //      ];
 //      $this->pagination->initialize($config);
 //      $page = ($this->uri->segment(2))? $this->uri->segment(2) : 0;
 //      $this->data["links"] = $this->pagination->create_links();
 //    $prodct_all=$this->Search_Model->az_to_za($sub_category_id,$child_category_id,'desc',$config["per_page"], $page);
 //    foreach($prodct_all as $prodct_all_row)
 //    {
 //            echo '<div class="col-md-3 col-xs-12">
 //              <div class="dress-card">
 //                  <div class="dress-card-head">
 //                    <a class="dress-card-img" href="'.base_url('product/'.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode).'">';
 //                        $product_img=unserialize($prodct_all_row->images); 
 //                        if(!empty($product_img))
 //                        {
 //                            $path=explode("##",$prodct_all_row->image_link);
 //                            echo '<img class="dress-card-img-top" src="'.base_url('webroot/upload/product/').$path[0].'/'.$product_img[0].'" alt="">';
                       
 //                        }
 //                        else
 //                        {
 //                            echo '<img src="'.base_url('webroot/user/images/logo.png').'">';
 //                        }       
 //                    echo '</a>';
 //                    if($this->session->userdata('loginDetail')!=''){
 //                        $wishlist_row=$this->User_Model->check_wishlist($prodct_all_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode);
                      
 //                      echo '<div class="surprise-bubble '.$wishlist_row == 1 ? 'active' : ''.'">
 //                        <span class="dress-card-heart">
 //                          <i class="fa fa-heart" aria-hidden="true"></i>
 //                        </span>
 //                        <p> <span onclick="wishlist('.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode.')">Wishlist</span></p>
 //                      </div>';
 //                    }else{
 //                      echo '<div class="surprise-bubble">
 //                        <span class="dress-card-heart">
 //                          <i class="fa fa-heart" aria-hidden="true"></i>
 //                        </span>
 //                        <p> <span onclick="wishlist('.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode.')">Wishlist</span></p>
 //                      </div>';
 //                    }
 //                    echo '</div>
 //                    <div class="dress-card-body">
 //                          <h4 class="dress-card-title">';
 //                                  $name = strlen($prodct_all_row->name) > 13 ? substr($prodct_all_row->name,0,13)."..." : $prodct_all_row->name;
 //                                  echo $name;
                                  
 //                          echo '</h4>
 //                          <p class="seller-name"><a href="'.base_url('shop/'.$prodct_all_row->admin_id).'">By:'.$prodct_all_row->shop_name.'</a></p>
 //                          <p><span class="dress-card-price">Rs.'.$prodct_all_row->sell_price.' &ensp;</span><span class="dress-card-crossed">Rs.'.$prodct_all_row->mrp_price.'</span><span class="dress-card-off">&ensp;('.intval((($prodct_all_row->mrp_price-$prodct_all_row->sell_price)/$prodct_all_row->mrp_price)*100).'% OFF)</span></p>
                          
 //                      </div>
 //              </div>
 //            </div>';
 //    }
 //    echo "##";
 //    echo '<span>Page 1 of 10</span>';
 //    echo $this->pagination->create_links();
 //  }

 //  public function pagezToA()
 //  {
 //      $scid=$this->uri->segment(2);
 //      $filter=explode("_",$scid);

 //      $this->load->library('pagination');
 //      $config=[
 //        'base_url'=>base_url('z-to-a-data/'.$scid),
 //        'per_page'=>2,
 //        'total_rows'=>$this->Search_Model->category_all_num_rows($filter[0],$filter[1]),
 //        'uri_segment'=>3,
 //        'full_tag_open'=>"<ul class='pagination'>",
 //        'full_tag_close'=>"</ul>",
 //        'next_tag_open'=>"<li>",
 //        'next_tag_close'=>"</li>",
 //        'prev_tag_open'=>"<li>",
 //        'prev_tag_close'=>"</li>",
 //        'num_tag_open'=>"<li>",
 //        'num_tag_close'=>"</li>",
 //        'cur_tag_open'=>"<li class='active'><a>",
 //        'cur_tag_close'=>"</a></li>"
 //      ];
 //      //pr($config);
 //      $this->pagination->initialize($config);
 //      $page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
 //      $this->data["links"] = $this->pagination->create_links();
 //      // echo $this->pagination->create_links();

 //      //$this->data['menu_lebel'] = $this->Home_Model->get_categories();
 //      $this->data['prodct_all']=$this->Search_Model->az_to_za($filter[0],$filter[1],'desc',$config["per_page"], $page);
 //      $this->data['filter_id']=$filter;
 //      $this->data['page_title']='product all';       
 //      $this->data['subview']='product/product'; 
 //        if($page==0)
 //        {
 //          $page=1;
 //        }
 //      $this->data['page']=$page;
 //      $this->data['totalpage']=intval($config['total_rows'])/intval($config['per_page']);
 //      $this->load->view('user/layout/default', $this->data);
 //  }

 //  public function discountLowToHigh()
 //  {
 //    $prodct_all=$this->Search_Model->discount_low_and_high(5);
 //    array_multisort(array_column($prodct_all, 'sell_price'),SORT_ASC,$prodct_all);
 //    //pr($prodct_all);

 //    foreach($prodct_all as $prodct_all_row)
 //    {
 //            echo '<div class="col-md-3 col-xs-12">
 //              <div class="dress-card">
 //                  <div class="dress-card-head">
 //                    <a class="dress-card-img" href="'.base_url('product/'.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode).'">';
 //                        $product_img=unserialize($prodct_all_row->images); 
 //                        if(!empty($product_img))
 //                        {
 //                            $path=explode("##",$prodct_all_row->image_link);
 //                            echo '<img class="dress-card-img-top" src="'.base_url('webroot/upload/product/').$path[0].'/'.$product_img[0].'" alt="">';
                       
 //                        }
 //                        else
 //                        {
 //                            echo '<img src="'.base_url('webroot/user/images/logo.png').'">';
 //                        }       
 //                    echo '</a>';
 //                    if($this->session->userdata('loginDetail')!=''){
 //                        $wishlist_row=$this->User_Model->check_wishlist($prodct_all_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode);
                      
 //                      echo '<div class="surprise-bubble '.$wishlist_row == 1 ? 'active' : ''.'">
 //                        <span class="dress-card-heart">
 //                          <i class="fa fa-heart" aria-hidden="true"></i>
 //                        </span>
 //                        <p> <span onclick="wishlist('.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode.')">Wishlist</span></p>
 //                      </div>';
 //                    }else{
 //                      echo '<div class="surprise-bubble">
 //                        <span class="dress-card-heart">
 //                          <i class="fa fa-heart" aria-hidden="true"></i>
 //                        </span>
 //                        <p> <span onclick="wishlist('.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode.')">Wishlist</span></p>
 //                      </div>';
 //                    }
 //                    echo '</div>
 //                    <div class="dress-card-body">
 //                          <h4 class="dress-card-title">';
 //                                  $name = strlen($prodct_all_row->name) > 13 ? substr($prodct_all_row->name,0,13)."..." : $prodct_all_row->name;
 //                                  echo $name;
                                  
 //                          echo '</h4>
 //                          <p class="seller-name"><a href="'.base_url('shop/'.$prodct_all_row->admin_id).'">By:'.$prodct_all_row->shop_name.'</a></p>
 //                          <p><span class="dress-card-price">Rs.'.$prodct_all_row->sell_price.' &ensp;</span><span class="dress-card-crossed">Rs.'.$prodct_all_row->mrp_price.'</span><span class="dress-card-off">&ensp;('.intval((($prodct_all_row->mrp_price-$prodct_all_row->sell_price)/$prodct_all_row->mrp_price)*100).'% OFF)</span></p>
                          
 //                      </div>
 //              </div>
 //            </div>';
 //    }
 //  }

 //  public function discountHighToLow()
 //  {
 //    $prodct_all=$this->Search_Model->discount_low_and_high(5);
 //    array_multisort(array_column($prodct_all, 'sell_price'),SORT_DESC,$prodct_all);
    
 //    //pr($prodct_all);

 //    foreach($prodct_all as $prodct_all_row)
 //    {
 //            echo '<div class="col-md-3 col-xs-12">
 //              <div class="dress-card">
 //                  <div class="dress-card-head">
 //                    <a class="dress-card-img" href="'.base_url('product/'.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode).'">';
 //                        $product_img=unserialize($prodct_all_row->images); 
 //                        if(!empty($product_img))
 //                        {
 //                            $path=explode("##",$prodct_all_row->image_link);
 //                            echo '<img class="dress-card-img-top" src="'.base_url('webroot/upload/product/').$path[0].'/'.$product_img[0].'" alt="">';
                       
 //                        }
 //                        else
 //                        {
 //                            echo '<img src="'.base_url('webroot/user/images/logo.png').'">';
 //                        }       
 //                    echo '</a>';
 //                    if($this->session->userdata('loginDetail')!=''){
 //                        $wishlist_row=$this->User_Model->check_wishlist($prodct_all_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode);
                      
 //                      echo '<div class="surprise-bubble '.$wishlist_row == 1 ? 'active' : ''.'">
 //                        <span class="dress-card-heart">
 //                          <i class="fa fa-heart" aria-hidden="true"></i>
 //                        </span>
 //                        <p> <span onclick="wishlist('.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode.')">Wishlist</span></p>
 //                      </div>';
 //                    }else{
 //                      echo '<div class="surprise-bubble">
 //                        <span class="dress-card-heart">
 //                          <i class="fa fa-heart" aria-hidden="true"></i>
 //                        </span>
 //                        <p> <span onclick="wishlist('.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode.')">Wishlist</span></p>
 //                      </div>';
 //                    }
 //                    echo '</div>
 //                    <div class="dress-card-body">
 //                          <h4 class="dress-card-title">';
 //                                  $name = strlen($prodct_all_row->name) > 13 ? substr($prodct_all_row->name,0,13)."..." : $prodct_all_row->name;
 //                                  echo $name;
                                  
 //                          echo '</h4>
 //                          <p class="seller-name"><a href="'.base_url('shop/'.$prodct_all_row->admin_id).'">By:'.$prodct_all_row->shop_name.'</a></p>
 //                          <p><span class="dress-card-price">Rs.'.$prodct_all_row->sell_price.' &ensp;</span><span class="dress-card-crossed">Rs.'.$prodct_all_row->mrp_price.'</span><span class="dress-card-off">&ensp;('.intval((($prodct_all_row->mrp_price-$prodct_all_row->sell_price)/$prodct_all_row->mrp_price)*100).'% OFF)</span></p>
                          
 //                      </div>
 //              </div>
 //            </div>';
 //    }
 //  }

 //  public function discountAtoZ()
 //  {
 //    $prodct_all=$this->Search_Model->discount_low_and_high(5);
 //    array_multisort(array_column($prodct_all, 'name'),SORT_ASC,$prodct_all);
 //    //pr($prodct_all);

 //    foreach($prodct_all as $prodct_all_row)
 //    {
 //            echo '<div class="col-md-3 col-xs-12">
 //              <div class="dress-card">
 //                  <div class="dress-card-head">
 //                    <a class="dress-card-img" href="'.base_url('product/'.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode).'">';
 //                        $product_img=unserialize($prodct_all_row->images); 
 //                        if(!empty($product_img))
 //                        {
 //                            $path=explode("##",$prodct_all_row->image_link);
 //                            echo '<img class="dress-card-img-top" src="'.base_url('webroot/upload/product/').$path[0].'/'.$product_img[0].'" alt="">';
                       
 //                        }
 //                        else
 //                        {
 //                            echo '<img src="'.base_url('webroot/user/images/logo.png').'">';
 //                        }       
 //                    echo '</a>';
 //                    if($this->session->userdata('loginDetail')!=''){
 //                        $wishlist_row=$this->User_Model->check_wishlist($prodct_all_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode);
                      
 //                      echo '<div class="surprise-bubble '.$wishlist_row == 1 ? 'active' : ''.'">
 //                        <span class="dress-card-heart">
 //                          <i class="fa fa-heart" aria-hidden="true"></i>
 //                        </span>
 //                        <p> <span onclick="wishlist('.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode.')">Wishlist</span></p>
 //                      </div>';
 //                    }else{
 //                      echo '<div class="surprise-bubble">
 //                        <span class="dress-card-heart">
 //                          <i class="fa fa-heart" aria-hidden="true"></i>
 //                        </span>
 //                        <p> <span onclick="wishlist('.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode.')">Wishlist</span></p>
 //                      </div>';
 //                    }
 //                    echo '</div>
 //                    <div class="dress-card-body">
 //                          <h4 class="dress-card-title">';
 //                                  $name = strlen($prodct_all_row->name) > 13 ? substr($prodct_all_row->name,0,13)."..." : $prodct_all_row->name;
 //                                  echo $name;
                                  
 //                          echo '</h4>
 //                          <p class="seller-name"><a href="'.base_url('shop/'.$prodct_all_row->admin_id).'">By:'.$prodct_all_row->shop_name.'</a></p>
 //                          <p><span class="dress-card-price">Rs.'.$prodct_all_row->sell_price.' &ensp;</span><span class="dress-card-crossed">Rs.'.$prodct_all_row->mrp_price.'</span><span class="dress-card-off">&ensp;('.intval((($prodct_all_row->mrp_price-$prodct_all_row->sell_price)/$prodct_all_row->mrp_price)*100).'% OFF)</span></p>
                          
 //                      </div>
 //              </div>
 //            </div>';
 //    }
 //  }

 //  public function discountZtoA()
 //  {
 //    $prodct_all=$this->Search_Model->discount_low_and_high(5);
 //    array_multisort(array_column($prodct_all, 'name'),SORT_DESC,$prodct_all);
    
 //    //pr($prodct_all);

 //    foreach($prodct_all as $prodct_all_row)
 //    {
 //            echo '<div class="col-md-3 col-xs-12">
 //              <div class="dress-card">
 //                  <div class="dress-card-head">
 //                    <a class="dress-card-img" href="'.base_url('product/'.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode).'">';
 //                        $product_img=unserialize($prodct_all_row->images); 
 //                        if(!empty($product_img))
 //                        {
 //                            $path=explode("##",$prodct_all_row->image_link);
 //                            echo '<img class="dress-card-img-top" src="'.base_url('webroot/upload/product/').$path[0].'/'.$product_img[0].'" alt="">';
                       
 //                        }
 //                        else
 //                        {
 //                            echo '<img src="'.base_url('webroot/user/images/logo.png').'">';
 //                        }       
 //                    echo '</a>';
 //                    if($this->session->userdata('loginDetail')!=''){
 //                        $wishlist_row=$this->User_Model->check_wishlist($prodct_all_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode);
                      
 //                      echo '<div class="surprise-bubble '.$wishlist_row == 1 ? 'active' : ''.'">
 //                        <span class="dress-card-heart">
 //                          <i class="fa fa-heart" aria-hidden="true"></i>
 //                        </span>
 //                        <p> <span onclick="wishlist('.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode.')">Wishlist</span></p>
 //                      </div>';
 //                    }else{
 //                      echo '<div class="surprise-bubble">
 //                        <span class="dress-card-heart">
 //                          <i class="fa fa-heart" aria-hidden="true"></i>
 //                        </span>
 //                        <p> <span onclick="wishlist('.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode.')">Wishlist</span></p>
 //                      </div>';
 //                    }
 //                    echo '</div>
 //                    <div class="dress-card-body">
 //                          <h4 class="dress-card-title">';
 //                                  $name = strlen($prodct_all_row->name) > 13 ? substr($prodct_all_row->name,0,13)."..." : $prodct_all_row->name;
 //                                  echo $name;
                                  
 //                          echo '</h4>
 //                          <p class="seller-name"><a href="'.base_url('shop/'.$prodct_all_row->admin_id).'">By:'.$prodct_all_row->shop_name.'</a></p>
 //                          <p><span class="dress-card-price">Rs.'.$prodct_all_row->sell_price.' &ensp;</span><span class="dress-card-crossed">Rs.'.$prodct_all_row->mrp_price.'</span><span class="dress-card-off">&ensp;('.intval((($prodct_all_row->mrp_price-$prodct_all_row->sell_price)/$prodct_all_row->mrp_price)*100).'% OFF)</span></p>
                          
 //                      </div>
 //              </div>
 //            </div>';
 //    }
 //  }

 //  public function priceLowToHigh()
 //  {
 //    $prodct_all=$this->Search_Model->price_low_and_high(5);
 //    array_multisort(array_column($prodct_all, 'sell_price'),SORT_ASC,$prodct_all);
 //    foreach($prodct_all as $prodct_all_row)
 //    {
 //            echo '<div class="col-md-3 col-xs-12">
 //              <div class="dress-card">
 //                  <div class="dress-card-head">
 //                    <a class="dress-card-img" href="'.base_url('product/'.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode).'">';
 //                        $product_img=unserialize($prodct_all_row->images); 
 //                        if(!empty($product_img))
 //                        {
 //                            $path=explode("##",$prodct_all_row->image_link);
 //                            echo '<img class="dress-card-img-top" src="'.base_url('webroot/upload/product/').$path[0].'/'.$product_img[0].'" alt="">';
                       
 //                        }
 //                        else
 //                        {
 //                            echo '<img src="'.base_url('webroot/user/images/logo.png').'">';
 //                        }       
 //                    echo '</a>';
 //                    if($this->session->userdata('loginDetail')!=''){
 //                        $wishlist_row=$this->User_Model->check_wishlist($prodct_all_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode);
                      
 //                      echo '<div class="surprise-bubble '.$wishlist_row == 1 ? 'active' : ''.'">
 //                        <span class="dress-card-heart">
 //                          <i class="fa fa-heart" aria-hidden="true"></i>
 //                        </span>
 //                        <p> <span onclick="wishlist('.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode.')">Wishlist</span></p>
 //                      </div>';
 //                    }else{
 //                      echo '<div class="surprise-bubble">
 //                        <span class="dress-card-heart">
 //                          <i class="fa fa-heart" aria-hidden="true"></i>
 //                        </span>
 //                        <p> <span onclick="wishlist('.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode.')">Wishlist</span></p>
 //                      </div>';
 //                    }
 //                    echo '</div>
 //                    <div class="dress-card-body">
 //                          <h4 class="dress-card-title">';
 //                                  $name = strlen($prodct_all_row->name) > 13 ? substr($prodct_all_row->name,0,13)."..." : $prodct_all_row->name;
 //                                  echo $name;
                                  
 //                          echo '</h4>
 //                          <p class="seller-name"><a href="'.base_url('shop/'.$prodct_all_row->admin_id).'">By:'.$prodct_all_row->shop_name.'</a></p>
 //                          <p><span class="dress-card-price">Rs.'.$prodct_all_row->sell_price.' &ensp;</span><span class="dress-card-crossed">Rs.'.$prodct_all_row->mrp_price.'</span><span class="dress-card-off">&ensp;('.intval((($prodct_all_row->mrp_price-$prodct_all_row->sell_price)/$prodct_all_row->mrp_price)*100).'% OFF)</span></p>
                          
 //                      </div>
 //              </div>
 //            </div>';
 //    }
 //  }

  public function priceHighToLow()
  {
    $prodct_all=$this->Search_Model->price_low_and_high(5);
    array_multisort(array_column($prodct_all, 'sell_price'),SORT_DESC,$prodct_all);
    foreach($prodct_all as $prodct_all_row)
    {
            echo '<div class="col-md-3 col-xs-12">
              <div class="dress-card">
                  <div class="dress-card-head">
                    <a class="dress-card-img" href="'.base_url('product/'.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode).'">';
                        $product_img=unserialize($prodct_all_row->images); 
                        if(!empty($product_img))
                        {
                            $path=explode("##",$prodct_all_row->image_link);
                            echo '<img class="dress-card-img-top" src="'.base_url('webroot/upload/product/').$path[0].'/'.$product_img[0].'" alt="">';
                       
                        }
                        else
                        {
                            echo '<img src="'.base_url('webroot/user/images/logo.png').'">';
                        }       
                    echo '</a>';
                    if($this->session->userdata('loginDetail')!=''){
                        $wishlist_row=$this->User_Model->check_wishlist($prodct_all_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode);
                      
                      echo '<div class="surprise-bubble '.$wishlist_row == 1 ? 'active' : ''.'">
                        <span class="dress-card-heart">
                          <i class="fa fa-heart" aria-hidden="true"></i>
                        </span>
                        <p> <span onclick="wishlist('.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode.')">Wishlist</span></p>
                      </div>';
                    }else{
                      echo '<div class="surprise-bubble">
                        <span class="dress-card-heart">
                          <i class="fa fa-heart" aria-hidden="true"></i>
                        </span>
                        <p> <span onclick="wishlist('.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode.')">Wishlist</span></p>
                      </div>';
                    }
                    echo '</div>
                    <div class="dress-card-body">
                          <h4 class="dress-card-title">';
                                  $name = strlen($prodct_all_row->name) > 13 ? substr($prodct_all_row->name,0,13)."..." : $prodct_all_row->name;
                                  echo $name;
                                  
                          echo '</h4>
                          <p class="seller-name"><a href="'.base_url('shop/'.$prodct_all_row->admin_id).'">By:'.$prodct_all_row->shop_name.'</a></p>
                          <p><span class="dress-card-price">Rs.'.$prodct_all_row->sell_price.' &ensp;</span><span class="dress-card-crossed">Rs.'.$prodct_all_row->mrp_price.'</span><span class="dress-card-off">&ensp;('.intval((($prodct_all_row->mrp_price-$prodct_all_row->sell_price)/$prodct_all_row->mrp_price)*100).'% OFF)</span></p>
                          
                      </div>
              </div>
            </div>';
    }
  }

  public function priceAtoZ()
  {
    $prodct_all=$this->Search_Model->price_low_and_high(5);
    array_multisort(array_column($prodct_all, 'name'),SORT_ASC,$prodct_all);
    foreach($prodct_all as $prodct_all_row)
    {
            echo '<div class="col-md-3 col-xs-12">
              <div class="dress-card">
                  <div class="dress-card-head">
                    <a class="dress-card-img" href="'.base_url('product/'.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode).'">';
                        $product_img=unserialize($prodct_all_row->images); 
                        if(!empty($product_img))
                        {
                            $path=explode("##",$prodct_all_row->image_link);
                            echo '<img class="dress-card-img-top" src="'.base_url('webroot/upload/product/').$path[0].'/'.$product_img[0].'" alt="">';
                       
                        }
                        else
                        {
                            echo '<img src="'.base_url('webroot/user/images/logo.png').'">';
                        }       
                    echo '</a>';
                    if($this->session->userdata('loginDetail')!=''){
                        $wishlist_row=$this->User_Model->check_wishlist($prodct_all_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode);
                      
                      echo '<div class="surprise-bubble '.$wishlist_row == 1 ? 'active' : ''.'">
                        <span class="dress-card-heart">
                          <i class="fa fa-heart" aria-hidden="true"></i>
                        </span>
                        <p> <span onclick="wishlist('.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode.')">Wishlist</span></p>
                      </div>';
                    }else{
                      echo '<div class="surprise-bubble">
                        <span class="dress-card-heart">
                          <i class="fa fa-heart" aria-hidden="true"></i>
                        </span>
                        <p> <span onclick="wishlist('.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode.')">Wishlist</span></p>
                      </div>';
                    }
                    echo '</div>
                    <div class="dress-card-body">
                          <h4 class="dress-card-title">';
                                  $name = strlen($prodct_all_row->name) > 13 ? substr($prodct_all_row->name,0,13)."..." : $prodct_all_row->name;
                                  echo $name;
                                  
                          echo '</h4>
                          <p class="seller-name"><a href="'.base_url('shop/'.$prodct_all_row->admin_id).'">By:'.$prodct_all_row->shop_name.'</a></p>
                          <p><span class="dress-card-price">Rs.'.$prodct_all_row->sell_price.' &ensp;</span><span class="dress-card-crossed">Rs.'.$prodct_all_row->mrp_price.'</span><span class="dress-card-off">&ensp;('.intval((($prodct_all_row->mrp_price-$prodct_all_row->sell_price)/$prodct_all_row->mrp_price)*100).'% OFF)</span></p>
                          
                      </div>
              </div>
            </div>';
    }
  }
  public function priceZtoA()
  {
    $prodct_all=$this->Search_Model->price_low_and_high(5);
    array_multisort(array_column($prodct_all, 'name'),SORT_DESC,$prodct_all);
    foreach($prodct_all as $prodct_all_row)
    {
            echo '<div class="col-md-3 col-xs-12">
              <div class="dress-card">
                  <div class="dress-card-head">
                    <a class="dress-card-img" href="'.base_url('product/'.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode).'">';
                        $product_img=unserialize($prodct_all_row->images); 
                        if(!empty($product_img))
                        {
                            $path=explode("##",$prodct_all_row->image_link);
                            echo '<img class="dress-card-img-top" src="'.base_url('webroot/upload/product/').$path[0].'/'.$product_img[0].'" alt="">';
                       
                        }
                        else
                        {
                            echo '<img src="'.base_url('webroot/user/images/logo.png').'">';
                        }       
                    echo '</a>';
                    if($this->session->userdata('loginDetail')!=''){
                        $wishlist_row=$this->User_Model->check_wishlist($prodct_all_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode);
                      
                      echo '<div class="surprise-bubble '.$wishlist_row == 1 ? 'active' : ''.'">
                        <span class="dress-card-heart">
                          <i class="fa fa-heart" aria-hidden="true"></i>
                        </span>
                        <p> <span onclick="wishlist('.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode.')">Wishlist</span></p>
                      </div>';
                    }else{
                      echo '<div class="surprise-bubble">
                        <span class="dress-card-heart">
                          <i class="fa fa-heart" aria-hidden="true"></i>
                        </span>
                        <p> <span onclick="wishlist('.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode.')">Wishlist</span></p>
                      </div>';
                    }
                    echo '</div>
                    <div class="dress-card-body">
                          <h4 class="dress-card-title">';
                                  $name = strlen($prodct_all_row->name) > 13 ? substr($prodct_all_row->name,0,13)."..." : $prodct_all_row->name;
                                  echo $name;
                                  
                          echo '</h4>
                          <p class="seller-name"><a href="'.base_url('shop/'.$prodct_all_row->admin_id).'">By:'.$prodct_all_row->shop_name.'</a></p>
                          <p><span class="dress-card-price">Rs.'.$prodct_all_row->sell_price.' &ensp;</span><span class="dress-card-crossed">Rs.'.$prodct_all_row->mrp_price.'</span><span class="dress-card-off">&ensp;('.intval((($prodct_all_row->mrp_price-$prodct_all_row->sell_price)/$prodct_all_row->mrp_price)*100).'% OFF)</span></p>
                          
                      </div>
              </div>
            </div>';
    }
  }

  public function rangeSlider()
  {
    $sub_category_id=$this->input->post('sub_category_id');
    $child_category_id=$this->input->post('child_category_id'); 
    $rangestart=$this->input->post('rangestart');
    $rangeend=$this->input->post('rangeend'); 
    $this->load->library('pagination');
    $config=[
        'base_url'=>base_url('range-slider-data/'.$sub_category_id.'_'.$child_category_id.'_'.$rangestart.'_'.$rangeend),
        'per_page'=>2,
        'total_rows'=>$this->Search_Model->range_slider_all_num_rows($sub_category_id,$child_category_id,$rangestart,$rangeend),
        'uri_segment'=>2,
        'full_tag_open'=>"<ul class='pagination'>",
        'full_tag_close'=>"</ul>",
        'next_tag_open'=>"<li>",
        'next_tag_close'=>"</li>",
        'prev_tag_open'=>"<li>",
        'prev_tag_close'=>"</li>",
        'num_tag_open'=>"<li>",
        'num_tag_close'=>"</li>",
        'cur_tag_open'=>"<li class='active'><a>",
        'cur_tag_close'=>"</a></li>"
      ];
      $this->pagination->initialize($config);
      $page = ($this->uri->segment(2))? $this->uri->segment(2) : 0;
      $this->data["links"] = $this->pagination->create_links();
    $prodct_all=$this->Search_Model->range_slider($sub_category_id,$child_category_id,$rangestart,$rangeend,$config["per_page"], $page);
    foreach($prodct_all as $prodct_all_row)
    {
            echo '<div class="col-md-3 col-xs-12">
              <div class="dress-card">
                  <div class="dress-card-head">
                    <a class="dress-card-img" href="'.base_url('product/'.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode).'">';
                        $product_img=unserialize($prodct_all_row->images); 
                        if(!empty($product_img))
                        {
                            $path=explode("##",$prodct_all_row->image_link);
                            echo '<img class="dress-card-img-top" src="'.base_url('webroot/upload/product/').$path[0].'/'.$product_img[0].'" alt="">';
                       
                        }
                        else
                        {
                            echo '<img src="'.base_url('webroot/user/images/logo.png').'">';
                        }       
                    echo '</a>';
                    if($this->session->userdata('loginDetail')!=''){
                        $wishlist_row=$this->User_Model->check_wishlist($prodct_all_row->uniqcode,$this->session->userdata('loginDetail')->uniqcode);
                      
                      echo '<div class="surprise-bubble '.$wishlist_row == 1 ? 'active' : ''.'">
                        <span class="dress-card-heart">
                          <i class="fa fa-heart" aria-hidden="true"></i>
                        </span>
                        <p> <span onclick="wishlist('.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode.')">Wishlist</span></p>
                      </div>';
                    }else{
                      echo '<div class="surprise-bubble">
                        <span class="dress-card-heart">
                          <i class="fa fa-heart" aria-hidden="true"></i>
                        </span>
                        <p> <span onclick="wishlist('.$prodct_all_row->sub_category_id.'_'.$prodct_all_row->uniqcode.')">Wishlist</span></p>
                      </div>';
                    }
                    echo '</div>
                    <div class="dress-card-body">
                          <h4 class="dress-card-title">';
                                  $name = strlen($prodct_all_row->name) > 13 ? substr($prodct_all_row->name,0,13)."..." : $prodct_all_row->name;
                                  echo $name;
                                  
                          echo '</h4>
                          <p class="seller-name"><a href="'.base_url('shop/'.$prodct_all_row->admin_id).'">By:'.$prodct_all_row->shop_name.'</a></p>
                          <p><span class="dress-card-price">Rs.'.$prodct_all_row->sell_price.' &ensp;</span><span class="dress-card-crossed">Rs.'.$prodct_all_row->mrp_price.'</span><span class="dress-card-off">&ensp;('.intval((($prodct_all_row->mrp_price-$prodct_all_row->sell_price)/$prodct_all_row->mrp_price)*100).'% OFF)</span></p>
                          
                      </div>
              </div>
            </div>';
    }
    echo "##";
    echo '<span>Page 1 of 10</span>';
    echo $this->pagination->create_links();
  }

  public function pageRangeSlider()
  {
      $scid=$this->uri->segment(2);
      $filter=explode("_",$scid);

      $this->load->library('pagination');
      $config=[
        'base_url'=>base_url('range-slider-data/'.$scid),
        'per_page'=>2,
        'total_rows'=>$this->Search_Model->range_slider_all_num_rows($filter[0],$filter[1],$filter[2],$filter[3]),
        'uri_segment'=>3,
        'full_tag_open'=>"<ul class='pagination'>",
        'full_tag_close'=>"</ul>",
        'next_tag_open'=>"<li>",
        'next_tag_close'=>"</li>",
        'prev_tag_open'=>"<li>",
        'prev_tag_close'=>"</li>",
        'num_tag_open'=>"<li>",
        'num_tag_close'=>"</li>",
        'cur_tag_open'=>"<li class='active'><a>",
        'cur_tag_close'=>"</a></li>"
      ];
      //pr($config);
      $this->pagination->initialize($config);
      $page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;
      $this->data["links"] = $this->pagination->create_links();
      // echo $this->pagination->create_links();

      //$this->data['menu_lebel'] = $this->Home_Model->get_categories();
      $this->data['prodct_all']=$this->Search_Model->az_to_za($filter[0],$filter[1],'desc',$config["per_page"], $page);
      $this->data['filter_id']=$filter;
      $this->data['page_title']='product all';       
      $this->data['subview']='product/product'; 
        if($page==0)
        {
          $page=1;
        }
      $this->data['page']=$page;
      $this->data['totalpage']=intval($config['total_rows'])/intval($config['per_page']);
      $this->load->view('user/layout/default', $this->data);
  }
}
    