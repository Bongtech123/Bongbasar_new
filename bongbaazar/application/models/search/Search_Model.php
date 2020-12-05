<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_Model extends CI_Model
{

    public function search($query)
    {

    	$this->db->select ('max(discount)');
        $this->db->from('view_products');
        $this->db->group_by('product_uniqcode');
        $this->db->order_by('max(discount)','desc');
        $subquery=$this->db->get_compiled_select();

        $this->db->select('view_products.admin_id,view_products.admin_name,view_products.product_uniqcode,view_products.product_name,view_products.image, view_products.mrp_price,view_products.sell_price,view_products.discount,view_products.uniqcode,view_products.product_type');
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
        $this->db->where("view_products.discount IN ($subquery)");
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
        return $query->result();
    }

    public function search_all_product_name()
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
        $this->db->where('view_products.admin_status', 'Active');
        $this->db->group_by('view_products.product_uniqcode');
        $query = $this->db->get();
        return $query->result();
    }
    public function low_and_high($child_category_id,$order,$limit,$start)
    {
    
        $this->db->select('view_products.admin_id,view_products.admin_name,view_products.product_uniqcode,view_products.category_id,view_products.sub_category_id,view_products.product_name,view_products.image,view_products.mrp_price,view_products.sell_price,view_products.discount,view_products.uniqcode,view_products.color');
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
        $this->db->group_by('view_products.product_uniqcode');
        $this->db->order_by('view_products.sell_price',$order);
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    public function az_to_za($sub_category_id,$child_category_id,$order,$limit,$start)
    {
        $this->db->select('table_name');
        $this->db->where('status','Active');
        $this->db->where('uniqcode',$sub_category_id);
        $data = $this->db->get('tbl_sub_category')->row();
        if(!empty($data))
        {
            $this->db->select($data->table_name.'.admin_id,tbl_admin.shop_name,'.$data->table_name.'.uniqcode,'.$data->table_name.'.category_id,'.$data->table_name.'.sub_category_id,'.$data->table_name.'.name,'.$data->table_name.'.images,'.$data->table_name.'.mrp_price,'.$data->table_name.'.sell_price,'.$data->table_name.'.image_link,tbl_sub_category.table_name');
            $this->db->join('tbl_category', 'tbl_category.uniqcode = '.$data->table_name.'.category_id', 'inner');
            $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = '.$data->table_name.'.sub_category_id', 'inner');
            $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = '.$data->table_name.'.child_category_id', 'inner');
            $this->db->join('tbl_admin', 'tbl_admin.uniqcode = '.$data->table_name.'.admin_id', 'inner');
            $this->db->where('tbl_category.status','Active');
            $this->db->where('tbl_sub_category.status','Active');
            $this->db->where('tbl_child_category.status','Active');
            $this->db->where($data->table_name.'.status','Active');
            $this->db->where($data->table_name.'.super_admin_status','Active');
            $this->db->where('tbl_admin.status','Active');
            $this->db->where($data->table_name.'.child_category_id',$child_category_id);
            $this->db->order_by($data->table_name.'.name',$order);
            $this->db->limit($limit, $start);
            $data = $this->db->get($data->table_name)->result();
            return $data;
        }
        else
        {
            return false;
        }  
    }

    public function discount_low_and_high($limit)
    {
        $fdata=array();

        $this->db->select('tbl_men_accessories.admin_id,tbl_admin.shop_name,tbl_men_accessories.uniqcode,tbl_men_accessories.category_id,tbl_men_accessories.sub_category_id,tbl_men_accessories.name,tbl_men_accessories.images,tbl_men_accessories.mrp_price,tbl_men_accessories.sell_price,tbl_men_accessories.image_link,(((tbl_men_accessories.mrp_price-tbl_men_accessories.sell_price)*100)/tbl_men_accessories.mrp_price) as discount,tbl_sub_category.table_name');
        $this->db->from('tbl_men_accessories');
        $this->db->join('tbl_category', 'tbl_category.uniqcode= tbl_men_accessories.category_id', 'inner');
        $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = tbl_men_accessories.sub_category_id', 'inner');
        $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = tbl_men_accessories.child_category_id', 'inner');
        $this->db->join('tbl_admin', 'tbl_admin.uniqcode = tbl_men_accessories.admin_id', 'inner');
        $this->db->where('tbl_category.status','Active');
        $this->db->where('tbl_sub_category.status','Active');
        $this->db->where('tbl_child_category.status','Active');
        $this->db->where('tbl_men_accessories.status','Active');
        $this->db->where('tbl_men_accessories.super_admin_status','Active');
        $this->db->where('tbl_admin.status','Active');
        $this->db->limit($limit);
        $query1 = $this->db->get();
        $data= $query1->result();


        $this->db->select('tbl_men_clothing.admin_id,tbl_admin.shop_name,tbl_men_clothing.uniqcode,tbl_men_clothing.category_id,tbl_men_clothing.sub_category_id,tbl_men_clothing.name,tbl_men_clothing.images,tbl_men_clothing.mrp_price,tbl_men_clothing.sell_price,tbl_men_clothing.image_link,(((tbl_men_clothing.mrp_price-tbl_men_clothing.sell_price)*100)/tbl_men_clothing.mrp_price) as discount,tbl_sub_category.table_name');
        $this->db->from('tbl_men_clothing');
        $this->db->join('tbl_category', 'tbl_category.uniqcode= tbl_men_clothing.category_id', 'inner');
        $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = tbl_men_clothing.sub_category_id', 'inner');
        $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = tbl_men_clothing.child_category_id', 'inner');
        $this->db->join('tbl_admin', 'tbl_admin.uniqcode = tbl_men_clothing.admin_id', 'inner');
        $this->db->where('tbl_category.status','Active');
        $this->db->where('tbl_sub_category.status','Active');
        $this->db->where('tbl_child_category.status','Active');
        $this->db->where('tbl_men_clothing.status','Active');
        $this->db->where('tbl_men_clothing.super_admin_status','Active');
        $this->db->where('tbl_admin.status','Active');
        $this->db->limit($limit);
        $query2 = $this->db->get();
        $data= array_merge($data,$query2->result());

        $this->db->select('tbl_men_shoes.admin_id,tbl_admin.shop_name,tbl_men_shoes.uniqcode,tbl_men_shoes.category_id,tbl_men_shoes.sub_category_id,tbl_men_shoes.name,tbl_men_shoes.images,tbl_men_shoes.mrp_price,tbl_men_shoes.sell_price,tbl_men_shoes.image_link,(((tbl_men_shoes.mrp_price-tbl_men_shoes.sell_price)*100)/tbl_men_shoes.mrp_price) as discount,tbl_sub_category.table_name');
        $this->db->from('tbl_men_shoes');
        $this->db->join('tbl_category', 'tbl_category.uniqcode= tbl_men_shoes.category_id', 'inner');
        $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = tbl_men_shoes.sub_category_id', 'inner');
        $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = tbl_men_shoes.child_category_id', 'inner');
        $this->db->join('tbl_admin', 'tbl_admin.uniqcode = tbl_men_shoes.admin_id', 'inner');
        $this->db->where('tbl_category.status','Active');
        $this->db->where('tbl_sub_category.status','Active');
        $this->db->where('tbl_child_category.status','Active');
        $this->db->where('tbl_men_shoes.status','Active');
        $this->db->where('tbl_men_shoes.super_admin_status','Active');
        $this->db->where('tbl_admin.status','Active');
        $this->db->limit($limit);
        $query3 = $this->db->get();
        $data= array_merge($data,$query3->result());

        $this->db->select('tbl_kid_accessories.admin_id,tbl_admin.shop_name,tbl_kid_accessories.uniqcode,tbl_kid_accessories.category_id,tbl_kid_accessories.sub_category_id,tbl_kid_accessories.name,tbl_kid_accessories.images,tbl_kid_accessories.mrp_price,tbl_kid_accessories.sell_price,tbl_kid_accessories.image_link,(((tbl_kid_accessories.mrp_price-tbl_kid_accessories.sell_price)*100)/tbl_kid_accessories.mrp_price) as discount,tbl_sub_category.table_name');
        $this->db->from('tbl_kid_accessories');
        $this->db->join('tbl_category', 'tbl_category.uniqcode = tbl_kid_accessories.category_id', 'inner');
       $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = tbl_kid_accessories.sub_category_id', 'inner');
        $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = tbl_kid_accessories.child_category_id', 'inner');
        $this->db->join('tbl_admin', 'tbl_admin.uniqcode = tbl_kid_accessories.admin_id', 'inner');
        $this->db->where('tbl_category.status','Active');
        $this->db->where('tbl_sub_category.status','Active');
        $this->db->where('tbl_child_category.status','Active');
        $this->db->where('tbl_kid_accessories.status','Active');
        $this->db->where('tbl_kid_accessories.super_admin_status','Active');
        $this->db->where('tbl_admin.status','Active');
        $this->db->limit($limit);
        $query4 = $this->db->get();
        $data= array_merge($data,$query4->result());  

        $this->db->select('tbl_kid_clothing.admin_id,tbl_admin.shop_name,tbl_kid_clothing.uniqcode,tbl_kid_clothing.category_id,tbl_kid_clothing.sub_category_id,tbl_kid_clothing.name,tbl_kid_clothing.images,tbl_kid_clothing.mrp_price,tbl_kid_clothing.sell_price,tbl_kid_clothing.image_link,(((tbl_kid_clothing.mrp_price-tbl_kid_clothing.sell_price)*100)/tbl_kid_clothing.mrp_price) as discount,tbl_sub_category.table_name');
        $this->db->from('tbl_kid_clothing');
        $this->db->join('tbl_category', 'tbl_category.uniqcode = tbl_kid_clothing.category_id', 'inner');
       $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = tbl_kid_clothing.sub_category_id', 'inner');
        $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = tbl_kid_clothing.child_category_id', 'inner');
        $this->db->join('tbl_admin', 'tbl_admin.uniqcode = tbl_kid_clothing.admin_id', 'inner');
        $this->db->where('tbl_category.status','Active');
        $this->db->where('tbl_sub_category.status','Active');
        $this->db->where('tbl_child_category.status','Active');
        $this->db->where('tbl_kid_clothing.status','Active');
        $this->db->where('tbl_kid_clothing.super_admin_status','Active');
        $this->db->where('tbl_admin.status','Active');
        $this->db->limit($limit);
        $query5 = $this->db->get();
        $data= array_merge($data,$query5->result());

        $this->db->select('tbl_kid_shoes.admin_id,tbl_admin.shop_name,tbl_kid_shoes.uniqcode,tbl_kid_shoes.category_id,tbl_kid_shoes.sub_category_id,tbl_kid_shoes.name,tbl_kid_shoes.images,tbl_kid_shoes.mrp_price,tbl_kid_shoes.sell_price,tbl_kid_shoes.image_link,(((tbl_kid_shoes.mrp_price-tbl_kid_shoes.sell_price)*100)/tbl_kid_shoes.mrp_price) as discount,tbl_sub_category.table_name');
        $this->db->from('tbl_kid_shoes');
        $this->db->join('tbl_category', 'tbl_category.uniqcode = tbl_kid_shoes.category_id', 'inner');
       $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = tbl_kid_shoes.sub_category_id', 'inner');
        $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = tbl_kid_shoes.child_category_id', 'inner');
        $this->db->join('tbl_admin', 'tbl_admin.uniqcode = tbl_kid_shoes.admin_id', 'inner');
        $this->db->where('tbl_category.status','Active');
        $this->db->where('tbl_sub_category.status','Active');
        $this->db->where('tbl_child_category.status','Active');
        $this->db->where('tbl_kid_shoes.status','Active');
        $this->db->where('tbl_kid_shoes.super_admin_status','Active');
        $this->db->where('tbl_admin.status','Active');
        $this->db->limit($limit);
        $query6 = $this->db->get();
        $data= array_merge($data,$query6->result());

        $this->db->select('tbl_women_accessories.admin_id,tbl_admin.shop_name,tbl_women_accessories.uniqcode,tbl_women_accessories.category_id,tbl_women_accessories.sub_category_id,tbl_women_accessories.name,tbl_women_accessories.images,tbl_women_accessories.mrp_price,tbl_women_accessories.sell_price,tbl_women_accessories.image_link,(((tbl_women_accessories.mrp_price-tbl_women_accessories.sell_price)*100)/tbl_women_accessories.mrp_price) as discount,tbl_sub_category.table_name');
        $this->db->from('tbl_women_accessories');
        $this->db->join('tbl_category', 'tbl_category.uniqcode = tbl_women_accessories.category_id', 'inner');
       $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = tbl_women_accessories.sub_category_id', 'inner');
        $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = tbl_women_accessories.child_category_id', 'inner');
        $this->db->join('tbl_admin', 'tbl_admin.uniqcode = tbl_women_accessories.admin_id', 'inner');
        $this->db->where('tbl_category.status','Active');
        $this->db->where('tbl_sub_category.status','Active');
        $this->db->where('tbl_child_category.status','Active');
        $this->db->where('tbl_women_accessories.status','Active');
        $this->db->where('tbl_women_accessories.super_admin_status','Active');
        $this->db->where('tbl_admin.status','Active');
        $this->db->limit($limit);
        $query7 = $this->db->get();
        $data= array_merge($data,$query7->result());

        $this->db->select('tbl_women_clothing.admin_id,tbl_admin.shop_name,tbl_women_clothing.uniqcode,tbl_women_clothing.category_id,tbl_women_clothing.sub_category_id,tbl_women_clothing.name,tbl_women_clothing.images,tbl_women_clothing.mrp_price,tbl_women_clothing.sell_price,tbl_women_clothing.image_link,(((tbl_women_clothing.mrp_price-tbl_women_clothing.sell_price)*100)/tbl_women_clothing.mrp_price) as discount,tbl_sub_category.table_name');
        $this->db->from('tbl_women_clothing');
        $this->db->join('tbl_category', 'tbl_category.uniqcode = tbl_women_clothing.category_id', 'inner');
       $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = tbl_women_clothing.sub_category_id', 'inner');
        $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = tbl_women_clothing.child_category_id', 'inner');
        $this->db->join('tbl_admin', 'tbl_admin.uniqcode = tbl_women_clothing.admin_id', 'inner');
        $this->db->where('tbl_category.status','Active');
        $this->db->where('tbl_sub_category.status','Active');
        $this->db->where('tbl_child_category.status','Active');
        $this->db->where('tbl_women_clothing.status','Active');
        $this->db->where('tbl_women_clothing.super_admin_status','Active');
        $this->db->where('tbl_admin.status','Active');
        $this->db->limit($limit);
        $query8 = $this->db->get();
        $data= array_merge($data,$query8->result());

        $this->db->select('tbl_women_shoes.admin_id,tbl_admin.shop_name,tbl_women_shoes.uniqcode,tbl_women_shoes.category_id,tbl_women_shoes.sub_category_id,tbl_women_shoes.name,tbl_women_shoes.images,tbl_women_shoes.mrp_price,tbl_women_shoes.sell_price,tbl_women_shoes.image_link,(((tbl_women_shoes.mrp_price-tbl_women_shoes.sell_price)*100)/tbl_women_shoes.mrp_price) as discount,tbl_sub_category.table_name');
        $this->db->from('tbl_women_shoes');
        $this->db->join('tbl_category', 'tbl_category.uniqcode = tbl_women_shoes.category_id', 'inner');
       $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = tbl_women_shoes.sub_category_id', 'inner');
        $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = tbl_women_shoes.child_category_id', 'inner');
        $this->db->join('tbl_admin', 'tbl_admin.uniqcode = tbl_women_shoes.admin_id', 'inner');
        $this->db->where('tbl_category.status','Active');
        $this->db->where('tbl_sub_category.status','Active');
        $this->db->where('tbl_child_category.status','Active');
        $this->db->where('tbl_women_shoes.status','Active');
        $this->db->where('tbl_women_shoes.super_admin_status','Active');
        $this->db->where('tbl_admin.status','Active');
        $this->db->limit($limit);
        $query9 = $this->db->get();
        $data= array_merge($data,$query9->result());

        $this->db->select('tbl_hand_care.admin_id,tbl_admin.shop_name,tbl_hand_care.uniqcode,tbl_hand_care.category_id,tbl_hand_care.sub_category_id,tbl_hand_care.name,tbl_hand_care.images,tbl_hand_care.mrp_price,tbl_hand_care.sell_price,tbl_hand_care.image_link,(((tbl_hand_care.mrp_price-tbl_hand_care.sell_price)*100)/tbl_hand_care.mrp_price) as discount,tbl_sub_category.table_name');
        $this->db->from('tbl_hand_care');
        $this->db->join('tbl_category', 'tbl_category.uniqcode = tbl_hand_care.category_id', 'inner');
       $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = tbl_hand_care.sub_category_id', 'inner');
        $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = tbl_hand_care.child_category_id', 'inner');
        $this->db->join('tbl_admin', 'tbl_admin.uniqcode = tbl_hand_care.admin_id', 'inner');
        $this->db->where('tbl_category.status','Active');
        $this->db->where('tbl_sub_category.status','Active');
        $this->db->where('tbl_child_category.status','Active');
        $this->db->where('tbl_hand_care.status','Active');
        $this->db->where('tbl_hand_care.super_admin_status','Active');
        $this->db->where('tbl_admin.status','Active');
        $this->db->limit($limit);
        $query9 = $this->db->get();
        $data= array_merge($data,$query9->result());

        $this->db->select('tbl_personal_care.admin_id,tbl_admin.shop_name,tbl_personal_care.uniqcode,tbl_personal_care.category_id,tbl_personal_care.sub_category_id,tbl_personal_care.name,tbl_personal_care.images,tbl_personal_care.mrp_price,tbl_personal_care.sell_price,tbl_personal_care.image_link,(((tbl_personal_care.mrp_price-tbl_personal_care.sell_price)*100)/tbl_personal_care.mrp_price) as discount,tbl_sub_category.table_name');
        $this->db->from('tbl_personal_care');
        $this->db->join('tbl_category', 'tbl_category.uniqcode = tbl_personal_care.category_id', 'inner');
       $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = tbl_personal_care.sub_category_id', 'inner');
        $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = tbl_personal_care.child_category_id', 'inner');
        $this->db->join('tbl_admin', 'tbl_admin.uniqcode = tbl_personal_care.admin_id', 'inner');
        $this->db->where('tbl_category.status','Active');
        $this->db->where('tbl_sub_category.status','Active');
        $this->db->where('tbl_child_category.status','Active');
        $this->db->where('tbl_personal_care.status','Active');
        $this->db->where('tbl_personal_care.super_admin_status','Active');
        $this->db->where('tbl_admin.status','Active');
        $this->db->limit($limit);
        $query9 = $this->db->get();
        $data= array_merge($data,$query9->result());
        return $data;

    }

    public function price_low_and_high($limit)
    {
        
        $this->db->select('tbl_men_accessories.admin_id,tbl_admin.shop_name,tbl_men_accessories.uniqcode,tbl_men_accessories.category_id,tbl_men_accessories.sub_category_id,tbl_men_accessories.name,tbl_men_accessories.images,tbl_men_accessories.mrp_price,tbl_men_accessories.sell_price,tbl_men_accessories.image_link,tbl_sub_category.table_name');
        $this->db->from('tbl_men_accessories');
        $this->db->join('tbl_category', 'tbl_category.uniqcode= tbl_men_accessories.category_id', 'inner');
        $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = tbl_men_accessories.sub_category_id', 'inner');
        $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = tbl_men_accessories.child_category_id', 'inner');
        $this->db->join('tbl_admin', 'tbl_admin.uniqcode = tbl_men_accessories.admin_id', 'inner');
        $this->db->where('tbl_category.status','Active');
        $this->db->where('tbl_sub_category.status','Active');
        $this->db->where('tbl_child_category.status','Active');
        $this->db->where('tbl_men_accessories.status','Active');
        $this->db->where('tbl_men_accessories.super_admin_status','Active');
        $this->db->where('tbl_admin.status','Active');
        $this->db->order_by('tbl_men_accessories.sell_price', 'asc');
        $this->db->limit($limit);
        $query1 = $this->db->get();
        $data= $query1->result();

        $this->db->select('tbl_men_clothing.admin_id,tbl_admin.shop_name,tbl_men_clothing.uniqcode,tbl_men_clothing.category_id,tbl_men_clothing.sub_category_id,tbl_men_clothing.name,tbl_men_clothing.images,tbl_men_clothing.mrp_price,tbl_men_clothing.sell_price,tbl_men_clothing.image_link,tbl_sub_category.table_name');
        $this->db->from('tbl_men_clothing');
        $this->db->join('tbl_category', 'tbl_category.uniqcode= tbl_men_clothing.category_id', 'inner');
        $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = tbl_men_clothing.sub_category_id', 'inner');
        $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = tbl_men_clothing.child_category_id', 'inner');
        $this->db->join('tbl_admin', 'tbl_admin.uniqcode = tbl_men_clothing.admin_id', 'inner');
        $this->db->where('tbl_category.status','Active');
        $this->db->where('tbl_sub_category.status','Active');
        $this->db->where('tbl_child_category.status','Active');
        $this->db->where('tbl_men_clothing.status','Active');
        $this->db->where('tbl_men_clothing.super_admin_status','Active');
        $this->db->where('tbl_admin.status','Active');
        $this->db->order_by('tbl_men_clothing.sell_price', 'asc');
        $this->db->limit($limit);
        $query2 = $this->db->get();
        $data= array_merge($data,$query2->result());

        $this->db->select('tbl_men_shoes.admin_id,tbl_admin.shop_name,tbl_men_shoes.uniqcode,tbl_men_shoes.category_id,tbl_men_shoes.sub_category_id,tbl_men_shoes.name,tbl_men_shoes.images,tbl_men_shoes.mrp_price,tbl_men_shoes.sell_price,tbl_men_shoes.image_link,tbl_sub_category.table_name');
        $this->db->from('tbl_men_shoes');
        $this->db->join('tbl_category', 'tbl_category.uniqcode= tbl_men_shoes.category_id', 'inner');
        $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = tbl_men_shoes.sub_category_id', 'inner');
        $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = tbl_men_shoes.child_category_id', 'inner');
        $this->db->join('tbl_admin', 'tbl_admin.uniqcode = tbl_men_shoes.admin_id', 'inner');
        $this->db->where('tbl_category.status','Active');
        $this->db->where('tbl_sub_category.status','Active');
        $this->db->where('tbl_child_category.status','Active');
        $this->db->where('tbl_men_shoes.status','Active');
        $this->db->where('tbl_men_shoes.super_admin_status','Active');
        $this->db->where('tbl_admin.status','Active');
        $this->db->order_by('tbl_men_shoes.sell_price', 'asc');
        $this->db->limit($limit);
        $query3 = $this->db->get();
        $data= array_merge($data,$query3->result());

        $this->db->select('tbl_kid_accessories.admin_id,tbl_admin.shop_name,tbl_kid_accessories.uniqcode,tbl_kid_accessories.category_id,tbl_kid_accessories.sub_category_id,tbl_kid_accessories.name,tbl_kid_accessories.images,tbl_kid_accessories.mrp_price,tbl_kid_accessories.sell_price,tbl_kid_accessories.image_link,tbl_sub_category.table_name');
        $this->db->from('tbl_kid_accessories');
        $this->db->join('tbl_category', 'tbl_category.uniqcode = tbl_kid_accessories.category_id', 'inner');
       $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = tbl_kid_accessories.sub_category_id', 'inner');
        $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = tbl_kid_accessories.child_category_id', 'inner');
        $this->db->join('tbl_admin', 'tbl_admin.uniqcode = tbl_kid_accessories.admin_id', 'inner');
        $this->db->where('tbl_category.status','Active');
        $this->db->where('tbl_sub_category.status','Active');
        $this->db->where('tbl_child_category.status','Active');
        $this->db->where('tbl_kid_accessories.status','Active');
        $this->db->where('tbl_kid_accessories.super_admin_status','Active');
        $this->db->where('tbl_admin.status','Active');
        $this->db->order_by('tbl_kid_accessories.sell_price', 'asc');
        $this->db->limit($limit);
        $query4 = $this->db->get();
        $data= array_merge($data,$query4->result());


         $this->db->select('tbl_kid_clothing.admin_id,tbl_admin.shop_name,tbl_kid_clothing.uniqcode,tbl_kid_clothing.category_id,tbl_kid_clothing.sub_category_id,tbl_kid_clothing.name,tbl_kid_clothing.images,tbl_kid_clothing.mrp_price,tbl_kid_clothing.sell_price,tbl_kid_clothing.image_link,tbl_sub_category.table_name');
        $this->db->from('tbl_kid_clothing');
        $this->db->join('tbl_category', 'tbl_category.uniqcode = tbl_kid_clothing.category_id', 'inner');
       $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = tbl_kid_clothing.sub_category_id', 'inner');
        $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = tbl_kid_clothing.child_category_id', 'inner');
        $this->db->join('tbl_admin', 'tbl_admin.uniqcode = tbl_kid_clothing.admin_id', 'inner');
        $this->db->where('tbl_category.status','Active');
        $this->db->where('tbl_sub_category.status','Active');
        $this->db->where('tbl_child_category.status','Active');
        $this->db->where('tbl_kid_clothing.status','Active');
        $this->db->where('tbl_kid_clothing.super_admin_status','Active');
        $this->db->where('tbl_admin.status','Active');
        $this->db->order_by('tbl_kid_clothing.sell_price', 'asc');
        $this->db->limit($limit);
        $query5 = $this->db->get();
        $data= array_merge($data,$query5->result());


        $this->db->select('tbl_kid_shoes.admin_id,tbl_admin.shop_name,tbl_kid_shoes.uniqcode,tbl_kid_shoes.category_id,tbl_kid_shoes.sub_category_id,tbl_kid_shoes.name,tbl_kid_shoes.images,tbl_kid_shoes.mrp_price,tbl_kid_shoes.sell_price,tbl_kid_shoes.image_link,tbl_sub_category.table_name');
        $this->db->from('tbl_kid_shoes');
        $this->db->join('tbl_category', 'tbl_category.uniqcode = tbl_kid_shoes.category_id', 'inner');
       $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = tbl_kid_shoes.sub_category_id', 'inner');
        $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = tbl_kid_shoes.child_category_id', 'inner');
        $this->db->join('tbl_admin', 'tbl_admin.uniqcode = tbl_kid_shoes.admin_id', 'inner');
        $this->db->where('tbl_category.status','Active');
        $this->db->where('tbl_sub_category.status','Active');
        $this->db->where('tbl_child_category.status','Active');
        $this->db->where('tbl_kid_shoes.status','Active');
        $this->db->where('tbl_kid_shoes.super_admin_status','Active');
        $this->db->where('tbl_admin.status','Active');
        $this->db->order_by('tbl_kid_shoes.sell_price', 'asc');
        $this->db->limit($limit);
        $query6 = $this->db->get();
        $data= array_merge($data,$query6->result());


        $this->db->select('tbl_women_accessories.admin_id,tbl_admin.shop_name,tbl_women_accessories.uniqcode,tbl_women_accessories.category_id,tbl_women_accessories.sub_category_id,tbl_women_accessories.name,tbl_women_accessories.images,tbl_women_accessories.mrp_price,tbl_women_accessories.sell_price,tbl_women_accessories.image_link,tbl_sub_category.table_name');
        $this->db->from('tbl_women_accessories');
        $this->db->join('tbl_category', 'tbl_category.uniqcode = tbl_women_accessories.category_id', 'inner');
       $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = tbl_women_accessories.sub_category_id', 'inner');
        $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = tbl_women_accessories.child_category_id', 'inner');
        $this->db->join('tbl_admin', 'tbl_admin.uniqcode = tbl_women_accessories.admin_id', 'inner');
        $this->db->where('tbl_category.status','Active');
        $this->db->where('tbl_sub_category.status','Active');
        $this->db->where('tbl_child_category.status','Active');
        $this->db->where('tbl_women_accessories.status','Active');
        $this->db->where('tbl_women_accessories.super_admin_status','Active');
        $this->db->where('tbl_admin.status','Active');
        $this->db->order_by('tbl_women_accessories.sell_price', 'asc');
        $this->db->limit($limit);
        $query7 = $this->db->get();
        $data= array_merge($data,$query7->result());

        $this->db->select('tbl_women_clothing.admin_id,tbl_admin.shop_name,tbl_women_clothing.uniqcode,tbl_women_clothing.category_id,tbl_women_clothing.sub_category_id,tbl_women_clothing.name,tbl_women_clothing.images,tbl_women_clothing.mrp_price,tbl_women_clothing.sell_price,tbl_women_clothing.image_link,tbl_sub_category.table_name');
        $this->db->from('tbl_women_clothing');
        $this->db->join('tbl_category', 'tbl_category.uniqcode = tbl_women_clothing.category_id', 'inner');
       $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = tbl_women_clothing.sub_category_id', 'inner');
        $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = tbl_women_clothing.child_category_id', 'inner');
        $this->db->join('tbl_admin', 'tbl_admin.uniqcode = tbl_women_clothing.admin_id', 'inner');
        $this->db->where('tbl_category.status','Active');
        $this->db->where('tbl_sub_category.status','Active');
        $this->db->where('tbl_child_category.status','Active');
        $this->db->where('tbl_women_clothing.status','Active');
        $this->db->where('tbl_women_clothing.super_admin_status','Active');
        $this->db->where('tbl_admin.status','Active');
        $this->db->order_by('tbl_women_clothing.sell_price', 'asc');
        $this->db->limit($limit);
        $query8 = $this->db->get();
        $data= array_merge($data,$query8->result());


        $this->db->select('tbl_women_shoes.admin_id,tbl_admin.shop_name,tbl_women_shoes.uniqcode,tbl_women_shoes.category_id,tbl_women_shoes.sub_category_id,tbl_women_shoes.name,tbl_women_shoes.images,tbl_women_shoes.mrp_price,tbl_women_shoes.sell_price,tbl_women_shoes.image_link,tbl_sub_category.table_name');
        $this->db->from('tbl_women_shoes');
        $this->db->join('tbl_category', 'tbl_category.uniqcode = tbl_women_shoes.category_id', 'inner');
       $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = tbl_women_shoes.sub_category_id', 'inner');
        $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = tbl_women_shoes.child_category_id', 'inner');
        $this->db->join('tbl_admin', 'tbl_admin.uniqcode = tbl_women_shoes.admin_id', 'inner');
        $this->db->where('tbl_category.status','Active');
        $this->db->where('tbl_sub_category.status','Active');
        $this->db->where('tbl_child_category.status','Active');
        $this->db->where('tbl_women_shoes.status','Active');
        $this->db->where('tbl_women_shoes.super_admin_status','Active');
        $this->db->where('tbl_admin.status','Active');
        $this->db->order_by('tbl_women_shoes.sell_price', 'asc');
        $this->db->limit($limit);
        $query9 = $this->db->get();
        $data= array_merge($data,$query9->result());

        $this->db->select('tbl_personal_care.admin_id,tbl_admin.shop_name,tbl_personal_care.uniqcode,tbl_personal_care.category_id,tbl_personal_care.sub_category_id,tbl_personal_care.name,tbl_personal_care.images,tbl_personal_care.mrp_price,tbl_personal_care.sell_price,tbl_personal_care.image_link,tbl_sub_category.table_name');
        $this->db->from('tbl_personal_care');
        $this->db->join('tbl_category', 'tbl_category.uniqcode = tbl_personal_care.category_id', 'inner');
       $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = tbl_personal_care.sub_category_id', 'inner');
        $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = tbl_personal_care.child_category_id', 'inner');
        $this->db->join('tbl_admin', 'tbl_admin.uniqcode = tbl_personal_care.admin_id', 'inner');
        $this->db->where('tbl_category.status','Active');
        $this->db->where('tbl_sub_category.status','Active');
        $this->db->where('tbl_child_category.status','Active');
        $this->db->where('tbl_personal_care.status','Active');
        $this->db->where('tbl_personal_care.super_admin_status','Active');
        $this->db->where('tbl_admin.status','Active');
        $this->db->order_by('tbl_personal_care.sell_price', 'asc');
        $this->db->limit($limit);
        $query9 = $this->db->get();
        $data= array_merge($data,$query9->result());

        $this->db->select('tbl_hand_care.admin_id,tbl_admin.shop_name,tbl_hand_care.uniqcode,tbl_hand_care.category_id,tbl_hand_care.sub_category_id,tbl_hand_care.name,tbl_hand_care.images,tbl_hand_care.mrp_price,tbl_hand_care.sell_price,tbl_hand_care.image_link,tbl_sub_category.table_name');
        $this->db->from('tbl_hand_care');
        $this->db->join('tbl_category', 'tbl_category.uniqcode = tbl_hand_care.category_id', 'inner');
       $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = tbl_hand_care.sub_category_id', 'inner');
        $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = tbl_hand_care.child_category_id', 'inner');
        $this->db->join('tbl_admin', 'tbl_admin.uniqcode = tbl_hand_care.admin_id', 'inner');
        $this->db->where('tbl_category.status','Active');
        $this->db->where('tbl_sub_category.status','Active');
        $this->db->where('tbl_child_category.status','Active');
        $this->db->where('tbl_hand_care.status','Active');
        $this->db->where('tbl_hand_care.super_admin_status','Active');
        $this->db->where('tbl_admin.status','Active');
        $this->db->order_by('tbl_hand_care.sell_price', 'asc');
        $this->db->limit($limit);
        $query9 = $this->db->get();
        $data= array_merge($data,$query9->result());

        return $data;
    }

    public function category_all_num_rows($sub_category_id,$child_category_id)
    {
      
        
    }

    public function range_slider_all_num_rows($sub_category_id,$child_category_id,$rangestart,$rangeend)
    {
        $this->db->select('table_name');
        $this->db->where('status','Active');
        $this->db->where('uniqcode',$sub_category_id);
      
        $data = $this->db->get('tbl_sub_category')->row();
        if(!empty($data))
        {
            $this->db->select($data->table_name.'.admin_id,tbl_admin.shop_name,'.$data->table_name.'.uniqcode,'.$data->table_name.'.category_id,'.$data->table_name.'.sub_category_id,'.$data->table_name.'.name,'.$data->table_name.'.images,'.$data->table_name.'.mrp_price,'.$data->table_name.'.sell_price,'.$data->table_name.'.image_link,tbl_sub_category.table_name');
            $this->db->join('tbl_category', 'tbl_category.uniqcode = '.$data->table_name.'.category_id', 'inner');
            $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = '.$data->table_name.'.sub_category_id', 'inner');
            $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = '.$data->table_name.'.child_category_id', 'inner');
            $this->db->join('tbl_admin', 'tbl_admin.uniqcode = '.$data->table_name.'.admin_id', 'inner');
            $this->db->where('tbl_category.status','Active');
            $this->db->where('tbl_sub_category.status','Active');
            $this->db->where('tbl_child_category.status','Active');
            $this->db->where($data->table_name.'.status','Active');
            $this->db->where($data->table_name.'.super_admin_status','Active');
            $this->db->where('tbl_admin.status','Active');
            $this->db->where($data->table_name.'.child_category_id',$child_category_id);
            $this->db->where($data->table_name.'.sell_price>=', $rangestart);
            $this->db->where($data->table_name.'.sell_price<=', $rangeend);
            $data = $this->db->get($data->table_name)->num_rows();
            return $data;
        }
        else
        {
            return false;
        }  
    }
    public function range_slider($sub_category_id,$child_category_id,$rangestart,$rangeend,$limit,$start)
    {
        $this->db->select('table_name');
        $this->db->where('status','Active');
        $this->db->where('uniqcode',$sub_category_id);
      
        $data = $this->db->get('tbl_sub_category')->row();
        if(!empty($data))
        {
            $this->db->select($data->table_name.'.admin_id,tbl_admin.shop_name,'.$data->table_name.'.uniqcode,'.$data->table_name.'.category_id,'.$data->table_name.'.sub_category_id,'.$data->table_name.'.name,'.$data->table_name.'.images,'.$data->table_name.'.mrp_price,'.$data->table_name.'.sell_price,'.$data->table_name.'.image_link,tbl_sub_category.table_name');
            $this->db->join('tbl_category', 'tbl_category.uniqcode = '.$data->table_name.'.category_id', 'inner');
            $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = '.$data->table_name.'.sub_category_id', 'inner');
            $this->db->join('tbl_child_category', 'tbl_child_category.uniqcode = '.$data->table_name.'.child_category_id', 'inner');
            $this->db->join('tbl_admin', 'tbl_admin.uniqcode = '.$data->table_name.'.admin_id', 'inner');
            $this->db->where('tbl_category.status','Active');
            $this->db->where('tbl_sub_category.status','Active');
            $this->db->where('tbl_child_category.status','Active');
            $this->db->where($data->table_name.'.status','Active');
            $this->db->where($data->table_name.'.super_admin_status','Active');
            $this->db->where('tbl_admin.status','Active');
            $this->db->where($data->table_name.'.child_category_id',$child_category_id);
            $this->db->where($data->table_name.'.sell_price>=', $rangestart);
            $this->db->where($data->table_name.'.sell_price<=', $rangeend);
            $this->db->limit($limit, $start);
            $data = $this->db->get($data->table_name)->result();
            return $data;
        }
        else
        {
            return false;
        }  
    }

}
