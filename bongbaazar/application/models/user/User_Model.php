<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Model extends CI_Model
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

    public function all_state($data,$table)
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

	public function update($table,$data,$dataChange)
	{
		$this->db->where($data);
			$this->db->update($table, $dataChange);
			//$qur="SELECT * from $table where `type`='student' ORDER BY `id` ASC";
			
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

	public function entty_check($where,$table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where($where);
        $count_row = $this->db->get()->num_rows();
        return $count_row;
    }

    public function wishlist($spid)
    {
    	$sp=explode("_",$spid);
		$this->db->select('table_name');
        $this->db->where('status','Active');
        $this->db->where('uniqcode',$sp[0]);
        $data = $this->db->get('tbl_sub_category')->row();
        //pr($data);
        if(!empty($data))
        {
            $this->db->select($data->table_name.'.*');
                $this->db->from($data->table_name);
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
                $this->db->where($data->table_name.'.uniqcode',$sp[1]);
                $data = $this->db->get()->row();
                return $data;

        }
        else
        {
            return false;
        }
    }

    public function check_wishlist($product_id,$product_features_id,$user_id)
    {
        $this->db->where('product_id',$product_id);
        $this->db->where('user_id',$user_id);
        $this->db->where('product_features_id',$product_features_id);
        $this->db->from('tbl_wishlist');
        $count_row = $this->db->get()->num_rows();
        return $count_row;
    }

    public function user_wishlist($user_id)
    {
        $this->db->select('view_products.admin_id,view_products.admin_name,view_products.product_uniqcode,view_products.product_name,view_products.image, view_products.mrp_price,view_products.sell_price,view_products.discount,view_products.uniqcode,view_products.product_type,view_products.color,view_products.slug,tbl_color.color_name');
            $this->db->from('tbl_wishlist');
            $this->db->join('view_products', 'view_products.uniqcode = tbl_wishlist.product_features_id', 'inner');
            $this->db->join('tbl_category', 'tbl_category.uniqcode= view_products.category_id', 'inner');
            $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = view_products.sub_category_id', 'inner');
            $this->db->join('tbl_child_category','tbl_child_category.uniqcode = view_products.child_category_id','inner');
            $this->db->join('tbl_color','tbl_color.uniqcode = view_products.color','inner');
            $this->db->where('tbl_category.status', 'Active');
            $this->db->where('tbl_sub_category.status', 'Active');
            $this->db->where('tbl_child_category.status', 'Active');
            $this->db->where('view_products.status', 'Active');
            $this->db->where('view_products.super_admin_status', 'Active');
            $this->db->where('view_products.admin_status', 'Active');
            $this->db->where('tbl_wishlist.user_id', $user_id);
            $query = $this->db->get();
            return $query->result();
    }
    public function checkOtp($user_id,$otp)
    {
       
        $count_row = $this->db->query("SELECT * FROM `tbl_users` WHERE (`email` = '".$user_id."' OR `mobile_no` = '".$user_id."') AND `otp` = '".$otp."' AND `status` = 'Active'");
        $result = $count_row->num_rows();
        return $result; 
    }
    public function update_password($table,$user_id,$password)
    {
        $this->db->query("UPDATE ".$table."  SET `password`='".$password."' WHERE `mobile_no`='".$user_id."' or `email`='".$user_id."'");  
        return 1;  
    }

    public function review_check($order_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_review');
        $this->db->where('order_id',$order_id);
        $result=$this->db->get();
        return $result->row();
    }
    public function user_wallet($user_id)
    {
        $wallet_details=array();
        $this->db->where('user_id',$user_id);
        $data=$this->db->get('tbl_wallet_details')->row();
        $this->db->where('user_id',$user_id);
        $this->db->order_by('id','DESC');
        $data1=$this->db->get('tbl_wallet_transaction')->result();
        $wallet_details['wallet']= $data;
        $wallet_details['wallet_transaction']= $data1;
        return $wallet_details;
    }
}
