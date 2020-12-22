<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_Model extends CI_Model
{
	public function get_categories()
	{
        $this->db->select('uniqcode,category_name');
        $this->db->where('status','Active');
        $parent = $this->db->get('tbl_category');
         
        $categories = $parent->result();
        $i=0;
        foreach($categories as $p_cat)
        {

            $categories[$i]->sub = $this->sub_categories($p_cat->uniqcode);
            $i++;
        }
        return $categories;
    }

    public function sub_categories($id)
    {
    	$sub=array();
            
        $this->db->select('tbl_sub_category.uniqcode,tbl_sub_category.category_id,tbl_sub_category.sub_category_name');
        $this->db->from('view_products');
        $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = view_products.sub_category_id', 'inner');
        $this->db->where('view_products.super_admin_status','Active');
        $this->db->where('view_products.status','Active');
        $this->db->where('view_products.admin_status','Active');
        $this->db->where('view_products.category_id',$id);
        $this->db->group_by('view_products.sub_category_id');
        $query = $this->db->get();
        $sub=$query->result();
            
        $categories = $sub;

        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->child = $this->child_categories($p_cat->uniqcode);
            $i++;
        }
        return $categories;       
    }

    public function child_categories($child_category_id)
    {
    	$fdata=array();
        $this->db->select('tbl_child_category.uniqcode,tbl_child_category.category_id,tbl_child_category.sub_category_id,tbl_child_category.child_category_name,tbl_child_category.image');
        $this->db->from('view_products');
        $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = view_products.child_category_id', 'inner');
        $this->db->where('view_products.super_admin_status','Active');
        $this->db->where('view_products.status','Active');
        $this->db->where('view_products.admin_status','Active');
        $this->db->where('view_products.sub_category_id',$child_category_id);
        $this->db->group_by('view_products.child_category_id');
        $query = $this->db->get();
        $fdata=$query->result();
        return $fdata;     
    }

    //Product Discount All Clothing
    public function ProductDiscountAllClothing($limit,$product_type)
    {
        $this->db->select ('max(discount)');
        $this->db->from('view_products');
        $this->db->group_by('product_uniqcode');
        $this->db->order_by('max(discount)','desc');
        $subquery=$this->db->get_compiled_select();



        $this->db->select('view_products.admin_id,view_products.admin_name,view_products.shop_name,view_products.product_uniqcode,view_products.product_name,view_products.image,view_products.mrp_price,view_products.sell_price,view_products.discount,view_products.uniqcode,view_products.product_type,view_products.slug,view_products.color');
        $this->db->from('view_products');
        $this->db->join('tbl_category', 'tbl_category.uniqcode= view_products.category_id', 'inner');
        $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = view_products.sub_category_id', 'inner');
        $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = view_products.child_category_id', 'inner');
        $this->db->where('tbl_category.status', 'Active');
        $this->db->where('tbl_sub_category.status', 'Active');
        $this->db->where('tbl_child_category.status', 'Active');
        $this->db->where('view_products.status', 'Active');
        $this->db->where('view_products.super_admin_status', 'Active');
        $this->db->where('view_products.admin_status', 'Active');
        $this->db->where('view_products.super_admin_product_status','Active');
        $this->db->where('view_products.admin_product_status','Active');
        $this->db->where('view_products.product_type', $product_type);
        $this->db->where("view_products.discount IN ($subquery)");
        $this->db->group_by('view_products.product_uniqcode');
        $this->db->order_by('view_products.discount','DESC');
        $this->db->limit($limit);
        
        $query = $this->db->get();
        return $query->result();
    }

    //Clothing Scroll_getRows
    public function ClothingScroll_getRows($limit,$product_type)
    {
        $this->db->select ('max(discount)');
        $this->db->from('view_products');
        $this->db->group_by('product_uniqcode');
        $this->db->order_by('max(discount)','desc');
        $subquery=$this->db->get_compiled_select();



        $this->db->select('view_products.admin_id,view_products.admin_name,view_products.shop_name,view_products.product_uniqcode,view_products.product_name,view_products.image,view_products.mrp_price,view_products.sell_price,view_products.discount,view_products.uniqcode,view_products.product_type,view_products.slug,view_products.color');
        $this->db->from('view_products');
        $this->db->join('tbl_category', 'tbl_category.uniqcode= view_products.category_id', 'inner');
        $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = view_products.sub_category_id', 'inner');
        $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = view_products.child_category_id', 'inner');
        $this->db->where('tbl_category.status', 'Active');
        $this->db->where('tbl_sub_category.status', 'Active');
        $this->db->where('tbl_child_category.status', 'Active');
        $this->db->where('view_products.status', 'Active');
        $this->db->where('view_products.super_admin_status', 'Active');
        $this->db->where('view_products.admin_status', 'Active');
        $this->db->where('view_products.super_admin_product_status','Active');
        $this->db->where('view_products.admin_product_status','Active');
        $this->db->where('view_products.product_type', $product_type);
        $this->db->where("view_products.discount IN ($subquery)");
        $this->db->group_by('view_products.product_uniqcode');
        $this->db->limit($limit);
        
        $query = $this->db->get();
        return $query->result();             

    }

    //Product Discount All Clothing
    public function ProductLowToHigh($limit)
    {
        $this->db->select ('min(sell_price)');
        $this->db->from('view_products');
        $this->db->group_by('product_uniqcode');
        $this->db->order_by('min(sell_price)','asc');
        $subquery=$this->db->get_compiled_select();


        $this->db->select('view_products.admin_id,view_products.admin_name,view_products.shop_name,view_products.product_uniqcode,view_products.product_name,view_products.image,view_products.mrp_price,view_products.sell_price,view_products.discount,view_products.uniqcode,view_products.product_type,view_products.slug,view_products.color');
        $this->db->from('view_products');
        $this->db->join('tbl_category', 'tbl_category.uniqcode= view_products.category_id', 'inner');
        $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = view_products.sub_category_id', 'inner');
        $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = view_products.child_category_id', 'inner');
        $this->db->where('tbl_category.status', 'Active');
        $this->db->where('tbl_sub_category.status', 'Active');
        $this->db->where('tbl_child_category.status', 'Active');
        $this->db->where('view_products.status', 'Active');
        $this->db->where('view_products.super_admin_status', 'Active');
        $this->db->where('view_products.admin_status', 'Active');
        $this->db->where('view_products.super_admin_product_status','Active');
        $this->db->where('view_products.admin_product_status','Active');
        $this->db->where("view_products.sell_price IN ($subquery)");
        $this->db->group_by('view_products.product_uniqcode');
        $this->db->order_by('view_products.sell_price','asc');
        $this->db->limit($limit);
        
        $query = $this->db->get();
        return $query->result();
    }

    public function ClothingAll_getRows($product_type)
    {
        $this->db->select('tbl_child_category.uniqcode,tbl_child_category.category_id,tbl_child_category.sub_category_id,tbl_child_category.child_category_name,tbl_child_category.image');
        $this->db->from('view_products');
        $this->db->join('tbl_category', 'tbl_category.uniqcode = view_products.category_id', 'inner');
        $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = view_products.sub_category_id', 'inner');
        $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = view_products.child_category_id', 'inner');

        $this->db->where('tbl_category.status','Active');
        $this->db->where('tbl_sub_category.status','Active');
        $this->db->where('tbl_child_category.status','Active');
        $this->db->where('view_products.status','Active');
        $this->db->where('view_products.super_admin_status','Active');
        $this->db->where('view_products.admin_status','Active');
        $this->db->where('view_products.super_admin_product_status','Active');
        $this->db->where('view_products.admin_product_status','Active');
        $this->db->where('view_products.product_type', $product_type);
        $this->db->group_by('view_products.child_category_id');
        $query = $this->db->get();
        $finaldata=$query->result();
        return $finaldata;              

    }

    //Child Category 
    public function ChildAllProduct_getRows($where_clause,$limit, $start)
    {
        $this->db->select('view_products.admin_id,view_products.admin_name,view_products.shop_name,view_products.product_uniqcode,view_products.category_id,view_products.sub_category_id,view_products.product_name,view_products.image,view_products.mrp_price,view_products.sell_price,view_products.discount,view_products.uniqcode,view_products.color,view_products.slug,view_products.product_type');

        $this->db->from('view_products');
        $this->db->where($where_clause);
        //$this->db->group_by('view_products.product_uniqcode');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
        
    }

    public function find_by_color($child_category_id)
    {
        $this->db->select('tbl_color.color_name,tbl_color.uniqcode');
        $this->db->from('view_products');
        $this->db->join('tbl_color','tbl_color.uniqcode=view_products.color', 'left');
        $this->db->where('tbl_color.status', 'Active');
        $this->db->where('view_products.status', 'Active');
        $this->db->where('view_products.super_admin_status', 'Active');
        $this->db->where('view_products.admin_status', 'Active');
        $this->db->where('view_products.super_admin_product_status','Active');
        $this->db->where('view_products.admin_product_status','Active');
        $this->db->where('view_products.child_category_id', $child_category_id);
        $this->db->group_by('view_products.color');
        $query = $this->db->get();
        return $query->result();
    }

    public function find_by_size($child_category_id)
    {
        $this->db->select('tbl_size.size_name,tbl_size.uniqcode');
        $this->db->from('view_products');
        $this->db->join('tbl_size','tbl_size.uniqcode=view_products.size', 'inner');
        $this->db->where('tbl_size.status', 'Active');
        $this->db->where('view_products.status', 'Active');
        $this->db->where('view_products.super_admin_status', 'Active');
        $this->db->where('view_products.admin_status', 'Active');
        $this->db->where('view_products.super_admin_product_status','Active');
        $this->db->where('view_products.admin_product_status','Active');
        $this->db->where('view_products.child_category_id', $child_category_id);
        $this->db->group_by('view_products.size');
        $query = $this->db->get();
        return $query->result();
    }

    public function find_by_brand($child_category_id)
    {
        $this->db->select('brand_name');
        $this->db->from('view_products');
        $this->db->where('status', 'Active');
        $this->db->where('super_admin_status', 'Active');
        $this->db->where('admin_status', 'Active');
        $this->db->where('super_admin_product_status','Active');
        $this->db->where('admin_product_status','Active');
        $this->db->where('child_category_id', $child_category_id);
        $this->db->group_by('brand_name');
        $query = $this->db->get();
        return $query->result();
    }

    public function find_by_child_category_color($child_category_id,$color)
    {
        $this->db->select('tbl_color.color_name,tbl_color.uniqcode');
        $this->db->from('view_products');
        $this->db->join('tbl_color','tbl_color.uniqcode=view_products.color', 'left');
        $this->db->where('tbl_color.status', 'Active');
        $this->db->where('view_products.status', 'Active');
        $this->db->where('view_products.super_admin_status', 'Active');
        $this->db->where('view_products.admin_status', 'Active');
        $this->db->where('view_products.super_admin_product_status','Active');
        $this->db->where('view_products.admin_product_status','Active');
        $this->db->where('view_products.child_category_id', $child_category_id);
        $this->db->group_start();
        $this->db->like('tbl_color.color_name',$color, 'both');
        $this->db->group_end();
        $this->db->group_by('view_products.color');

        $query = $this->db->get();
        return $query->result();
    }

    public function find_by_child_category_size($child_category_id,$size)
    {
        $this->db->select('tbl_size.size_name,tbl_size.uniqcode');
        $this->db->from('view_products');
        $this->db->join('tbl_size','tbl_size.uniqcode=view_products.size', 'inner');
        $this->db->where('tbl_size.status', 'Active');
        $this->db->where('view_products.status', 'Active');
        $this->db->where('view_products.super_admin_status', 'Active');
        $this->db->where('view_products.admin_status', 'Active');
        $this->db->where('view_products.super_admin_product_status','Active');
        $this->db->where('view_products.admin_product_status','Active');
        $this->db->where('view_products.child_category_id', $child_category_id);
        $this->db->group_start();
        $this->db->like('tbl_size.size_name',$size, 'both');
        $this->db->group_end();
        $this->db->group_by('view_products.size');
        $query = $this->db->get();
        return $query->result();
    }

    public function find_by_child_category_brand($child_category_id,$brand)
    {
        $this->db->select('brand_name');
        $this->db->from('view_products');
        $this->db->where('status', 'Active');
        $this->db->where('super_admin_status', 'Active');
        $this->db->where('admin_status', 'Active');
        $this->db->where('super_admin_product_status','Active');
        $this->db->where('admin_product_status','Active');
        $this->db->where('child_category_id', $child_category_id);
        $this->db->group_start();
        $this->db->like('brand_name',$brand, 'both');
        $this->db->group_end();
        $this->db->group_by('brand_name');
        $query = $this->db->get();
        return $query->result();
    }

    public function find_by_child_category_min_max($child_category_id)
    {
        $this->db->select('min(sell_price) as min_price,max(sell_price) as max_price');
        $this->db->from('view_products');
        $this->db->where('status', 'Active');
        $this->db->where('super_admin_status', 'Active');
        $this->db->where('admin_status', 'Active');
        $this->db->where('super_admin_product_status','Active');
        $this->db->where('admin_product_status','Active');
        $this->db->where('child_category_id',$child_category_id);
        $query = $this->db->get();
        return $query->row();
    }

     //Product Discount All Clothing
     public function ProductDiscountAllClothingFilter($where_clause,$limit, $start)
     {
         $this->db->select('view_products.admin_id,view_products.admin_name,view_products.product_uniqcode,view_products.category_id,view_products.sub_category_id,view_products.product_name,view_products.image,view_products.mrp_price,view_products.sell_price,view_products.discount,view_products.uniqcode,view_products.color,view_products.slug,view_products.product_type');

         $this->db->from('view_products');
         $this->db->where($where_clause);
         //$this->db->group_by('view_products.product_uniqcode');
         $this->db->limit($limit, $start);
         $query = $this->db->get();
         return $query->result();
     }
	function shuffle_assoc($list) 
    {

        if (!is_array($list)) return $list;

        $keys = array_keys($list);
        shuffle($keys);
          $random = array();
          foreach ($keys as $key)
            $random[] = $list[$key];

          return $random;
    }
	

}
