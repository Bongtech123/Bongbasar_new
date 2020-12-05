<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner_Model extends CI_Model
{
	
	public function banner_getRows($table)    
    {
        $current_date=date('Y-m-d');
        $this->db->select('uniqcode,image');
        $this->db->where('status','Active');
        $this->db->where('date(from_date)<=',$current_date);
        $this->db->where('date(to_date)>=',$current_date);
        $this->db->or_where('to_date','Lifetime');
        $this->db->order_by('serial_no');
        $query = $this->db->get($table);
        return $query->result();
    }
}
