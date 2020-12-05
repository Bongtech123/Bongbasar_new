<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Size_Model extends CI_Model
{
	
    public function size($uniqcode)
    {
    	$this->db->select('uniqcode,size_name');
        $this->db->where('status','Active');
        $this->db->where('uniqcode', $uniqcode);
        $size = $this->db->get('tbl_size')->row();
        //pr($size);
        return $size;      
            // $all_size=array();
            // $data=array();


            // $image_all=unserialize($size);
            
            // for($i=0;$i<count($image_all);$i++){

            //     $all_size[$i]=chop($image_all[$i],"##");
            // }
            // $all_size=array_unique($all_size);


            
            // foreach($all_size as $all_size_row)
            // {
                
            //     $this->db->select('tbl_size.uniqcode,tbl_size.size_name');
            //     $this->db->from('tbl_size');
            //     $this->db->join('tbl_category', 'tbl_category.uniqcode = tbl_size.category_id', 'inner');
            //     $this->db->join('tbl_sub_category', 'tbl_sub_category.uniqcode = tbl_size.sub_category_id', 'inner');
            //     $this->db->where('tbl_size.uniqcode',$all_size_row);
            //     $this->db->where('tbl_size.status','Active');
            //     $this->db->where('tbl_category.status','Active');
            //     $this->db->where('tbl_sub_category.status','Active');

            //     $query1=$this->db->get();
            //     $data= array_merge($data,$query1->result());
            // }

            //return $data; 
    }

	
	
}
