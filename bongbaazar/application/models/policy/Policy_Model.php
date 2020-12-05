

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Policy_Model extends CI_Model
{
    public function policy_get_row($where,$table)
    {
        $this->db->select('description');
        $this->db->from($table);
        $this->db->where($where);
        $data = $this->db->get()->row();
        return $data;
    }

}
