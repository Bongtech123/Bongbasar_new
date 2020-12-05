<?php
defined('BASEPATH') OR exit('No direct script access allowed');  

class Product_Model extends CI_Model   
{
    public function productView($product_id)
    {
        $this->db->select('tbl_product.admin_id,tbl_admin.shop_name,tbl_admin.business_type,tbl_product.product_type,tbl_product.product_name,tbl_product.brand_name,tbl_product.slug,tbl_product.others_featurs,tbl_product.description');
        $this->db->from('tbl_product');
        $this->db->join('tbl_admin', 'tbl_product.admin_id = tbl_admin.uniqcode', 'inner');
        $this->db->where('tbl_product.status','Active');
        $this->db->where('tbl_product.super_admin_status','Active');
        $this->db->where('tbl_product.uniqcode',$product_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function productViewColor($product_id)
    {
        $this->db->select('color,product_id,uniqcode,image');
        $this->db->from('tbl_product_features');
        $this->db->where('super_admin_product_status','Active');
        $this->db->where('admin_product_status','Active');
        $this->db->where('product_id',$product_id);
        $this->db->group_by('color');
        $query = $this->db->get();
        return $query->result();
    }

    public function productViewColorFeatures($product_features_id,$product_id)
    {
        $this->db->select('color,product_id');
        $this->db->from('tbl_product_features');
        $this->db->where('super_admin_product_status','Active');
        $this->db->where('admin_product_status','Active');
        $this->db->where('uniqcode',$product_features_id);
        $this->db->where('product_id',$product_id);
        $this->db->group_by('color');
        $query = $this->db->get();
        return $query->result();
    }

    public function productViewSize($product_id,$color)
    {
        $this->db->select('tbl_product_features.color, tbl_product_features.size, tbl_product_features.product_id, tbl_size.size_name,tbl_product_features.uniqcode');
        $this->db->from('tbl_product_features');
        $this->db->join('tbl_size', 'tbl_product_features.size = tbl_size.uniqcode', 'inner');
        $this->db->where('tbl_product_features.super_admin_product_status','Active');
        $this->db->where('tbl_product_features.admin_product_status','Active');
        $this->db->where('tbl_size.status','Active');

        $this->db->where('tbl_product_features.product_id',$product_id);
        $this->db->where('tbl_product_features.color',$color);
        $query = $this->db->get();
        return $query->result();
    }

    public function productViewPriceImage($product_features_id)
    {
        $this->db->select('uniqcode,product_id,mrp_price,sell_price,discount,size,color,image,stock_quentity');
        $this->db->from('tbl_product_features');
        $this->db->where('super_admin_product_status','Active');
        $this->db->where('admin_product_status','Active');
        $this->db->where('uniqcode',$product_features_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function category_all_num_rows($child_category_id)
    {
        $this->db->select ('max(discount)');
        $this->db->from('view_products');
        $this->db->group_by('product_uniqcode');
        $this->db->order_by('max(discount)','desc');
        $subquery=$this->db->get_compiled_select();

        $this->db->select('view_products.admin_id');
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
        $this->db->where('view_products.child_category_id', $child_category_id);
        $this->db->where("view_products.discount IN ($subquery)");
        $this->db->group_by('view_products.product_uniqcode');
        $query = $this->db->get();
        return $query->num_rows();
    }
}