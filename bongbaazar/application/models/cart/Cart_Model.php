<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_Model extends CI_Model
{
    
	public function get_cartItem($user_id)
	{
		$this->db->select('view_products.product_name,view_products.product_type,tbl_cart.uniqcode,tbl_cart.product_id,tbl_cart.product_features_id,tbl_cart.quantity,view_products.admin_id,view_products.admin_name,view_products.sell_price,view_products.mrp_price,view_products.discount,view_products.image,view_products.size,tbl_cart.color,view_products.slug');
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


	public function get_buyCartItem($user_id)
	{
		$this->db->select('view_products.product_name,view_products.product_type,tbl_cart.uniqcode,tbl_cart.product_id,tbl_cart.product_features_id,tbl_cart.quantity,view_products.admin_id,view_products.admin_name,view_products.sell_price,view_products.mrp_price,view_products.discount,view_products.image,view_products.size,tbl_cart.color,view_products.slug');
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

    public function get_size($uniqcode)
    { 
        $this->db->select();
        $this->db->where('uniqcode',$uniqcode);
        $this->db->from('tbl_size');
        return $this->db->get()->row()->size_name;
    }
    
    public function get_color($uniqcode)
    { 
        $this->db->select();
        $this->db->where('uniqcode',$uniqcode);
        $this->db->from('tbl_color');
        return $this->db->get()->row()->color_name;
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

	public function update($table,$where,$data)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
			
		if($this->db->affected_rows())
		{
			return true;
		}
		else{
			 return false;
		}   
	}

	public function delete($data,$table)
	{
		$this->db->where($data);
		$this->db->delete($table);
		if($this->db->affected_rows())
		{
			return true;
		}
		else{
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
    public function selectrow($data,$table)
	{
		$data=$this->db->where($data)
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
	
}
