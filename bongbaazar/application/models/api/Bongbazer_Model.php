<?php
    
    if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Bongbazer_Model extends CI_Model  
    {

        public function __construct()
        {
            parent::__construct();
        }

        //Banner
        public function banner_getRows($table)  
        {
            $current_date=date('Y-m-d');
            $this->db->select('uniqcode,image');
            $this->db->where('status','Active');
            $this->db->where('date(from_date)<=',$current_date);
            $this->db->where('date(to_date)>=',$current_date);
            $this->db->or_where('to_date','Lifetime');

            $query = $this->db->get($table);
            return $query->result_array();

        }

        //Category 

        public function category_getRows($table)
        {
            $this->db->select('uniqcode,category_name');
            $this->db->where('status','Active');
            $query = $this->db->get($table);
            return $query->result_array();

        }

        //Sub Category 
        public function subCategory_getRows($id)
        {
            
            $fdata=array();
            $this->db->select('tbl_sub_category.uniqcode,tbl_sub_category.category_id,tbl_sub_category.sub_category_name');
            $this->db->from('view_products');
            $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = view_products.sub_category_id', 'inner');
            $this->db->where('view_products.super_admin_status','Active');
            $this->db->where('view_products.status','Active');
            $this->db->where('view_products.admin_status','Active');
            $this->db->where('view_products.super_admin_product_status','Active');
            $this->db->where('view_products.admin_product_status','Active');
            $this->db->where('view_products.category_id',$id);
            $this->db->group_by('view_products.sub_category_id');
            $query = $this->db->get();
            $fdata=$query->result();
            
            return $fdata;

        }

        //Child Category 
        public function childCategory_getRows($id)
        {

            $fdata=array();
            $this->db->select('tbl_child_category.uniqcode,tbl_child_category.category_id,tbl_child_category.sub_category_id,tbl_child_category.child_category_name,tbl_child_category.image');
            $this->db->from('view_products');
            $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = view_products.child_category_id', 'inner');
            $this->db->where('view_products.super_admin_status','Active');
            $this->db->where('view_products.status','Active');
            $this->db->where('view_products.admin_status','Active');
            $this->db->where('view_products.sub_category_id',$id);
            $this->db->where('view_products.super_admin_product_status','Active');
            $this->db->where('view_products.admin_product_status','Active');
            $this->db->group_by('view_products.child_category_id');
            $query = $this->db->get();
            $fdata=$query->result();
            return $fdata;

        }

        //Admin
        public function admin_getRows()
        {
            
            $this->db->select('tbl_admin.uniqcode,tbl_admin.name,tbl_admin.shop_name,tbl_admin.shop_image');
            $this->db->from('view_products');
            $this->db->join('tbl_admin', 'tbl_admin.uniqcode = view_products.admin_id', 'inner');
            $this->db->where('view_products.super_admin_status','Active');
            $this->db->where('view_products.status','Active');
            $this->db->where('view_products.admin_status','Active');
            $this->db->where('view_products.super_admin_product_status','Active');
            $this->db->where('view_products.admin_product_status','Active');
            $this->db->group_by('view_products.admin_id');
            $query = $this->db->get();
            return $query->result_array();

        }

        //About Us
        public function aboutUs_getRows($table)
        {
            $this->db->select('company_name,email,description,contact_us');
            $this->db->where('status','Active');
            $query = $this->db->get($table);
            return $query->result_array();

        }

        //Polcy
        public function policy($table)
        {
             
            $this->db->select('description');
            $this->db->where('status','Active');
            $this->db->where('ideal_for','user');
            $this->db->limit('1');
            $query = $this->db->get($table);
            return $query->result_array();
        }

        //Product Discount All Clothing
        public function ProductDiscountAllClothing($limit,$product_type)
        {
            $this->db->select ('max(discount)');
            $this->db->from('view_products');
            $this->db->group_by('product_uniqcode');
            $this->db->order_by('max(discount)','desc');
            $subquery=$this->db->get_compiled_select();

            $this->db->select('view_products.admin_id,view_products.admin_name,view_products.product_uniqcode,view_products.product_name,view_products.image,view_products.mrp_price,view_products.sell_price,view_products.discount,view_products.uniqcode,view_products.product_type,view_products.color');
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
            $this->db->where('view_products.product_type', $product_type);
            $this->db->where('view_products.super_admin_product_status','Active');
            $this->db->where('view_products.admin_product_status','Active');
            $this->db->where("view_products.discount IN ($subquery)");
            $this->db->group_by('view_products.product_uniqcode');
            $this->db->order_by('view_products.discount','DESC');
            $this->db->limit($limit);
            
            $query = $this->db->get();
            return $query->result_array();
        }

        //Clothing Scroll_getRows
        public function ClothingScroll_getRows($limit,$product_type)
        {
            $this->db->select ('max(discount)');
            $this->db->from('view_products');
            $this->db->group_by('product_uniqcode');
            $this->db->order_by('max(discount)','desc');
            $subquery=$this->db->get_compiled_select();

            $this->db->select('view_products.admin_id,view_products.admin_name,view_products.product_uniqcode,view_products.product_name,view_products.image,view_products.mrp_price,view_products.sell_price,view_products.discount,view_products.uniqcode,view_products.product_type,view_products.color');
            $this->db->from('view_products');
            $this->db->join('tbl_category', 'tbl_category.uniqcode= view_products.category_id', 'inner');
            $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = view_products.sub_category_id', 'inner');
            $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = view_products.child_category_id', 'inner');
            $this->db->where('tbl_category.status', 'Active');
            $this->db->where('tbl_sub_category.status', 'Active');
            $this->db->where('tbl_child_category.status', 'Active');
            $this->db->where('view_products.status', 'Active');
            $this->db->where('view_products.super_admin_status', 'Active');
            $this->db->where('view_products.super_admin_product_status','Active');
            $this->db->where('view_products.admin_product_status','Active');
            $this->db->where('view_products.admin_status', 'Active');
            $this->db->where('view_products.product_type', $product_type);
            $this->db->where("view_products.discount IN ($subquery)");
            $this->db->group_by('view_products.product_uniqcode');
            $this->db->limit($limit);
            
            $query = $this->db->get();
            return $query->result_array();             

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
            $this->db->where('view_products.super_admin_product_status','Active');
            $this->db->where('view_products.admin_product_status','Active');
            $this->db->where('view_products.admin_status','Active');
            $this->db->where('view_products.product_type', $product_type);
            $this->db->group_by('view_products.child_category_id');
            $query = $this->db->get();
            $finaldata=$query->result_array();
            return $finaldata;               

        }

         //Child Category 
        public function ChildAllProduct_getRows($child_category_id)
        {
            $this->db->select ('max(discount)');
            $this->db->from('view_products');
            $this->db->group_by('product_uniqcode');
            $this->db->order_by('max(discount)','desc');
            $subquery=$this->db->get_compiled_select();

            $this->db->select('view_products.admin_id,view_products.admin_name,view_products.product_uniqcode,view_products.product_name,view_products.image, view_products.mrp_price,view_products.sell_price,view_products.discount,view_products.uniqcode,view_products.product_type,view_products.color');
            $this->db->from('view_products');
            $this->db->join('tbl_category', 'tbl_category.uniqcode= view_products.category_id', 'inner');
            $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = view_products.sub_category_id', 'inner');
            $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = view_products.child_category_id', 'inner');
            $this->db->where('tbl_category.status', 'Active');
            $this->db->where('tbl_sub_category.status', 'Active');
            $this->db->where('tbl_child_category.status', 'Active');
            $this->db->where('view_products.status', 'Active');
            $this->db->where('view_products.super_admin_status', 'Active');
            $this->db->where('view_products.super_admin_product_status','Active');
            $this->db->where('view_products.admin_product_status','Active');
            $this->db->where('view_products.admin_status', 'Active');
            $this->db->where('view_products.child_category_id', $child_category_id);
            $this->db->where("view_products.discount IN ($subquery)");
            $this->db->group_by('view_products.product_uniqcode');
            $query = $this->db->get();
            return $query->result_array();
        }

        //Product Discount All Clothing
        public function ProductLowToHigh($limit)
        {
            $this->db->select ('min(sell_price)');
            $this->db->from('view_products');
            $this->db->group_by('product_uniqcode');
            $this->db->order_by('min(sell_price)','asc');
            $subquery=$this->db->get_compiled_select();


            $this->db->select('view_products.admin_id,view_products.admin_name,view_products.product_uniqcode,view_products.product_name,view_products.image,view_products.mrp_price,view_products.sell_price,view_products.discount,view_products.uniqcode,view_products.product_type,view_products.color');
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
            $this->db->where("view_products.sell_price IN ($subquery)");
            $this->db->where('view_products.super_admin_product_status','Active');
            $this->db->where('view_products.admin_product_status','Active');
            $this->db->group_by('view_products.product_uniqcode');
            $this->db->order_by('view_products.sell_price','asc');
            $this->db->limit($limit);
            
            $query = $this->db->get();
            return $query->result_array();
        }

        //Singel Admin Details
        public function singel_admin($admin_id)
        {
            $this->db->select('uniqcode,shop_name,shop_address,shop_image');
            $this->db->where('status','Active');
            $this->db->where('uniqcode',$admin_id);
            $query = $this->db->get('tbl_admin');
            return $query->result_array();

        }

        //Singel Admin All Product
        public function admin_all_product($admin_id)
        {
            $this->db->select ('max(discount)');
            $this->db->from('view_products');
            $this->db->group_by('product_uniqcode');
            $this->db->order_by('max(discount)','desc');
            $subquery=$this->db->get_compiled_select();

            $this->db->select('view_products.admin_id,view_products.admin_name,view_products.product_uniqcode,view_products.product_name,view_products.image, view_products.mrp_price,view_products.sell_price,view_products.discount,view_products.uniqcode,view_products.product_type,view_products.color');
            $this->db->from('view_products');
            $this->db->join('tbl_category', 'tbl_category.uniqcode= view_products.category_id', 'inner');
            $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = view_products.sub_category_id', 'inner');
            $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = view_products.child_category_id', 'inner');
            $this->db->where('tbl_category.status', 'Active');
            $this->db->where('tbl_sub_category.status', 'Active');
            $this->db->where('tbl_child_category.status', 'Active');
            $this->db->where('view_products.status', 'Active');
            $this->db->where('view_products.super_admin_status', 'Active');
            $this->db->where('view_products.super_admin_product_status','Active');
            $this->db->where('view_products.admin_product_status','Active');
            $this->db->where('view_products.admin_status', 'Active');
            $this->db->where('view_products.admin_id', $admin_id);
            $this->db->where("view_products.discount IN ($subquery)");
            $this->db->group_by('view_products.product_uniqcode');
            $query = $this->db->get();
            return $query->result_array();

        }
        //All City List For Active Admin
        public function allAdminCity_getRows()
        {
            
            $this->db->select('tbl_admin.city');
            $this->db->from('tbl_admin');
            $this->db->join('view_products', 'view_products.admin_id = tbl_admin.uniqcode', 'inner');
            $this->db->where('view_products.super_admin_status','Active');
            $this->db->where('view_products.status','Active');
            $this->db->where('view_products.admin_status','Active');
            $this->db->where('tbl_admin.status','Active');
            $this->db->where('view_products.super_admin_product_status','Active');
            $this->db->where('view_products.admin_product_status','Active');
            $this->db->group_by('view_products.admin_id');
            $this->db->group_by('tbl_admin.city');
            $query = $this->db->get();
            $data= $query->result_array();

            return $data;
        }

        //All Active Shop
        public function allShopName_getRows($city)
        {
            
            $this->db->select('tbl_admin.shop_name');
            $this->db->from('tbl_admin');
            $this->db->join('view_products', 'view_products.admin_id = tbl_admin.uniqcode', 'inner');
            $this->db->where('view_products.super_admin_status','Active');
            $this->db->where('view_products.status','Active');
            $this->db->where('view_products.admin_status','Active');
            $this->db->where('tbl_admin.status','Active');
            $this->db->where('view_products.super_admin_product_status','Active');
            $this->db->where('view_products.admin_product_status','Active');
            $this->db->group_by('view_products.admin_id');
            $this->db->like('tbl_admin.city',$city,'both');
            $query = $this->db->get();
            $data= $query->result_array();

            return $data;
        }

        //Search Admin
        public function search_all_admin_getRows($shop_name,$city)
        {
            
            $this->db->select('tbl_admin.uniqcode,tbl_admin.name,tbl_admin.shop_name,tbl_admin.shop_image');
            $this->db->from('tbl_admin');
            $this->db->join('view_products', 'view_products.admin_id = tbl_admin.uniqcode', 'inner');
            $this->db->where('view_products.super_admin_status','Active');
            $this->db->where('view_products.status','Active');
            $this->db->where('view_products.admin_status','Active');
            $this->db->where('tbl_admin.status','Active');
            $this->db->where('view_products.super_admin_product_status','Active');
            $this->db->where('view_products.admin_product_status','Active');
            $this->db->group_by('view_products.admin_id');
            $this->db->group_start();
            $this->db->like('tbl_admin.shop_name',$shop_name,'both');
            $this->db->like('tbl_admin. city', $city,'both');
            $this->db->group_end();
            $query = $this->db->get();
            $data= $query->result_array();

            return $data;
        }

        //All Product Admin Name 
        public function all_admin_product_name($admin_id)
        {
            $this->db->select('view_products.product_name');
            $this->db->from('view_products');
            $this->db->join('tbl_category', 'tbl_category.uniqcode= view_products.category_id', 'inner');
            $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = view_products.sub_category_id', 'inner');
            $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = view_products.child_category_id', 'inner');
            $this->db->where('tbl_category.status', 'Active');
            $this->db->where('tbl_sub_category.status', 'Active');
            $this->db->where('tbl_child_category.status', 'Active');
            $this->db->where('view_products.status', 'Active');
            $this->db->where('view_products.admin_id', $admin_id);
            $this->db->where('view_products.super_admin_status', 'Active');
            $this->db->where('view_products.super_admin_product_status','Active');
            $this->db->where('view_products.admin_product_status','Active');
            $this->db->where('view_products.admin_status', 'Active');
            $this->db->group_by('view_products.product_uniqcode');
            $query = $this->db->get();
            return $query->result_array();
        }

        //Search Produt For Particular Admin
        public function search_admin_getRows($query,$admin_id)
        {
            $this->db->select ('max(discount)');
            $this->db->from('view_products');
            $this->db->group_by('product_uniqcode');
            $this->db->order_by('max(discount)','desc');
            $subquery=$this->db->get_compiled_select();

            $this->db->select('view_products.admin_id,view_products.admin_name,view_products.product_uniqcode,view_products.product_name,view_products.image, view_products.mrp_price,view_products.sell_price,view_products.discount,view_products.uniqcode,view_products.product_type,view_products.color');
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
            $this->db->where('view_products.admin_id', $admin_id);
            $this->db->where("view_products.discount IN ($subquery)");
            $this->db->where('view_products.super_admin_product_status','Active');
            $this->db->where('view_products.admin_product_status','Active');
            $this->db->group_start();
            $this->db->like('view_products.product_name', $query,'both');
            $this->db->or_like('tbl_category.category_name',$query,'both');
            $this->db->or_like('tbl_sub_category.sub_category_name',$query,'both');
            $this->db->or_like('tbl_child_category.child_category_name',$query,'both');
            $this->db->or_like('view_products.brand_name',$query,'both');
            $this->db->group_end();
            $this->db->group_by('view_products.product_uniqcode');
            $query = $this->db->get();
            return $query->result_array();

        }
        //All Product Name
        public function all_product_name()
        {
            $this->db->select('view_products.product_name');
            $this->db->from('view_products');
            $this->db->join('tbl_category', 'tbl_category.uniqcode= view_products.category_id', 'inner');
            $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = view_products.sub_category_id', 'inner');
            $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = view_products.child_category_id', 'inner');
            $this->db->where('tbl_category.status', 'Active');
            $this->db->where('tbl_sub_category.status', 'Active');
            $this->db->where('tbl_child_category.status', 'Active');
            $this->db->where('view_products.status', 'Active');
            $this->db->where('view_products.super_admin_status', 'Active');
            $this->db->where('view_products.super_admin_product_status','Active');
            $this->db->where('view_products.admin_product_status','Active');
            $this->db->where('view_products.admin_status', 'Active');
            $this->db->group_by('view_products.product_uniqcode');
            $query = $this->db->get();
            return $query->result_array();
        }

        // Mani Search Engiene
        public function search_getRows($query)
        {
            $this->db->select ('max(discount)');
            $this->db->from('view_products');
            $this->db->group_by('product_uniqcode');
            $this->db->order_by('max(discount)','desc');
            $subquery=$this->db->get_compiled_select();

            $this->db->select('view_products.admin_id,view_products.admin_name,view_products.product_uniqcode,view_products.product_name,view_products.image, view_products.mrp_price,view_products.sell_price,view_products.discount,view_products.uniqcode,view_products.product_type,view_products.color');
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
            $this->db->where("view_products.discount IN ($subquery)");
            $this->db->where('view_products.super_admin_product_status','Active');
            $this->db->where('view_products.admin_product_status','Active');
            $this->db->group_start();
            $this->db->like('view_products.product_name', $query,'both');
            $this->db->or_like('tbl_category.category_name',$query,'both');
            $this->db->or_like('tbl_sub_category.sub_category_name',$query,'both');
            $this->db->or_like('tbl_child_category.child_category_name',$query,'both');
            $this->db->or_like('view_products.brand_name',$query,'both');
            $this->db->or_like('view_products.admin_name',$query,'both');
            $this->db->group_end();
            $this->db->group_by('view_products.product_uniqcode');
            $query = $this->db->get();
            return $query->result_array();

        }

        //Wishlist Checking
        public function check_wishlist($product_id,$user_id,$product_features_id)
        {
            $this->db->where('product_id',$product_id);
            $this->db->where('user_id',$user_id);
            $this->db->where('product_features_id',$product_features_id);
            $this->db->from('tbl_wishlist');
            $count_row = $this->db->get()->num_rows();
            return $count_row;
        }

        //All Wish List Details
        public function allWishlist_getRows($user_id)
        {
            $this->db->select('view_products.admin_id,view_products.admin_name,view_products.product_uniqcode,view_products.product_name,view_products.image, view_products.mrp_price,view_products.sell_price,view_products.discount,view_products.uniqcode,view_products.product_type,view_products.color');
            $this->db->from('tbl_wishlist');
            $this->db->join('view_products', 'view_products.uniqcode = tbl_wishlist.product_features_id', 'inner');
            $this->db->join('tbl_category', 'tbl_category.uniqcode= view_products.category_id', 'inner');
            $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = view_products.sub_category_id', 'inner');
            $this->db->join('tbl_child_category','tbl_child_category.uniqcode = view_products.child_category_id','inner');
            $this->db->where('tbl_category.status', 'Active');
            $this->db->where('tbl_sub_category.status', 'Active');
            $this->db->where('tbl_child_category.status', 'Active');
            $this->db->where('view_products.status', 'Active');
            $this->db->where('view_products.super_admin_status', 'Active');
            $this->db->where('view_products.super_admin_product_status','Active');
            $this->db->where('view_products.admin_product_status','Active');
            $this->db->where('view_products.admin_status', 'Active');
            $this->db->where('tbl_wishlist.user_id', $user_id);
            $query = $this->db->get();
            return $query->result_array();
        }

        public function allAddressUniqcode_getRows($uniqcode)
        {
             
            $this->db->select('tbl_users_delivery_address.uniqcode,tbl_users_delivery_address.user_id,tbl_users_delivery_address.name,tbl_users_delivery_address.mobile_no,tbl_users_delivery_address.address_details,tbl_users_delivery_address.city_dist_town,tbl_users_delivery_address.state,tbl_users_delivery_address.pin_code,tbl_users_delivery_address.locality,tbl_users_delivery_address.landmark,tbl_users_delivery_address.alternative_mob_no');
            $this->db->from('tbl_users_delivery_address');
            $this->db->join('tbl_users', 'tbl_users.uniqcode = tbl_users_delivery_address.user_id', 'inner');

            $this->db->where('tbl_users_delivery_address.status','Active');
            $this->db->where('tbl_users.status','Active');
            $this->db->where('tbl_users_delivery_address.uniqcode',$uniqcode);
            $query = $this->db->get();
            return $query->result();
        }

        public function allAddress_getRows($user_id)
        {
             
            $this->db->select('tbl_users_delivery_address.uniqcode,tbl_users_delivery_address.user_id,tbl_users_delivery_address.name,tbl_users_delivery_address.mobile_no,tbl_users_delivery_address.address_details,tbl_users_delivery_address.city_dist_town,tbl_users_delivery_address.state,tbl_users_delivery_address.pin_code,tbl_users_delivery_address.locality,tbl_users_delivery_address.landmark,tbl_users_delivery_address.alternative_mob_no');
            $this->db->from('tbl_users_delivery_address');
            $this->db->join('tbl_users', 'tbl_users.uniqcode = tbl_users_delivery_address.user_id', 'inner');

            $this->db->where('tbl_users_delivery_address.status','Active');
            $this->db->where('tbl_users.status','Active');
            $this->db->where('tbl_users_delivery_address.user_id',$user_id);
            $query = $this->db->get();
            return $query->result();
        }

        public function allSelectAddress_getRows($user_id)
        {
             
            $this->db->select('tbl_users_delivery_address.uniqcode,tbl_users_delivery_address.user_id,tbl_users_delivery_address.name,tbl_users_delivery_address.mobile_no,tbl_users_delivery_address.address_details,tbl_users_delivery_address.city_dist_town,tbl_users_delivery_address.state,tbl_users_delivery_address.pin_code,tbl_users_delivery_address.locality,tbl_users_delivery_address.landmark,tbl_users_delivery_address.alternative_mob_no');
            $this->db->from('tbl_users_delivery_address');
            $this->db->join('tbl_users', 'tbl_users.uniqcode = tbl_users_delivery_address.user_id', 'inner');

            $this->db->where('tbl_users_delivery_address.status','Active');
            $this->db->where('tbl_users.status','Active');
            $this->db->where('tbl_users_delivery_address.select_address','1');
            $query = $this->db->get();
            return $query->result();
        }

        public function allState_getRows($countryCode)
        {
             
            $this->db->select('name,transid');
            $this->db->from('tbl_state_mast');
            $this->db->where('is_active','Active');
            $this->db->where('is_delete','N');
            $this->db->where('country_id',$countryCode);
            $query = $this->db->get();
            return $query->result();
        }

        public function productView($product_id)
        {    
            $this->db->select('tbl_product.admin_id,tbl_admin.shop_name,tbl_product.product_name,tbl_product.brand_name,tbl_product.slug,tbl_product.others_featurs,tbl_product.description,tbl_admin.business_type');
            $this->db->from('tbl_product');
            $this->db->join('tbl_admin', 'tbl_product.admin_id = tbl_admin.uniqcode', 'inner');
            $this->db->where('tbl_product.status','Active');
            $this->db->where('tbl_product.super_admin_status','Active');
            $this->db->where('tbl_product.uniqcode',$product_id);
            $query = $this->db->get();
            return $query->result();

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
            return $query->result();

        }

        public function allCart_getRows($user_id)
        {
            $this->db->select('view_products.product_name,view_products.product_type,tbl_cart.uniqcode,tbl_cart.product_id,tbl_cart.product_features_id,tbl_cart.quantity,view_products.admin_id,view_products.admin_name,view_products.sell_price,view_products.mrp_price,view_products.discount,view_products.image,view_products.size,tbl_cart.color,tbl_cart.status');
            $this->db->from('tbl_cart');
            $this->db->join('view_products', 'view_products.uniqcode = tbl_cart.product_features_id', 'inner');
            $this->db->where('tbl_cart.user_id',$user_id);
            $this->db->where('view_products.super_admin_product_status','Active');
            $this->db->where('view_products.admin_product_status','Active');
            $this->db->where('view_products.super_admin_status','Active');
            $this->db->where('view_products.status','Active');
            $this->db->where('tbl_cart.status','Cart');
            $data = $this->db->get()->result();                 
            return $data;
        }

        public function size($size)
        {
            $this->db->select('uniqcode,size_name');
            $this->db->from('tbl_size');
            $this->db->where('uniqcode',$size);
            $this->db->where('status','Active');
            $data=$this->db->get()->result();

            return $data;
        }

        public function buyNow_getRows($user_id)
        {
            $this->db->select('view_products.product_name,view_products.product_type,tbl_cart.uniqcode,tbl_cart.product_id,tbl_cart.product_features_id,tbl_cart.quantity,view_products.admin_id,view_products.admin_name,view_products.sell_price,view_products.mrp_price,view_products.discount,view_products.image,view_products.size,tbl_cart.color,tbl_cart.status');
            $this->db->from('tbl_cart');
            $this->db->join('view_products', 'view_products.uniqcode = tbl_cart.product_features_id', 'inner');
            $this->db->where('tbl_cart.user_id',$user_id);
            $this->db->where('view_products.super_admin_product_status','Active');
            $this->db->where('view_products.admin_product_status','Active');
            $this->db->where('view_products.super_admin_status','Active');
            $this->db->where('view_products.status','Active');
            $this->db->where('tbl_cart.status','Buy');
            $data = $this->db->get()->result();                 
            return $data;
        }

        public function buyNowCheck_getRows($user_id)
        {
            $this->db->select('product_id,product_features_id,color');
            $this->db->from('tbl_cart');
            $this->db->where('user_id',$user_id);
            $this->db->where('status','Buy');
            $data = $this->db->get()->row();                 
            return $data;
        }

        public function buyNowCheck1_getRows($user_id)
        {
            $this->db->select('uniqcode');
            $this->db->from('tbl_cart');
            $this->db->where('user_id',$user_id);
            $this->db->where('status','Buy');
            $data = $this->db->get()->row()->uniqcode;                 
            return $data;
        }

        public function productViewOrder($product_id,$product_features_id)
        {
            $this->db->select('tbl_gst.gst_rate,view_products.mrp_price,view_products.sell_price,view_products.discount,tbl_state_mast.name,view_products.size,view_products.business_type');
            $this->db->from('view_products');
            $this->db->join('tbl_gst', 'tbl_gst.uniqcode = view_products.gst_id', 'inner');
            $this->db->join('tbl_state_mast', 'tbl_state_mast.id = view_products.state', 'inner');
            $this->db->where('view_products.super_admin_product_status','Active');
            $this->db->where('view_products.admin_product_status','Active');
            $this->db->where('view_products.super_admin_status','Active');
            $this->db->where('view_products.status','Active');
            $this->db->where('view_products.product_uniqcode',$product_id);
            $this->db->where('view_products.uniqcode',$product_features_id);

            $data = $this->db->get()->row();                 
            return $data;
        }
        public function UserDeliveryOrder($uniqcode)
        {
            $this->db->select('state');
            $this->db->from('tbl_users_delivery_address');
            $this->db->where('status','Active');
            $this->db->where('uniqcode',$uniqcode);
            $data = $this->db->get()->row();
            return $data;
        }

        public function address_order($uniqcode)
        {
            $this->db->select('name,mobile_no,address_details,city_dist_town,state,pin_code,locality,landmark,alternative_mob_no');
            $this->db->from('tbl_users_delivery_address');
            $this->db->where('status','Active');
            $this->db->where('uniqcode',$uniqcode);
            $data = $this->db->get()->row();
            return $data;
        }


        public function fees($business_type)
        {
            $this->db->select('uniqcode,service_fee,tds_fee,gst_fee,tcs_fee');
            $this->db->from('tbl_fees');
            $this->db->where('business_type',$business_type);
            $data = $this->db->get()->row();
            return $data;
        }

        public function allOrder_getRows($user_id)
        {
             
            $this->db->select('tbl_order.order_code,tbl_order.order_date,tbl_order.delivery_date,sum(tbl_order.sell_price*tbl_order.quantity) as sell_price,sum(tbl_order.mrp_price*tbl_order.quantity) as mrp_price,sum(tbl_order.shipping_price*tbl_order.quantity) as shipping_price,tbl_order.address,tbl_users.name as order_from,count(order_code) as count,view_products.image');
            $this->db->from('tbl_order');
            $this->db->join('view_products', 'view_products.uniqcode = tbl_order.product_features_id', 'inner');
            $this->db->join('tbl_users', 'tbl_users.uniqcode = tbl_order.user_id', 'inner');

            $this->db->where('tbl_order.order_status','Pending');
            $this->db->where('tbl_order.user_id',$user_id);
            $this->db->group_by('tbl_order.order_code');
            $query = $this->db->get();
            return $query->result_array();
        }

        public function allOrderDetails_getRows($order_code)
        {
            $this->db->select('view_products.product_name,view_products.product_type,tbl_order.uniqcode,tbl_order.product_id,tbl_order.product_features_id,tbl_order.quantity,view_products.admin_id,view_products.admin_name,view_products.business_type,tbl_order.sell_price,tbl_order.mrp_price,tbl_order.discount,view_products.image,tbl_order.size,tbl_order.color,tbl_order.order_status,tbl_order.address');
            $this->db->from('tbl_order');
            $this->db->join('view_products', 'view_products.uniqcode = tbl_order.product_features_id', 'inner');
            $this->db->where('tbl_order.order_code',$order_code);
            $data = $this->db->get()->result();                 
            return $data;
        }

















        public function insert($data,$table)
        {
            $this->db->insert($table,$data);
            if($this->db->affected_rows())
            {

                return true;
            }
            else
            {
                return false;
            }
        }

        public function entty_check($data,$table)
        {
            $this->db->where($data);
            $query = $this->db->get($table);
            $count_row = $query->num_rows();
            return $count_row;
        }

        public function update($table,$where,$data)
        {
            $this->db->where($where);
            $this->db->update($table, $data);
            if($this->db->affected_rows())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function selectrow1($data1,$table)
        {
            $this->db->select('*');
            $this->db->where($data1);
            $query = $this->db->get($table);
            $data=$query->result_array();

            if(!empty($data))
            {

                return $data;

            }
            else
            {
                return false;
            }
        }

        public function selectrow($data1,$table)
        {
            $data=$this->db->where($data1)
            ->from($table)
            ->get()->row();
            if(!empty($data))
            {

                return $data;

            }
            else
            {
                return false;
            }
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


        public function test()
        {

            $query='SELECT shop_name FROM tbl_admin WHERE shop_name LIKE'.$query;
            echo $query;
            return $this->db->query($query)->result_array();

        }
    } 
?>