<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seller_Model extends CI_Model
{
	public function shop_getRows($limit,$table)
    {
        $this->db->select('tbl_admin.uniqcode,tbl_admin.name,tbl_admin.shop_name,tbl_admin.shop_image');
        $this->db->from('view_products');
        $this->db->join('tbl_admin','tbl_admin.uniqcode = view_products.admin_id', 'inner');
        $this->db->where('view_products.super_admin_status','Active');
        $this->db->where('view_products.status','Active');
        $this->db->where('view_products.admin_status','Active');
        $this->db->group_by('view_products.admin_id');
        $query = $this->db->get();
        return $query->result();   
    }

    
    public function get_all_shop()
    {

        $this->db->select('tbl_admin.uniqcode,tbl_admin.shop_image,tbl_admin.shop_name,tbl_admin.shop_address');
        $this->db->from('view_products');
        $this->db->join('tbl_admin', 'tbl_admin.uniqcode = view_products.admin_id', 'inner');
        $this->db->where('view_products.super_admin_status','Active');
        $this->db->where('view_products.status','Active');
        $this->db->where('view_products.admin_status','Active');
        $this->db->group_by('view_products.admin_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function allAdminCity_getRows()
    {
        
        $this->db->select('tbl_admin.city');
        $this->db->from('tbl_admin');
        $this->db->join('view_products', 'view_products.admin_id = tbl_admin.uniqcode', 'inner');
        $this->db->where('view_products.super_admin_status','Active');
        $this->db->where('view_products.status','Active');
        $this->db->where('view_products.admin_status','Active');
        $this->db->where('tbl_admin.status','Active');
        $this->db->group_by('view_products.admin_id');
        $this->db->group_by('tbl_admin.city');
        $query = $this->db->get();
        $data= $query->result();

        return $data;
    }

    public function get_shop_for_location($city)
    {

        $this->db->select('tbl_admin.uniqcode,tbl_admin.shop_image,tbl_admin.shop_name,tbl_admin.shop_address');
        $this->db->from('view_products');
        $this->db->join('tbl_admin', 'tbl_admin.uniqcode = view_products.admin_id', 'inner');
        $this->db->where('view_products.super_admin_status','Active');
        $this->db->where('view_products.status','Active');
        $this->db->where('view_products.admin_status','Active');
        $this->db->like('tbl_admin.city',$city,'both');
        $this->db->group_by('view_products.admin_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_shop_city_name($shop_name,$location)
    {

        $this->db->select('tbl_admin.uniqcode,tbl_admin.shop_image,tbl_admin.shop_name,tbl_admin.shop_address');
        $this->db->from('view_products');
        $this->db->join('tbl_admin', 'tbl_admin.uniqcode = view_products.admin_id', 'inner');
        $this->db->where('view_products.super_admin_status','Active');
        $this->db->where('view_products.status','Active');
        $this->db->where('view_products.admin_status','Active');
        $this->db->group_start();
        $this->db->like('tbl_admin.shop_name',$shop_name,'both');
        $this->db->like('tbl_admin.city',$location,'both');
        $this->db->group_end();
        $this->db->group_by('view_products.admin_id');
        $query = $this->db->get();
        return $query->result();
    }



    public function admin_all_product($where_clause,$limit, $start)
    {
        $this->db->select('view_products.admin_id,view_products.admin_name,view_products.shop_name,view_products.product_uniqcode,view_products.category_id,view_products.sub_category_id,view_products.product_name,view_products.image,view_products.mrp_price,view_products.sell_price,view_products.discount,view_products.uniqcode,view_products.color,view_products.slug,view_products.product_type');
        $this->db->from('view_products');
        $this->db->where($where_clause);
        //$this->db->group_by('view_products.product_uniqcode');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    public function shop_image($uniqcode)
    {
        $this->db->select('shop_image,shop_address,name,uniqcode');
        $this->db->from('tbl_admin');
        $this->db->where('uniqcode',$uniqcode);
        $data=$this->db->get()->row();
        return $data;
    }

    public function get_all_shop_product($query,$shopid)
    {
        $this->db->select ('max(discount)');
        $this->db->from('view_products');
        $this->db->group_by('product_uniqcode');
        $this->db->order_by('max(discount)','desc');
        $subquery=$this->db->get_compiled_select();

        $this->db->select('view_products.admin_id,view_products.admin_name,view_products.product_uniqcode,view_products.product_name,view_products.image, view_products.mrp_price,view_products.sell_price,view_products.discount,view_products.uniqcode,view_products.product_type,view_products.slug');
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
        $this->db->where('view_products.admin_id', $shopid);
        $this->db->where("view_products.discount IN ($subquery)");
        $this->db->group_start();
        $this->db->like('view_products.product_name', $query,'both');
        $this->db->or_like('tbl_category.category_name',$query,'both');
        $this->db->or_like('tbl_sub_category.sub_category_name',$query,'both');
        $this->db->or_like('tbl_child_category.child_category_name',$query,'both');
        $this->db->or_like('view_products.brand_name',$query,'both');
        $this->db->group_end();
        $this->db->group_by('view_products.product_uniqcode');
        $query = $this->db->get();
        return $query->result();
       
    }

    public function seller_filter_data($id)
    {
        echo $id;
        echo "test";
        //die;
    }

    public function find_by_color($admin_id)
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
        $this->db->where('view_products.admin_id', $admin_id);
        $this->db->group_by('view_products.color');
        $query = $this->db->get();
        return $query->result();
    }
    public function find_by_size($admin_id)
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
        $this->db->where('view_products.admin_id', $admin_id);
        $this->db->group_by('view_products.size');
        $query = $this->db->get();
        return $query->result();
    }

    public function find_by_brand($admin_id)
    {
        $this->db->select('brand_name');
        $this->db->from('view_products');
        $this->db->where('status', 'Active');
        $this->db->where('super_admin_status', 'Active');
        $this->db->where('admin_status', 'Active');
        $this->db->where('super_admin_product_status','Active');
        $this->db->where('admin_product_status','Active');
        $this->db->where('admin_id', $admin_id);
        $this->db->group_by('brand_name');
        $query = $this->db->get();
        return $query->result();
    }

   

    public function find_by_admin_id_color($admin_id,$color)
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
        $this->db->where('view_products.admin_id', $admin_id);
        $this->db->group_start();
        $this->db->like('tbl_color.color_name',$color, 'both');
        $this->db->group_end();
        $this->db->group_by('view_products.color');

        $query = $this->db->get();
        return $query->result();
    }

    public function find_by_admin_id_size($admin_id,$size)
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
        $this->db->where('view_products.admin_id', $admin_id);
        $this->db->group_start();
        $this->db->like('tbl_size.size_name',$size, 'both');
        $this->db->group_end();
        $this->db->group_by('view_products.size');
        $query = $this->db->get();
        return $query->result();
    }

    public function find_by_admin_id_brand($admin_id,$brand)
    {
        $this->db->select('brand_name');
        $this->db->from('view_products');
        $this->db->where('status', 'Active');
        $this->db->where('super_admin_status', 'Active');
        $this->db->where('admin_status', 'Active');
        $this->db->where('super_admin_product_status','Active');
        $this->db->where('admin_product_status','Active');
        $this->db->where('admin_id', $admin_id);
        $this->db->group_start();
        $this->db->like('brand_name',$brand, 'both');
        $this->db->group_end();
        $this->db->group_by('brand_name');
        $query = $this->db->get();
        return $query->result();
    }

    public function find_by_admin_id_min_max($admin_id)
    {
        $this->db->select('min(sell_price) as min_price,max(sell_price) as max_price');
        $this->db->from('view_products');
        $this->db->where('status', 'Active');
        $this->db->where('super_admin_status', 'Active');
        $this->db->where('admin_status', 'Active');
        $this->db->where('super_admin_product_status','Active');
        $this->db->where('admin_product_status','Active');
        $this->db->where('admin_id',$admin_id);
        $query = $this->db->get();
        return $query->row();
    }
}
