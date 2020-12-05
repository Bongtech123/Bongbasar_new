<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Model extends CI_Model
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
	public function insert($table,$data)
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

	
	
}
