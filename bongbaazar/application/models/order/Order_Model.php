<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_Model extends CI_Model
{
	
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
	

	public function select_all($data,$table)
	{
		$data=$this->db->where($data)
				->from($table)
				->get()->result();
		if(!empty($data))
		{
				
		 	return $data;
				
		}
		else
		{
		 	return false;
		}
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
	public function entty_check($data,$table)
	{
		$this->db->where($data);
		$query = $this->db->get($table);		
    	$count_row = $query->num_rows();
    	return $count_row;
	}

	public function user_orders($user_id)
	{
		$this->db->select('tbl_order.order_code,cast(tbl_order.order_date as Date) as order_date,cast(tbl_order.delivery_date as Date) as delivery_date,sum(tbl_order.sell_price*tbl_order.quantity) as sell_price,sum(tbl_order.mrp_price*tbl_order.quantity) as mrp_price,sum(tbl_order.shipping_price*tbl_order.quantity) as shipping_price,tbl_order.address,tbl_users.name as order_from,count(order_code) as count,view_products.image');
        $this->db->from('tbl_order');
        $this->db->join('view_products', 'view_products.uniqcode = tbl_order.product_features_id', 'inner');
        $this->db->join('tbl_users', 'tbl_users.uniqcode = tbl_order.user_id', 'inner');

        $this->db->where('tbl_order.order_status','Pending');
        $this->db->where('tbl_order.user_id',$user_id);
        $this->db->group_by('tbl_order.order_code');
        $this->db->order_by('tbl_order.order_date','DESC');
        $query = $this->db->get();
        return $query->result();
	}

	public function user_orders_details($user_id,$order_code)
	{
		$this->db->select('tbl_order.order_code,cast(tbl_order.order_date as Date) as order_date,cast(tbl_order.delivery_date as Date) as delivery_date,sum(tbl_order.sell_price*tbl_order.quantity) as sell_price,sum(tbl_order.mrp_price*tbl_order.quantity) as mrp_price,sum(tbl_order.shipping_price*tbl_order.quantity) as shipping_price,tbl_order.address,tbl_users.name as order_from,count(order_code) as count,view_products.image');
        $this->db->from('tbl_order');
        $this->db->join('view_products', 'view_products.uniqcode = tbl_order.product_features_id', 'inner');
        $this->db->join('tbl_users', 'tbl_users.uniqcode = tbl_order.user_id', 'inner');
        $this->db->where('tbl_order.order_status','Pending');
        $this->db->where('tbl_order.user_id',$user_id);
        $this->db->where('tbl_order.order_code',$order_code);
        $this->db->order_by('tbl_order.order_date','DESC');
        $query = $this->db->get();
        return $query->result();
	}

	public function user_bag_total($user_id,$order_code)
	{
		$this->db->select('
			SUM((tbl_order.sell_price*tbl_order.quantity)) as total_sale_amount,
			SUM((tbl_order.delivery_price*tbl_order.quantity)) as total_delivery_amount,
			SUM((tbl_order.sell_price*tbl_order.quantity)+(tbl_order.delivery_price*tbl_order.quantity)) as total_amount
			');
		$this->db->from('tbl_order');
		$this->db->where('tbl_order.order_code',$order_code);
		$this->db->where('tbl_order.status<>','cancel');
		// $this->db->group_by('tbl_order.order_code');
        return $this->db->get()->row();  
	}

	public function user_delivery_item($user_id,$order_code)
	{
		$this->db->select('tbl_order.*,view_products.product_name,view_products.product_type,
		view_products.admin_id,view_products.admin_name,view_products.business_type,view_products.image,view_products.slug,
		view_products.description,tbl_color.color_name,tbl_size.size_name');
            $this->db->from('tbl_order');
			$this->db->join('view_products', 'view_products.uniqcode = tbl_order.product_features_id', 'inner');
			$this->db->join('tbl_color', 'tbl_color.uniqcode = tbl_order.color', 'inner');
			$this->db->join('tbl_size', 'tbl_size.uniqcode = tbl_order.size', 'inner');
			
            $this->db->where('tbl_order.order_code',$order_code);
            $data = $this->db->get()->result();                 
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
        $this->db->select('tbl_users_delivery_address.state');
        $this->db->from('tbl_users_delivery_address');
        $this->db->where('tbl_users_delivery_address.status','Active');
        $this->db->where('tbl_users_delivery_address.uniqcode',$uniqcode);
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

}
