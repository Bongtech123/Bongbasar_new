<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Address_Model extends CI_Model
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

	public function update($table,$where,$data)
	{
		$this->db->where($where);
			$this->db->update($table, $data);
			//$qur="SELECT * from $table where `type`='student' ORDER BY `id` ASC";
			
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

	public function entty_check($data,$table)
	{
		$this->db->where($data);
		$query = $this->db->get($table);		
    	$count_row = $query->num_rows();
    	return $count_row;
	}

	public function user_address($user_id,$table)
    {
    		$this->db->select();
    		$this->db->from($table);
    		$this->db->where('user_id',$user_id);
    		$this->db->where('status','Active');
    		$all_address=$this->db->get()->result();
    		return $all_address;

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
	
}
